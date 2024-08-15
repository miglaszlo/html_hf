<?php 
/*
    a receptet a kedvencek közé teszi, vagy kiveszi onnan
*/
session_start();
include 'functions.php';
if (isset($_GET['id']) && isset($_SESSION['id'])) {
    $recipe_id = $_GET['id'];
    $user_id = $_SESSION['id'];
    $conn = reach_db();
    if(isFavorurite($recipe_id, $user_id)){
        mysqli_query($conn, "DELETE FROM favourites WHERE Users_id = $user_id AND Recipes_id = $recipe_id");
    }
    else{
        mysqli_query($conn, "INSERT INTO favourites (Users_id, Recipes_id) VALUES ('$user_id', '$recipe_id')");
    }
    header('Location: ../views/favourites.php');
}