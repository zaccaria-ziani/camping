<?php

session_start();

$connexion=mysqli_connect("localhost","root","","camping");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <title>Inscription</title>
</head>
<body>
    

        <br><br>
        <form method="POST" action="">
        <div class="info">

    <h1>Inscription</h1>
					
					<label for="login">Login :<br> </label>
					<input type="text" name="login" id="login" required>

					<br>
					<br>

					


					<label for="mail">Email :<br></label>
					<input type="mail" name="mail" id="mail" required>

					<br>
					<br>

					<label for="password">Mot de passe :<br></label>
					<input type="password" name="password" id="password" required>

					<br>
					<br>


					<label for="confirmpassword">Confirmer mot de passe : <br></label>
					<input type="password" name="confirmpassword" id="confirmpassword" required>
					<br>
					<br>

					<input type="submit" value="Inscription" name="confirm" /><br>
				</div>

				
		</form>
		
	</div>
	

        </form>
    </div>
</body>
</html>

<?php
	


	if(isset($_POST['confirm']))
	{
        $login=$_POST['login'];
        $password=$_POST['password'];
        $confirmpassword=$_POST['confirmpassword'];
        $mail=$_POST['mail'];              
		$requeteSelectLogin = "SELECT login FROM utilisateurs WHERE login='".$login."'" ;    
        $querySelectLogin = mysqli_query($connexion, $requeteSelectLogin);
        $resultatLogin = mysqli_fetch_all($querySelectLogin); 
        $requeteSelectMail = "SELECT mail FROM utilisateurs WHERE mail='".$mail."'";
        $querySelectMail = mysqli_query($connexion, $requeteSelectMail);
        $resultatMail= mysqli_fetch_all($querySelectMail);    
        
        if(!empty($resultatLogin))
        {
            echo "login  déja pris";
        }
        elseif(!empty($resultatMail))
        {
            echo"mail déja pris";
        }
        elseif(!empty($password) && $password!=$confirmpassword)
        {
            echo "champ vide ou mdp incorrects";
        }
        else
        {
            $requeteInsert= "INSERT INTO utilisateurs (login,password,mail) VALUES('".$login."','".$password."','".$_POST['mail']."')";  
            $queryInsert=mysqli_query($connexion,$requeteInsert); 
            // header('Location:connexion.php'); 
        }

    }




	

?>






