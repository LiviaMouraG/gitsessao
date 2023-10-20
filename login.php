<?php
session_start();

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];

    // Conecte ao banco de dados usando PDO
    try{
        $pdo = new PDO("mysql:host=localhost;dbname=autenticacao","root","");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        die("Erro na conexão com o banco de dados:" . $e->getMessage( 
        ));
    }

    //Verifique se o usuario existe e se a senha est correta
    $stmt = $pdo->prepare("SELECT*FROM usuarios WHERE usuario = ?");
    $stmt->execute([$usuario]);
    $user = $stmt->fetch();

    if($user && password_verify($senha, $user["senha"])){
        $_SESSION["usuario"]=$usuario;
        header("location: dashboard.php");
    }else{
        echo"<script>alert('login falhou. Verifique suas credenciais.')</script>";
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>login</title>
</head>
<body>
    <h1>Login</h1>
    <form method="post">
        <input type="text" name="usuario" placeholder="Nome do Usuário" required><br>
        <input type="password" name="senha" placeholder="senha" required><br>
        <input type="submit" value="Entrar">
    </form>
</body>
</html>