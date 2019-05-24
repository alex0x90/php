<?php  
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
?>

<html>
<head>
	<title>Ask Me</title>
	<link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="assets/js/register.js"></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8" />
</head>

<body>

	<?php  
    	if(isset($_POST['register_button'])) {
    		echo '
    		<script>
    
    		$(document).ready(function() {
    			$("#first").hide();
    			$("#second").show();
    		});
    
    		</script>
    
    		';
    	}
	?>

	<div class="wrapper">

		<div class="login_box">

			<div class="login_header">
				<h1>Ask Me</h1>
				<br>
				הפורום המוביל בישראל לשיתוף מידע
			</div>
			<br>
			<div id="first">
				<form action="register.php" method="POST">
					<input type="email" name="log_email" placeholder="הכנס אימייל" value="<?php 
					if(isset($_SESSION['log_email'])) {
						echo $_SESSION['log_email'];
					} 
					?>" required>
					<br>
					<input type="password" name="log_password" placeholder="הכנס סיסמא">
					<br>
					<?php if(in_array("Email or password was incorrect<br>", $error_array)) echo  "Email or password was incorrect<br>"; ?>
					<input type="submit" name="login_button" value="Login">
					<br>
					<a href="#" id="signup" class="signup">אין לך חשבון ? לחץ כאן להרשמה </a>
					<br>
					This site made by Yuval and Alex
				</form>
			</div>

			<div id="second">

				<form action="register.php" method="POST" id="sampleForm" name="sampleForm">
					<input type="text" name="reg_fname" placeholder="שם פרטי" value="<?php 
					if(isset($_SESSION['reg_fname'])) {
						echo $_SESSION['reg_fname'];
					} 
					?>" required>
					<br>
					<?php if(in_array("Your first name must be between 2 and 25 characters<br>", $error_array)) echo "Your first name must be between 2 and 25 characters<br>"; ?>
					
					


					<input type="text" name="reg_lname" placeholder="שם משפחה" value="<?php 
					if(isset($_SESSION['reg_lname'])) {
						echo $_SESSION['reg_lname'];
					} 
					?>" required>
					<br>
					<?php if(in_array("Your last name must be between 2 and 25 characters<br>", $error_array)) echo "Your last name must be between 2 and 25 characters<br>"; ?>

					<input type="email" name="reg_email" placeholder="הכנס אימייל" value="<?php 
					if(isset($_SESSION['reg_email'])) {
						echo $_SESSION['reg_email'];
					} 
					?>" required>
					<br>

					<input type="email" name="reg_email2" placeholder="אישר אימייל" value="<?php 
					if(isset($_SESSION['reg_email2'])) {
						echo $_SESSION['reg_email2'];
					} 
					?>" required>
					<br>
					<?php if(in_array("Email already in use<br>", $error_array)) echo "Email already in use<br>"; 
					else if(in_array("Invalid email format<br>", $error_array)) echo "Invalid email format<br>";
					else if(in_array("Emails don't match<br>", $error_array)) echo "Emails don't match<br>"; ?>


					<input type="password" name="reg_password" placeholder="בחר סיסמא" required>
					<br>
					<input type="password" name="reg_password2" placeholder="אשר סיסמא" required>
					<br>

					<input type="hidden" name="free_text" value="" required>
					<br>
					
					<div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">בחר קטגוריה
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                          <li class="dropdown-submenu">
                            <a class="test" tabindex="-1" href="#">מקצועות הנדסאים <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                              <li><a tabindex="-1" href="#" id="1">הנדסאי תוכנה</a></li>
                              <li><a tabindex="-1" href="#" id="2">הנדסאי תעשייה וניהול</a></li>
                    		   <li><a tabindex="-1" href="#" id="3">הנדסאי חשמל</a></li>
                              <li><a tabindex="-1" href="#" id="4">אדריכלות</a></li>
                            </ul>
                          </li>
                    	       <li class="dropdown-submenu">
                            <a class="test" tabindex="-1" href="#">מקצועות הנדסה <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                              <li><a tabindex="-1" href="#" id="6">הנדסת תוכנה</a></li>
                              <li><a tabindex="-1" href="#" id="7">הנדסת תעשייה וניהול</a></li>
                    		   <li><a tabindex="-1" href="#"id="8">הנדסת חשמל</a></li>
                              <li><a tabindex="-1" href="#" id="9">הנדסת בניין</a></li>
                            </ul>
                          </li>
                        </ul>
                </div>
				<br>	


				<br>
				<?php if(in_array("Your passwords do not match<br>", $error_array)) echo "Your passwords do not match<br>"; 
				else if(in_array("Your password can only contain english characters or numbers<br>", $error_array)) echo "Your password can only contain english characters or numbers<br>";
				else if(in_array("Your password must be betwen 5 and 30 characters<br>", $error_array)) echo "Your password must be betwen 5 and 30 characters<br>"; ?>
                <center>
                <div class="g-recaptcha" data-sitekey="6LebDnoUAAAAAASp-MrSpJkF327QxhNEQr2UM518"></div>
                </center>     
                <br>
				<input type="submit" name="register_button" value="הירשם">
				<br>

				<?php if(in_array("<span style='color: #14C800;'>כבר משתמש רשום ? לחץ </span><br>", $error_array)) echo "<span style='color: #14C800;'>כבר משתמש רשום ? לחץ </span><br>"; ?>
					<a href="#" id="signin" class="signin">כבר משתמש רשום ? לחץ כאן</a>
				</form>
			</div>
		</div>
	</div>
    	
    <script>
        $(document).ready(function(){
          $('.dropdown-submenu a.test').on("click", function(e){
            $(this).next('ul').toggle();
            e.stopPropagation();
            e.preventDefault();
          });
        });
        	
        var reply_click = function()
        {
        	var x = this.innerText;
        	 document.sampleForm.free_text.value = x;
            //alert(x);
        }
        document.getElementById('1').onclick = reply_click;
        document.getElementById('2').onclick = reply_click;
        document.getElementById('3').onclick = reply_click;	
        document.getElementById('4').onclick = reply_click;	
        document.getElementById('6').onclick = reply_click;
        document.getElementById('7').onclick = reply_click;	
        document.getElementById('8').onclick = reply_click;	
        document.getElementById('9').onclick = reply_click;
    </script> 

</body>
</html>