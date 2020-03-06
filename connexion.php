<?php 
session_start();
$connexion=mysqli_connect("localhost","root","","camping");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>
<body>
    <form method="POST" action="">
                <div class="info">

    <h2>Connexion<h2>
        <br><br>
<label for="login">Login :<br> </label>
					<input type="text" name="login" id="login" required>

					<br>
					<br>

					<label for="password">Mot de passe :<br></label>
                    <input type="password" name="password" id="password" required>

                    <br>
                    <br>
                    
                    <input type="submit" value="connexion" name="confirm" /><br>

                </div>
    </form>
</body>
</html>

<?php 
    if(isset($_POST['confirm']))
    {
        $login = mysqli_real_escape_string($connexion, htmlspecialchars($_POST['login']));
        $password = mysqli_real_escape_string($connexion, htmlspecialchars($_POST['password']));
        $result = mysqli_fetch_all(mysqli_query($connexion, "SELECT password FROM utilisateurs WHERE login = '$login' "));
        $cryptedpassword = $result[0][0];
        $checkpass = password_verify($password, $cryptedpassword);
        if($checkpass == true)
        {
            $result = mysqli_fetch_all(mysqli_query($connexion, "SELECT id FROM utilisateurs WHERE login = '$login' "));
            $id = $result[0][0];
            $_SESSION['id'] = $id;
            header('Location: profil.php');
        }
        else
        {
            echo "Mot de passe invalide";
        }
    }






// if(isset($_POST['confirm']))
// {
// $login=$_POST['login'];
// $password=$_POST['password'];
// $requeteSelectId="SELECT id FROM utilisateurs WHERE login='$login'";  
// $querySelectLogin=mysqli_query($connexion,$requeteSelectId);
// $resultatLogin=mysqli_fetch_assoc($querySelectLogin);
// var_dump($resultatLogin);
// }

// if(password_verify($_POST['password'],$resultatLogin[2]))
// {
//     echo "login inexistant";
// }
// else
// {
//     echo "connecté";
//     header("location:profil.php");
// }
?>