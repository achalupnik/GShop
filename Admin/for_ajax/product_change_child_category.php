<?php
require_once '../../Core/init.php';

ob_start();
$parent_id = (int)sanitize($_POST['parent_id']);
$sql = "SELECT * FROM category WHERE parent=".$parent_id;
$result = mysqli_query($connection, $sql);
echo "<option></option>";
while($row = $result->fetch_assoc()): ?>
<option value="<?=$row['id'];?>"><?=$row['name'];?></option>
<?php
endwhile;

echo ob_get_clean();
