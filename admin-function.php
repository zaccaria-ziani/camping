<?php

function transday($day){
    switch($day){
        case "Monday":
            $day = "Lundi";
            break;
        case "Tuesday":
            $day = "Mardi";
            break;
        case "Wednesday":
            $day = "Mercredi";
            break;
        case "Thursday":
            $day = "Jeudi";
            break;
        case "Friday":
            $day = "Vendredi";
            break;
        case "Saturday":
            $day = "Samedi";
            break;
        case "Sunday":
            $day = "Dimanche";
            break;
    }
    return $day;
}

?>