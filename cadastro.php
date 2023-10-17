<?php
    require_once("backend/conection/conection.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuario (nome, email, senha) VALUES (?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $nome, $email, $senha);
        
        if($stmt->execute()){
            echo "<script>alert('". $nome ." cadastrado com sucesso')</script>";
            header("location: login.php");
        }
        else{
            echo "erro ao registar" . $stmt->error;
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
                <h1>cadastro</h1>
                <div class="w100">
                    <p>Nome</p>
                    <input type="text" name="nome">
                </div>
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
            </form>
        </div>
    </header>

    <script src="src/js/main.js"></script>
</body>
</html>