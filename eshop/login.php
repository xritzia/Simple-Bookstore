<?php 
session_start();

// Log-in Error
if (isset($_SESSION["login_error"]) && $_SESSION["login_error"] == true) {
	echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
        swal("Sorry!", "Incorrect password.", "error");
    });
    </script>';
    $_SESSION["login_error"] = false;
}

// Log-in Error 1
if (isset($_SESSION["login_error1"]) && $_SESSION["login_error1"] == true) {
    echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
        swal("Sorry!", "User doesn\'t exist.", "error");
    });
    </script>';
    $_SESSION["login_error1"] = false;
}

$title = 'Book 101 - Log-in';
include('header.php');
include('back.php');
?>
</header>
<main>
<!-- Log-in -->
	<form class="loginform" id="loginform" method="POST" action="logindb.php" enctype="multipart/form-data">
		<h2 class="regiH2 underline1">Log-in Here!</h2>
		<input class="loginbox" type="text" name="email" placeholder="e-mail"><br>
		<input class="loginbox" type="password" name="password" placeholder="password"><br>
		<input class="loginbtn btnhov" type="submit" name="login" value="Log-in">
	</form>
</main>

<?php 
include('footer.php');
?>
