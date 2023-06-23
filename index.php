<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
          crossorigin="">
    <link rel="stylesheet" href="load.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Title</title>
</head>
<body>
<div class="loads" id="pageLoader">
<svg class="loading" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
     width="574.558px" height="190px" viewBox="0 0 574.558 120" enable-background="new 0 0 574.558 120" xml:space="preserve">
  <defs>
      <pattern id="water" width=".25" height="1.1" patternContentUnits="objectBoundingBox">
          <path fill="#FB9366" d="M0.25,1H0c0,0,0-0.659,0-0.916c0.083-0.303,0.158,0.334,0.25,0C0.25,0.327,0.25,1,0.25,1z"/>
      </pattern>

      <text id="text" transform="matrix(1 0 0 1 -8.0684 116.7852)" font-size="125">ERROR 404</text>

      <mask id="text_mask">
          <use x="0" y="0" xlink:href="#text" opacity="1" fill="#FDD238"/>
      </mask>
  </defs>

    <use x="0" y="0" xlink:href="#text" fill="#FDD238"/>

    <rect class="water-fill" mask="url(#text_mask)" fill="url(#water)" x="-400" y="0" width="1600" height="120"/>
</svg>
<script src="load.js"></script>
</div>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <img class="top img-fluid" src="img/logoHeader.png"  alt="logo MOKU">
            <a class="navbar-brand">Home</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link">About</a>
                    </li>
                </ul>
            </div>
            <div>

            </div>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Rechercher ...">
                <button type="button" class="btn btn-outline-success">Entrée</button>
            </form>
        </div>
    </nav>
</header>
<main>
    <div class="pageUN">
        <img src="img/pexels.jpg" height="500" width="1700" class="essence img-fluid" alt="essence">
        <h2 id="oeil">En un coup d'oeil</h2>
        <p>Mises a jour le :jj/mm/aa</p>
    </div>
    <section class="row align-items-left">
        <div class="column">
            <h2>4600</h2>
            <h5>En augmentation depuis 2022</h5>
            <h5>Nombre de stations EN HAUTE-SAVOIE</h5>
            <p>lE NOMBRE DE STATION-SERVICE EST EN CONSTANTE AUGMENTATION ET LA HAUTE-SAVOIE N’Y FAIT PAS EXCEPTION !</p>
        </div>
        <div class="column">
            <h2>1.60</h2>
            <h5>En augmentation depuis 2023</h5>
            <h5>PRIX MOYEN DEPUIS 2023</h5>
            <p>prix moyen de l’ÉSSENCE EN FRANCE LE PRIX MOYEN DE L’ÉSSENCE FACILEMENT ACCESSIBLE</p>
        </div>
        <div class="column">
            <h2>8.6%</h2>
            <h5>TAUX D’AUGMENTATION DEPUIS 2023</h5>
            <h5>AUGMENTATION du prix EN POURCENTAGE</h5>
            <p>L’ANNÉE 2023 A CONNU L’UNE DES CROISSANCES DE PRIX LES PLUS IMPORTANTES</p>
        </div>
        <div class="column">
            <h1>1.65</h1>
            <h5>En augmentation depuis 2023</h5>
            <h5>COûT DE L’éSSENCE ACTUEL</h5>
            <p>ACTUALISE CHAQUE JOUR IL S’AGIT DU PRIX MOYEN DE L’ESSENCE EN HAUTE SAVOIE</p>
        </div>
    </section>
    <h2 class="expUN">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</h2>

    <section class="map">
        <div class="wrapper">
            <div class="phrase">
                <h1>Station a Annecy !</h1>
            </div>
        </div>
        <div class="container align-items-left">
            <div class="row align-items-stretch">
                <div class="col-9">
                    <div id="map"></div>
                    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
                            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
                            crossorigin=""></script>
                    <script src="main.js"></script>
                </div>
                <div class="col-3">
                    <div id="photoOlfa"></div>
                    <img src="img/olfa.png" alt="Photo Olfa">
                </div>
            </div>
        </div>
    </section>
    <section class="graphiqueUN">
        <h1 id="phraseDEUX">Evolution du prix moyen du Carburant en France</h1>
        <div class="metLeGraphique">
            <?php
            $pdo = new PDO('pgsql:dbname=fuel-dataviz;host=localhost;port=5432','postgres','password');
//            $query = $pdo->query('SELECT * FROM carburant');
//            $post = $query->fetchAll();
//            echo '<pre>';
//            print_r($post);
//            echo '</pre>';
//            phpinfo();

