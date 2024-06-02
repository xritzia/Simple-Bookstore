<!-- Change Title -->
<?php $title = 'Welcome back!';?>

<!-- User Menu -->
<div class="usermenu">
	<h4>Welcome back <span class="username "><?php echo $_SESSION['username']; ?>!</span></h4>
	<?php
		// Check if the logged-in user has access to the button
		if ($_SESSION['email'] == 'admin@admin.com') {
			echo '<button class="btn btnhov" type="button" onClick="location.href=\'book.php\'">Upload a Book</button>';
		}
	?>
</div>


