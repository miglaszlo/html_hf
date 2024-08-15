<?php 
/*

    világos mód gombra kattintva állítja az adatbázisban tárolt adatot

*/
session_start();
include '../function/functions.php';

if($_SERVER['REQUEST_METHOD'] == 'get'){
    header('Location: ../views/profil.php');
}
$user_id = $_SESSION['id'];
    if(isset($_POST['mode'])){
        $mode = $_POST['mode'];
        $conn = reach_db();
        $result = mysqli_query($conn, "SELECT * FROM users WHERE id = '$user_id'");
        $row = mysqli_fetch_assoc($result);
        $mode = $row['dark_mode'];
        if($mode == 1){
            $mode = 0;
        }
        }else{
            $mode = 0;
        }
        $sql = "UPDATE users SET dark_mode = '$mode' WHERE id = '$user_id'";
        mysqli_query($conn, $sql);
        header('Location: ../views/profil.php');
    
