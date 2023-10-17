<?php
require_once("conection/conection.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql = "DELETE FROM tarefas WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "Tarefa excluída com sucesso.";
        header("Location: ../index.php");
    } else {
        echo "Erro ao excluir a tarefa: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
