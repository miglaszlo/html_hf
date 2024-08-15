<?php 
/*
    a felhasználót bejelentkezteti, és a session változókat beállítja
*/

include 'header.php'; ?>



<?php if(isset($_SESSION['username'])) {
    header('Location: index.php');
} ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = reach_db();
    
    $username = mysqli_escape_string($conn,$_POST["username"]);
    $password = mysqli_escape_string($conn, $_POST["password"]);

    $sql = "SELECT * FROM users WHERE username = '$username'";

    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row["password"])){
            $_SESSION["username"] = $username;  
            $_SESSION["id"] = $row["id"];
            header("Location: index.php");
            exit;
        } else {
            $error_msg = "Hibás felhasználónév vagy jelszó!";
        }
    } else {
        $error_msg = "Hibás felhasználónév vagy jelszó!";
    }

    mysqli_close($conn);
}
?>
<div class="main-container">
    <?php if(isset($error_msg)) { ?>
                <div class="error-container">
                    <h2 class="error">
                        <?php 
                        echo $error_msg;
                        ?>
                    </h2>
                </div>
            <?php } ?>

    <div class="centered-title">
      <h1>Bejelentkezés</h1>
    </div>

    <div id="login-form">
        <div id="post-login">
            <form method="POST" action="login.php">
                <input type="text" name="username" placeholder="Felhasználónév" required><br><br>         
                <input type="password" name="password" placeholder="Jelszó" required><br><br> 
                <button type="submit">Bejelentkezés</button>
            </form>
            <div id="not-registered">
                <p>Még nincs fiókja? <a href="register.php">Regisztráljon!</a></p>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
