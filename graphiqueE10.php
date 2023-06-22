<div id="phpLink">
    <?php
    $queryHSE10 = $pdo->query("SELECT AVG(valeur), extract(YEAR from date) FROM prix
    JOIN carburant ON prix.carburant_id = carburant.id
    JOIN point_de_vente ON prix.point_de_vente_id = point_de_vente.id
    AND  carburant.nom = 'E10'
    AND left(code_postal,2)= '74'
    AND(extract(YEAR from date)=2007
        OR extract(YEAR from date)=2014
        OR extract(YEAR from date)=2023)
GROUP BY extract(YEAR from date);");

    $queryFE10 = $pdo->query("SELECT AVG(valeur), extract(YEAR from date) FROM prix
JOIN carburant ON prix.carburant_id = carburant.id
JOIN point_de_vente ON prix.point_de_vente_id = point_de_vente.id
AND  carburant.nom = 'E10'
 AND(extract(YEAR from date)=2007
    OR extract(YEAR from date)=2014
    OR extract(YEAR from date)=2023)
GROUP BY extract(YEAR from date);");

    foreach ($queryHSE10 as $data)
    {
        $avgHSE10[]=$data['avg'];
        $extractHSE10[]=$data['extract'];
    };
    foreach ($queryFE10 as $data)
    {
        $avgFE10[]=$data['avg'];
     $extractFE10[]=$data['extract'];
    };
    ?>


    <canvas id="barCanvasE10" aria-label="chart" role="img"></canvas>

    <script >
        const barCanvasE10 = document.getElementById("barCanvasE10");
        // const moy2007= document.getElementById("phpLink")
        const barChartE10 = new Chart(barCanvasE10,{
            type:"bar",
            data:{
                labels: <?php echo json_encode($extractHSE10)?>,
                datasets:[{
                    data: <?php echo json_encode($avgFE10)?>,
                },{
                    data:<?php echo json_encode($avgHSE10)?>
                }]
            }
        })
    </script>
</div>
