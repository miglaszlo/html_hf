<?php 
/*

    hozzávaló módosítása

*/
session_start();


include '../function/functions.php';

if($_SERVER['REQUEST_METHOD'] == 'get'){
    header('Location: ../views/index.php');
    exit;
}

$conn = reach_db();
$recipe_id = $_POST['recipe_id'];
$ingredient_id = $_POST['ingredient_id'];


$ingredient_name = mysqli_real_escape_string($conn, $_POST['ingredient-name']);
$amount = mysqli_real_escape_string($conn, $_POST['ingredient-amount']);
$unit = mysqli_real_escape_string($conn, $_POST['ingredient-unit']);

if(!isNumber($amount) ){
    header("Location: ../views/edit_recipe.php?id=$recipe_id&errormsg=Hibás mennyiség!");
    exit;
}

if($ingredient_name == "" ){
    header("Location: ../views/edit_recipe.php?id=$recipe_id&errormsg=Hibás hozzávaló név!");
    exit;
}
if($unit == "" ){
    header("Location: ../views/edit_recipe.php?id=$recipe_id&errormsg=Hibás mértékegység!");
    exit;
}

mysqli_query($conn, "UPDATE ingredients SET name = '$ingredient_name', unit_of_measure = '$unit' WHERE id = '$ingredient_id'");

mysqli_query($conn, "UPDATE recipe_contains SET amount = '$amount' WHERE Recipes_id = '$recipe_id' AND Ingredients_id = '$ingredient_id'");


mysqli_close($conn);

header("Location: ../views/edit_recipe.php?id=$recipe_id");

