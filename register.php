<!--Joshua T Smith-->
<!--Purpose is to run a self processing register form-->
<!--Created 9/16/2019-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link rel="stylesheet" href="includes/style.css" type="text/css" media="screen" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
  <?php
		//intializes workshops array
    $workshops[] = "";
		//sets page title
  	$page_title = 'Weather Wizards Registration';

		//this adds the header to the site
  	include ('includes/header.html');

    //Validates Name
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
      if(!empty($_POST['name']))
      {
        $name = $_POST['name'];
      }
      else
      {
				//error for failed validation of name
        $name = NULL;
        echo "<p><font color=red><b>You forgot to enter your name!</b></font>";
      }

      //Validate Guardian Name
      if(!empty($_POST['guardian']))
      {
        $guardian = $_POST['guardian'];
      }
      else
      {
				//error for failed validation of guardian name
        $guardian = NULL;
        echo "<p><font color=red><b>You forgot to enter your parent or guardian’s name!</b></font></p>";
      }

      //Validate Guardian Email
      if(!empty($_POST['email']))
      {
        $email = $_POST['email'];
      }
      else
      {
				//error for failed validation of guardian email
        $email = NULL;
        echo "<p><font color=red><b>You forgot to enter your parent or guardian’s email!</b></font></p>";
      }

      //Validate Guardian Phone
      if(!empty($_POST['phone']))
      {
        $phone = $_POST['phone'];
      }
      else
      {
				//error for failed validation of guardians phone number
        $phone = NULL;
        echo "<p><font color=red><b>You forgot to enter your parent or guardian’s phone number!</b></font></p>";
      }

      //Validate Membership Status
      if(!empty($_POST['member']))
      {
        $member = $_POST['member'];
      }
      else
      {
        $member = NULL;
        echo "<p><font color=red><b>You forgot to enter your membership status!</b></font></p>";
      }

			//sets the values entered for the workshops checkboxes
      if(isset($_POST['workshops']))
    	{
    		foreach ($_POST['workshops'] as $value)
    		{
    			$workshops[] = $value;
    		}
    	}

      //Checks to see if any mandatory variables are empty
      if ($name == NULL || $guardian == NULL || $email == NULL || $phone == NULL || $member == NULL)
      {
        echo "<p>Weather Wizard, we need your name and your parent or guardian's name, email, phone
          <br>and your membership status to send information about our workshops.<br> Enter required
          information and click the Register button again.</p>";
      }

      //If all Mandatory Info is filled out continues program
      else
      {
        //location center selection structure
        if($_POST['center'] == "charleston")
        {
          echo "<p>You are nearest to our Charleston SC location, the Holy City! Go River Dogs!</p>";
        }
        elseif($_POST['center'] == "summerville")
        {
          echo "<p>You are nearest to our Summerville SC location, the Birthplace of Sweet Tea! Refreshing!</p>";
        }
        elseif($_POST['center'] == "pleasant")
        {
          echo "<p>You are nearest to our Mt. Pleasant, SC location that has a historical and beachy vibe!</p>";
        }
        //If nothing matches
        else
        {
          echo "<p>Not sure of the nearest location? We will send you an email to keep in touch!</p>";
        }

        //Membership selection structure
        if($member == "yes")
        {
          echo "<p>Welcome back $name! Thank you for being a member of Weather Wizards</p>";
        }
        elseif($member == "no")
        {
          echo "<p>Hi $name, we hope you'll join Weather Wizards. We have more fun than a jar full of lightning bugs!</p>";
        }
        else
        {
          echo "<p>Hi $name! Welcome to Weather Wizards where the forecast is always a 99% chance of fun!</p>";
        }

				//Validates workshops isn't empty
        if (empty($_POST['workshops']))
        {
          echo "<p>You have not chosen a workshop, but we add new workshops all the time. We'll keep you updated by e-mail</p>";
        }
        //if the user picked a workshop(s) displays them from the array
        else
        {
          echo "<p>You have chosen the following workshop(s): </p>";
          foreach ($_POST['workshops'] as $workshop)
          {
            echo "<p>Make a $workshop</p>";
          }
        }
      }
  }
	?>

	<!--Beginning of Html-->
  <h1>Weather Wizards Workshops</h1>

  <!--Beginning Description-->
  <p class="tab">We host weather wizards workshops throughout the year for kids from 6-12</p>
  <p class="tab">Please note that the following workshops are free to members</p>

  <!--List of Free Workshops-->
  <div id="free_workshops">
    <ul>
      <li>Make a Rain Gauge</li>
      <li>Make a Thermometer</li>
    </ul>
  </div>
  <!--form that passes data to the verification script-->
  <form name="register.php" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset><legend><h2>Register Your Interests:</h2></legend>
      <p><label><input type="checkbox" name="workshops[]" value="Rain Guage" <?php if (in_array('Rain Guage', $workshops)) echo(' CHECKED '); ?>>Make a Rain Guage</label></p>
      <p><label><input type="checkbox" name="workshops[]" value="Thermometer" <?php if (in_array('Thermometer', $workshops)) echo(' CHECKED '); ?>>Make a Thermometer</label></p>
      <p><label><input type="checkbox" name="workshops[]" value="Windsock" <?php if (in_array('Windsock', $workshops)) echo(' CHECKED '); ?>>Make a Windsock</label></p>
      <p><label><input type="checkbox" name="workshops[]" value="Lightning in Your Mouth" <?php if (in_array('Lightning in Your Mouth', $workshops)) echo(' CHECKED '); ?>>Make a Lightning in Your Mouth</label></p>
      <p><label><input type="checkbox" name="workshops[]" value="Hygrometer" <?php if (in_array('Hygrometer', $workshops)) echo(' CHECKED '); ?>>Make a Hygrometer</label></p>

      <!--Name Entry Field(Mandatory) Entry-->
      <p class="tab">Your name:</p>
      <p class="tab"><label><input type="text" name="name" size="20" maxlength="60" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>"></label></p>

      <!--Guardian Name(Mandatory) Entry-->
      <p class="tab">Your parent or guardian's name:</p>
      <p class="tab"><label><input type="text" name="guardian" size="40" maxlength="60" value="<?php if (isset($_POST['guardian'])) echo $_POST['guardian']; ?>"></label></p>

      <!--Guardian Email(Mandatory) Entry-->
      <p class="tab">Your parent or guardian's email:</p>
      <p class="tab"><label><input type="email" name="email" size="40" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"></label></p>

      <!--Guardian Phone Number(Mandatory) Entry-->
      <p class="tab">Your parent or guardian's phone:</p>
      <p class="tab"><label><input type="tel" name="phone" size="40" maxlength="60" value="<?php if (isset($_POST['phone'])) echo $_POST['phone']; ?>"></label></p>

      <!--Drop down list of location-->
      <p class="tab"><label>Your closest center:
        <select name="center">
          <option value="charleston" <?php if (isset($_POST['center']) && ($_POST['center'] == 'charleston')) echo 'selected = "selected"'; ?>>Charleston</option>
          <option value="summerville" <?php if (isset($_POST['center']) && ($_POST['center'] == 'summerville')) echo 'selected = "selected"'; ?>>Summerville</option>
          <option value="pleasant" <?php if (isset($_POST['center']) && ($_POST['center'] == 'pleasant')) echo 'selected = "selected"'; ?>>Mt. Pleasant</option>
        </select></label>
      </p>

      <!--Member Bubble(Mandatory) Entry-->
      <p>
        <label for="member-field">Are you a member?</label><input type="radio" name="member" value="yes" <?php if (isset($_POST['member']) && ($_POST['member'] == 'yes')) echo 'checked="checked"'; ?>/>Yes</label>
        <label><input type="radio" name="member" value="no" <?php if (isset($_POST['member']) && ($_POST['member'] == 'no')) echo 'checked="checked"'; ?> />No</label>
        <label><input type="radio" name="member" value="sign_up" <?php if (isset($_POST['member']) && ($_POST['member'] == 'sign_up')) echo 'checked="checked"'; ?>/>Sign me up!</label>
      </p>

			<!--Register Button and Reset Button-->
      <p><input type="submit" name="submit" value="Register">
        <input type="reset" name="reset" value="Reset"></p>

    <!--END OF HTML FORM-->
    </fieldset>
  </form>
	<!--Script for including footer-->
	<?php include ('includes/footer.html'); ?>
</body>
</html>
