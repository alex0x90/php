<?php

include("includes/header.php");

if(isset($_GET['q'])) {
	$query = $_GET['q'];
}
else {
	$query = "";
}

if(isset($_GET['type'])) {
	$type = $_GET['type'];
}
else {
	$type = "name";
}
?>

<div class="main_column column" id="main_column">

	<?php 
	if($query == "")
		echo "אתה חייב להזין שם לחיפוש";
	else {



		//If query contains an underscore, assume user is searching for usernames
		if($type == "username") 
			$usersReturnedQuery = mysqli_query($con, "SELECT * FROM users WHERE username LIKE '$query%' AND user_closed='no' LIMIT 8");
		//If there are two words, assume they are first and last names respectively
		else {

			$names = explode(" ", $query);

			if(count($names) == 3)
				$usersReturnedQuery = mysqli_query($con, "SELECT * FROM users WHERE (first_name LIKE '$names[0]%' AND last_name LIKE '$names[2]%') AND user_closed='no'");
			//If query has one word only, search first names or last names 
			else if(count($names) >= 2)
				$usersReturnedQuery = mysqli_query($con, "SELECT * FROM users WHERE (first_name LIKE '$names[0]%' AND last_name LIKE '$names[1]%')OR (test LIKE '$names[0]%' AND test LIKE '$names[1]%')  AND user_closed='no'");
			else 
				$usersReturnedQuery = mysqli_query($con, "SELECT * FROM users WHERE (first_name LIKE '$names[0]%' OR last_name LIKE '$names[0]%') OR (test LIKE '$names[0]%' AND test LIKE '$names[1]%') AND user_closed='no'");
		}

		//Check if results were found 
		if(mysqli_num_rows($usersReturnedQuery) == 0)
			echo " אי אפשר למצוא את " . $type . " לייקים: " .$query;
		else 
			echo mysqli_num_rows($usersReturnedQuery) . " תוצאות החיפוש: <br> <br>";


		echo "<p id='grey'>תנסה לחפש:</p>";
		echo "<a href='search.php?q=" . $query ."&type=name'>שם פרטי</a>, <a href='search.php?q=" . $query ."&type=username'>שם משתמש</a><br><br><hr id='search_hr'>";

		while($row = mysqli_fetch_array($usersReturnedQuery)) {
			$user_obj = new User($con, $user['username']);

			$button = "";
			$mutual_friends = "";

			if($user['username'] != $row['username']) {

				//Generate button depending on friendship status 
				if($user_obj->isFriend($row['username']))
					$button = "<input type='submit' name='" . $row['username'] . "' class='danger' value='הסר חבר'>";
				else if($user_obj->didReceiveRequest($row['username']))
					$button = "<input type='submit' name='" . $row['username'] . "' class='warning' value='הגב לבקשה'>";
				else if($user_obj->didSendRequest($row['username']))
					$button = "<input type='submit' class='default' value='בקשה נשלחה'>";
				else 
					$button = "<input type='submit' name='" . $row['username'] . "' class='success' value='הוסף חבר'>";

				$mutual_friends = $user_obj->getMutualFriends($row['username']) . " חבר משותף ";


				//Button forms
				if(isset($_POST[$row['username']])) {

					if($user_obj->isFriend($row['username'])) {
						$user_obj->removeFriend($row['username']);
						header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
					}
					else if($user_obj->didReceiveRequest($row['username'])) {
						header("Location: requests.php");
					}
					else if($user_obj->didSendRequest($row['username'])) {

					}
					else {
						$user_obj->sendRequest($row['username']);
						header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
					}

				}



			}

			echo "<div class='search_result'>
					<div class='searchPageFriendButtons'>
						<form action='' method='POST'>
							" . $button . "
							<br>
						</form>
					</div>


					<div class='result_profile_pic'>
						<a href='" . $row['username'] ."'><img src='". $row['profile_pic'] ."' style='height: 100px;'></a>
					</div>

						<a href='" . $row['username'] ."'> " . $row['first_name'] . " " . $row['last_name'] . "
						<p id='grey'> " . $row['username'] ."</p>
						</a>
						<br>
						" . $mutual_friends ."<br>

				</div>
				<hr id='search_hr'>";

		} //End while
	}


	?>



</div>