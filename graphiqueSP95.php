<!---->
<?php
$queryHSSP95 = $pdo->query("SELECT AVG(valeur), extract(YEAR from date) FROM prix
    JOIN carburant ON prix.carburant_id = carburant.id
    JOIN point_de_vente ON prix.point_de_vente_id = point_de_vente.id
    AND  carburant.nom = 'SP95'
    AND left(code_postal,2)= '74'
    AND(extract(YEAR from date)=2007
        OR extract(YEAR from date)=2014
        OR extract(YEAR from date)=2023)
GROUP BY extract(YEAR from date)");

$queryFSP95 = $pdo->query("SELECT AVG(valeur), extract(YEAR from date) FROM prix
                                JOIN carburant ON prix.carburant_id = carburant.id
                               AND  carburant.nom = 'SP95'
                                AND(extract(YEAR from date)=2007
                                OR extract(YEAR from date)=2014
                                OR extract(YEAR from date)=2023)
                                GROUP BY extract(YEAR from date)");

foreach ($queryHSSP95 as $data)
{
    $avgHSSP95[]=$data['avg'];
    $extractHSSP95[]=$data['extract'];
}
foreach ($queryFSP95 as $data)
{
    $avgFSP95[]=$data['avg'];
    $extractFSP95[]=$data['extract'];
}
?>


<canvas id="barCanvasSP95" aria-label="chart" role="img"></canvas>

<script>
    const barCanvasSP95 = document.getElementById("barCanvasSP95");
    // const moy2007= document.getElementById("phpLink")
    const barChartSP95 = new Chart(barCanvasSP95,{
        type:"bar",
        data:{
            labels: <?php echo json_encode($extractFSP95)?>,
            datasets:[
                {
                    label: "France",
                    data: <?php echo json_encode($avgFSP95)?>,
                },
                {
                    label: "Haute Savoie",
                    data:<?php echo json_encode($avgHSSP95)?>
                }
            ]
        }
    })
</script>
