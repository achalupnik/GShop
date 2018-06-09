<?php
require_once '../Core/init.php';

$category_id = (int)sanitize($_POST['category_id']);

if(empty($_POST['search_val'])){
    $sql = "SELECT p.id,p.name,p.price,p.image FROM product as p INNER JOIN category as c WHERE p.category=c.id AND c.parent='$category_id'";
}else{
    $search_val = sanitize($_POST['search_val']);
    if($category_id === 0)
        $sql = "SELECT * FROM product WHERE name LIKE '%$search_val%'";
    else
        $sql = "SELECT p.id,p.name,p.price,p.image FROM product as p INNER JOIN category as c WHERE p.name LIKE '%$search_val%' AND p.category=c.id AND c.parent='$category_id'";
}


$result = mysqli_query($connection, $sql);


ob_start();
while ($row = $result->fetch_assoc()):
    ?>

    <li>
        <div class="card">
            <div class="card-header text-center"><?= $row['name']; ?></div>
            <div class="card-body to-align-img">
                <img src="<?= $row['image']; ?>" alt="<?= $row['name']; ?>">
            </div>
            <div class="card-footer">
                <span class="float-left" style="line-height: 30px;"><?= $row['price']; ?>zł</span>
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