//            try
//            {
//                $connexion = new PDO('pgsql:dbname=fuel-dataviz;host=localhost;port=5432','postgres','password');
//            }
//
//            catch(Exception $e)
//            {
//                echo 'Erreur : '.$e->getMessage().'<br />';
//                echo 'N° : '.$e->getCode();
//            }
            ?>
            <div id="phpLink">
                <?php
                $query = $pdo->query("SELECT AVG(valeur), extract(YEAR from date) FROM prix
                                JOIN carburant ON prix.carburant_id = carburant.id
                               -- AND  carburant.nom = 'Gazole'
                                AND(extract(YEAR from date)=2007
                                OR extract(YEAR from date)=2014
                                OR extract(YEAR from date)=2023)
                                GROUP BY extract(YEAR from date)");

                foreach ($query as $data)
                {
                    $avg[]=$data['avg'];
                    $extract[]=$data['extract'];
                };
                ?>
                <canvas id="barCanvas" aria-label="chart" role="img"></canvas>
                <?php include 'footer.php'?>
                <script >const barCanvas = document.getElementById("barCanvas");
                    // const moy2007= document.getElementById("phpLink")
                    const barChart = new Chart(barCanvas,{
                        type:"bar",
                        data:{
                            labels:<?php echo json_encode($extract)?>,
                            datasets:[{
                                data: <?php echo json_encode($avg)?>
                            }]
                        }
                    })
                </script>
            </div>
        </div>
        <h3 class="expDEUX">Sur ce graphique , vous pouvez voir la moyenne des prix de carburants en France representer entre 2007 jusqu’en 2023 . </h3>
        <h3 class="expTROIS">Nous pouvons voir une augmentation remarcable , nous avons commencé a envrion 1 euro , puis d’année en année le prix n’a fais que augmenter jusqu’a arrivé a 2 euros ! </h3>
    </section>
    <section class="graphiqueDEUX">
        <h1 id="phraseTROIS">Evolution des prix moyens du carburant en France/Haute-savoie</h1>
        <div class="metLeGraphiqueDeux">
            <a class="btn btn-primary" href="/?url=SP95" role="button">SP95</a>
            <a class="btn btn-primary" href="/?url=E10" role="button">E10</a>
            <a class="btn btn-primary" href="/?url=E85" role="button">E85</a>
            <a class="btn btn-primary" href="/?url=GPLC" role="button">GPLC</a>
            <a class="btn btn-primary" href="/?url=GAZOLE" role="button">GAZOLE</a>
            <a class="btn btn-primary" href="/?url=SP98" role="button">SP98</a>
            <?php
            switch ($_GET['url']){
                case 'SP95';
                require ('graphiqueSP95.php');
                break;
                case 'SP98';
                    require ('graphiqueSP98.php');
                    break;
                case 'E85';
                    require ('graphiqueE85.php');
                    break;
                case 'GAZOLE';
                    require ('graphiqueGazole.php');
                    break;
                case 'GLPC';
                    require ('graphiqueGPLC.php');
                    break;
                default;
                require ('graphiqueE10.php');
                break;
            }
            ?>

        </div>
        <h3 class="expQUATRE">Vorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus, ut interdum tellus elit sed risus. Maecenas eget condimentum velit, sit amet feugiat lectus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent auctor purus luctus enim egestas, ac scelerisque ante pulvinar. Donec ut rhoncus ex. Suspendisse ac rhoncus nisl, eu tempor urna. Curabitur vel bibendum lorem. Morbi convallis convallis diam sit amet lacinia. Aliquam in elementum tellus.</h3>
    </section>
</main>
<footer>
    <section class="row align-items-center">
        <div class="column text-white">
            <img id="home" src="img/Vector.png" alt="maison">
            <h5>Annecy 74000,France</h5>
            <h5>https://www.service-public.fr</h5>
        </div>
        <div class="column text-white">
            <h5><img id="env" src="img/env.png">Fuel-France@info.fr</h5>
            <h5>https://www.prix-carburants.gouv.fr</h5>
        </div>
        <div class="column text-white">
            <h5><img id="tel" src="img/tel.png">07 98 56 31 67</h5>
            <h5>https://www.data.gouv.fr/fr</h5>
        </div>
    </section>
    <hr class="background-color-white">
    <div class="marg">
        <div class="container">
            <section class="row align-items-start justify-content-md-center">
                <div class="col col-lg-2">
                    <img src="img/logoFooter.png">
                </div>
                <div class="col col-lg-2">
                    <img src="img/cFooter.png">
                </div>
                <div class="col col-lg-2">
                    <p class="fin text-white">2023 Copyright, Inc</p>
                </div>
            </section>
        </div>
    </div>
</footer>

</body>
</html>
