<?php
require_once '../Core/init.php';
include "includes/head.php";
include 'includes/menu.php';

$errors = array();

if(isset($_GET) && !empty($_GET)){

    //Delete product
    if(isset($_GET['del']) && !empty($_GET['del'])){
        $del_id = (int)sanitize($_GET['del']);
        $sql = "UPDATE product SET deleted=1 WHERE id=".$del_id;
        mysqli_query($connection, $sql);
        header('Location: product.php');
        exit();
    }

    if(isset($_GET['edit']))
        $main_id = sanitize($_GET['edit']);
    else
        $main_id = (int)sanitize($_GET['add']);


    //Add/Edit product to DB
    if(isset($_POST) && !empty($_POST)){
        if(!empty($_POST['product_name']))
            $product_name = sanitize($_POST['product_name']);
        if(!empty($_POST['product_brand']))
            $product_brand_id = (int)sanitize($_POST['product_brand']);
        if(!empty($_POST['parent_category']))
        $parent_category_id = (int)sanitize($_POST['parent_category']);
        if(!empty($_POST['child_category']))
        $child_category_id = (int)sanitize($_POST['child_category']);
        if(!empty($_POST['product_price']))
        $product_price = sanitize($_POST['product_price']);
        if(!empty($_POST['product_size']))
        $product_size = sanitize($_POST['product_size']);
        if(!empty($_POST['product_description']))
        $product_description = sanitize($_POST['product_description']);


        if(isset($product_name)) {
            $sql = "SELECT * FROM product WHERE name='$product_name'";
            $result = mysqli_query($connection, $sql);
            if ($result->num_rows)
                $errors[] = "Produkt o takiej nazwie już istnieje w bazie danych";
        }

        if((isset($_FILES['product_img'])) && !empty($_FILES['product_img']['name'])){
            $product_img = $_FILES['product_img'];
            $product_img_type = explode('/', $product_img['type']);
            if($product_img_type[0] != 'image')
                $errors[] = "Przesłany plik musi być typu image";

            $allowed_ext_img = array("gif", "jpeg", "jpg", "png");
            if(!in_array($product_img_type[1], $allowed_ext_img))
                $errors[] = "Dozwolone typy obrazu: gif, jpeg, jpg, png";

            $name_extention = explode('.', $product_img['name']);
            if(!in_array($name_extention[1], $allowed_ext_img))
                $errors[] = "Dozwolone rozszerzenia obrazu: gif, jpeg, jpg, png";

            if($product_img['size']>1000000)
                $errors[] = "Obrazek nie może mieć rozmiar większy niż 1MB";

            $product_img_path =  $_SERVER['DOCUMENT_ROOT'].'/GShop/img/products/'.md5(microtime()).'.'.$name_extention[1];
            $product_img_path2 =  '/GShop/img/products/'.md5(microtime()).'.'.$name_extention[1];
        }



        $post = array('product_name', 'product_brand', 'parent_category', 'child_category', 'product_price', 'product_size');
        foreach ($post as $key => $item){
            if(empty($_POST[$post[$key]])){
                $errors[] = "Musisz uzupełnić wszytkie pola oznaczone znakiem gwiazdki(*)";
                break;
            }
        }

        if(!empty($errors))
            echo display_errors($errors);
        else{
            if(isset($_GET['add']) && !empty($_GET['add'])) {
                move_uploaded_file($product_img['tmp_name'], $product_img_path);
                $sql = "INSERT INTO product (name, price, brand, category, image, size, description) VALUES ('$product_name', '$product_price', '$product_brand_id', '$child_category_id', '$product_img_path2', '$product_size', '$product_description')";
                mysqli_query($connection, $sql);
                header('Location: product.php');
                exit();
            }

            if(isset($_GET['edit']) && !empty($_GET['edit'])){
                if((isset($_FILES['product_img'])) && !empty($_FILES['product_img']['name'])){
                    move_uploaded_file($product_img['tmp_name'], $product_img_path);
                    $sql = "UPDATE product SET name='$product_name', price='$product_price', brand='$product_brand_id', category='$child_category_id', image='$product_img_path2', size='$product_size', description='$product_description' WHERE id=".$main_id;
                }else{
                    $sql = "UPDATE product SET name='$product_name', price='$product_price', brand='$product_brand_id', category='$child_category_id', size='$product_size', description='$product_description' WHERE id=".$main_id;
                }
                mysqli_query($connection, $sql);
                header('Location: product.php');
                exit();
            }
        }
    }

    //Edit - Fulfill inputs from db
    if(isset($_GET['edit']) && !empty($_GET['edit'])){
        $edit_id = (int)sanitize($_GET['edit']);
        $sql = "SELECT * FROM product WHERE id=".$edit_id;
        $result = mysqli_query($connection, $sql);
        $row = $result->fetch_assoc();

        $product_name = $row['name'];
        $product_brand_id = $row['brand'];
        $child_category_id = $row['category'];
        $product_price = $row['price'];
        $product_img = $row['image'];
        $product_description = $row['description'];
        $product_size = $row['size'];

        $sql = "SELECT * FROM category WHERE id=".$row['category'];
        $result = mysqli_query($connection, $sql);
        $row = $result->fetch_assoc();
        $parent_category_id = $row['parent'];
    }

}



