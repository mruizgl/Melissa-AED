<?php
    session_start();
    $secreto = rand(1,10);
    $_SESSION["secreto"] = $secreto;
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form action="login.php" method="post">
        <input type="text" name="username"  id="username"/>
        <input type="submit" name="formularioLogin">
        
    </form>
    
</body>
</html>