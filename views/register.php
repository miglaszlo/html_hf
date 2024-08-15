<?php
/*
    regisztrációs oldal
*/


include 'header.php'; 

if(isset($_SESSION['username'])) {
    Header('Location: index.php');
}
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    if(isset($_GET['error_msg']))
        $error_msg = $_GET['error_msg'];
    $error_flag = true;
}
else{
    $error_flag = false;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $error_flag == false) {
    $error_flag = false;

    $conn = reach_db();
    
    $username = mysqli_escape_string($conn, $_POST['username']);
    $email = mysqli_escape_string($conn, $_POST['email']);
    $password = mysqli_escape_string($conn, $_POST['password']);
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if(!validateEmail($email)){
        $error_msg = "Hibás email cím!";
        $error_flag = true;

        
    }
    if(!validatePassword($password)){
        $error_msg = "Hibás jelszó!";
        $error_flag = true;

    }


    if (mysqli_num_rows($result) > 0) {
        $error_msg = "A felhasználónév már foglalt!";
        $error_flag = true;



    }
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $error_msg = "Az email cím már foglalt!";
        $error_flag = true;
        
    }
    if($error_flag){
        header('Location: register.php?error_msg=' . $error_msg);
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    if(!$error_flag){
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";
        $result = mysqli_query($conn, $sql);
        if ($result === TRUE) {
            echo 'Sikeres regisztráció!';
            $_SESSION['username'] = $username;
            $_SESSION['id'] = mysqli_insert_id($conn);
            header('Location: index.php');
            exit;
        } else {
            echo 'Hiba a regisztráció során!';
            exit;
        }
    }

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
        <h1>Regisztráció</h1>
    </div>

    <div id="registration-form">
        <div id="post-registration">
            <form method="POST" action="">
                <input type="text" name="username" placeholder="Felhasználónév" required><br><br>
                <input type="email" name="email" placeholder="Email" required><br><br>
                <input type="password" name="password" placeholder="Jelszo" required><br><br>
                Jelszónak tartalmaznia kell legalább speciális karaktert.
                <button type="submit">Regisztráció</button>
            </form>
            <div id="already-registered">
                <p>Már van fiókja? <a href="login.php">Jelentkezzen be!</a></p>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>