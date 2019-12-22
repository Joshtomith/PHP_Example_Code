<!--Joshua T Smith-->
<!--Purpose is to run a PHP script to output values realtive to Charleston's Heat/feel through a form-->
<!--Created 9/15/2019-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link rel="stylesheet" href="includes/style.css" type="text/css" media="screen" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
	<!--Inludes header at the top-->
	<?php
	$page_title = 'Heat Index!';
	include ('includes/header.html');
	?>
  <h1>Heat Index</h1>

  <!--first couple of explantory paragraphs of the h-index calculator-->
  <p>In the Summer, when people say "It’s not the heat, it’s the humidity", what do they
    mean? There are 2 factors that make a hot day feel really hot. The first is the air
    temperature and the second is relative humidity. After taking measurements for
    temperature and relative humidity, we can calculate a heat index that is called our “feels
    like” temperature.</p>
  <p>HI means Heat Index (the “Feels Like” Temperature).</p>
  <p>T means the air temperature (This formula works when temperatures are in the range of 80 to 112).</p>
  <p>RH means relative humidity (This formula works when relative humidity is in the range of 13 to 85)</p>

	<!--container for the error message and heat index output to allow for styling-->
	<p id="heat_index_container">
		<!--PHP Script that calculates Weather values-->
	  <?php
			//Checks to see if the user submitted the form
			if ($_SERVER['REQUEST_METHOD'] == 'POST')
			{
				//Validates humidity and temp are both not null and in the range of accepted values
				if((!empty($_POST['temperature']) && $_POST['temperature'] >= 80 && $_POST['temperature'] <= 112) && ((!empty($_POST['humidity']) && $_POST['humidity'] >= 13 && $_POST['humidity'] <= 85)))
		    {
					//Sets variables once validated
		      $temperature = $_POST['temperature'];
					$relative_humidity = $_POST['humidity'];
					#CALCULATIONS (Heat Index)
			    $heat_index = -42.379 + 2.04901523*$temperature + 10.14333127*$relative_humidity - .22475541*$temperature*$relative_humidity - .00683783*$temperature*$temperature -
			    .05481717*$relative_humidity*$relative_humidity + .00122874*$temperature*$temperature*$relative_humidity + .00085282*$temperature*$relative_humidity*$relative_humidity - .00000199*$temperature*$temperature*$relative_humidity*$relative_humidity;
					echo "The Heat Index is: $heat_index";
		    }
				//If not in the range of values or fails to validate and error message is generated and resets values
		    else
		    {
		      $temperature = NULL;
					$relative_humidity = NULL;
		      echo "The temperature should be a number between 80 and 112.<br>
						The humidity should be a number between 13 and 85.<br>
						Please try again.<br>";
		    }
			}
	  ?>
	</p><br>
  <!--End of PHP script-->

	<!--Html form where the user enters values to calculate heat index-->
	<form name="heat.php" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<b>Get the Heat Index</b></label><br><br>
		<label for="temperature" id="temperature_spacing">Temperature:</label>
	  <input type="number" id="Temperature" name="temperature"><br>
		<label for="humidity" id="humidity_spacing">Humidity:</label>
	  <input type="number" id="Humidity" name="humidity"><br>
	  <input type="submit" name="submit" value="Gimme the Heat Index">
  </form>

  <!--Closing paragraphs after the html form-->
  <p>If you need to take the temperature, but don't have a Thermometer, then see our Weather Workshops to
    find a workshop on How to make a Thermometer. (Create a Hyperlink for Weather Workshops to a
    workshops.php file)</p>
  <p>If you need to measure the relative humidity, but don't have a Hygrometer. Don't worry, we have a
    Weather Workshops that shows you how to make a Hygrometer too! (Create a Hyperlink for Weather
    Workshops to a workshops.php file)</p>
  <p>(You can go to the website for those other guys The Weather Channel to get these measurements, but
    taking measurements from them isn't as much fun as doing it yourself. (Create a Hyperlink for The
    Weather Channel to the weather.com website.)</p>

		<!--Inludes footer at the bottom-->
		<<?php include ('includes/footer.html'); ?>
</body>
</html>
