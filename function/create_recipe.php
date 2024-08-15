<?php 
/*

POST-ban érkezik a recept neve, majd beillesztésre kerül az adatbázisba, továbbirányít a recept szerkesztésére.

*/
    session_start();
    include '../function/functions.php';


    if(!isset($_SESSION['username'])) {
        header('Location: index.php');
    } 

    if(isset($_POST['recipe-name'])) {
        $conn = reach_db();
        $now = 'NOW()';
        $recipe_name = mysqli_escape_string($conn, $_POST['recipe-name']);
        $user_id = $_SESSION['id'];
        $sql = "INSERT INTO recipes (title, Users_id, creation_date) VALUES ('$recipe_name', '$user_id',$now)";
        if(mysqli_query($conn, $sql)) {
            $recipe_id = mysqli_insert_id($conn);
            header("Location: ../views/edit_recipe.php?id=$recipe_id");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
       
        mysqli_close($conn);
    }


