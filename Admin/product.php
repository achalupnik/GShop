<?php
require_once '../Core/init.php';
include "includes/head.php";
include 'includes/menu.php';

$errors = array();
if(isset($_GET) && !empty($_GET)){
    if(isset($_GET['del']) && !empty($_GET['del'])){
        $del_id = (int)sanitize($_GET['del']);
        $sql = "UPDATE product SET deleted=1 WHERE id=".$del_id;
        mysqli_query($connection, $sql);
        header('Location: product.php');
        exit();
    }

    if(isset($_GET['add']) && !empty($_GET['add']) && isset($_POST) && !empty($_POST)){
        $product_name = sanitize($_POST['product_name']);
        $product_brand_id = (int)sanitize($_POST['product_brand']);
        $parent_category_id = (int)sanitize($_POST['parent_category']);
        $child_category_id = (int)sanitize($_POST['child_category']);
        $product_price = sanitize($_POST['product_price']);
        $product_size = sanitize($_POST['product_size']);
        $product_img = sanitize($_POST['product_img']);
        $product_description = sanitize($_POST['description']);

        $sql = "SELECT * FROM product WHERE name='$product_name'";
        $reult = mysqli_query($connection, $sql);
        if($result->num_rows)
            $errors = "Produkt o takiej nazwie już istnieje w bazie danych";

        
    }
}

if(isset($_GET['add']) && !empty($_GET['add'])){ ?>
    <h3 class="text-center mt-4 mb-5">Dodaj Produkt</h3>
    <div class="container-fluid">
        <form method="post" action="product.php?add=1" enctype="multipart/form-data">
            <div class="row mt-3 mb-4">
                <div class="col-md-3">
                    <label for="product_name">Produkt:</label>
                    <input type="text" id="product_name" name="product_name" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="product_brand">Marka:</label>
                    <select id="product_brand" name="product_brand" class="form-control">
                        <option value="0"></option>
                        <?php
                        $sql = "SELECT * FROM brand";
                        $result = mysqli_query($connection, $sql);
                        while($row = $result->fetch_assoc()):
                        ?>
                        <option value="<?=$row['id'];?>"><?=$row['name'];?></option>
                        <?php
                        endwhile;
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="parent_category">Kategoria (Rodzic):</label>
                    <select id="parent_category" name="parent_category" class="form-control" onchange="change_child_category();">
                        <option value="0">Rodzic</option>
                        <option disabled>─────────────────────</option>
                        <?php
                        $sql = "SELECT * FROM category WHERE parent=0";
                        $result = mysqli_query($connection, $sql);
                        while($row = $result->fetch_assoc()):
                        ?>
                        <option value="<?=$row['id'];?>"><?=$row['name'];?></option>
                        <?php
                        endwhile;
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="child_category">Kategoria (Dziecko):</label>
                    <select id="child_category" name="child_category" class="form-control">
                        <option value="0"></option>
                        <?php
                        $result = mysqli_query($connection, $sql);
                        while($row = $result->fetch_assoc()):
                        ?>
                        <option value="<?=$row['id']?>;"><?=$row['name'];?></option>
                        <?php
                        endwhile;
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="product_price">Cena: (zł)</label>
                    <input type="text" id="product_price" name="product_price" class="form-control" placeholder="Cena np. 12.99">
                </div>
                <div class="col-md-4">
                    <label for="btn_size">Rozmiar & Ilość:</label>
                    <button id="btn_size" class="btn btn-light form-control" data-toggle="modal" data-target="#modal_size">Rozmiar & Ilość</button>

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
                                    <button class="btn btn-primary mt-1" onclick="add_modal_row();">Dodaj pola edycyjne</button>
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
                    <input type="text" id="product_size" name="product_size" class="form-control" value="" disabled>
                </div>
            </div>
            <div class="row my-4">
                <div class="col-md-6">
                    <label for="product_img">Obraz:</label>
                    <input type="file" id="product_img" name="product_img" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="product_description">Opis:</label>
                    <textarea id="product_description" name="product_description" class="form-control">

                    </textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-success w-100">Dodaj Produkt</button>
        </form>
    </div>



<?php
}else {
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
        <table class="table table-striped table-bordered">
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







<script type="text/javascript">
    $(window).ready(function () {
        add_modal_row();
    });

function switch_feature(id) {
    var data = {"id": id};
    $.ajax({
       url      : 'for_ajax/product_change_feature.php',
       type     : 'post',
       data     : data
    });
}

function change_child_category() {
    var parent = $("#parent_category").find(":selected").val();
    alert(parent);
    var data = {"parent_id": parent};
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

</script>




















