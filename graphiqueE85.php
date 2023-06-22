<!---->
<?php
$queryHSE85 = $pdo->query("SELECT AVG(valeur), extract(YEAR from date) FROM prix
    JOIN carburant ON prix.carburant_id = carburant.id
    JOIN point_de_vente ON prix.point_de_vente_id = point_de_vente.id
    AND  carburant.nom = 'E85'
    AND left(code_postal,2)= '74'
    AND(extract(YEAR from date)=2007
        OR extract(YEAR from date)=2014
        OR extract(YEAR from date)=2023)
GROUP BY extract(YEAR from date)");

$queryFE85 = $pdo->query("SELECT AVG(valeur), extract(YEAR from date) FROM prix
                                JOIN carburant ON prix.carburant_id = carburant.id
                               AND  carburant.nom = 'E85'
                                AND(extract(YEAR from date)=2007
                                OR extract(YEAR from date)=2014
                                OR extract(YEAR from date)=2023)
                                GROUP BY extract(YEAR from date)");

foreach ($queryHSE85 as $data)
{
    $avgHSE85[]=$data['avg'];
    $extractHSE85[]=$data['extract'];
}
foreach ($queryFE85 as $data)
{
    $avgFE85[]=$data['avg'];
    $extractFE85[]=$data['extract'];
}
?>


<canvas id="barCanvasE85" aria-label="chart" role="img"></canvas>

<script>
    const barCanvasE85 = document.getElementById("barCanvasE85");
    // const moy2007= document.getElementById("phpLink")
    const barChartE85 = new Chart(barCanvasE85,{
        type:"bar",
        data:{
            labels: <?php echo json_encode($extractFE85)?>,
            datasets:[
                {
                    label: "France",
                    data: <?php echo json_encode($avgFE85)?>,
                },
                {
                    label: "Haute Savoie",
                    data:<?php echo json_encode($avgHSE85)?>
                }
            ]
        }
    })
</script>

