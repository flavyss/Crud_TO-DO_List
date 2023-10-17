<?php
require_once("backend/conection/conection.php");
require_once("backend/verify.php");

$idUsuario = $_SESSION["id_user"];

$sql = "SELECT id, titulo, descricao FROM tarefas WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $idUsuario);
$stmt->execute();
$result = $stmt->get_result();

$tarefas = array();

while ($row = $result->fetch_assoc()) {
    $tarefas[] = $row;
}

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
    <link rel="stylesheet" href="src/css/index.css">

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
                    <li><a href="index.php" class="ativo">Lista</a></li>
                    <li><a href="nova.php">Nova tarefa</a></li>
                    <li><a href="backend/logout.php">Sair</a></li>
                </ul>
            </nav>
            <nav class="menuMobile">
                <h2 class="disp"><i class="fa-solid fa-bars"></i></h2>
                <ul>
                    <h2 class="fecha"><i class="fa-regular fa-circle-xmark"></i></h2>
                    <li><a href="index.php" class="ativo">Lista</a></li>
                    <li><a href="nova.php">Nova tarefa</a></li>
                    <li><a href="backend/logout.php">Sair</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section>
        <div class="container">
            <h1>Afazeres de: <span><?php echo $_SESSION["nome"] ?></span></h1>

            <div class="afazeres">
                <?php foreach ($tarefas as $tarefa) { ?>
                    <div class="contAfa">
                        <div class="titulo">
                            <h3><?php echo $tarefa['titulo']; ?></h3>
                        </div>
                        <div class="descricao">
                            <p><?php echo $tarefa['descricao']; ?></p>
                        </div>
                        <div class="butons">
                            <button><a href="editar.php?id=<?php echo $tarefa['id']; ?>">Editar</a></button>
                            <button><a href="backend/excluir.php?id=<?php echo $tarefa['id']; ?>">Excluir</a></button>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <span><a href="https://www.facebook.com/" target="_blank"><i class="fa-brands fa-facebook" target="_blank"></i></a> <a href="https://www.instagram.com/" target="_blank"><i class="fa-brands fa-instagram"></i></a> <a href="https://twitter.com/" target="_blank"><i class="fa-brands fa-twitter"></i></a> <a href="https://youtube.com" target="_blank"><i class="fa-brands fa-youtube"></i></a></span>
            <p>© Todos os Direitos Reservados - 2022 </p>
            <p>feito com amor por KriptonFlavy <i class="fa-solid fa-laptop-code"></i></p>
        </div>
    </footer>

    <script src="src/js/main.js"></script>
</body>
</html>