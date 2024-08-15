

<?php 
/*

    a használt függvényeket tartalmazó fájl
    
    reach_db() - kapcsolatot teremt az adatbázissal
    get_user($username) - lekéri a felhasználó adatait
    create_user($row) - felhasználó objektumot hoz létre
    isFavorurite($recipe_id,$user_id) - ellenőrzi, hogy a kedvencek között van-e a recept
    validatePassword($password) - ellenőrzi, hogy a jelszó megfelel-e a követelményeknek
    validateEmail($email) - ellenőrzi, hogy az email megfelel-e a követelményeknek
    isNumber($input) - ellenőrzi, hogy a bemenet szám-e

*/

    function reach_db(){
        $connect = mysqli_connect('localhost','root','','hf');
        if(mysqli_connect_error()){
            die('Hiba az adatbázishoz csatlakozás során: ' . mysqli_connect_error());
        }
        return $connect;
    }
    function get_user($username){
        $conn = reach_db();
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($result);
        return $user;
    }

    function create_user($row){
        return [
            'id' => $row['id'],
            'username' => $row['username'],
            'email' => $row['email'],
        ];
            
        
    }

    function isFavorurite($recipe_id,$user_id){
        $conn = reach_db();
        $result = mysqli_query($conn, "SELECT * FROM favourites WHERE Users_id = '$user_id' AND Recipes_id = '$recipe_id'");
        if(mysqli_num_rows($result) > 0){
            return true;
        }
        return false;
    }

    function validatePassword($password) {
        $passwordPattern = '/^(?=.*[\W_]).+$/';
        if (preg_match($passwordPattern, $password)) {
            return true;
        } else {
            return false;

        }
    }
    

    
    function validateEmail($email) {
        $emailPattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        if (preg_match($emailPattern, $email)) {
            return true;
        } else {
            return false;

        }
    }

    function isNumber($input) {
        $numberPattern = '/^-?\d+(\.\d+)?$/';
        if (preg_match($numberPattern, $input)) {
            return true;
        } else {
            return false;
        }
    }