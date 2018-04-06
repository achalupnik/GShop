<nav class="navbar navbar-expand-xl navbar-light sticky-top" style="background: #e3f2fd;" id="menu">
    <button class="navbar-toggler" data-toggle="collapse" data-target="#mainNav">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav mr-auto" id="menu_list" >
            <li class="nav-item active">
                <a class="nav-link" href="index.php"><i class="icon-home myicon"></i></a>
            </li>
            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle mr-2" data-toggle="dropdown" href="#" id="men_toggle">Mężczyzna</a>
                <div class="dropdown-menu" id="men_toggle">
                    <a class="dropdown-item" href="#">Buty</a>
                    <a class="dropdown-item" href="#">Cośiktam</a>
                </div></li>
            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle mr-2" data-toggle="dropdown" href="#" id="woman_toggle">Kobieta</a>
                <div class="dropdown-menu" id="woman_toggle">
                    <a class="dropdown-item" href="#">Buty</a>
                    <a class="dropdown-item" href="#">Cośiktam</a>
                </div>
            </li>
            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle mr-2" data-toggle="dropdown" href="#" id="boy_toggle">Chłopiec</a>
                <div class="dropdown-menu" id="boy_toggle">
                    <a class="dropdown-item" href="#">Buty</a>
                    <a class="dropdown-item" href="#">Cośiktam</a>
                </div>
            </li>
            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle mr-2" data-toggle="dropdown" href="#" id="girl_toggle">Dziewczynka</a>
                <div class="dropdown-menu" id="girl_toggle">
                    <a class="dropdown-item" href="#">Buty</a>
                    <a class="dropdown-item" href="#">Cośiktam</a>
                </div>
            </li>
        </ul>
    </div>
    <form class="form-inline" style="margin-right: 40px;" id="f_form">
        <select class="form-control" id="select_form">
            <option>Wszystkie działy</option>
            <option>Mężczyzna</option>
            <option>Kobieta</option>
            <option>Chłopiec</option>
            <option>Dziewczynka</option>
        </select>
        <input class="form-control " type="search" placeholder="Search" id="search">
        <button class="btn" id="btn_search" type="submit">Search</button>
    </form>
    <div><a href="#"><i class="icon-basket myicon"><span class="badge badge-info mr-3" id="badge">0</span></i></a></div>
    <div class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" id="account_user"><i class="icon-user myicon"></i></a>
    <ul class="dropdown-menu" id="account_user" style="left: -150%;">
        <li class="dropdown-submenu"><a class="dropdown-item" href="#">LogIn</a></li>
        <li class="dropdown-submenu"><a class="dropdown-item" href="#">Logout</a></li>
    </ul>
    </div>

</nav>
