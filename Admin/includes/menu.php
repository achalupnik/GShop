<nav class="navbar navbar-expand-xl navbar-light sticky-top" style="background: #e3f2fd;" id="menu">
    <button class="navbar-toggler" data-toggle="collapse" data-target="#mainNav">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav mr-auto" id="menu_list" >
            <li class="nav-item active mr-4">
                <a class="nav-link" href="index.php"><i class="icon-home myicon"></i></a>
            </li>
            <li class="nav-item active mr-4">
                <a class="nav-link" href="brand.php">Marki</a>
            </li>
            <li class="nav-item active mr-4">
                <a class="nav-link" href="category.php">Kategorie</a>
            </li>
            <li class="nav-item active mr-4">
                <a class="nav-link" href="product.php">Produkty</a>
            </li>
        </ul>
    </div>

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
