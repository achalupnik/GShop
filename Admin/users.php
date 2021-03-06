<?php
include 'includes/head.php';
include 'includes/menu.php';
include  '../Core/info.php';

$errors = array();

if(!is_logged()){
    header('Location: login.php');
    $_SESSION['error_flash'] = "Musisz być zalogowany by mieć dostęp do tej funkcji";
    exit();
}

if(!have_permission()){
    header('Location: index.php');
    $_SESSION['error_flash'] = "Nie masz potrzebnych uprawnień by przeprowadzić tą akcję";
    exit();
}

if(isset($_GET['remove']) && !empty($_GET['remove'])){
    $remove_id = (int)sanitize($_GET['remove']);
    if($remove_id != $user_data['id']){
        $sql = "DELETE FROM users WHERE id=".$remove_id;
        mysqli_query($connection, $sql);
        header('Location: users.php');
        exit();
    }else{
        $errors[] = "Nie możesz usunąć konta, na którym jesteś zalogowany";
        echo display_errors($errors);
    }
}

if(isset($_GET['add']) && !empty($_GET['add'])){
    if(isset($_POST['input_login']) && !empty($_POST['input_login']))
        $login = trim(sanitize($_POST['input_login']),' ');
    else
        $errors[] = "Musisz usupełnić login";

    if(isset($_POST['input_first_name']) && !empty($_POST['input_first_name']))
        $first_name = trim(sanitize($_POST['input_first_name']),' ');
    else
        $errors[] = "Musisz uzupełnić pole z imieniem";

    if(isset($_POST['input_second_name']) && !empty($_POST['input_second_name']))
        $second_name = trim(sanitize($_POST['input_second_name']), ' ');
    else
        $errors[] = "Musisz uzupełnić pole z nazwiskiem";

    if(isset($_POST['input_permission']))
        $permission = (int)sanitize($_POST['input_permission']);
    else
        $errors[] = "Nie przesłano uprawnień";

    if(isset($_POST['input_first_password']) && !empty($_POST['input_first_password']))
        $first_password = trim(sanitize($_POST['input_first_password']), ' ');
    else
        $errors[] = "Musisz uzupełnić pole z hasłem";

    if(isset($_POST['input_second_password']) && !empty($_POST['input_second_password']))
        $second_password = trim(sanitize($_POST['input_second_password']),' ');
    else
        $errors[] = "Musisz powtórzyć hasło";


    if(empty($errors)){
        $sql = "SELECT * FROM users WHERE login='$login'";
        $result = mysqli_query($connection, $sql);
        if($result->num_rows >0)
            $errors[] = "Użytkownik o podanym loginie już istnieje w bazie";

        if($first_password != $second_password)
            $errors[] = "Podane hasła się różnią";
    }

    if(!empty($errors))
        echo display_errors($errors);
    else{
        $name = $first_name.' '.$second_name;

        $password = password_hash($first_password, PASSWORD_DEFAULT);

        switch ($permission){
            case 0:
                $permission = "";
                break;
            case 1:
                $permission = "editor";
                break;
            case 2:
                $permission = "admin,editor";
                break;
        }
        $sql = "INSERT INTO users (login, full_name, password, permissions) VALUES ('$login', '$name', '$password', '$permission')";
        mysqli_query($connection, $sql);
    }
}

//Set active tab
if(!empty($errors) && isset($_POST['input_login']))
    $tab = 2;
else
    $tab = 1;

?>

<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item"><a href="#menu_1" class="nav-link <?=(($tab==1)?'active':'');?>"  role="tab" data-toggle="tab" style="color: black;">Użytkownicy</a></li>
    <li class="nav-item"><a href="#menu_2" class="nav-link <?=(($tab==2)?'active':'');?>" role="tab" data-toggle="tab" style="color: black;">Stwórz nowego użytkownika</a></li>
</ul>
<div class="tab-content">

    <div class="tab-pane show <?=(($tab==1)?'active':'fade');?>" role="tabpanel" id="menu_1"><br>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Login</th>
                <th>Imię Nazwisko</th>
                <th>Stworzenie konta</th>
                <th>Ostatnie logowanie</th>
                <th>Uprawnienia</th>
                <th>Usuń użytkownika</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT * FROM users";
            $result = mysqli_query($connection, $sql);
            while($row = $result->fetch_assoc()):
            ?>
            <tr>
                <td><?=$row['login'];?></td>
                <td><?=$row['full_name'];?></td>
                <td><?=$row['join_date'];?></td>
                <td><?=$row['last_login_date'];?></td>
                <td>
                    <select class="form-control" id="user_permission" onchange="change_permissions(<?=$row['id'];?>);" <?=(($user_data['id'] == $row['id'])?'disabled':'');?>>
                        <option value="">Brak</option>
                        <option value="editor" <?=(($row['permissions']=='editor')?'selected':'');?> >Edytor</option>
                        <option value="admin,editor" <?=(($row['permissions']=='admin,editor')?'selected':'');?> >Administrator</option>
                    </select>
                </td>
                <?php if($user_data['id'] != $row['id']){;?>
                <td><a href="users.php?remove=<?=$row['id'];?>" class="btn btn-light"><i class="icon-doc-remove"></i></a></td>
                <?php } ?>
            </tr>
            <?php
            endwhile;
            ?>
            </tbody>
        </table>
    </div>

    <div class="tab-pane <?=(($tab==2)?'active':'fade');?>" role="tabpanel" id="menu_2"><br>
        <div class="container-fluid">
            <form action="users.php?add=1" method="post">
                <div class="row">
                    <div class="col-md-3">
                        <label for="input_login"><b>Login</b></label>
                        <input type="text" class="form-control" id="input_login" name="input_login" <?=((!empty($errors)&&isset($login))?'value='.$login:'');?> autofocus required>
                    </div>
                    <div class="col-md-3">
                        <label for="input_first_name"><b>Imię</b></label>
                        <input type="text" class="form-control" id="input_first_name" name="input_first_name" <?=((!empty($errors)&&isset($first_name))?'value='.$first_name:'');?> required>
                    </div>
                    <div class="col-md-3">
                        <label for="input_second_name"><b>Nazwisko</b></label>
                        <input type="text" class="form-control" id="input_second_name" name="input_second_name" <?=((!empty($errors)&&isset($second_name))?'value='.$second_name:'');?> required>
                    </div>
                    <div class="col-md-3">
                        <label for="input_permission"><b>Uprawnienia</b></label>
                        <select class="form-control" id="input_permission" name="input_permission">
                            <option value="0">Brak</option>
                            <option value="1" <?=((!empty($errors) && isset($permission) && $permission==1)?'selected':'');?>>Edytor</option>
                            <option value="2" <?=((!empty($errors) && isset($permission) && $permission==2)?'selected':'');?>>Administraotr</option>
                        </select>
                    </div>
                    <div class="col-md-3 mt-3">
                        <label for="input_first_password"><b>Hasło</b></label>
                        <input type="password" class="form-control" id="input_first_password" name="input_first_password" required>
                    </div>
                    <div class="col-md-3 mt-3">
                        <label for="input_second_password"><b>Powtórz hasło</b></label>
                        <input type="password" class="form-control" id="input_second_password" name="input_second_password" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-5 mr-3 float-right">Dodaj użytkownika</button>
            </form>
        </div>
    </div>

</div>





<?php
include 'includes/footer.php';