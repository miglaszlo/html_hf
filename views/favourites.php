<?php
/*
    a felhasználó kedvenc receptjeit jeleníti meg
*/

include 'header.php';

    $conn = reach_db();
    $user_id = $_SESSION['id'];
    $result = mysqli_query($conn, "SELECT * FROM favourites WHERE Users_id = $user_id");
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
            <h1>Kedvencek</h1>
        </div>
        <div id="fav-container">
            <table border="0">
                <tr>
                    <th>Recept neve</th>
                    <th>Elkészítési idő</th>
                    <th>Létrehozás dátuma</th>
                    <th></th>
                </tr>
                <?php
                while($row = mysqli_fetch_assoc($result)){
                    $recipe_id = $row['Recipes_id'];
                    $result2 = mysqli_query($conn, "SELECT * FROM recipes WHERE id = $recipe_id");
                    while($row2 = mysqli_fetch_assoc($result2)){
                        $recipe_name = $row2['title'];
                        if(isset($row2['cooking_time']))
                            $cooking_time = $row2['cooking_time'];
                        else
                            $cooking_time = "N/A";
                        if(isset($row2['creation_date']))
                            $creation_date = $row2['creation_date'];
                        else
                            $creation_date = "N/A";

                        echo "<tr>";
                        echo "<td><a href='view_recipe.php?id=$recipe_id'>$recipe_name</a></td>";
                        echo "<td>$cooking_time perc</td>";
                        echo "<td>$creation_date</td>";
                        echo  "<td> <a href='../function/tgl_fav.php?id=$recipe_id'> <i style='font-size:24px' class='fas'>&#xf004;</i></a></td> ";
                        echo "</tr>";
                    }
                }
                
            ?>
            </table>
        </div>
    </div>

<?php include 'footer.php'; ?>