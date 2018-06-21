
<div class="container-fluid mt-5 mb-5">
    <div class="row">
        <div class="col-2" id="before_left_sidebar">
            <ul class="nav nav-pills flex-column" id="left_sidebar">
                <li class="nav-item">
                    <div class="nav-link active pointer" onclick="select_table(0, 'brand')">Wszystkie Marki</div>
                </li>
                <?php
                $sql = "SELECT * FROM brand";
                $result = mysqli_query($connection, $sql);
                while($row = $result->fetch_assoc()):
                ?>
                <li class="nav-item"><div onclick="select_table(<?=$row['id'];?>, 'brand');" class="nav-link pointer"><?=$row['name'];?></div></li>
                <?php
                endwhile;
                ?>
            </ul>
        </div>
