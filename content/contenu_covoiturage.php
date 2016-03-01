<div class="row">
    <?php
    if ((!array_key_exists('loggedIn', $_SESSION) || $_SESSION['loggedIn'] == false)) {
    echo '<script language="Javascript">
alert ("Vous devez être logué pour y accéder!" )
</script>';
    exit();
    }
    $trajet = array(
        1 => "X - Massy",
        2 => "X - Lozere",
        3 => "X - Paris",
        4 => "X - Orly",
        5 => "X - CDG",
        6 => "Autre",
    );
    $sens = array(
        1 => "X -> Massy",
        2 => "Massy -> X",
        3 => "X -> Lozere",
        4 => "Lozere -> X",
        5 => "X -> Paris",
        6 => "Paris -> X",
        7 => "X -> Orly",
        8 => "Orly -> X",
        9 => "X -> CDG",
        10 => "CDG -> X",
        11 => "Consulter les trajets",
        12 => "Ajouter un trajet",
    );

    $commentaire = array(
        1 => "De retour avec ta valise un dimanche soir ?",
        2 => "De retour de Paris avec le dernier RER ?",
        3 => "Envie de sortie un week-end ?",
        4 => "Un avion tôt le matin ?",
        5 => "Un avion tôt le matin ?",
        6 => "Un autre besoin ?",
    );

    function bloc($i) {
        global $trajet;
        global $commentaire;
        global $sens;
        $j = 2 * $i - 1;
        $k = $j + 1;
        echo<<<FIN
        <div class = "col-sm-4 col-md-4 col-lg-4">
        <div class = "thumbnail">
        <br>
            <img data-src="holder.js/300x200" src="img/img_trajet/photo$i.jpg" alt="" class="pic">
            <div class="caption">
                <h3><center>$trajet[$i]</center></h3>
                <p><center>$commentaire[$i]</center></p>
                
                <p>
                   <center><button class="btn btn-trajet1 " data-toggle="modal" data-target="#myModal$j">
                        $sens[$j]
                   </button>
                
FIN;
        if ($k != 12) {
            echo "<button class=\"btn btn-trajet2 btn-default \" data-toggle=\"modal\" data-target=\"#myModal$k\">$sens[$k]</button>";
        } else {
            echo "<a  href=\"index.php?page=ajouterTrajet\"><input type=\"button\" value=\"$sens[$k]\" class=\"btn btn-serieux1 \"></a>";
        }
        echo<<<FIN
        
        
        
        
        
                <div class="modal fade bs-example-modal-lg" id="myModal$j" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">$sens[$j]</h4>
                            </div>
                            <div class="modal-body">
                <div class="row">
                <div>
                <center><a class="btn btn-serieux1 btn-lg" role="button" href="index.php?page=ajouterTrajet">Ajouter un trajet</a></center>
                </div>
                <br>
                <div class = "col-sm-6 col-md-6 col-lg-6 box1">
                    <h2>Je suis Passager</h2>
             
                
  
FIN;
        require_once('scripts/trajet.php');

        $tableau = Trajet::getTrajetConducteur($sens[$j]);
        $trajetids = array();
        foreach ($tableau as $traj) {
            if (!$traj->nbplaces == 0) {
                $trajetids[] = printTrajetConducteur($traj);
            }
        }




        echo<<<FIN
        </div>
       
                <div class = "col-sm-6 col-md-6 col-lg-6 box2">
                    <h2>Je suis conducteur<h2>
                
FIN;
        require_once('scripts/trajet.php');

        $tableau2 = Trajet::getTrajetPassager($sens[$j]);

        foreach ($tableau2 as $traj) {
            if($traj->passager1!="" || $traj->passager2!="" || $traj->passager3!="" || $traj->passager4!=""){

            $trajetids[] = printTrajetPassager($traj);
            }
        }


        echo<<<FIN
        </div>
        
                </div>
                            </div>

                        </div>
                    </div>
                </div>
   
   <div class="modal fade bs-example-modal-lg" id="myModal$k" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">$sens[$k]</h4>
                            </div>
                            <div class="modal-body">
                <div class="row">
                <div>
                <center><a class="btn btn-serieux1 btn-lg" role="button" href="index.php?page=ajouterTrajet">Ajouter un trajet</a></center>
                </div>
                <br>
                <div class = "col-sm-6 col-md-6 box1">
                    <h2>Je suis Passager</h2>
                
  
FIN;
        require_once('scripts/trajet.php');

        $tableau3 = Trajet::getTrajetConducteur($sens[$k]);

        foreach ($tableau3 as $traj) {
            if (!$traj->nbplaces == 0) {
                $trajetids[] = printTrajetConducteur($traj);
            }
        }


        echo<<<FIN
        </div>
       

                <div class = "col-sm-6 col-md-6 box2">
                    <h2>Je suis conducteur<h2>
                
FIN;
        require_once('scripts/trajet.php');

        $tableau4 = Trajet::getTrajetPassager($sens[$k]);

        foreach ($tableau4 as $traj) {
if($traj->passager1!="" || $traj->passager2!="" || $traj->passager3!="" || $traj->passager4!=""){
            $trajetids[] = printTrajetPassager($traj);
}
        }
        echo "<script> trajetids=trajetids.concat(" . json_encode($trajetids) . "); </script> ";


        echo<<<FIN
        </div>
        
                </div>
                            </div>

                        </div>
                    </div>
                </div>
                    <br>

   
   </center>
                </p>
        </div>
        </div>
        </div>
FIN;
    }

    echo "<br><br><div><center><a class=\"btn btn-serieux1 btn-lg\" role=\"button\" href=\"index.php?page=ajouterTrajet\">Ajouter un trajet</a><center></div>";
    echo "<div class=\"voiture\">";
    echo "<div class='covoit'>";
    echo "<hr width=\"90%\" size=\"5px\">";

    echo "<script> var trajetids=new Array();</script>";
    for ($i = 1; $i <= 5; $i++) {
        bloc($i);
    }
    echo "</div>";
    echo "</div>";
    ?>
</div>

<script language='javascript'>
  
  $(document).ready(function() {
    
    //alert(trajetids);
    for (var key in trajetids) {
        toggletrip(trajetids[key]);
    }
    console.log(trajetids);
});
</script>