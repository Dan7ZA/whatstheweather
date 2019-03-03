<?php 
	
	$weather = "";
	$error = "";
	
	if ($_GET['city']){
			
		$urlContents = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".urlencode($_GET['city'])."&appid=XXX");
			
		$weatherArray = json_decode($urlContents, true);
		
		if($weatherArray['cod']==200){
			
			$weather = "The weather in ".$_GET['city']." is currently '".$weatherArray['weather'][0]['description']."'";
			
			$tempInCelsius = intval($weatherArray['main']['temp']-273);
			
			$weather .= " and the temperature is ".$tempInCelsius."&deg;C.";
			
			if($_GET['city']=="Amsterdam"){
				$weather .= " Also, I love you Philippa Phelp";
			}
			
		} else {
			
			$error = "Could not find ".$_GET['city'].", please try again";
			
		}
		
		
		
	}

?>

<!doctype html>
<html lang="en">
 <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
	integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
	crossorigin="anonymous">
	
	<title>Weather Report</title>
	
	<style type="text/css">
	
		html{ 
			background: url(background.jpg) no-repeat center center fixed; 
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		}
		
		body {
			
			background: none;
			
		}
		
		.container {
			
			text-align: center;
			margin-top: 200px;
			width: 450px;
			
		}
		
		input {
			
			margin:20px;
			
		}	
		
		button {
			
			margin-bottom:20px;
			
		}
		

	
	</style>
    
 </head>
  <body>
	<div class="container">
	
		<h1>What's the Weather?</h1>
		
		<form>
			<div class="form-group">
				<label for="city">Enter the name of a city.</label>
				<input type="text" class="form-control" id="city" name="city" placeholder="eg New York, London">
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
		
		<div id="weather">
			<?php 
              
            if ($weather) {
                  
                echo '<div class="alert alert-success" role="alert">'.$weather.'</div>';
                  
            } else if ($error) {
                  
                echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
				
			}
			?></div>
	
	</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>