<?php
include 'includes/head.php';
include 'includes/menu.php';
include  '../Core/info.php';

if(!is_logged()){
    header('Location: login.php');
    $_SESSION['error_flash'] = "Musisz być zalogowany by mieć dostęp do tej funkcji";
    exit();
}

if(!have_permission('editor')){
    header('Location: index.php');
    $_SESSION['error_flash'] = "Nie masz potrzebnych uprawnień by przeprowadzić tą akcję";
    exit();
}

if(isset($_POST) && !empty($_POST) || !empty($_GET)){
    $errors = array();

    //add new brand
    if(isset($_POST['brand_input']) && !empty($_POST['brand_input']) && !isset($_GET['edit'])){
        $new_brand = sanitize($_POST['brand_input']);
        $sql = "SELECT * FROM brand WHERE name='$new_brand'";
        $result = mysqli_query($connection, $sql);
        if($result->num_rows)
            $errors[] = "Taka marka istnieje już w bazie danych";

        if(empty($errors)){
            $sql = "INSERT INTO brand VALUES (NULL, '$new_brand')";
            mysqli_query($connection, $sql);
        }else
            echo display_errors($errors);
    }

    //delete brand
    if(isset($_GET['del']) && !empty($_GET['del'])){
        $del_id = (int)sanitize($_GET['del']);
        $sql = "DELETE FROM brand WHERE id=".$del_id;
        mysqli_query($connection, $sql);
        header('Location: brand.php');
        exit();
    }

    //edit brand
    if(isset($_GET['edit']) && !empty($_GET['edit'])){
        $edit_id = (int)sanitize($_GET['edit']);
        $sql = "SELECT * FROM brand WHERE id=".$edit_id;
        $result = mysqli_query($connection, $sql);
        $row = $result->fetch_assoc();
        $edit_name = $row['name'];

        if(isset($_POST['brand_input']) && !empty($_POST['brand_input'])) {
            $brand_name = sanitize($_POST['brand_input']);
            $brand_id = (int)sanitize($_GET['edit']);
            $sql = "UPDATE brand SET name='$brand_name' WHERE id=".$brand_id;
            mysqli_query($connection, $sql);
            header('Location: brand.php');
            exit();
        }
    }
}
?>

<div class="container-fluid">
    <h2 class="text-center mt-3">Marki</h2><br>
    <form method="post" action="brand.php<?=(isset($edit_id)?'?edit='.$edit_id:'');?>" class="form-inline">
        <div class="form-group all-center">
            <label for="brand_input"><?=(isset($edit_id)?'Edytuj':'Dodaj');?> markę:</label>
            <input type="text" id="brand_input" name="brand_input" class="form-control mx-1" placeholder="<?=(isset($edit_name)?$edit_name:'');?>" required>
            <input type="submit" class="btn btn-success" value="<?=(isset($edit_id)?'Edytuj':'Dodaj');?> Markę">
        </div>
    </form>

    <hr>

</div>


    <table class="table table-striped table-bordered table-sm text-center" style="width: auto; margin: 0 auto;">
        <thead>
        <tr>
            <th class="td_width">Edytuj</th>
            <th class="td_width">Marka</th>
            <th class="td_width">Usuń</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM brand";
        $result = mysqli_query($connection, $sql);
        while($row = $result->fetch_assoc()):
        ?>
        <tr>
            <td class="td_width"><a href="brand.php?edit=<?=$row['id'];?>" class="icon-pencil btn btn-light btn-sm"></a></td>
            <td class="td_width"><?=$row['name'];?></td>
            <td class="td_width"><a href="brand.php?del=<?=$row['id'];?>" class="icon-doc-remove btn btn-light btn-sm"></a></td>
        </tr>
        <?php
        endwhile;
        ?>
        </tbody>
    </table>









<?php
include 'includes/footer.php';