//Add product - Form
if((isset($_GET['add']) && !empty($_GET['add'])) || isset($_GET['edit']) && !empty($_GET['edit'])){ ?>
    <h3 class="text-center mt-4 mb-5"><?=(isset($edit_id)?'Edytuj':'Dodaj');?> Produkt</h3>
    <div class="container-fluid">
        <form method="post" action="product.php?<?=((isset($_GET['edit']) && !empty($_GET['edit']))?'edit=':'add='); echo $main_id;?>" enctype="multipart/form-data">
            <div class="row mt-3 mb-4">
                <div class="col-md-3">
                    <label for="product_name">Produkt*:</label>
                    <input type="text" id="product_name" name="product_name" class="form-control" value="<?=((isset($product_name) && !empty($product_name))?$product_name:'');?>">
                </div>
                <div class="col-md-3">
                    <label for="product_brand">Marka*:</label>
                    <select id="product_brand" name="product_brand" class="form-control">
                        <option value="0"></option>
                        <?php
                        $sql = "SELECT * FROM brand";
                        $result = mysqli_query($connection, $sql);
                        while($row = $result->fetch_assoc()):
                        ?>
                        <option value="<?=$row['id'];?>" <?=((isset($product_brand_id) && !empty($product_brand_id) && $row['id']==$product_brand_id)?'selected':'');?>><?=$row['name'];?></option>
                        <?php
                        endwhile;
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="parent_category">Kategoria (Rodzic)*:</label>
                    <select id="parent_category" name="parent_category" class="form-control" onchange="change_child_category();">
                        <option value="0">Rodzic</option>
                        <option disabled>─────────────────────</option>
                        <?php
                        $sql = "SELECT * FROM category WHERE parent=0";
                        $result = mysqli_query($connection, $sql);
                        while($row = $result->fetch_assoc()):
                        ?>
                        <option value="<?=$row['id'];?>" <?=((isset($parent_category_id) && !empty($parent_category_id) && $row['id']==$parent_category_id)?'selected':'');?>><?=$row['name'];?></option>
                        <?php
                        endwhile;
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="child_category">Kategoria (Dziecko)*:</label>
                    <select id="child_category" name="child_category" class="form-control">
                        <option value="0"></option>
                        <?php
                        $result = mysqli_query($connection, $sql);
                        while($row = $result->fetch_assoc()):
                        ?>
                        <option value="<?=$row['id'];?>" <?=((isset($child_category_id) && !empty($child_category_id) && $row['id']==$child_category_id)?'selected':'');?>><?=$row['name'];?></option>
                        <?php
                        endwhile;
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="product_price">Cena (zł)*:</label>
                    <input type="text" id="product_price" name="product_price" class="form-control" placeholder="Cena np. 12.99" value="<?=((isset($product_price) && !empty($product_price))?$product_price:'');?>">
                </div>
                <div class="col-md-4">
                    <label for="btn_size">Rozmiar & Ilość*:</label>
                    <button id="btn_size" type="button" class="btn btn-light form-control" data-toggle="modal" data-target="#modal_size">Rozmiar & Ilość</button>

                    <div class="modal fade" id="modal_size" tabindex="-1" role="dialog" aria-labelledby="modal_size" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title w-100 text-center">Rozmiar & Ilość</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div id="modal_data">
                                        <!-- This data are added by JS script -->
                                    </div>
                                    <button class="btn btn-primary mt-1" type="button" onclick="add_modal_row();">Dodaj pola edycyjne</button>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" onclick="process_modal_data();">Akceptuje</button>
                                    <button type="button" id="close_modal" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="product_size">Rozmiar & Ilość: (podgląd)</label>
                    <input type="text" id="product_size" name="product_size" class="form-control" value="<?=((isset($product_size) && !empty($product_size))?$product_size:'');?>" readonly>
                </div>
            </div>
            <div class="row my-4">
                <div class="col-md-6">
                    <?php if(isset($edit_id) && !empty($product_img)){ ?>
                        <div id="div_remove_img" class="d-flex flex-column">
                            <label for="edit_img">Obraz:</label>
                            <img class="mb-2 w-25" id="edit_img" src="<?=$product_img;?>" alt="obraz" height="auto">
                            <button type="button" class="btn btn-secondary w-25" onclick="remove_img(<?=$edit_id;?>);">Usuń obraz</button>
                        </div>
                    <?php }else{ ?>
                        <label for="product_img">Obraz:</label>
                        <input type="file" id="product_img" name="product_img" class="form-control">
                    <?php } ?>
                </div>
                <div class="col-md-6">
                    <label for="product_description">Opis:</label>
                    <textarea id="product_description" name="product_description" class="form-control"><?=((isset($product_description) && !empty($product_description))?$product_description:'');?></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-success w-100"><?=(isset($edit_id)?'Edytuj':'Dodaj');?> Produkt</button>
        </form>
    </div>



<?php
}else {

    //Display products
    ?>
    <link type="text/css" rel="stylesheet" href="../css/toggle_switch.css">
    <div id="test"></div>
    <div class="container-fluid">
        <h3 class="text-center mt-3">Produkty</h3>
        <div class="form-inline my-4">
            <div class="all-center">
                <a href="product.php?add=1" class="btn btn-success mr-1">Dodaj Produkt</a>
                <a href="product.php?restore=1" class="btn btn-primary">Przywróć produkt</a>
            </div>
        </div>
        <hr style="border: 1px solid gray; opacity: 0.3;">
        <table class="table table-striped table-sm table-bordered">
            <thead>
            <tr>
                <th>Produkt</th>
                <th>Kategoria</th>
                <th>Cena</th>
                <th>Wyświetlaj</th>
                <th>Opcje</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT * FROM product WHERE deleted=0";
            $result = mysqli_query($connection, $sql);
            while ($row = $result->fetch_assoc()):
                $sql = "SELECT * FROM category WHERE id=" . $row['category'];
                $result_category = mysqli_query($connection, $sql);
                $row_category = $result_category->fetch_assoc();
                if ($row_category['parent'] != 0) {
                    $sql = "SELECT * FROM category WHERE id=" . $row_category['parent'];
                    $result_category_p = mysqli_query($connection, $sql);
                    $row_category_p = $result_category_p->fetch_assoc();
                }
                ?>
                <tr>
                    <td><?= $row['name']; ?></td>
                    <td><?= (($row_category['parent'] != 0) ? $row_category_p['name'] : 'Parent') . ': ' . $row_category['name']; ?></td>
                    <td><?= $row['price']; ?>zł</td>
                    <td>
                        <label class="switch">
                            <input type="checkbox" <?= ($row['feature'] ? 'checked' : ''); ?>
                                   onclick="switch_feature(<?= $row['id']; ?>);">
                            <span class="sliderp round"></span>
                        </label>
                    </td>
                    <td>
                        <a href="product.php?edit=<?= $row['id']; ?>" class="btn btn-sm btn-light"><i
                                    class="icon-pencil no-decoration"></i></a>
                        <a href="product.php?del=<?= $row['id']; ?>" class="btn btn-sm btn-warning"><i
                                    class="icon-doc-remove no-decoration"></i></a>
                    </td>
                </tr>
                <?php
            endwhile;
            ?>
            </tbody>
        </table>

    </div>
<?php
}

