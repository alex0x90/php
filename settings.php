<?php 
include("includes/header.php");
include("includes/form_handlers/settings_handler.php");
?>

<div class="main_column column">

	<h4>הגדרות חשבון</h4>
	<?php
	echo "<img src='" . $user['profile_pic'] ."' class='small_profile_pic'>";
	?>
	<br>
	<a href="upload.php">העלה תמונת פרופיל</a> <br><br><br>

	על מנת לעדכן את נתוני המשתמש שלך הזן את הנתונים הבאים

	<?php
	$user_data_query = mysqli_query($con, "SELECT first_name, last_name, email FROM users WHERE username='$userLoggedIn'");
	$row = mysqli_fetch_array($user_data_query);

	$first_name = $row['first_name'];
	$last_name = $row['last_name'];
	$email = $row['email'];
	?>

	<form action="settings.php" method="POST">
		שם: <input type="text" name="first_name" value="<?php echo $first_name; ?>" id="settings_input"><br>
		שם משפחה: <input type="text" name="last_name" value="<?php echo $last_name; ?>" id="settings_input"><br>
		אימייל: <input type="text" name="email" value="<?php echo $email; ?>" id="settings_input"><br>

		<?php echo $message; ?>

		<input type="submit" name="update_details" id="save_details" value="עדכן נתונים" class="info settings_submit"><br>
	</form>

	<h4>שינוי סיסמא</h4>
	<form action="settings.php" method="POST">
		סיסמא ישנה: <input type="password" name="old_password" id="settings_input"><br>
		סיסמא חדשה: <input type="password" name="new_password_1" id="settings_input"><br>
		שוב סיסמא חדשה: <input type="password" name="new_password_2" id="settings_input"><br>

		<?php echo $password_message; ?>

		<input type="submit" name="update_password" id="save_details" value="עדכן סיסמא" class="info settings_submit"><br>
	</form>

	<h4>סגור חשבון זה</h4>
	<form action="settings.php" method="POST">
		<input type="submit" name="close_account" id="close_account" value="סגור חשבון" class="danger settings_submit">
	</form>


</div>