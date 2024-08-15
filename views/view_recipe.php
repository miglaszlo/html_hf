<?php
/*
    adott recepet megjelenítése
*/


include 'header.php'; ?>
    <?php

        $conn = reach_db();
        $recipe_id = $_GET['id'];
        $result = mysqli_query($conn, "SELECT * FROM recipes WHERE id = '$recipe_id'");
        $row = mysqli_fetch_assoc($result);
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
            <h1><?php echo $row['title']; 

            if(isset($_SESSION['username']) && !isFavorurite($recipe_id, $_SESSION['id'])) {
              echo  "<a href='../function/tgl_fav.php?id=$recipe_id' ><i style='font-size:24px' class='far'>&#xf004;</i> </a>";
              
            }
            else if(isset($_SESSION['username'])){ 
                
                echo  "<a href='../function/tgl_fav.php?id=$recipe_id' ><i style='font-size:24px' class='fas'>&#xf004;</i> </a>";

             } ?>
        </h1>
        </div>
        <div id="view-recipe-container">
            <div id="description">
                <h2>Leírás</h2>
                <p><?php echo $row['description'] ?></p>
            </div>
            <div id="cooking-time">
                <h2>Elkészítési idő</h2>
                <p><?php echo $row['cooking_time'] ?> perc</p>
            </div>
            <div id="ingredients">
                <h2>Összetevők</h2>
                <table border="1">
                    <tr>
                        <th>Hozzávaló</th>
                        <th>Mennyiség</th>
                        <th>Mértékegység</th>
                    </tr>
                    <?php
                        $result = mysqli_query($conn, "SELECT * FROM recipe_contains
                        inner join ingredients on recipe_contains.Ingredients_id = ingredients.id
                        WHERE recipe_contains.Recipes_id = '$recipe_id'");
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>".$row['name']."</td>";
                            echo "<td>".$row['amount']."</td>";
                            echo "<td>".$row['unit_of_measure']."</td>";
                            echo "</tr>";
                        }
                    ?>
                </table>
            </div>
  
 
    </div>

<?php include 'footer.php'; ?>