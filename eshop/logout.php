<?php
if (isset($_POST['logout'])) {
    // Destroy session - Log out
    session_destroy();
    header("Location: index.php");
    exit();
}
?>

<!-- Log-out and Cart buttons -->
    <form method="POST" action="">
        <button class="logout btnhovcl" type="submit" name="logout">Log-out</button>
    </form>
    <button class="cart carthov" onclick="location.href='cart.php'">Cart <i class="fa-solid fa-cart-shopping" style="color: #000000;"></i></button>
</header>