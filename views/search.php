<?php 
/*
    a receptek között keres hozzávaló alapján
*/

include 'header.php' ;

    if(isset($_GET['ingredient'])) {
        $conn = reach_db();
        $ingredient = $_GET['ingredient'];
        $sql = "select * from recipes inner join recipe_contains on recipes.id = recipe_contains.Recipes_id inner join ingredients on recipe_contains.Ingredients_id = ingredients.id WHERE ingredients.name LIKE '$ingredient' GROUP BY ingredients.id;";
        $result = mysqli_query($conn, $sql);

    }else
        $result = null;
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
            <h1>Keresés</h1>
        </div>
        <div id="search-container">
            <form action="../views/search.php" method="get">
                <input type="text" name="ingredient" placeholder="Hozzávaló">
                <button type="submit">Keresés</button>
            </form>
        </div>
        <br>
        <?php if(!$result || mysqli_num_rows($result) == 0) {
            ?>
            <div id="search-results">
                <?php
            echo 'Nincs találat';
            ?>
            </div>
            <?php
        } else {
            ?>
            <div id="search-results">
                <table border="0">
                    <tr>
                        <th>Recept neve</th>
                        <th>Elkészítési idő</th>
                        <th>Létrehozás dátuma</th>
                        <th>Feltöltő</th>
                    </tr>
                <?php



                while($row = mysqli_fetch_assoc($result)) {
                    $recipe_id = $row['Recipes_id'];
                    $recipe_name = $row['title'];
                    if(isset($row['cooking_time']))
                        $cooking_time = $row['cooking_time'];
                    else
                        $cooking_time = "N/A";
                    if(isset($row['creation_date']))
                        $creation_date = $row['creation_date'];
                    else
                        $creation_date = "N/A";
                    $user_id = $row['Users_id'];
                    $result2 = mysqli_query($conn, "SELECT username FROM users WHERE id = '$user_id'");
                    $row2 = mysqli_fetch_assoc($result2);
                    $username = $row2['username'];


                    echo "<tr>";
                    echo "<td><a href='view_recipe.php?id=$recipe_id'>$recipe_name</a></td>";
                    echo "<td>$cooking_time perc</td>";
                    echo "<td>$creation_date</td>";
                    echo "<td>$username</td>";
                    
                    echo "</tr>";
                }
                ?>
                </table>
                <?php
            }
            
            ?>
        </div>
    </div>


<?php include 'footer.php'; ?>