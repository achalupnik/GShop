<?php
require_once '../Core/init.php';
include 'includes/head.php';

if(!is_logged()){
    header('Location: login.php');
    $_SESSION['error_flash'] = "Musisz być zalogowany by mieć dostęp do tej funkcji";
    exit();
}

$errors = array();
if(isset($_POST) && !empty($_POST)){
    if(isset($_POST['old_password']) && !empty($_POST['old_password']))
        $old_password = trim(sanitize($_POST['old_password']), ' ');
    else
        $errors[] = "Musisz podać stare hasło";

    if(isset($_POST['new_password']) && !empty($_POST['new_password']))
        $new_password = trim(sanitize($_POST['new_password']), ' ');
    else
        $errors[] = "Musisz podać nowe hasło";

    if(isset($_POST['confirm_password']) && !empty($_POST['confirm_password']))
        $confirm_password = trim(sanitize($_POST['confirm_password']), ' ');
    else
        $errors[] = "Musisz potwierdzić nowe hasło";
    
    if(isset($new_password) && isset($confirm_password) && $new_password != $confirm_password)
        $errors[] = "Podane hasła różnią się od siebie";
    
    if(empty($errors)){
        $new_password = password_hash($new_password, PASSWORD_DEFAULT);

        if(password_verify($old_password, $user_data['password'])){
            $sql = "UPDATE users SET password='$new_password' WHERE id=".$user_data['id'];
            mysqli_query($connection, $sql);
            $_SESSION['success_flash'] = 'Hasło zostało z powodzeniem zmienione';
            $date = date('Y:m:d H:i:s');
            $sql = "UPDATE users SET last_login_date='$date' WHERE id=".$user_data['id'];
            mysqli_query($connection, $sql);
            header('Location: index.php');
            exit();
        }else
            $errors[] = "Stare hasło jest błędne";

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
                <h3 class="text-center mb-1">Zmiana hasła</h3>
                <div class="form-group mt-4">
                    <label for="old_password">Stare hasło:</label>
                    <input type="password" class="form-control" name="old_password" id="old_password" required>
                </div>
                <div class="form-group">
                    <label for="new_password">Nowe hasło:</label>
                    <input type="password" name="new_password" id="new_password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Powtórz hasło:</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success btn-lg mt-4 float-right">Zmień hasło!</button>
            </form>
            <div style="clear: both;"></div>
        </div>
    </div>
    </div>
























<?php
include 'includes/footer.php';
