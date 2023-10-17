<?php
    require_once("backend/conection/conection.php");

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        $sql = "SELECT id, nome, senha FROM usuario WHERE email = ? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->bind_result($id, $nome, $senha_hash);

        if($stmt->fetch() && password_verify($senha, $senha_hash)){
            session_start();
            $_SESSION["nome"] = $nome;
            $_SESSION["id_user"] = $id;
            header("Location: index.php");
            exit();
        }
        else{
            echo "<script>alert('email ou senha incorreto ou não existente')</script>";
        }

        $stmt->close();
    }
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
    <link rel="stylesheet" href="src/css/login.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="img">
                <img src="src/images/banner.jpg" alt="">
            </div>
            <form method="post">
                <h1>Login</h1>
                <div class="w100">
                    <p>Email</p>
                    <input type="text" name="email">
                </div>
                <div class="w100">
                    <p>Senha</p>
                    <input type="password" name="senha">
                </div>
                <div class="w100s">
                    <input type="submit" value="Entrar">
                </div>
                <div class="txts">
                    <a href="cadastro.php">Cadastrar-se</a>
                </div>
            </form>
        </div>
    </header>

    <script src="src/js/main.js"></script>
</body>
</html>