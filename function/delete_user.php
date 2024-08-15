<?php
/*

    törli a felhasználót, és a hozzátartozó recepteket

*/
session_start();
include 'functions.php';
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];

    $conn = reach_db();
    $result = mysqli_query($conn, "SELECT id FROM recipes WHERE Users_id = $id");
    $query = "DELETE FROM favourites WHERE Users_id = $id";
    mysqli_query($conn, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $recipe_id = $row['id'];
        $query = "DELETE FROM recipe_contains WHERE Recipes_id = $recipe_id";
        mysqli_query($conn, $query);
    }

    mysqli_query($conn, "DELETE FROM recipes WHERE Users_id = $id");

    mysqli_query($conn, "DELETE FROM users WHERE id = $id");

    header('Location: ../function/logout.php');

    
    mysqli_close($conn);
}
