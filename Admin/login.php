<?php
require_once '../Core/init.php';
include 'includes/head.php';

$errors = array();
if(isset($_POST) && !empty($_POST)){
    if(isset($_POST['login']) && !empty($_POST['login']))
        $login = sanitize($_POST['login']);
    else
        $errors[] = "Musisz uzupełnić login";

    if(isset($_POST['password']) && !empty($_POST['password']))
        $password = sanitize($_POST['password']);
    else
        $errors[] = "Musisz uzupełnić hasło";


    if(empty($errors)){
        $login = trim($login, ' ');
        $password = trim ($password, ' ');
        $sql = "SELECT * FROM users WHERE login='$login'";
        $result = mysqli_query($connection, $sql);

        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
            if(password_verify($password, $row['password'])){
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['success_flash'] = 'Zalogowałeś się jako '.$row['login'];
                $date = date('Y:m:d H:i:s');
                $sql = "UPDATE users SET last_login_date='$date' WHERE id=".$row['id'];
                mysqli_query($connection, $sql);
                header('Location: index.php');
                exit();
            }else {
                $errors[] = "Błędne hasło"; }
        }else
            $errors[] = "Błędny login";
    }

    if(!empty($errors))
        echo display_errors($errors);
}




?>



<style type="text/css">
    body{
        /* Background pattern from Toptal Subtle Patterns */
        background-image: url('../img/patterns/skulls.png');
    }

    #form_container{
        height: auto;
        background: white;
        padding: 15px;

        -webkit-border-radius: 15px;
        -moz-border-radius: 15px;
        border-radius: 15px;

        -webkit-box-shadow: 0px 0px 64px 39px rgba(0,0,0,0.75);
        -moz-box-shadow: 0px 0px 64px 39px rgba(0,0,0,0.75);
        box-shadow: 0px 0px 64px 39px rgba(0,0,0,0.75);
    }

    #main_container{
        margin: 15vh auto;
        width: 40%;
    }
</style>


<div class="container-fluid" id="main_container">
            <div id="form_container">
                <form method="post">
                    <h3 class="text-center mb-1">Logowanie</h3>
                    <div class="form-group mt-4">
                        <label for="login">Login:</label>
                        <input type="text" class="form-control" name="login" id="login" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Hasło:</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-success btn-lg mt-4 float-right">Zaloguj się!</button>
                </form>
                <div style="clear: both;"></div>
            </div>
    </div>
</div>
























<?php
include 'includes/footer.php';
