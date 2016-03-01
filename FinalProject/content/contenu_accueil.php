
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

        <title>Carousel Template for Bootstrap</title>

        <!-- Bootstrap core CSS -->
        <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Custom styles for this template -->
        <link href="carousel.css" rel="stylesheet">
    </head>


 
    <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <!-- si je l'inclue uniquement dans mon CSS, le rendu est moins bon, je ne sais pas pourquoi ...-->
    <style type="text/css">
        h2{
            margin: 0;     
            padding-top: 90px;
            font-size: 52px;
            font-family: "trebuchet ms", sans-serif;
            color:white;
            text-shadow: 0 0 2px #000000;

        }
        .item{   
            text-align: center;
            height: 300px !important;
            text-shadow: 0 0 5px #000000;

        }

        #accueil1{
            background-image: url(img/accueil/bandeau1.jpg);
            background-position: center;
            background-repeat:no-repeat;
            background-size: 100% 100%;

        }

        #accueil2{
            background-image: url(img/accueil/bandeau2.jpg);
            background-position: center;
            background-repeat:no-repeat;
            background-size: 100% 100%;

        }

        #accueil3{
            background-image: url(img/accueil/bandeau3.jpg);
            background-position: center;
            background-repeat:no-repeat;
            background-size: 100% 100%;

        }

        .carousel{
            margin-top: 20px;
        }
        .bs-example{
            margin: 20px;
        }
        .center {
            display:table-cell;
            vertical-align:middle;
            float:none;
        }

    </style>
</head>
<body>
    <div class="bs-example">
        <div id="myCarousel" class="carousel slide" data-interval="3000" data-ride="carousel">
            <!-- Carousel indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>   
            <!-- Carousel items -->
            <div class="carousel-inner text-accueil p-carousel">
                <div class="active item" id="accueil1">
                    <h2>Voyagez tout de suite !</h2>
                    <div class="carousel-caption">
                        <p>Trouvez le trajet qui vous convient en 1 minute.</p>
                        <p><a class="btn btn-lg btn-serieux1" href="http://localhost/FinalProject/index.php?page=covoiturage" role="button">Go !</a></p>
                    </div>
                </div>
                <div class="item" id="accueil2">
                    <h2>Comment ça marche ?</h2>
                    <div class="carousel-caption">
                        <p>Découvrez le fonctionnement de X-Covoit et ses règles de bonne conduite.</p>
                        <p><a class="btn btn-lg btn-serieux1" href="http://localhost/FinalProject/index.php?page=info" role="button">Règles de fonctionnement</a></p>
                    </div>
                </div>
                <div class="item" id="accueil3">
                    <h2>Je propose un trajet</h2>
                    <div class="carousel-caption">
                        <p>Proposez directement un trajet, que vous soyez conducteur ou passager.</p>
                        <p><a class="btn btn-lg btn-serieux1" href="http://localhost/FinalProject/index.php?page=ajouterTrajet" role="button">Ajouter un trajet</a></p>
                    </div>
                </div>
            </div>
            <!-- Carousel nav -->
            <a class="carousel-control left" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="carousel-control right" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div>
    </div>
</body>                             		
<!-- Marketing messaging and featurettes
================================================== -->
<!-- Wrap the rest of the page in another container to center all the content. -->

<div class="container marketing">

    <!-- Three columns of text below the carousel -->
    <div class="row">
        <div class="col-lg-4 text-accueil">
            <center><img  class="img-circle" src="img/accueil/essence.png" height="140" alt="Generic placeholder image"></center>
            <h3>Conducteurs : Réduisez vos frais de route !</h3>
            <p>Ne voyagez plus seul ! Economisez sur vos frais en prenant des passagers lors de vos longs trajets en voiture</p>
            <center><p><a class="btn btn-serieux1" href="http://localhost/FinalProject/index.php?page=info" role="button">Détails &raquo;</a></p></center>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4 text-accueil">
            <center><img class="img-circle img-border" src="img/img_trajet/photo2.jpg" height="140" alt="Generic placeholder image"></center>
            <h3>Passagers : Ne rentrez plus à pied de Lozere !</h3>
            <p>Réservez facilement votre place en ligne, même à la dernière minute !</p>
            <center><p><a class="btn btn-serieux1" href="http://localhost/FinalProject/index.php?page=info" role="button">Détails &raquo;</a></p></center>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4 text-accueil">
            <center><img class="img-circle img-border" src="img/accueil/poignee_main.jpg" height="140" alt="Generic placeholder image"></center>
            <h3>Covoiturage : Confiance & sérénité</h3>
            <p>Des profils vérifiés et des avis entre membres créent une communauté fiable, pour voyager en toute confiance.</p>
            <center><p><a class="btn btn-serieux1" href="http://localhost/FinalProject/index.php?page=info" role="button">Détails &raquo;</a></p></center>
        </div><!-- /.col-lg-4 -->
    </div><!-- /.row -->


    <!-- FOOTER -->
    <footer class="text-accueil">
        <p>&copy; 2014 X-Covoit, Inc.</p>
    </footer>

</div><!-- /.container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="../../dist/js/bootstrap.min.js"></script>
<script src="../../assets/js/docs.min.js"></script>
</body>
</html>
