<!---->
<?php
$queryHSGazole = $pdo->query("SELECT AVG(valeur), extract(YEAR from date) FROM prix
    JOIN carburant ON prix.carburant_id = carburant.id
    JOIN point_de_vente ON prix.point_de_vente_id = point_de_vente.id
    AND  carburant.nom = 'Gazole'
    AND left(code_postal,2)= '74'
    AND(extract(YEAR from date)=2007
        OR extract(YEAR from date)=2014
        OR extract(YEAR from date)=2023)
GROUP BY extract(YEAR from date)");

$queryFGazole = $pdo->query("SELECT AVG(valeur), extract(YEAR from date) FROM prix
                                JOIN carburant ON prix.carburant_id = carburant.id
                               AND  carburant.nom = 'Gazole'
                                AND(extract(YEAR from date)=2007
                                OR extract(YEAR from date)=2014
                                OR extract(YEAR from date)=2023)
                                GROUP BY extract(YEAR from date)");

foreach ($queryHSGazole as $data)
{
    $avgHSGazole[]=$data['avg'];
    $extractHSGazole[]=$data['extract'];
}
foreach ($queryFGazole as $data)
{
    $avgFGazole[]=$data['avg'];
    $extractFGazole[]=$data['extract'];
}
?>


<canvas id="barCanvasGazole" aria-label="chart" role="img"></canvas>

<script>
    const barCanvasGazole = document.getElementById("barCanvasGazole");
    // const moy2007= document.getElementById("phpLink")
    const barChartGazole = new Chart(barCanvasGazole,{
        type:"bar",
        data:{
            labels: <?php echo json_encode($extractFGazole)?>,
            datasets:[
                {
                    label: "France",
                    data: <?php echo json_encode($avgFGazole)?>,
                },
                {
                    label: "Haute Savoie",
                    data:<?php echo json_encode($avgHSGazole)?>
                }
            ]
        }
    })
</script>

