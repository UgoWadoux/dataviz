<!---->
<?php
$queryHSSP98 = $pdo->query("SELECT AVG(valeur), extract(YEAR from date) FROM prix
    JOIN carburant ON prix.carburant_id = carburant.id
    JOIN point_de_vente ON prix.point_de_vente_id = point_de_vente.id
    AND  carburant.nom = 'SP98'
    AND left(code_postal,2)= '74'
    AND(extract(YEAR from date)=2007
        OR extract(YEAR from date)=2014
        OR extract(YEAR from date)=2023)
GROUP BY extract(YEAR from date)");

$queryFSP98 = $pdo->query("SELECT AVG(valeur), extract(YEAR from date) FROM prix
                                JOIN carburant ON prix.carburant_id = carburant.id
                               AND  carburant.nom = 'SP98'
                                AND(extract(YEAR from date)=2007
                                OR extract(YEAR from date)=2014
                                OR extract(YEAR from date)=2023)
                                GROUP BY extract(YEAR from date)");

foreach ($queryHSSP98 as $data)
{
    $avgHSSP98[]=$data['avg'];
    $extractHSSP98[]=$data['extract'];
}
foreach ($queryFSP98 as $data)
{
    $avgFSP98[]=$data['avg'];
    $extractFSP98[]=$data['extract'];
}
?>


<canvas id="barCanvasSP98" aria-label="chart" role="img"></canvas>

<script>
    const barCanvasSP98 = document.getElementById("barCanvasSP98");
    // const moy2007= document.getElementById("phpLink")
    const barChartSP98 = new Chart(barCanvasSP98,{
        type:"bar",
        data:{
            labels: <?php echo json_encode($extractFSP98)?>,
            datasets:[
                {
                    label: "France",
                    data: <?php echo json_encode($avgFSP98)?>,
                },
                {
                    label: "Haute Savoie",
                    data:<?php echo json_encode($avgHSSP98)?>
                }
            ]
        }
    })
</script>

