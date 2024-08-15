<?php 
/*
    új recept hozzáadása
*/

include 'header.php'; 
    if(!isset($_SESSION['username'])) {
        header('Location: index.php');
    } ?>

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
                <h1>Új recepet</h1>
        </div>

        <div id="new-recipe-container">

            <form action="../function/create_recipe.php" method="post">
                <input type="text" name="recipe-name" id="recipe-name" placeholder="Recept címe" required><br>
                <button type="submit">Recept hozzáadása</button>
            </form>
        </div>
                
    </div>

<?php include 'footer.php'; ?>