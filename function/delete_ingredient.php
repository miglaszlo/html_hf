
<?php
/*

törli a kiválasztott hozzávalót az adatbázisból, és a szükséges további táblákból is

*/
session_start();
include 'functions.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $recipe_id = $_GET['recipe_id'];

    $conn = reach_db();
    mysqli_query($conn, "DELETE FROM recipe_contains WHERE Ingredients_id = $id");
    mysqli_query($conn, "DELETE FROM ingredients WHERE id = $id");
}
    header("Location: ../views/edit_recipe.php?id=$recipe_id");
    exit;