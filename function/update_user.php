<?php 

/*
    a POST-ban érkezet adatok alapján
    frissíti a felhasználó adatait
*/
include 'functions.php'; ?>
<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    $id = $_SESSION["id"];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $conn = reach_db();

    $checkUsernameQuery = "SELECT * FROM users WHERE username = '$username' AND id != $id";
    $resultUsername = mysqli_query($conn, $checkUsernameQuery);
    if (mysqli_num_rows($resultUsername) > 0) {

        header('Location: ../views/profil.php?error_msg=Felhasználónév foglalt!');
        exit;
    }
    if(!validateEmail($email)){
        header('Location: ../views/profil.php?error_msg=E-mail cím hibás!');
        exit;
    }

    $checkEmailQuery = "SELECT * FROM users WHERE email = '$email' AND id != $id";
    $resultEmail = mysqli_query($conn, $checkEmailQuery);
    if (mysqli_num_rows($resultEmail) > 0) {

        header('Location: ../views/profil.php?error_msg=E-mail cím foglalt!');
        exit;
    }


    
    if(!empty($password)){
        if(!validatePassword($password)){
            header('Location: ../views/profil.php?error_msg=Hibás jelszó!');
            exit;
        }
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE users SET username = '$username', email = '$email', password = '$hashedPassword' WHERE id = $id";
    } else {
        $query = "UPDATE users SET username = '$username', email = '$email' WHERE id = $id";
    }
    mysqli_query($conn, $query);
    $_SESSION['username'] = $username;
    $_SESSION['id'] = $id;
    mysqli_close($conn);
    header('Location: ../views/profil.php');
}

