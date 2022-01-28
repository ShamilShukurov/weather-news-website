<?php
include_once "config.php";
$link = $connection->prepare("SELECT DATE,Temperature,Humidity FROM Weather ORDER BY DATE");
$link->execute();
$graph_data = $link->fetchAll(PDO::FETCH_ASSOC);
$axisX = array();
$axisYP = array();
$axisY = array();
foreach ($graph_data as $data) {
    array_push($axisX, $data['DATE']);
    array_push($axisYP, $data['Humidity']);
    array_push($axisY, $data['Temperature']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/main.css">
    <title>Analysis</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-sm navbar-dark shadow">
            <a class="navbar-brand" href="index.php"><img src="assets/logo.png" alt="logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item ml-sm-4">
                        <a class="nav-link" href="index.php">HOME</a>
                    </li>
                    <li class="nav-item active ml-sm-4">
                        <a class="nav-link" href="analysis.php">ANALYSIS</a>
                    </li>
                    <li class="nav-item ml-sm-4">
                        <a class="nav-link" href="add.php">ADD</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 graph">
                    <h3>Temperature</h3>
                    <canvas id="canvas"></canvas>
                </div>
                <div class="col-md-6 graph">
                    <h3>Humidity</h3>
                    <canvas id="canvas2"></canvas>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <nav class="navbar navbar-dark shadow">
            <p>Copyright. All right reserved</p>
            <p>©2020</p>
        </nav>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js" integrity="sha512-zO8oeHCxetPn1Hd9PdDleg5Tw1bAaP0YmNvPY8CwcRyUk7d7/+nyElmFrB6f7vg4f7Fv4sui1mcep8RIEShczg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script>
        var ctx = document.getElementById('canvas').getContext('2d');
        var temp = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($axisX) ?>,
                datasets: [{
                    label: 'Temperature',
                    data: <?php echo json_encode($axisY) ?>,
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1
                }]
            }
        });
        var ctx2 = document.getElementById('canvas2').getContext('2d');
        var tempTemp = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($axisX) ?>,
                datasets: [{
                    label: 'Humidity',
                    data: <?php echo json_encode($axisYP) ?>,
                    backgroundColor: 'rgba(222, 243, 86, 0.2)',
                    borderColor: 'rgba(22, 243, 86, 1)',
                    borderWidth: 1
                }]
            }
        });
    </script>
</body>

</html>