<div class="container-fluid mt-5 mb-5">
    <div class="row">
        <div class="col-2">
            <ul class="nav nav-pills flex-column" id="left_sidebar">
                <li class="nav-item">
                    <a href="#" class="nav-link active">Marki</a>
                </li>
                <?php
                $sql = "SELECT * FROM brand";
                $result = mysqli_query($connection, $sql);
                while($row = $result->fetch_assoc()):
                ?>
                <li class="nav-item"><a href="#" class="nav-link"><?=$row['name'];?></a></li>
                <?php
                endwhile;
                ?>
            </ul>
        </div>