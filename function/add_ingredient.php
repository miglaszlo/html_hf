<?php
/* 

    Új hozzávaló hozzáadá
    POST adatként érkeznek az adatok
    ellenőrzés, hogy megfelelőek-e az adatok
    adatbázisba illesztés

*/
        session_start();
        include '../function/functions.php';

        if($_SERVER['REQUEST_METHOD'] == 'get'){
            header('Location: ../views/index.php');
            exit;
        }
        if(!isNumber($_POST['amount'])){
         $recipe_id = $_POST['recipe_id'];

         header("Location: ../views/edit_recipe.php?id=$recipe_id&errormsg=Hibás mennyiség!");
            exit;
        }
    $conn = reach_db();
    $recipe_id = $_POST['recipe_id'];
    $ingredient = mysqli_real_escape_string($conn, $_POST['ingredient']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
    $unit = mysqli_real_escape_string($conn, $_POST['unit']);
    
    if($ingredient == "" ){
            header("Location: ../views/edit_recipe.php?id=$recipe_id&errormsg=Hibás hozzávaló!");
        }
        $sql = "INSERT INTO ingredients (name, unit_of_measure) VALUES ('$ingredient', '$unit')";
    
        if(mysqli_query($conn, $sql)){
            $ingredient_id = mysqli_insert_id($conn);

        } else {
            echo "Error: " . mysqli_error($conn);
        }
        $sql = "INSERT INTO recipe_contains (Recipes_id, Ingredients_id, amount) VALUES ('$recipe_id', '$ingredient_id', '$amount')";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
    

        header("Location: ../views/edit_recipe.php?id=$recipe_id");

