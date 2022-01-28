<?php
include_once "config.php";
if (array_key_exists('submit', $_POST)) {
    if (is_numeric($_POST['temperature']) && is_numeric($_POST['windSpeed']) && is_numeric($_POST['precipitation']) && is_numeric($_POST['humidity']) && is_numeric($_POST['pressure'])) {
        $sql = 'INSERT INTO `Weather` ( `DATE`, `TIME`, `Temperature`, `Wind_Speed`, `Precipitation`, `Humidity`, `Barometric_Pressure`, `DayID`, `Wind_DirectionID`) VALUES
        ( :da, :ti, :te, :wi, :pc, :hu, :pr, :dy, :wd)';
        $link = $connection->prepare($sql);
        $link->bindValue(':da', $_POST['date']);
        $link->bindValue(':ti', $_POST['time']);
        $link->bindValue(':te', $_POST['temperature']);
        $link->bindValue(':wi', $_POST['windSpeed']);
        $link->bindValue(':pc', $_POST['precipitation']);
        $link->bindValue(':hu', $_POST['humidity']);
        $link->bindValue(':pr', $_POST['pressure']);
        $link->bindValue(':dy', $_POST['day']);
        $link->bindValue(':wd', $_POST['windDirection']);
        $result = $link->execute();
        if ($result) {
            header("Location: index.php?res=success");
        } else {
            echo "error";
        }
    } else {
        $error = "Entered values are wrong";
    }
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
    <title>Add</title>
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
                    <li class="nav-item ml-sm-4">
                        <a class="nav-link" href="analysis.php">ANALYSIS</a>
                    </li>
                    <li class="nav-item active ml-sm-4">
                        <a class="nav-link" href="add.php">ADD</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="container-fluid">
        <section id="add" class="row justify-content-center">
            <div class="col-md-9">
                <h3 id="addHeader">ADD A NEW ROW</h3>
                <form action="add.php" method="post">

                    <?php if (isset($error)) echo '<div class="alert alert-danger" role="alert">' . $error . '</div>'; ?>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input class="form-control" type="date" name="date" id="date" required>
                    </div>
                    <div class="form-group">
                        <label for="time">Time</label>
                        <input class="form-control" type="time" name="time" id="time" required>
                    </div>
                    <div class="form-group">
                        <label for="temperature">Temperature</label>
                        <input class="form-control" type="text" name="temperature" id="temperature" required>
                    </div>
                    <div class="form-group">
                        <label for="windSpeed">Wind speed</label>
                        <input class="form-control" type="text" name="windSpeed" id="windSpeed" required>
                    </div>
                    <div class="form-group">
                        <label for="precipitation">Precipitation</label>
                        <input class="form-control" type="text" name="precipitation" id="precipitation" required>
                    </div>
                    <div class="form-group">
                        <label for="humidity">Humidity</label>
                        <input class="form-control" type="text" name="humidity" id="humidity" required>
                    </div>
                    <div class="form-group">
                        <label for="pressure">Pressure</label>
                        <input class="form-control" type="text" name="pressure" id="pressure" required>
                    </div>
                    <div class="form-group">
                        <select name="windDirection" class="custom-select">
                            <option>Select wind direction...</option>
                            <option value="1">North</option>
                            <option value="2">North-East</option>
                            <option value="3">South</option>
                            <option value="4">South-West</option>
                            <option value="5">East</option>
                            <option value="6">West</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="day" class="custom-select">
                            <option>Select day...</option>
                            <option value="1">Sunny</option>
                            <option value="2">Windy</option>
                            <option value="3">Snowy</option>
                            <option value="4">Foggy</option>
                            <option value="5">Rainy</option>
                            <option value="6">Cloudy</option>
                        </select>
                    </div>
                    <button type="submit" name="submit" class="btn">Submit</button>
                </form>
            </div>
        </section>
    </main>

    <footer>
        <nav class="navbar navbar-dark shadow">
            <p>Copyright. All right reserved</p>
            <p>©2020</p>
        </nav>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>