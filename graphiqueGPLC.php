<!---->
<?php
$queryHSGPLc = $pdo->query("SELECT AVG(valeur), extract(YEAR from date) FROM prix
    JOIN carburant ON prix.carburant_id = carburant.id
    JOIN point_de_vente ON prix.point_de_vente_id = point_de_vente.id
    AND  carburant.nom = 'GPLc'
    AND left(code_postal,2)= '74'
    AND(extract(YEAR from date)=2007
        OR extract(YEAR from date)=2014
        OR extract(YEAR from date)=2023)
GROUP BY extract(YEAR from date)");

$queryFGPLc = $pdo->query("SELECT AVG(valeur), extract(YEAR from date) FROM prix
                                JOIN carburant ON prix.carburant_id = carburant.id
                               AND  carburant.nom = 'GPLc'
                                AND(extract(YEAR from date)=2007
                                OR extract(YEAR from date)=2014
                                OR extract(YEAR from date)=2023)
                                GROUP BY extract(YEAR from date)");

foreach ($queryHSGPLc as $data)
{
    $avgHSGPLc[]=$data['avg'];
    $extractHSGPLc[]=$data['extract'];
}
foreach ($queryFGPLc as $data)
{
    $avgFGPLc[]=$data['avg'];
    $extractFGPLc[]=$data['extract'];
}
?>


<canvas id="barCanvasGPLc" aria-label="chart" role="img"></canvas>

<script>
    const barCanvasGPLc = document.getElementById("barCanvasGPLc");
    // const moy2007= document.getElementById("phpLink")
    const barChartGPLc = new Chart(barCanvasGPLc,{
        type:"bar",
        data:{
            labels: <?php echo json_encode($extractFGPLc)?>,
            datasets:[
                {
                    label: "France",
                    data: <?php echo json_encode($avgFGPLc)?>,
                },
                {
                    label: "Haute Savoie",
                    data:<?php echo json_encode($avgHSGPLc)?>
                }
            ]
        }
    })
</script>

