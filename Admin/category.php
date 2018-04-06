<?php
require_once '../Core/init.php';
include 'includes/head.php';
include 'includes/menu.php';

//Add Category
if(isset($_POST) && !empty($_POST)){
    if(isset($_GET['add']) && !empty($_GET['add'])){
        $category_parent_id = (int)sanitize($_POST['category_parent']);
        $category_child = sanitize($_POST['category_child']);
        $errors = array();
        $sql = "SELECT * FROM category WHERE parent='$category_parent_id' and name='$category_child'";
        $result = mysqli_query($connection, $sql);
        if($result->num_rows)
            $errors[] = "W bazie danych istnieje już marka o takiej nazwie";

        if(empty($errors)){
            $sql = "INSERT INTO category (name, parent) VALUES ('$category_child', '$category_parent_id')";
            mysqli_query($connection, $sql);
        }else
            display_errors($errors);
    }
}

//Delete Category
if(isset($_GET['del']) && !empty($_GET['del'])){
    $del_id = (int)sanitize($_GET['del']);
    $sql = "DELETE FROM category WHERE id=".$del_id;
    mysqli_query($connection, $sql);
    header('Location: category.php');
    exit();
}

//Edit Category
if(isset($_GET['edit']) && !empty($_GET['edit'])){
    $edit_id = (int)sanitize($_GET['edit']);

    //Update db
    if(isset($_POST) && !empty($_POST)){
        $edit_name = sanitize($_POST['category_child']);
        $edit_parent = (int)sanitize($_POST['category_parent']);
        $sql = "UPDATE category SET name='$edit_name', parent='$edit_parent' WHERE id=".$edit_id;
        mysqli_query($connection, $sql);
        header('Location: category.php');
        exit();
    }

    $sql = "SELECT * FROM category WHERE id=".$edit_id;
    $result = mysqli_query($connection, $sql);
    $row = $result->fetch_assoc();
    $edit_parent = $row['parent'];
    $edit_name = $row['name'];
}

?>
<div class="container-fluid">
    <h3 class="text-center mt-3">Kategorie</h3><hr>
    <div class="row">
        <div class="col-md-6">
            <h4 class="text-center"><?=(isset($edit_id)?'Edtytuj':'Dodaj');?> Kategorie</h4><hr>
            <form action="category.php?<?=(isset($edit_id)?'edit='.$edit_id:'add=1');?>" method="post">
                <label for="category_parent"><b>Rodzic:</b></label>
                <select id="category_parent" name="category_parent" class="form-control">
                    <option value="0">Rodzic</option>
                    <option disabled>──────────</option>
                    <?php
                    $sql = "SELECT * FROM category WHERE parent=0";
                    $result = mysqli_query($connection, $sql);
                    while($row = $result->fetch_assoc()):
                    ?>
                    <option value="<?=$row['id'];?>" <?=((isset($edit_parent)&&($edit_parent == $row['id']))?'selected':'');?>><?=$row['name'];?></option>
                    <?php endwhile;?>
                </select>
                <label for="category_child" class="mt-4"><b>Kategoria:</b></label>
                <input type="text" id="category_child" <?=(isset($edit_name)?'value='.$edit_name:'');?> name="category_child" class="form-control">
                <input type="submit" value="<?=(isset($edit_id)?'Edit':'Add');?> Category" class="btn btn-success mt-2">
            </form>
        </div>
        <div class="col-md-6">
            <table class="table table-striped table-bordered table-sm">
                <thead>
                    <tr class="text-center">
                        <th>Kategorie</th>
                        <th>Rodzic</th>
                        <th>Opcje</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * FROM category WHERE parent=0";
                $result = mysqli_query($connection, $sql);
                while($row = $result->fetch_assoc()):
                ?>
                    <tr class="bg-primary">
                        <td><?=$row['name'];?></td>
                        <td>Parent</td>
                        <td>
                            <a href="category.php?edit=<?=$row['id'];?>" class="btn btn-sm btn-light"><i class="icon-pencil no-decoration"></i></a>
                            <a href="category.php?del=<?=$row['id'];?>" class="btn btn-sm btn-warning"><i class="icon-doc-remove no-decoration"></i></a>
                        </td>
                    </tr>
                <?php
                $sql2 = "SELECT * FROM category WHERE parent=".$row['id'];
                $result2 = mysqli_query($connection, $sql2);
                while($row2 = $result2->fetch_assoc()): ?>
                    <tr class="bg-info">
                        <td><?=$row2['name'];?></td>
                        <td><?=$row['name'];?></td>
                        <td>
                            <a href="category.php?edit=<?=$row2['id'];?>" class="btn btn-sm btn-light"><i class="icon-pencil no-decoration"></i></a>
                            <a href="category.php?del=<?=$row2['id'];?>" class="btn btn-sm btn-warning"><i class="icon-doc-remove no-decoration"></i></a>
                        </td>
                    </tr>
                <?php
                endwhile;
                endwhile;
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<?php
include 'includes/footer.php';