<?php
include 'includes/head.php';
include 'includes/menu.php';
include  '../Core/info.php';

if(!is_logged()){
    header('Location: login.php');
    $_SESSION['error_flash'] = "Musisz być zalogowany by mieć dostęp do tej funkcji";
    exit();
}

if(!have_permission()){
    header('Location: index.php');
    $_SESSION['error_flash'] = "Nie masz potrzebnych uprawnień by przeprowadzić tą akcję";
    exit();
}

?>

<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item active"><a class="nav-link active" href="#menu_1" role="tab" data-toggle="tab" style="color: black;">Users data</a></li>
    <li class="nav-item"><a href="#menu_2" class="nav-link" role="tab" data-toggle="tab" style="color: black;">Create new user</a></li>
    <li class="nav-item"><a href="#menu_3" class="nav-link" role="tab" data-toggle="tab" style="color: black;">Change permissions</a></li>
</ul>
<div class="tab-content">
    <div class="tab-pane show active" role="tabpanel" id="menu_1"><br>
info
    </div>
    <div class="tab-pane fade" role="tabpanel" id="menu_2"><br>
info2
    </div>
    <div class="tab-pane fade" role="tabpanel" id="menu_3"><br>
info3
    </div>
</div>





<?php
include 'includes/footer.php';