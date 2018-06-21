<link type="text/css" rel="stylesheet" href="css/style_slider.css">
<?php include 'includes/slider_modal.php';  ?>

<div class="col-10">
    <div id="slider_wrapper">
        <ul id="slider">
            <?php
            if(isset($_GET['brand']) && !empty($_GET['brand'])){
                $brand = (int)sanitize($_GET['brand']);
                $sql = "SELECT * FROM product WHERE feature=1 AND deleted=0 AND brand='$brand' LIMIT 40";
            }else
                $sql = "SELECT * FROM product WHERE feature=1 AND deleted=0 LIMIT 40";
            $result = mysqli_query($connection, $sql);
            while($row = $result->fetch_assoc()):
            ?>
            <li>
                <div class="card">
                    <div class="card-header text-center"><?=$row['name'];?></div>
                    <div class="card-body to-align-img">
                        <img src="<?=$row['image'];?>" alt="<?=$row['name'];?>">
                    </div>
                    <div class="card-footer">
                        <span class="float-left" style="line-height: 30px;"><?=$row['price'];?>zł</span>
                        <button class="btn btn-sm float-right" data-toggle="modal" data-target="#slider_modal" onclick="summon_modal(<?=$row['id'];?>);"><details></details></button>
                    </div>
                </div>
            </li>
            <?php
            endwhile;
            ?>
        </ul>
        <div id="left_mark"><span>&#60;</span></div>
        <div id="right_mark"><span>&#62;</span></div>
    </div>


</div>
<div id="after_main_slider" class="mt-3"></div>




</div>
</div>