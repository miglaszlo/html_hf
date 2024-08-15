<?php 
/*
    a recept szerkesztése
*/

include 'header.php'; 
    if(!isset($_SESSION['username'])) {
        header('Location: index.php');
    } 

    if($_SERVER["REQUEST_METHOD"] == "GET") {
        if(isset($_GET['errormsg'])) {
            $error_msg = $_GET['errormsg'];
        }
        $recipe_id = $_GET['id'];
        $conn = reach_db();
        $result = mysqli_query($conn, "SELECT * FROM recipes WHERE id = '$recipe_id'");
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $recipe_id = $row['id'];
            $recipe_name = $row['title'];

        }

        if(isset($_GET['desc'])){
            $desc = mysqli_real_escape_string($conn, $_GET['desc']);
            $update = mysqli_query($conn, "UPDATE recipes SET description = '$desc' WHERE id = '$recipe_id'");
        }
        else if(!isset($_GET['error_msg'])){
            $desc = $row['description'];
        }
        else{
            $desc = "";
        }
        if(isset($_GET['cooking-time'])){
            $cooking_time = mysqli_real_escape_string($conn, $_GET['cooking-time']);
            $update = mysqli_query($conn, "UPDATE recipes SET cooking_time = '$cooking_time' WHERE id = '$recipe_id'");
        }
        else if(!isset($_GET['error_msg'])){
            $cooking_time = $row['cooking_time'];
        }
        else{
            $cooking_time = "";
        }

        
    
    }
    $unit = "";
    $amount = "";
    $ingredient = "";

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
                <h1> Recept szerkesztése</h1>
        </div>

        <div id="edit-recipe-container">
                
                <form action="../function/add_ingredient.php" method="post">
                    <input type="hidden" name="recipe-id" value="<?php echo $recipe_id; ?>">
                    <input type="text" name="recipe-name" id="recipe-name" value="<?php echo $recipe_name; ?>" required><br>

                    <h2>Összetevők</h2> 
                    <div id="ingredients">
                            <input type="hidden" name="recipe_id" value="<?php echo $recipe_id; ?>">
                            <input type="text" name="ingredient" placeholder="Hozzávaló" required>
                            <input type="text" name="amount" placeholder="Mennyiség" required>
                            <input type="text" name="unit" placeholder="Mértékegység" required>
                            <button type="submit">Hozzáadás</button>
                    </div>
                </form>
                <form action="edit_recipe.php" method="get">
                    <input type="hidden" name="id" value="<?php echo $recipe_id; ?>">

                    <input type="text" name="desc" placeholder="Elkészítési útmutató" value="<?php echo $desc; ?>" required>
                    <input type="text" name="cooking-time" placeholder="Elkészítési idő (perc)" value="<?php echo $cooking_time; ?>" required>

                    <button type="submit">Recept módosítása</button>
                    
                </form>
                <div id="ingredients">
                <h2>Összetevők</h2>
                <table border="1">
                    <tr>
                        <th>Hozzávaló</th>
                        <th>Mennyiség</th>
                        <th>Mértékegység</th>
                        <th>Művelet</th>
                    </tr>
                    <?php
                        $result = mysqli_query($conn, "SELECT * FROM recipe_contains
                        inner join ingredients on recipe_contains.Ingredients_id = ingredients.id
                        WHERE recipe_contains.Recipes_id = '$recipe_id'");

                        while($row = mysqli_fetch_assoc($result)) {
                            $ingredient_id = $row['id'];
                            $ingredient_name = $row['name'];
                            $ingredient_amount = $row['amount'];
                            $ingredient_unit = $row['unit_of_measure'];

                            ?>
                            
                            <form action='../function/edit_ingredient.php' method='POST'>
                            <input type='hidden' name='ingredient_id' value='<?php echo $ingredient_id; ?>'>
                            <input type='hidden' name='recipe_id' value='<?php echo $recipe_id; ?>'>
                                
                            <tr>
                            <td> <input type='text' name='ingredient-name' value='<?php echo $ingredient_name; ?>' required> </td>
                            <td> <input type='text' name='ingredient-amount' value='<?php echo $ingredient_amount; ?>' required> </td>
                            <td> <input type='text' name='ingredient-unit' value='<?php echo $ingredient_unit; ?>' required> </td>

                            <td><a href='../function/delete_ingredient.php?id=<?php echo $ingredient_id?>&recipe_id=<?php echo$recipe_id?>' style='color: red;'><i style='font-size:24px' class='fas'>&#xf1f8;</i></a>
                            <button type='submit' id="save-button" style="background-color: transparent; border: none;"><i style='font-size:24px' class='fa'>&#xf0c7;</i></button>
                            </th>
                            </tr>
                        
                            </form> <?php 
                        }
                        ?>
                </table>
            </div>

        </div>
                
    </div>

<?php include 'footer.php'; ?>