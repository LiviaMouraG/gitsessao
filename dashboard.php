<?php
session_start();

if(!isset($SESSION["usuario"])){
    header("Location: login.php");
    exit;
}

echo "Bem-vindo," . $_SESSION["usuario"] . "!Esta é a página de dashboard.";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <a href="logout.php">Sair</a>
</body>
</html>