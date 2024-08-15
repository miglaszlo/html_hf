<?php session_start();
include '../function/functions.php';

$conn = reach_db();
if(isset($_SESSION['username'])) {
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '".$_SESSION['username']."'");
    $row = mysqli_fetch_assoc($result);
    $mode = $row['dark_mode'];
}else{
    $mode = null;

}
?>

<!DOCTYPE html>
<html lang="hu">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tied a Recept</title>
        <?php if($mode == 1) { ?>
            <link rel="stylesheet" href="../style/dark.css">
        <?php
        } else { ?>
            <link rel="stylesheet" href="../style/style.css">
        <?php } ?>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">




        
    </head>
    <body>
        <header>
            <?php
             if(!isset($_SESSION["username"])) { ?>
                <nav class="navbar">
                    <ul class="nav-list">
                        <li><a href="recipes.php">Felfedezés</a></li>
                        <li><a href="search.php">Keresés</a></li>


                        
                        <li><a href="index.php">Rólunk</a></li>
                        
                        <li><a href="register.php">Regisztráció</a></li>
                        <li><a href="login.php">Bejelentkezés</a></li>
                    </ul>
                </nav>
                <?php } ?>
                <?php if(isset($_SESSION["username"])){ ?>
                    <nav class="navbar">
                        <ul class="nav-list">
                            <li><a href="recipes.php">Felfedezés</a></li>
                            <li><a href="search.php">Keresés</a></li>
                    
                            <li class="dropdown">
                                <a href="#" class="dropbtn">Profil</a>
                                <div class="dropdown-content">
                                    <a href="own_recipes.php">Receptjeim</a>
                                    <a href="new_recipe.php">Receptfeltöltés</a>
                                    <a href="favourites.php">Kedvencek</a>
                                <a href="profil.php">Adatok</a>                          
                            </div>
                        </li>
                        
                        <li><a href="index.php">Rólunk</a></li>
                        <li><a href="../function/logout.php">Kijelentkezés</a></li>
                    </ul>
                </nav>
            <?php } ?>
        </header>