<nav class="navbar navbar-expand-xl navbar-light sticky-top" style="background: #e3f2fd;" id="menu">
    <button class="navbar-toggler" data-toggle="collapse" data-target="#mainNav">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav mr-auto" id="menu_list" >
            <li class="nav-item active">
                <a class="nav-link" href="index.php"><i class="icon-home myicon"></i></a>
            </li>
            <?php
            $sql = "SELECT * FROM category WHERE parent=0";
            $result = mysqli_query($connection, $sql);
            while($row = $result->fetch_assoc()):
            ?>
            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle mr-2" data-toggle="dropdown" href="#" id="men_toggle"><?=$row['name'];?></a>
                <div class="dropdown-menu" id="men_toggle">
                    <?php
                        $sql = "SELECT * FROM category WHERE parent=".$row['id'];
                        $result2 = mysqli_query($connection, $sql);
                        while($row2 = $result2->fetch_assoc()): ?>
                    <div class="dropdown-item pointer" onclick="select_table(<?=$row2['id'];?>, 'category');"><?=$row2['name'];?></div>
                        <?php endwhile; ?>
                </div>
            </li>
            <?php
            endwhile;
            ?>
        </ul>
    </div>
    <form class="form-inline" style="margin-right: 40px;" id="f_form">
        <select class="form-control" id="select_form">
            <option value="0">Wszystkie działy</option>
            <?php
            $sql = "SELECT * FROM category WHERE parent = 0";
            $result = mysqli_query($connection, $sql);
            while($row = $result->fetch_assoc()): ?>
            <option value="<?=$row['id']?>"><?=$row['name']?></option>
            <?php
            endwhile;
            ?>
        </select>
        <input class="form-control " type="search" placeholder="Search" id="search" onkeyup="search_filter();">
        <button class="btn" id="btn_search" type="submit">Search</button>
    </form>
    <div><a href="#"><i class="icon-basket myicon"><span class="badge badge-info mr-3" id="badge">0</span></i></a></div>
    <div class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" id="account_user"><i id="user_icon" class="icon-user myicon"></i></a>
    <ul class="dropdown-menu" id="account_user" style="left: -150%;">
        <?php
        if(is_logged()){
            ?>
            <li class="dropdown-submenu"><a class="dropdown-item" href="change_password.php">Zmień hasło</a></li>
            <li class="dropdown-submenu"><a class="dropdown-item" href="logout.php">Wyloguj się</a></li>
            <?php
        }else {
            ?>
            <li class="dropdown-submenu"><a class="dropdown-item" href="login.php">Zaloguj się</a></li>
            <?php
        }
        ?>
    </ul>
    </div>

</nav>

<?php
if(is_logged()){ ?>
    <script type="text/javascript">
        document.getElementById("user_icon").style.color = "#80aaff";
    </script>
    <?php
}