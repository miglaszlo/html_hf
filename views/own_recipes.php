<?php
/*
    a felhasználó saját receptjeit listázza ki
*/

include 'header.php';

    if(!isset($_SESSION['username'])) {
        header('Location: index.php');
    }

    $conn = reach_db();
    $user_id = $_SESSION['id'];
    $sql = "SELECT * FROM recipes WHERE Users_id = $user_id";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
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
                    <h1>Saját receptek</h1>
            </div>

            <div id="recipes-container">
                <div id="recipes">
                    <table border="0">
                        <tr>
                            <th>Recept neve</th>
                            <th>Elkészítési idő</th>
                            <th>Létrehozás dátuma</th>
                            <th>Műveletek</th>
                        </tr>
                        <?php
                        while($row = mysqli_fetch_assoc($result)) {
                            $recipe_id = $row['id'];
                            $recipe_name = $row['title'];
                            if(isset($row['cooking_time']))
                                $cooking_time = $row['cooking_time'];
                            else
                                $cooking_time = "N/A";
                            if(isset($row['creation_date']))
                                $creation_date = $row['creation_date'];
                            else
                                $creation_date = "N/A";

                            echo "<tr>";
                            echo "<td><a href='view_recipe.php?id=$recipe_id'>$recipe_name</a></td>";
                            echo "<td>$cooking_time perc</td>";
                            echo "<td>$creation_date</td>";

                            echo "<td><a href='../function/delete_recipe.php?id=$recipe_id' style='color: red;'><i style='font-size:24px' class='fas'>&#xf1f8;</i></a> 
                            <a href='../views/edit_recipe.php?id=$recipe_id' style='float: right;'><i style='font-size:24px' class='fa'>&#xf044;</i></a></td>";
                            echo "</tr>";



                        }
                        mysqli_close($conn);
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <?php
    }
    else {
        ?>
        <div class="main-container">
            <div class="centered-title">
                <h1>Saját receptek</h1>
            </div>
            <div id="recipes-container">
                <div id="recipes">
                    <h2>Nincs feltöltött recept</h2>
                </div>
            </div>
        </div>
        <?php
    }

                                 
    ?>                    
<?php include 'footer.php';?>