<?php
/*
    feltöltött receptek listázása
*/


include 'header.php';?>


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
                <h1>Receptek</h1>
        </div>

        <div id="recipes-container">
            <div id="recipes">

                <?php
                    $conn = reach_db();

                    $result = mysqli_query($conn, "SELECT * FROM recipes ");
                    if(mysqli_num_rows($result) > 0) {
                    ?>
                        <table border="0">
                            <tr>
                                <th>Recept neve</th>
                                <th>Elkészítési idő</th>
                                <th>Létrehozás dátuma</th>
                                <th>Feltöltő</th>
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
                            mysqli_close($conn);
                            ?>
                        </table>
                    <?php
                    } 
                ?>
                
            </div>

        </div>
    </div>             
    

<?php include 'footer.php'; ?>
