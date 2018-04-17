<style type="text/css" rel="stylesheet">
    .brand_link:hover{
        cursor: pointer;
    }
</style>

<div class="container-fluid mt-5 mb-5">
    <div class="row">
        <div class="col-2">
            <ul class="nav nav-pills flex-column" id="left_sidebar">
                <li class="nav-item">
                    <div class="nav-link active brand_link">Wszystkie Marki</div>
                </li>
                <?php
                $sql = "SELECT * FROM brand";
                $result = mysqli_query($connection, $sql);
                while($row = $result->fetch_assoc()):
                ?>
                <li class="nav-item"><div onclick="select_brand(<?=$row['id'];?>);" class="nav-link brand_link"><?=$row['name'];?></div></li>
                <?php
                endwhile;
                ?>
            </ul>
        </div>

<script type="text/javascript">
    function select_brand(id) {
        var data = {"id": id};
        $.ajax({

        });
    }
</script>