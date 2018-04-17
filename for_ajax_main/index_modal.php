<?php
require_once '../Core/init.php';
$id = (int)sanitize($_POST['id']);
$sql = "SELECT * FROM product WHERE id=".$id;
$result = mysqli_query($connection, $sql);
$row = $result->fetch_assoc();
$options = explode(',',$row['size']);
$sizes = array();
$quantities = array();
foreach($options as $item){
    $temp = explode(':', $item);
    $sizes[] .= $temp[0];
    $quantities[] .= $temp[1];
}
$sql = "SELECT * FROM brand WHERE id=".$row['brand'];
$result = mysqli_query($connection, $sql);
$row_brand = $result->fetch_assoc();
ob_start();
?>

    <div class="modal-header">
        <h4 class="modal-title text-center" style="width: 100%;"><b><?=$row['name'];?></b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-5 text-center" id="slider_modal_img">
                    <img src="<?=$row['image'];?>" alt="<?=$row['name'];?>">
                </div>
                <div class="col-sm-7">
                    <h5>Opis:</h5>
                    <p><?=$row['description'];?></p><hr>
                    <p>Cena: <?=$row['price'];?>zł</p>
                    <p>Marka: <?=$row_brand['name'];?></p>
                    <label for="quanity"><b>Zamawiana ilość towaru</b></label><br>
                    <input type="number" id="quanity" class="form-control"><br>
                    <label for="size"><b>Rozmiar: dostępna ilość</b></label>
                    <select id="size" class="form-control">
                        <option></option>
                        <?php
                        $n=0;
                        while($sizes[$n] != ''):
                        ?>
                        <option><?=$sizes[$n].': '.$quantities[$n];?></option>
                        <?php
                        $n++;
                        endwhile;
                        ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-warning"><i class="icon-basket" style="font-size: 8px;"></i>Add to Card</button>
    </div>

<?php
echo ob_get_clean();