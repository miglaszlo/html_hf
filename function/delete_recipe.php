


<?php 
/*

törli a GET-ben kapott recepetet, a hozzátartozó rekordokat a favourites, recipe_contains és recipes táblákból
továbbá az összes hozzávalót, ami a recepthez tartozik az ingredients táblából


*/
session_start();
include 'functions.php';
if(!isset($_SESSION['username'])) {
    header('Location: index.php');
}
if(isset($_GET['id'])) {
    $contains = array();
    $conn = reach_db();
    $user_id = $_SESSION['id'];
    $recipe_id = mysqli_real_escape_string($conn, $_GET['id']) ;

    $sql = "select * from recipes where id = $recipe_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $result2 = mysqli_query($conn, "SELECT Ingredients_id FROM recipe_contains WHERE Recipes_id = $recipe_id");
    while($row2 = mysqli_fetch_assoc($result2)){
        array_push($contains,$row2['Ingredients_id']);

    }

    if($row['Users_id'] != $user_id)
        header('Location: ../views/own_recipes.php');

    if(mysqli_num_rows($result) > 0 ){

        mysqli_query($conn, "DELETE FROM recipe_contains WHERE Recipes_id = $recipe_id");
        mysqli_query($conn, "DELETE FROM favourites WHERE Recipes_id = $recipe_id");
        mysqli_query($conn, "DELETE FROM recipes WHERE id = $recipe_id");
        foreach($contains as $ingredient_id){
            mysqli_query($conn, "DELETE FROM ingredients WHERE id = $ingredient_id");
        }

    } 


    mysqli_close($conn);
    header('Location: ../views/own_recipes.php');
}