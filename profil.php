<?php 
    session_start();
    if(!isset($_SESSION['id']))
    {
        header('Location: connexion.php');
    }
    if(isset($_GET['disconnect']))
    {
        session_destroy();
        header('Location: connexion.php');
    }
?>

<!DOCTYPE html>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profil</title>
</head>
<body>
    <p>prooooooofiiiiil</p>
    <?php if(isset($_SESSION['id'])){ echo $_SESSION['id']; }?>

    <a href="?disconnect">Deconnexion</a>
</body>
</html>