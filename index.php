<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
          crossorigin="">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Title</title>
</head>
<body>
<header>
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand">Home</a>
            <a class="nav-link" href="#">About</a>
            <li class="nav-item">
                <input
                    class="form-control rounded"
                    placeholder="Rechercher ..."
                    aria-label="Search"
                    aria-describedby="search-addon"
                />
                <span class="input-group-text border-0" id="search-addon">
                    <i class="fas fa-search"></i>
                </span>
                <button type="button" class="btn btn-outline-success">Entrée</button>
        </div>
    </nav>
</header>
<main>
    <div class="pageUN">
        <img src="img/pexels.jpg" height="500" width="1700">
        <h2>En un coup d'oeil</h2>
        <p>Mise a jour le :jj/mm/aa</p>
    </div>
    <section class="row">
        <div class="column">
            <h1>4600</h1>
            <h5>En augmentation depuis 2022</h5>
            <h5>Nombre de stations EN HAUTE-SAVOIE</h5>
            <p>lE NOMBRE DE STATION-SERVICE EST EN CONSTANTE AUGMENTATION ET LA HAUTE-SAVOIE N’Y FAIT PAS EXCEPTION !</p>
        </div>
        <div class="column">
            <h1>1.60</h1>
            <h5>En augmentation depuis 2023</h5>
            <h5>PRIX MOYEN DEPUIS 2023</h5>
            <p>prix moyen de l’ÉSSENCE EN FRANCE LE PRIX MOYEN DE L’ÉSSENCE FACILEMENT ACCESSIBLE</p>
        </div>
        <div class="column">
            <h1>8.6%</h1>
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
        <div class="container">
            <div class="row">
                <div class="col-9">
                    <div id="map"></div>
                    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
                            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
                            crossorigin=""></script>
                    <script src="main.js"></script>
                </div>
                <div class="col-3">
                    <div id="photoOlfa"></div>
                    <img src="img/Capture%20d’écran%20du%202023-06-21%2015-12-47.png">
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
                               AND  carburant.nom = 'Gazole'
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







        <h3 class="expDEUX">Sur ce graphique , vous pouvez voir la moyenne des prix de carburants en France representer entre 2007 jusqu’en 2023 . </h3>
        <h3 class="expTROIS">Nous pouvons voir une augmentation remarcable , nous avons commencé a envrion 1 euro , puis d’année en année le prix n’a fais que augmenter jusqu’a arrivé a 2 euros ! </h3>
    </section>
    <section class="graphiqueDEUX">
        <h1 id="phraseTROIS">Evolution des prix moyens du carburant en France/Haute-savoie</h1>
        <div class="metLeGraphiqueDeux">
            <?php
            require('graphiqueE10.php');
            ?>
        </div>
        <h3 class="expQUATRE">Vorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus, ut interdum tellus elit sed risus. Maecenas eget condimentum velit, sit amet feugiat lectus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent auctor purus luctus enim egestas, ac scelerisque ante pulvinar. Donec ut rhoncus ex. Suspendisse ac rhoncus nisl, eu tempor urna. Curabitur vel bibendum lorem. Morbi convallis convallis diam sit amet lacinia. Aliquam in elementum tellus.</h3>
    </section>
</main>
<footer>
    <section class="row">
        <div class="column">
            <h5>Annecy 74000,France</h5>
            <h5>Fuel-France@info.fr</h5>
            <h5>07 98 56 31 67</h5>
        </div>
        <div class="column">
            <h5>https://www.service-public.fr</h5>
            <h5>https://www.prix-carburants.gouv.fr</h5>
            <h5>https://www.data.gouv.fr/fr</h5>
        </div>
    </section>

</footer>

</body>
</html>
