<?php

session_start();

$connexion = mysqli_connect("localhost", "root", "", "camping");
$requete = "SELECT * FROM prix";
$query = mysqli_query($connexion, $requete);
$resultat = mysqli_fetch_all($query);

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="#">
    </head>
    <body>

        <!-- <header></header> -->

        <main>

        <?php

        if(!empty($_SESSION)):
            if($_SESSION["login"] == "admin"): ?>

                <form action="" method="POST">
                    
                    <label for="emplacement">Tarif emplacement:</label>
                    <input type="number" name="emplacement" id="emplacement" placeholder="Tarif actuel = <?php echo $resultat[0][0] ?>€/j">

                    <label for="electricite">Tarif borne électrique:</label>
                    <input type="number" name="electricite" id="electricite" placeholder="Tarif actuel = <?php echo $resultat[0][1] ?>€/j">

                    <label for="activite">Tarif des activités:</label>
                    <input type="number" name="activite" id="activite" placeholder="Tarif actuel = <?php echo $resultat[0][2] ?>€/j">

                    <label for="disco">Tarif accès Disco-Club</label>
                    <input type="number" name="disco" id="disco" placeholder="Tarif actuel = <?php echo $resultat[0][3] ?>€/j">

                    <input type="submit" name="modifier" id="modifier" value="Modifier">
                    <?php if(isset($_GET["modif"])): ?>
                        <p><?php echo "Modification effectuée" ?></p>
                    <?php endif; ?>
                </form>

            <?php endif;
        endif;
        
        ?>

        </main>

        <!-- <footer></footer> -->

    </body>

</html>

<?php

$location = filter_input(INPUT_POST, "emplacement", FILTER_VALIDATE_INT);
$elec = filter_input(INPUT_POST, "electricite", FILTER_VALIDATE_INT);
$activity = filter_input(INPUT_POST, "activite", FILTER_VALIDATE_INT);
$disco = filter_input(INPUT_POST, "disco", FILTER_VALIDATE_INT);

if(isset($_POST["modifier"])){

    $store_location = $resultat[0][0];
    $store_elec = $resultat[0][1];
    $store_activity = $resultat[0][2];
    $store_disco = $resultat[0][3];

    if(!empty($location)){
        $store_location = $location;
    } else {
        $location = $resultat[0][0];
    }
    if(!empty($elec)){
        $store_elec = $elec;
    } else {
        $elec = $resultat[0][1];
    }
    if(!empty($activity)){
        $store_activity = $activity;
    } else {
        $activity = $resultat[0][2];
    }
    if(!empty($disco)){
        $store_disco = $disco;
    } else {
        $disco = $resultat[0][3];
    }

    $connexion = mysqli_connect("localhost","root","","camping");
    $requete = "UPDATE prix SET emplacement='".$location."', electricite = '".$elec."',activite='".$activity."',disco='".$disco."'";
    $query = mysqli_query($connexion, $requete);
    $_GET["modif"] = "Modification effectuée";
    header("Location:admin.php?modif=1");
}







?>