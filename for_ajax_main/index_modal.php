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
    <div id="cart_error" class="bg-danger text-warning"></div>
    <div class="modal-header">
        <h4 class="modal-title text-center" style="width: 100%;"><b><?=$row['name'];?></b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form id="add_to_cart_form">
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
                        <label for="cart_quantity"><b>Ilość</b></label><br>
                        <input type="number" min="1" id="cart_quantity" name="cart_quantity" class="form-control"><br>
                        <label for="cart_size"><b>Rozmiar</b></label>
                        <select id="cart_size" name="cart_size" class="form-control">
                            <option></option>
                            <?php
                            $n=0;
                            while($sizes[$n] != ''):
                            ?>
                            <option value="<?=$n+1;?>"><?=$sizes[$n].' - Dostępnych('.$quantities[$n].')';?></option>
                            <?php
                            $n++;
                            endwhile;
                            ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="product_id" id="product_id" value="<?=$id;?>">
        <div class="modal-footer">
            <button type="button" id="close_add_to_cart_modal" class="btn btn-light" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-warning" onclick="add_to_cart();"><i class="icon-basket" style="font-size: 8px;"></i>Add to Card</button>
        </div>
    </form>
<?php
echo ob_get_clean();