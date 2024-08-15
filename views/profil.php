<?php 
/*
    a felhasználó adatainak szerkesztése, és a téma váltása, felhasználó törlése
*/


include 'header.php'; ?>

    <?php if(isset($_SESSION['username'])){
        $error = $_GET['error'] ?? null;

    }
    else {
            header('Location: login.php');
    }
    
    
        $user = create_user(get_user($_SESSION['username']));
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            if(isset($_GET['error_msg']))
                $error_msg = $_GET['error_msg'];
            $error_flag = true;
        }
        else{
            $error_flag = false;
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
            <h1>Profil</h1>
        </div>

        <div id="profile-container">
            <div class="title-container">
                <h2>Adatok szerkesztése</h2>
                
            </div>

            <div id="profile-data">

                <form method="POST" action="../function/update_user.php">
                    <input type="text" name="username" value= "<?php echo $user['username']; ?>" ><br><br>
                    <input type="email" name="email" value="<?php echo $user['email'];?>" ><br><br>
                    <input type="password" name="password" placeholder="Jelszó" value=""><br><br>
                    Jelszónak tartalmaznia kell legalább speciális karaktert.

                    <button type="submit">Mentés</button>
                </form>

            </div>

        </div>
        <br><br>
        <div id="theme-container">
            <div class="title-container">
                <h2>Téma</h2>
            </div>
                <div id="theme">
                    <form method="POST" action="../function/dark_mode.php">
                        <button type="submit" name="mode" value="1" id="dark-mode">Sötét mód</button> 
                    </form>
                    <form method="POST" action="../function/light_mode.php">
                        <button type="submit" name="mode" value="0" id="light-mode">Világos mód</button>
                    </form>
                </div>
        </div>
        <br><br>

        <?php if($_SESSION['username'] !== 'admin') { ?>
        <div id="delete-container">
            <div class="title-container">
                <h2>Felhasználó törlése</h2>
            </div>
            <div id="delete">
                <buttonbutton onclick="window.location.href='../function/delete_user.php'" id="delete-user">Felhasználó törlése</button>
            </div>
        </div>
        <?php } ?>
    </div>

<?php include 'footer.php'; ?>