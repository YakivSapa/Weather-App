<?php
  error_reporting(E_ERROR | E_PARSE);
  $weather = "";
  $error = "";
  if(isset($_GET['city'])){
    $urlContent = file_get_contents('https://api.openweathermap.org/data/2.5/weather?q='.$_GET['city'].'&units=metric&appid=5a77ca9276b4a4a704619c90347eb8e3');
    $forcastArray = json_decode($urlContent, true);
    if($forcastArray['cod'] == 200) {
      $weather = 'The weather in '.$_GET['city'].' is '.$forcastArray['weather'][0]['description'];
      $weather = $weather.'. The temperature is '.$forcastArray['main']['temp'].'&#8451;'.'. The speed of wind is '.$forcastArray['wind']['speed'].'m/sec';  
    } else {
      $error = "The city name is incorrect, please try another name.";
    }

  }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Weather App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="styles\style.css" rel="stylesheet" type="text/css">
  </head>
<body>

<!-- Main Form -->
<div class="container" id="mainDiv">
    <h1>Weather In The City</h1>

<form>
  <div class="form-group">
    <label for="city">Input a city name</label>
    <input class="form-control" id="city" name="city" aria-describedby="Forcast city" placeholder="Enter city name">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

<!-- Alert -->
<div id="forecastDiv">
    <?php
    if($weather){
      echo "<div class='alert alert-primary' role='alert'>".$weather."</div>";
    } else if ($error) {
      echo "<div class='alert alert-danger' role='alert'>".$error."</div>";
    }
    ?>

</div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>  
</body>
</html>