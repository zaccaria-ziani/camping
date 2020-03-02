<?php

session_start();

require("admin-function.php");

$connexion = mysqli_connect("localhost", "root", "", "camping");
$requete = "SELECT * FROM prix";
$query = mysqli_query($connexion, $requete);
$resultat = mysqli_fetch_all($query);

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>

        <!-- <header></header> -->

        <main>
            <section id="demi-bloc">
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

        <section>
            <h1>Modifier une réservation</h1>
                <?php
                    $connexion_res = mysqli_connect("localhost","root","","camping");
                    $requete_res = "SELECT u.id,u.login,r.lieu,r.debut,r.fin,r.option1,r.option2,r.option3,r.nb_emplacement,r.id_utilisateur FROM utilisateurs AS u INNER JOIN reservations AS r WHERE u.id = r.id_utilisateur";
                    echo $requete_res;
                    $query_res = mysqli_query($connexion_res, $requete_res);
                    $resultat_res = mysqli_fetch_all($query_res);
                    var_dump($resultat_res);

                    foreach($resultat_res as $resultat):

                        $store_id = $resultat[0];
                        $store_login = $resultat[1];
                        $store_lieu = $resultat[2];

                        $store_debut = $resultat[3];
                        // echo $store_debut;
                        $str_debut = strtotime($resultat[3]);

                        $debut_jour2 = strftime("%d", strtotime($store_debut));
                        // echo $debut_jour2;
                        $debut_jour = strftime("%A", strtotime($store_debut));
                        // echo $debut_jour;
                        $debut_mois = strftime("%B", strtotime($store_debut));
                        // echo $debut_mois;

                        $store_fin = $resultat[4];

                        $str_fin = strtotime($resultat[4]);
                        
                        $fin_jour2 = strftime("%d", strtotime($store_fin));
                        $fin_jour = strftime("%A", strtotime($store_fin));
                        $fin_mois = strftime("%B", strtotime($store_fin));

                        $option1 = $resultat[5];
                        $option2 = $resultat[6];
                        $option3 = $resultat[7];

                        $store_place = $resultat[8];

                        $store_user_id = $resultat[9];

                        $store_distdate = abs($str_fin - $str_debut)/60/60/24;
                        // echo $store_distdate;



                        /* ////////// CONVERTION JOUR EN FRANCAIS ////////// */


                        $trans_debut_jour = transday($debut_jour);
                        $trans_fin_jour = transday($fin_jour);

                        ?>

                        <a href="#" >
                            <section>
                                <article class="resa-bloc">
                                    <div>
                                        <p> Réservé par : <?php echo $store_login ?></p>
                                    </div>
                                    <div>
                                        <p>Lieu : <?php echo $store_lieu ?></p>
                                    </div>
                                    <div>
                                        <p>Date : du <?php echo $trans_debut_jour . " " . $debut_jour2 . " " . $debut_mois ?> au <?php echo $trans_fin_jour . " " . $fin_jour2 . " " . $fin_mois ?></p>
                                    </div>
                                    <div>
                                        <p>Option 1 : </p>
                                        <?php if($option1 == 1): ?>
                                            <div>1</div>
                                        <?php else: ?>
                                            <div>0</div>
                                        <?php endif; ?>
                                        <p>Option 2 : </p>
                                        <?php if($option2 == 1): ?>
                                            <div>1</div>
                                            <?php else: ?>
                                            <div>0</div>
                                        <?php endif; ?>
                                        <p>Option 3 : </p>
                                        <?php if($option3 == 1): ?>
                                            <div>1</div>
                                            <?php else: ?>
                                            <div>0</div>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <p>Durée du séjour : <?php echo $store_distdate ?> jours</p>
                                    </div>

                                </article>
                            </section>
                        </a>
                    <?php endforeach ?>
        </section>
    </section>
</main>

<!-- <footer></footer> -->

</body>

</html>




