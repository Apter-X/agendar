<?php 
class Date {

    var $days = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
    var $months = array('Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre');

    function getEvents($year){
        global $DB;
        $req = $DB->query('SELECT id,title,date FROM events WHERE YEAR(date)='.$year);
        $r = array();
        /*
         *  Ce que je veux $r[TIMESTAMP][id] = title;
         */
        while ($d = $req->fetch(PDO::FETCH_OBJ)){
            $r[strtotime($d->date)][$d->id] = $d->title;
        }
        return $r;
    }

    function getAll($year){
        $r = array();
        /*
        * Boucle version procedural
        *
        $date = strtotime($year.'-01-01');
        while(date('Y', $date) <= $year){
            //$r = [ANNEE] [MOIS] [JOUR] = Jour de la semaine
            $y = date('Y', $date);
            $m = date('n', $date);
            $d = date('j', $date);
            $w = str_replace('0', '7', date('w', $date));
            $r[$y][$m][$d] = $w;
            $date = strtotime(date('Y-m-d', $date).' +1 DAY');
        }
        *
        */
        $date = new DateTime($year.'-01-01');
        while($date->format('Y') <= $year){
            //$r = [ANNEE] [MOIS] [JOUR] = Jour de la semaine
            $y = $date->format('Y');
            $m = $date->format('n');
            $d = $date->format('j');
            $w = str_replace('0', '7', $date->format('w'));
            $r[$y][$m][$d] = $w;
            $date->add(new DateInterval('P1D'));
        }
        return $r;
    }
}