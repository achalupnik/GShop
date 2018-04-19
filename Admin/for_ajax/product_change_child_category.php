<?php
require_once '../../Core/init.php';

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

ob_start();
$parent_id = (int)sanitize($_POST['parent_id']);
$error_parent = (int)sanitize($_POST['error_parent']);
$error_child = (int)sanitize($_POST['error_child']);
$sql = "SELECT * FROM category WHERE parent=".$parent_id;
$result = mysqli_query($connection, $sql);
echo "<option></option>";
while($row = $result->fetch_assoc()): ?>
<option value="<?=$row['id'];?>" <?=((!empty($error_child) && !empty($error_child) && $parent_id == $error_parent && $row['id'] == $error_child)?'selected':'');?>><?=$row['name'];?></option>
<?php
endwhile;

echo ob_get_clean();
