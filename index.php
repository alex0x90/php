<?php 
include("includes/header.php");


if(isset($_POST['post'])){
	$post = new Post($con, $userLoggedIn);
	//  echo  $_POST['post_text'] . "<br>"; 
	//  echo  $_POST['post_text1'];
	
	$title = $_POST['post_text'];
	// echo $title;
	$body = $_POST['post_text1'];
	// echo $body;
	$post->submitPost($title , $body , 'none');
}


 ?>
	<div class="user_details column">
		<a href="<?php echo $userLoggedIn; ?>">  <img src="<?php echo $user['profile_pic']; ?>"> </a>

		<div class="user_details_left_right">
			<a href="<?php echo $userLoggedIn; ?>">
			<?php 
			echo $user['first_name'] . " " . $user['last_name'];

			 ?>
			</a>
			<br>
			<?php echo " פוסט: " . $user['num_posts']. "<br>"; 
			echo " לייק: " . $user['num_likes']. "<br>";
			echo " קטגוריה: " . $user['test']. "<br>";
			?>
		</div>

	</div>

	<div class="main_column column">
		<form class="post_form" action="index.php" method="POST">
			<textarea name="post_text" id="post_text" placeholder="שאל"></textarea>
			<textarea name="post_text1" id="post_text1" placeholder="תוכן השאלה"></textarea>
			
			<input type="submit" name="post" id="post_button" value="שלח">
			<hr>

		</form>

		<div class="posts_area"></div>
		<img id="loading" src="assets/images/icons/loading.gif">


	</div>

	<script>
	var userLoggedIn = '<?php echo $userLoggedIn; ?>';

	$(document).ready(function() {

		$('#loading').show();

		//Original ajax request for loading first posts 
		$.ajax({
			url: "includes/handlers/ajax_load_posts.php",
			type: "POST",
			data: "page=1&userLoggedIn=" + userLoggedIn,
			cache:false,

			success: function(data) {
				$('#loading').hide();
				$('.posts_area').html(data);
			}
		});

		$(window).scroll(function() {
			var height = $('.posts_area').height(); //Div containing posts
			var scroll_top = $(this).scrollTop();
			var page = $('.posts_area').find('.nextPage').val();
			var noMorePosts = $('.posts_area').find('.noMorePosts').val();

			if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false') {
				$('#loading').show();

				var ajaxReq = $.ajax({
					url: "includes/handlers/ajax_load_posts.php",
					type: "POST",
					data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
					cache:false,

					success: function(response) {
						$('.posts_area').find('.nextPage').remove(); //Removes current .nextpage 
						$('.posts_area').find('.noMorePosts').remove(); //Removes current .nextpage 

						$('#loading').hide();
						$('.posts_area').append(response);
					}
				});

			} //End if 

			return false;

		}); //End (window).scroll(function())


	});

	</script>




	</div>
</body>
</html>