include 'includes/footer.php';
?>



<!--
//supporting div's for barier php - js
//fulfill category_child when $errors -->
<input type="hidden" id="error_parent" value="<?=((isset($parent_category_id) && !empty($parent_category_id))?$parent_category_id:'');?>">
<input type="hidden" id="error_child" value="<?=((isset($child_category_id) && !empty($child_category_id))?$child_category_id:'');?>">




<script type="text/javascript">
    $(window).ready(function () {
        add_modal_row();

        //fulfill category_child when $errors
        if($("#error_child").val()!=='' || $("#error_parent").val() !== '')
            $("#parent_category").trigger('change');


        //fulfill modal 'Rozmiar & Ilość' when $errors
<?php
    if(isset($product_size) && !empty($product_size)){
        ?>
                var row = $("#product_size").val().split(',');
                for(var i=0, k=1; i<row.length;i++,k++){
                    if(i!=0)
                        add_modal_row();
                    var temp = row[i].split(':');
                    $("#m_size"+k).val(temp[0]);
                    $("#m_amount"+k).val(temp[1]);
                }
        <?php
    }
?>

    });

//Switch feature in DB
function switch_feature(id) {
    var data = {"id": id};
    $.ajax({
       url      : 'for_ajax/product_change_feature.php',
       type     : 'post',
       data     : data
    });
}

