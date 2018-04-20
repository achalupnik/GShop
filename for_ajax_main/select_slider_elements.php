<?php
require_once '../Core/init.php';

$id = (int)sanitize($_POST['id']);
$table = sanitize($_POST['table']);

if($id!==0)
    $sql = "SELECT * FROM product WHERE feature=1 and $table=".$id;
else
    $sql = "SELECT * FROM product WHERE feature=1 LIMIT 40";

$result = mysqli_query($connection, $sql);

    ob_start();
    while ($row = $result->fetch_assoc()):
        ?>

        <li>
            <div class="card">
                <div class="card-header text-center"><?= $row['name']; ?></div>
                <div class="card-body">
                    <img src="<?= $row['image']; ?>" alt="<?= $row['name']; ?>">
                </div>
                <div class="card-footer">
                    <span class="float-left" style="line-height: 30px;"><?= $row['price']; ?>zł</span><div style="clear:both">
                    <button class="btn btn-sm float-right" data-toggle="modal" data-target="#slider_modal"
                            onclick="summon_modal(<?= $row['id']; ?>);">
                        <details></details>
                    </button>
                </div>
            </div>
        </li>

        <?php
    endwhile;
echo ob_get_clean();

