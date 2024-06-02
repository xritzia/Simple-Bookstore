<?php 
$title = 'Book 101 - Register';
include('header.php');
include('back.php');
?>

</header>
	<main>
	<!-- Register Form -->
		<div class="loginform">
			<h2 class="regiH2 underline1">Not a member? Register here!</h2>
			<div id="error"></div>
			<form id="registerform" method="POST" action="registerdb.php">
				<input class="regibox" type="text" id="fname" name="fname" placeholder="first-name">
				<input class="regibox" type="text" id="lname" name="lname" placeholder="last-name"><br>
				<input class="regibox regimail" type="text" id="remail" name="remail" placeholder="e-mail"><br>
				<input class="regibox" type="password" id="rpassword" name="rpassword" placeholder="password">
				<input class="regibox" type="password" id="repassword" name="repassword" placeholder="repeat password"><br>
				<input class="regibtn btnhov" type="submit" id="registerbtn" name="register" value="Register">
			</form>
		</div>
	</main>

<?php 
include('footer.php');
?>