<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
          crossorigin="">
    <link rel="stylesheet" href="load.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="date.js" async></script>
    <title>Title</title>
    <script src="progression.js"></script>
</head>
<body>
<div class="loads" id="pageLoader">
<svg class="loading" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
     width="574.558px" height="190px" viewBox="0 0 574.558 120" enable-background="new 0 0 574.558 120" xml:space="preserve">
  <defs>
      <pattern id="water" width=".25" height="1.1" patternContentUnits="objectBoundingBox">
          <path fill="#FB9366" d="M0.25,1H0c0,0,0-0.659,0-0.916c0.083-0.303,0.158,0.334,0.25,0C0.25,0.327,0.25,1,0.25,1z"/>
      </pattern>

      <text id="text" transform="matrix(1 0 0 1 -8.0684 116.7852)" font-size="125">OLFA FUEL</text>

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
    <div class="progress">
        <div class="pou"></div>
    </div>
</header>
<div class="pageUN">
    <img src="img/pexels-skitterphoto-9796%201.png" class="essence img-fluid" alt="essence">
</div>
<main>
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
        <h2 id="oeil">En un coup d'oeil</h2>

        <p class="item">Mises a jour le : <span class="item" id='date'></span></p>
    </div>
    <section class="row align-items-left">
        <div class="column">
            <?php
            $queryNbSation = $pdo->query("SELECT count( DISTINCT point_de_vente.id) , extract(YEAR from date)FROM point_de_vente
                            JOIN prix p on point_de_vente.id = p.point_de_vente_id
                            WHERE left(code_postal,2)= '74'
                            AND extract(YEAR from date)=2023
                            GROUP BY extract(YEAR from date)");
            foreach ($queryNbSation as $dataStation):
            ?>
            <h2><?php
                echo $dataStation['count'];
                ?>
            </h2>
            <?php
            endforeach;
            ?>
            <h5>En augmentation depuis 2007</h5>
            <h5>Nombre de stations en Haute-Savoie</h5>
            <p>Le nombre de station-service est en constante augmentation et la Haute-Savoie n'y fait pas exception.</p>
        </div>
        <div class="column">
            <?php
            $queryStation2424= $pdo->query("SELECT count( DISTINCT point_de_vente.id), extract(YEAR  from date) FROM point_de_vente
                                    JOIN prix p on point_de_vente.id = p.point_de_vente_id
                                    WHERE left(code_postal,2)= '74'
                                    AND point_de_vente.automate_24_24= true
                                      AND extract(YEAR from date)=2023
                                    GROUP BY extract(YEAR from date)");
            foreach ($queryStation2424 as $dataStation2424):
            ?>

            <h2><?php
             echo $dataStation2424['count']
            ?>
            </h2>
            <?php
            endforeach;
            ?>
            <h5>En augmentation depuis 2007</h5>
            <h5>Nombre de station ouvertes 24H/24H</h5>
            <p>Les stations services se rendent de plus en plus disponible pour les utilisateurs, et cela passent par les horraires d'ouvertures et de fermetures.</p>
        </div>
        <div class="column">
            <?php
            $queryPourcentage1 = $pdo->query("SELECT AVG(valeur), extract(YEAR from date) FROM prix
                                    JOIN point_de_vente ON prix.point_de_vente_id = point_de_vente.id
                                    where left(code_postal,2)= '74'
                                     and extract(YEAR from date)=2014
                                    GROUP BY extract(YEAR from date)");

            $queryPourcentage2 = $pdo->query("SELECT AVG(valeur), extract(YEAR from date) FROM prix
                                    JOIN point_de_vente ON prix.point_de_vente_id = point_de_vente.id
                                    where left(code_postal,2)= '74'
                                     and extract(YEAR from date)=2023
                                    GROUP BY extract(YEAR from date)");
            foreach ($queryPourcentage1 as $dataPourcentage1){
            $nb1 []= $dataPourcentage1['avg'];
            };
            foreach ($queryPourcentage2 as $dataPourcentage2){
                $nb2[] =$dataPourcentage2['avg'];
            };
            $result = (($nb2[0]-$nb1[0])/$nb1[0])*100
            ?>

            <h2><?php
                echo number_format($result,2)."%";
                ?>

            </h2>

            <h5>En constante augmentation</h5>
            <h5>Augmentation moyenne du prix du carburant depuis 2014 en pourcentage</h5>
            <p>Ces dernières années ont connu une hausse du prix du carburant importante (ce pourcentage ne concerne que la période 2014 - 2023)</p>
        </div>
        <div class="column">
            <?php
            $queryActualPrice = $pdo->query("SELECT AVG(valeur)FROM prix
                                JOIN carburant ON prix.carburant_id = carburant.id
                                JOIN point_de_vente ON prix.point_de_vente_id = point_de_vente.id
                                    AND left(code_postal,2)= '74'
                                    AND prix.date::text LIKE '2023-05-24%'");
            foreach ($queryActualPrice as $dataActualPrice):
            ?>
            <h2> <?php
                echo number_format($dataActualPrice['avg'],2)."€";
                ?>

            </h2>
            <?php
            endforeach;
            ?>
            <h5>En augmentation par rapport a la veille</h5>
            <h5>Dernière moyenne quotidienne du coût de l'essence</h5>
            <p>Actualisé chaque jour, il s'agit du prix moyen du carburant en Haute-Savoie.</p>
        </div>
    </section>
    <h2 class="expUN">Pour rappel ce site est un site a but non lucratif fondé par une petite équipe soudée, nous nous sommes inspirés de site gouvernementaux, et les infos viennent d'une base de donnée vérifiée et officielle. </h2>

    <section class="map">
        <div class="wrapper">
            <div class="phrase">
                <h1>Station a Annecy !</h1>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="column">
                    <div id="map"></div>
                    <script id="mod" src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
                            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
                            crossorigin=""></script>
                    <script src="main.js"></script>
                </div>
                <div class="column">
                    <div class="photoOlf">
                        <img class="ol" src="img/olfa.png" alt="Photo Olfa">
                    </div>


                    <div>
                        <?php
                   //     $pdo = new PDO('pgsql:dbname=fuel-dataviz;host=localhost;port=5432', 'postgres', 'password');

                        $queryMap = $pdo->query("SELECT latitude, longitude 
                                                       FROM point_de_vente
                                                       WHERE left(code_postal,2)= '74'");
                        foreach ($queryMap as $key ) {
                            $latitude[] = $key['latitude'];
                            $longitude[] = $key['longitude'];
                        };
//                        $test = count($latitude);
//                        var_dump($test);

                        $positionTab = [];
                        for ($i=0;$i<count($latitude);$i++){
                            $positionTab[$i] =[$latitude[$i], $longitude[$i]];
                        };

                        $queryAdresse = $pdo->query("SELECT adresse
                                                           FROM point_de_vente
                                                           WHERE left(code_postal,2)= '74'");

                        foreach ($queryAdresse as $data){
                            $adresse[]= $data['adresse'];
                        };

                        $adresseMap = [];
                        for ($j=0;$j<count($adresse);$j++){
                            $adresseMap[$j] = [$adresse[$j]];

                        };

                        $queryVille = $pdo->query("SELECT ville fROM point_de_vente
                                                         WHERE left(code_postal,2)= '74'");
                        foreach ($queryVille as $data){
                            $ville[]= $data['ville'];
                        };
                        $adresseVille = [];
                        for ($k=0;$k<count($ville);$k++){
                            $adresseVille[$k] = [$ville[$k]];
                        };


                        $queryType = $pdo->query("SELECT type fROM point_de_vente
                                                         WHERE left(code_postal,2)= '74'");

                        foreach ($queryType as $data){
                            $type[]= $data['type'];
                        };
                        $adresseType = [];
                        for ($p=0;$p<count($type);$p++){
                            $adresseType[$p] = [$type[$p]];
                        };

                        ?>

                        <script>
                            let coords = [];
                            coords.push(<?php echo json_encode($positionTab)?>);
                            coords = coords[0];

                            let noms = [];
                            noms.push(<?php echo json_encode($adresseMap)?>);
                            noms = noms[0];


                            let ville = [];
                            ville.push(<?php echo json_encode($adresseVille)?>);
                            ville = ville[0];


                            let type = [];
                            type.push(<?php echo json_encode($adresseType)?>);
                            type = type[0];

                           let newType = type.map(element =>{
                               if (element == 'R'){
                                   return 'sur la ROUTE';
                               } else if (element == 'A'){
                                   return 'sur l`AUTOROUTE'
                               } else {
                                   return element
                               }
                           });
                           console.log(newType);


                          var map = L.map('map').setView([45.89860986946062, 6.12917203841142], 13);

                            var CartoDB_VoyagerLabelsUnder = L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager_labels_under/{z}/{x}/{y}{r}.png', {
                                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
                                subdomains: 'abcd',
                                maxZoom: 20
                            }).addTo(map);


                            let queryLength = ville.length;
                           // console.log(queryLength);

                            for (let i = 0; i <queryLength; i++) {
                                var pop = L.popup({
                                    closeOnClick: true
                                }).setContent('<h6>Adresse : ' + noms[i] + '<h6>Ville : '+ ville[i] +'<h6>Type : '+ newType[i]);

                                var marker = L.marker(coords[i]).addTo(map).bindPopup(pop);
                            }
                        </script>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <section class="graphiqueUN">
        <h1 id="phraseDEUX">Evolution du prix moyen du Carburant en France</h1>
        <div class="metLeGraphique">
            <div id="phpLink">
                <?php
                $query = $pdo->query("SELECT AVG(valeur), extract(YEAR from date) FROM prix
                                JOIN carburant ON prix.carburant_id = carburant.id
                               -- AND  carburant.nom = 'Gazole'
                                AND(extract(YEAR from date)=2007
                                OR extract(YEAR from date)=2014
                                OR extract(YEAR from date)=2023)
                                GROUP BY extract(YEAR from date)");


                $queryHS = $pdo->query(
                    "SELECT AVG(valeur), extract(YEAR from date) FROM prix
    JOIN carburant ON prix.carburant_id = carburant.id
    JOIN point_de_vente ON prix.point_de_vente_id = point_de_vente.id
    AND left(code_postal,2)= '74'
    AND(extract(YEAR from date)=2007
        OR extract(YEAR from date)=2014
        OR extract(YEAR from date)=2023)
GROUP BY extract(YEAR from date)"
                );

                foreach ($query as $data)
                {
                    $avg[]=$data['avg'];
                    $extract[]=$data['extract'];
                };

                foreach ($queryHS as $data2){
                    $avgHS[]=$data2['avg'];
                }
                ?>
                <div>
                <canvas id="barCanvas" ></canvas>
                </div>
                <script >
                    const graphUn = document.getElementById("barCanvas");
                    // const moy2007= document.getElementById("phpLink")
                    new Chart(graphUn,{
                        type:"bar",
                        data: {
                            labels:<?php echo json_encode($extract)?>,
                            datasets:[{
                                label: 'Moyenne en France',
                                data: <?php echo json_encode($avg)?>,
                                backgroundColor:'#FB9366',
                                borderColor:'#FB9366'
                            },
                                {
                                    label: 'Moyenne en Haute-Savoie',
                                    data: <?php echo json_encode($avgHS)?>,
                                    backgroundColor: '#FDD238',
                                    borderColor:'#FDD238'
                                }],

                        },

                        options:{
                            scales:{
                                y:{
                                    beginAtZero: true,
                                    min:0,
                                    max:2,
                                    grace: '5%',
                                    ticks:{
                                        stepSize: 0.002

                                    }
                                }
                            }
                        }
                    })
                </script>
            </div>
        </div>
        <h3 class="expDEUX">Sur ce graphique , vous pouvez voir la moyenne des prix de carburants en France representer entre 2007 jusqu’en 2023 . </h3>
        <h3 class="expTROIS">Nous pouvons voir une augmentation remarcable , nous avons commencé a envrion 1 euro , puis d’année en année le prix n’a fais que augmenter jusqu’a arrivé a 2 euros ! </h3>
    </section>
    <section class="graphiqueDEUX">
        <h1 id="phraseTROIS">Evolution des prix pour chaque carburant en France/Haute-savoie</h1>
        <div class="metLeGraphiqueDeux">
            <a class="btn btn-primary" href="/?url=SP95" role="button">SP95</a>
            <a class="btn btn-primary" href="/?url=E10" role="button">E10</a>
            <a class="btn btn-primary" href="/?url=E85" role="button">E85</a>
            <a class="btn btn-primary" href="/?url=GPLC" role="button">GPLC</a>
            <a class="btn btn-primary" href="/?url=GAZOLE" role="button">GAZOLE</a>
            <a class="btn btn-primary" href="/?url=SP98" role="button">SP98</a>
            <?php
            $varCarbur =NULL;
            switch ($_GET['url']){

                case 'SP95';
                    $varCarbur= "SP95";
                    break;
                case 'SP98';
                    $varCarbur= 'SP98';
                    break;
                case 'E85';
                    $varCarbur= 'E85';
                    break;
                case 'GAZOLE';
                    $varCarbur= 'Gazole';
                    break;
                case 'GLPC';
                    $varCarbur= 'GPLc';
                    break;
                default;
                    $varCarbur= 'E10';
                    break;
            };


            $queryHSE10 = $pdo->query("SELECT AVG(valeur), extract(YEAR from date) FROM prix
    JOIN carburant ON prix.carburant_id = carburant.id
    JOIN point_de_vente ON prix.point_de_vente_id = point_de_vente.id
    AND  carburant.nom = '$varCarbur'
    AND left(code_postal,2)= '74'
    AND(extract(YEAR from date)=2007
        OR extract(YEAR from date)=2014
        OR extract(YEAR from date)=2023)
GROUP BY extract(YEAR from date)");

            $queryFE10 = $pdo->query("SELECT AVG(valeur), extract(YEAR from date) FROM prix
                                JOIN carburant ON prix.carburant_id = carburant.id
                               AND  carburant.nom ='$varCarbur'
                                AND(extract(YEAR from date)=2007
                                OR extract(YEAR from date)=2014
                                OR extract(YEAR from date)=2023)
                                GROUP BY extract(YEAR from date)");

            foreach ($queryHSE10 as $data)
            {
                $avgHSE10[]=$data['avg'];
                $extractHSE10[]=$data['extract'];
            }
            foreach ($queryFE10 as $data)
            {
                $avgFE10[]=$data['avg'];
                $extractFE10[]=$data['extract'];
            }
            ?>


            <canvas id="barCanvasE10" aria-label="chart" role="img"></canvas>

            <script>
                const barCanvasE10 = document.getElementById("barCanvasE10");
                // const moy2007= document.getElementById("phpLink")
                const barChartE10 = new Chart(barCanvasE10,{
                    type:"bar",
                    data:{
                        labels: <?php echo json_encode($extractFE10)?>,
                        datasets:[
                            {
                                label: "France",
                                data: <?php echo json_encode($avgFE10)?>,
                                backgroundColor:'#FB9366',
                                borderColor:'#FB9366'
                            },
                            {
                                label: "Haute Savoie",
                                data:<?php echo json_encode($avgHSE10)?>,
                                backgroundColor: '#FDD238',
                                borderColor:'#FDD238'
                            }
                        ]
                    },
                    options:{
                        scales:{
                            y:{
                                beginAtZero: true,
                                min:0,
                                max:2,
                                grace: '5%',
                                ticks:{
                                    stepSize: 0.002

                                }
                            }
                        }
                    }
                })
            </script>



        </div>
        <h3 class="expQUATRE">Vorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus, ut interdum tellus elit sed risus. Maecenas eget condimentum velit, sit amet feugiat lectus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent auctor purus luctus enim egestas, ac scelerisque ante pulvinar. Donec ut rhoncus ex. Suspendisse ac rhoncus nisl, eu tempor urna. Curabitur vel bibendum lorem. Morbi convallis convallis diam sit amet lacinia. Aliquam in elementum tellus.</h3>
    </section>
    <div>
        <h1 id="phraseTROIS">Nombre de ruptures pour chaques carburant en France et en Haute-Savoie de 2007 a 2023 </h1>
     </div>
    <div class="container">
        <div class="row">
            <div class="col d-flex justify-content-center">
                <canvas id="barCanvasDeux" ></canvas>
            </div>

        </div>

    </div>
    <?php
    $queryRuptureF = $pdo->query("SELECT count(rupture.carburant_id), nom FROM rupture
                        JOIN carburant c on c.id = rupture.carburant_id
                        GROUP BY nom");
    $queryRuptureHS = $pdo->query("SELECT count(rupture.carburant_id), nom FROM rupture
                        JOIN carburant c on c.id = rupture.carburant_id
                        join point_de_vente on rupture.point_de_vente_id = point_de_vente.id
                        where left(code_postal,2)= '74'
                        GROUP BY nom");
    foreach ($queryRuptureF as $dataRuptureF){
        $NbSationRupture[] = $dataRuptureF['count'];
        $NomCarburant[] = $dataRuptureF['nom'];
    };
    foreach ($queryRuptureHS as $dataRuptureHS){
        $NbSationRuptureHS []= $dataRuptureHS['count'];
    }
    ?>
    <script>
        const graphDeux = document.getElementById("barCanvasDeux");
        // const moy2007= document.getElementById("phpLink")
        new Chart(graphDeux,{
            type:"doughnut",
            data: {
                labels:<?php echo json_encode($NomCarburant)?>,
                datasets:[{
                    borderDash: [1],
                    label: 'Nombre de fois que le carburant a été en rupture en France',
                    data: <?php echo json_encode($NbSationRupture)?>,
                    borderWidth: 2
                },
                    {
                        borderDash: [1],
                        label: 'Nombre de fois que le carburant a été en rupture en Haute-Savoie',
                        data: <?php echo json_encode($NbSationRuptureHS)?>,
                        borderWidth: 2
                    }

            ]
            }
        })
    </script>
    </div>
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
                    <p class="fin text-white">2023 Copyrightt, Inc</p>
                </div>
            </section>
        </div>
    </div>
</footer>

</body>
</html>