function alertx(){
    alert("dupa");
}

//Display all child for selected parent
function change_child_category() {
    var parent = $("#parent_category").find(":selected").val();
    var error_parent = $("#error_parent").val();
    var error_child = $("#error_child").val();
    var data = {"parent_id": parent, "error_parent": error_parent, "error_child": error_child};
    $.ajax({
        url      : 'for_ajax/product_change_child_category.php',
        type     : 'post',
        data     : data,
        success  : function (data) {
            $("#child_category").html(data);
        },
        error    : function () {
            alert("Błąd danych");
        }
    });
}

//Add row with Size & Ammount to modal
var row_number = 0;
function add_modal_row(){
    row_number++;
    var temp = '<div class="row mt-3">' +
        '<div class="col-md-6">' +
        '   <input id="m_size'+row_number+'" class="form-control" type="text" placeholder="rozmiar np. mały">' +
        '</div>' +
        '<div class="col-md-6">' +
        '   <input id="m_amount'+row_number+'" class="form-control" type="text" placeholder="ilość np. 13">' +
        '</div>' +
        '</div>';
    $("#modal_data").append(temp);
}

//In modal on Accept - Push data to product_size
function process_modal_data() {
    var nr = 1;
    var size, amount, data='';
    while((size=$("#m_size"+nr)).length && (amount=$("#m_amount"+nr)).length){
        nr++;
        if(nr!==2){
            data += ',';
        }
        data += size.val()+':'+amount.val();
    }
    $("#product_size").val(data);
    $('#close_modal').trigger('click');
}

function remove_img(id) {
    var data = {"id": id};
    $.ajax({
        url     : 'for_ajax/product_remove_img.php',
        type    : 'post',
        data    : data
    });
    $("#div_remove_img").html('<label for="product_img">Obraz:</label>'+
    '<input type="file" id="product_img" name="product_img" class="form-control">');
}

</script>
















