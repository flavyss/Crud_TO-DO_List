<?php
session_start();
require_once("backend/conection/conection.php");
require_once("backend/verify.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idTarefa = $_POST["id"];
    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];

    $sql = "UPDATE tarefas SET titulo = ?, descricao = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssi', $titulo, $descricao, $idTarefa);
    
    if ($stmt->execute()) {
        header("Location: ../index.php");
        exit();
    } else {
        echo "<script>alert('Erro ao atualizar a tarefa.')</script>";
    }

    $stmt->close();
}

$idTarefa = $_GET["id"];
$idUsuario = $_SESSION["id_user"];

$sql = "SELECT titulo, descricao FROM tarefas WHERE id = ? AND id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $idTarefa, $idUsuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: ../index.php");
    exit();
}

$tarefa = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Document</title>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Flavyss">
    <meta name="description" content="projeto portifolio">
    <meta name="keyords" content="aula,projeto,portifolio">
    <meta name="robots" content="index">

    <link rel="stylesheet" href="src/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="src/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="src/css/nova.css">

    <script src="https://kit.fontawesome.com/c49e0b56e6.js" crossorigin="anonymous"></script>

</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <a href="index.php" class="img">
                    <img src="src/images/logo.png" alt="">
                </a>
            </div>
            <nav class="menuDesktop">
                <ul>
                    <li><a href="index.php">Lista</a></li>
                    <li><a href="nova.php">Nova tarefa</a></li>
                    <li><a href="backend/logout.php">Sair</a></li>
                </ul>
            </nav>
            <nav class="menuMobile">
                <h2 class="disp"><i class="fa-solid fa-bars"></i></h2>
                <ul>
                    <h2 class="fecha"><i class="fa-regular fa-circle-xmark"></i></h2>
                    <li><a href="index.php">Lista</a></li>
                    <li><a href="nova.php">Nova tarefa</a></li>
                    <li><a href="backend/logout.php">Sair</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="cadastro">
        <div class="container">
            <h1>Editar Tarefa</h1>
            <form method="post">
                <input type="hidden" name="id" value="<?php echo $idTarefa; ?>">
                <div class="w100">
                    <p>Título:</p>
                    <input type="text" id="titulo" name="titulo" value="<?php echo $tarefa['titulo']; ?>" required>
                </div>
                <div class="w100">
                    <p>Descrição:</p>
                    <textarea id="descricao" name="descricao" required><?php echo $tarefa['descricao']; ?></textarea>
                </div>
                <div class="w100s">
                <input type="submit" value="Salvar">
                </div>
            </form>
        </div>
    </section>
    <footer>
        <hr><br>
        <div class="container">
            <span><a href="https://www.facebook.com/" target="_blank"><i class="fa-brands fa-facebook" target="_blank"></i></a> <a href="https://www.instagram.com/" target="_blank"><i class="fa-brands fa-instagram"></i></a> <a href="https://twitter.com/" target="_blank"><i class="fa-brands fa-twitter"></i></a> <a href="https://youtube.com" target="_blank"><i class="fa-brands fa-youtube"></i></a></span>
            <p>© Todos os Direitos Reservados - 2022 </p>
            <p>feito com amor por KriptonFlavy <i class="fa-solid fa-laptop-code"></i></p>
        </div>
    </footer>

    <script src="src/js/main.js"></script>
</body>
</html>