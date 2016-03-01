<div class="container">

    <?php
    require_once('scripts/user.php');
    $login = "";
    if (array_key_exists('login', $_POST)) {
        $login = $_POST['login'];
    }

    $nom = "";
    if (array_key_exists('nom', $_POST)) {
        $nom = $_POST['nom'];
    }

    $prenom = "";
    if (array_key_exists('prenom', $_POST)) {
        $prenom = $_POST['prenom'];
    }

    $promotion = "";
    if (array_key_exists('promotion', $_POST)) {
        $promotion = $_POST['promotion'];
    }

    $naissance = "";
    if (array_key_exists('naissance', $_POST)) {
        $naissance = $_POST['naissance'];
    }

    $email = "";
    if (array_key_exists('email', $_POST)) {
        $email = $_POST['email'];
    }

    $tel = "";
    if (array_key_exists('tel', $_POST)) {
        $tel = $_POST['tel'];
    }

    $probleme = FALSE;
    $ok = FALSE;
    $tentative = FALSE;
    if (isset($_POST['login']) && !$_POST['login'] == "" && isset($_POST['mdp']) && isset($_POST['mdp2']) && $_POST['mdp'] == $_POST['mdp2']) {

        if (isset($_FILES['ProfilPic'])) {
            $extensions_valides = array('jpg', 'jpeg', 'gif', 'png');
            $extension_upload = strtolower(substr(strrchr($_FILES['ProfilPic']['name'], '.'), 1));
            if (!in_array($extension_upload, $extensions_valides)) {
                $probleme = TRUE;
            }
        }

        $tentative = TRUE;
        $ok = User::insererUtilisateur($_POST['login'], $_POST['mdp'], $_POST['nom'], $_POST['prenom'], $_POST['promotion'], $_POST['naissance'], $_POST['email'], $_POST['tel']);
    }
    if ($ok) {
        $user = USER::getUtilisateur($login);
        mkdir("img/ProfilPic/{$login}", 0777, true);
        if (!$probleme) {
            $destination = "img/ProfilPic/{$login}/{$_FILES['ProfilPic']['name']}";
            $resultat = move_uploaded_file($_FILES['ProfilPic']['tmp_name'], $destination);
            $user->updateProfilPic($_FILES['ProfilPic']['name']);
        } else {
            $destination = "img/ProfilPic/{$login}/avatar.jpg";
            $source = "img/avatar.jpg";
            copy($source, $destination);
            $user->updateProfilPic('avatar.jpg');
        }
        echo '<script language="Javascript">alert ("Bienvenue sur notre site");</script>';
        logIn();
        echo"<form name=\"formulaireBidon\" method=\"post\" action=\"index.php?page=compte\"><input type=\"hidden\"></form>";
        echo "<script>document.formulaireBidon.submit();</script>";
    } else {
        if ($tentative) {
            echo '<script language="Javascript">alert ("Login déjà existant");</script>';
        }
        if (isset($_POST['mdp']) && isset($_POST['mdp2']) && !$_POST['mdp'] == $_POST['mdp2']) {
            echo '<script language="Javascript">alert ("Mots de passe différents");</script>';
        }
    }

    echo<<<FIN

    <div class="row text-register">
        <div class="text-accueil col-xs-12 col-sm-8 col-md-8 col-lg-8 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
            <form role="form" method='POST' action='index.php?page=register' enctype="multipart/form-data">
                <h2>M'inscrire sur le site</h2>
                <hr class="colorgraph">
                <div class="row">
                    <div class="form-group col-xs-12 col-sm-12 col-md-12">
                        <input type="text" name="login" id="input_login" class="form-control input-lg" placeholder="Login *" tabindex="1" required="">
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="text" name="prenom" id="input_prenom" class="form-control input-lg" placeholder="Prénom *" tabindex="2" value='$prenom' required="">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="text" name="nom" id="input_nom" class="form-control input-lg" placeholder="Nom *" tabindex="3" value='$nom' required="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="text" name="promotion" id="input_promotion" class="form-control input-lg" placeholder="Promotion" tabindex="4" value='$promotion'>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="text" name="naissance" id="input_naissance" class="form-control input-lg" placeholder="Date de naissance : AAAA-MM-JJ" tabindex="2" value='$naissance'>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="email" name="email" id="input_email" class="form-control input-lg" placeholder="Email *" tabindex="5" value='$email' required="">
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="password" name="mdp" id="input_mdp" class="form-control input-lg" placeholder="Mot de Passe *" tabindex="6" required="">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="password" name="mdp2" id="input_mdp2" class="form-control input-lg" placeholder="Mot de Passe (Confirmation) *" tabindex="7" required="">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                        <input type="tel" name="tel" id="input_tel" class="form-control input-lg" placeholder="Télephone *: 06XXXXXXXX" tabindex="8" value='$tel' required="">
                    </div>
                    </div>
                    <br><br>
                    <div class="form-group">
                        <label for="input_ProfilPic" class="col-sm-4 control-label">Photo de profil </label>
                        <div class="col-sm-4">
                            <input type="file" name="ProfilPic"  id="input_ProfilPic">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4 col-sm-3 col-md-3">
                        <span class="button-checkbox">
                            <input type="checkbox" name="t_and_c" id="t_and_c" class="hidden" value="1">
                        </span>
                    </div>
                    <hr class="colorgraph">
                    <center><div class="text-register col-xs-8 col-sm-9 col-md-9 col-md-offset-1 col-sm-offset-1">
                            En cliquant sur <strong class="label label-serieux1">Je m'inscris</strong> ,vous acceptez la  <a href="#" data-toggle="modal" data-target="#t_and_c_m" class="text-register">Charte de bonne conduite</a> de notre site.
                        </div></center>
                </div>

                <hr class="colorgraph">
                <div class="row">
                    <center><div class="col-xs-12 col-md-6 col-lg-6 col-md-offset-3"><input type="submit" value="Je m'inscris" class="btn btn-serieux1 btn-block btn-lg" tabindex="7"></div></center>
                </div>
            </form>
            <br>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="t_and_c_m" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Charte de bonne conduite</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <h3>1. Charte de bonne conduite</h3>
                        <p>En utilisant le site pour effectuer un trajet en covoiturage, vous donnez votre accord pour respecter « Charte de bonne conduite du covoitureur » décrite ci-après. Cette Charte constitue une obligation pour tous les Membres, et les Membres peuvent directement appliquer les termes de cette Charte les uns aux autres.
                        </p>
                    </div>
                    <div>
                        <h3>2. Trajet en covoiturage</h3>
                        <p>Le Conducteur garantit de ne publier sur le Site que des trajets qu’il souhaite réellement effectuer. Les Membres doivent fournir mutuellement toutes les informations liées à la Contribution aux frais, à l'itinéraire (points de départ et d'arrivée compris), à la présence ou tolérance d'animaux, à la présence ou tolérance de fumeurs et à la musique dans la voiture, et de manière générale, toute information à propos de la logistique du Trajet, du confort et de toute autre préférence.

                            Tous les membres doivent s'assurer que toute information fournie est exacte, et de s'assurer qu'ils sont en accord avec tous les termes convenus entre eux. X-Covoit n'est pas responsable de l'exactitude des informations ni des accords convenus entre les membres.

                            Le Conducteur garantit qu'il effectuera le Trajet qu'il publie et pour lequel des réservations sont enregistrées et accepte de voyager avec tout Passager auprès duquel il s'est engagé.
                        </p>
                    </div>
                    <div>
                        <h3>3. Sécurité</h3>
                        <p>Chaque Conducteur garantit qu'il ne prendra aucun risque en conduisant et qu'il ne consommera ni alcool, ni drogues, ni médicaments pouvant altérer ou perturber sa capacité à conduire de manière sûre, prudente et avec la concentration requise. Le Passager ne devra perturber la conduite du Conducteur d'aucune manière que ce soit.

                            Nous vous prions d'être attentif aux informations que vous fournissez via le site ou directement aux autres membres. Vous ne connaîtrez pas l'identité des personnes avec lesquelles vous communiquez sur le site. X-Covoit
                            ne prend pas de mesure pour vérifier l'identité de ses Membres.

                            Vous ne devez jamais fournir d'informations financières directement aux Membres.

                            Nous vous invitons le cas échéant à immédiatement signaler tout abus ou harcèlement à X-Covoit, en nous contactant via http://localhost/FinalProject/index.php?page=contact. Si vous n'êtes pas certain de devoir signaler l'abus, alors nous vous recommandons de le faire malgré tout.

                            Lorsque les Membres ont convenu d'un covoiturage, X-Covoit recommande qu’Ils se retrouvent dans une zone publique fréquentée, par exemple un parking public. X-Covoit recommande aux Membres d'avoir un téléphone portable et d'effectuer la procédure de vérification sur le site. Ceci est indispensable pour la bonne réalisation des covoiturages et la fiabilité des données publiées sur le site.

                            Les Membres devraient envisager le bien-fondé de la possibilité de prévenir un proche du Trajet en covoiturage qu'ils comptent effectuer, et notamment des détails de départ, d'arrivée et du véhicule. Les Membres pourraient envisager d'envoyer un SMS à un proche avec le nom et/ou la photo des autres Membres avec lesquels ils covoiturent, et (si le Membre est un passager) le numéro d'immatriculation du véhicule. Les Membres doivent informer les autres Membres s’ils prévoient de faire cela, et s’ils comptent prévenir un proche de leur trajet. Les Membres devraient toujours vérifier l'identité des autres Membres avec lesquels ils covoiturent avant de commencer le trajet.

                            Les Membres n'opposeront pas d'objection, ni ne seront offensés par la volonté d'un autre Membre de faire en sorte d’assurer  sa propre sécurité, notamment de la manière décrite ci-dessus.
                        </p>
                    </div>
                    <div>
                        <h3>4. Transparence</h3>
                        <p>Les Membres consentent à fournir à tout autre Membre les informations et les documents qu'un autre Membre peut raisonnablement solliciter dans le cadre d'un covoiturage entre eux.

                            Pour le Conducteur, ces informations incluent notamment (mais ne sont pas limitées à) le certificat d'immatriculation du véhicule (« carte grise »), le certificat d'assurance, le contrôle technique et le permis de conduire. Pour un Passager qui consent à conduire, cela inclut le permis de conduire ; dans tous les cas, il peut être demandé aux Membres de prouver leur identité aux autres Membres (par exemple en fournissant un passeport).

                            Les identités du Passager et du Conducteur doivent correspondre à celles communiquées par X-Covoit et à ce que le Passager et le Conducteur ont convenu. Un Passager ou un Conducteur peut refuser de participer à un covoiturage si l'identité de l'autre Membre ne correspond pas à celle annoncée.

                            X-Covoit rappelle également que le Site ne peut aucunement être utilisé à des fins commerciales ou professionnelles.
                        </p>
                    </div>
                    <div>
                        <h3>5. Coûts</h3>
                        <p>Les Passagers consentent à contribuer aux coûts à hauteur du montant convenu avec le Conducteur. Le Conducteur garantit que la Contribution aux Coûts reflète une réelle contribution à ses frais et que le Conducteur par l'intermédiaire des transactions réalisées avec les autres Membres ne perçoit aucune bénéfice pour la prestation réalisée.
                        </p>
                    </div>
                    <div>
                        <h3>6. Ponctualité</h3>
                        <p>Tous les Membres acceptent de se conformer et d'adhérer aux heures et aux lieux fixés pour le départ. Le Conducteur et le Passager doivent se présenter à l'endroit et à l'heure convenue pour le rendez-vous. Après une période de tolérance de 30 minutes après l'heure de départ programmée, la personne qui a omis de se présenter est responsable d'une annulation, et les conditions d'annulation s'appliquent alors (prière de voir les Conditions).
                        </p>
                    </div>
                    <div>
                        <h3>7. Règles et législation</h3>
                        <p>Le Conducteur assure que lui et son véhicule seront à tout moment en accord avec le Code de la Route et toute autre règle ou législation s'appliquant à leur conduite et au véhicule, notamment les limitations de vitesses et les restrictions de chargement du véhicule.

                            Il assure en particulier du fait que le véhicule dispose bien d'un contrôle technique en cours de validité,  d'un entretien régulier et qu'il ne présente pas de défaut pouvant porter préjudice à la sécurité des passagers. Le conducteur certifie également être bien assuré pour la conduite de ce véhicule et pour les passagers qu'ils transportent dans ce dernier.

                            Tous les Membres assurent ne pas porter ou transporter toute substance, matière ou objet qui est illégale, dangereuse ou offensante durant un Trajet.
                        </p>
                    </div>
                    <div>
                        <h3>8. Propreté</h3>
                        <p>Chaque Membre doit s'assurer de sa propreté et de celle des objets qu'il transporte au moment du départ et pendant le trajet, afin de ne pas offenser ou incommoder tout autre Membre.
                        </p>
                    </div>
                    <div>
                        <h3>9. Confort et conditions</h3>
                        <p>Les Membres doivent trouver un accord sur les conditions suivantes avant le Trajet et ces conditions constitueront une partie de l'accord établi entre eux: le montant de la Contribution aux frais, l'heure de départ, la quantité de bagages admise, le nombre de personnes qui voyagent, l'autorisation ou non de fumer, la présence d'animaux (et le cas échéant le type d'animaux accepté ou non), la présence de musique à bord (et comment la musique sera choisie), le point de rendez-vous et de dépose.
                        </p>
                    </div>
                    <div>
                        <h3>10. Informations publiées sur le site</h3>
                        <p>Aucun utilisateur du Site n'est autorisé à publier des informations diffamatoires, offensantes, ou pouvant causer du tort à des tiers. X-Covoit supprimera toute information contraire à ces conditions dès lors qu'il en prendra connaissance (mais X-Covoit ne surveille pas activement le site à la recherche de telles informations). Les Conducteurs et les Passagers acceptent à l'avance que des avis les concernant puissent être publiés sur le Site. Ils consentent également à ce que leur niveau d'expérience soit calculé et publié en accord avec les critères stipulés par X-Covoit.

                            Les utilisateurs du Site s'engagent également à respecter la charte de communication sur le site, notamment dans leurs échanges publics , en ne tentant pas de contourner les fonctionnements du site ou en n'ayant pas de comportements déplacés vis à vis d'autres membres du Site.</div>

                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">J'ai lu et j'accepte les conditions d'utilisation</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>

FIN;
    ?>

    <script text="javascript">
       $(document).ready(function() { $(function() {
    $( "#input_naissance" ).datepicker("option", "dateFormat", 'yy-mm-dd' );
  });
});
</script>