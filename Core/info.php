<?php
if(isset($_SESSION['success_flash']) && !empty($_SESSION['success_flash'])){
    echo '<ul class="bg-success" id="success_flash"><li>&nbsp;'.$_SESSION['success_flash'].'</li></ul>'; ?>
    <script type="text/javascript">
        setTimeout(function () {
            $("#success_flash").html("");
        }, 15000);
    </script>
    <?php
    unset($_SESSION['success_flash']);
}

if(isset($_SESSION['error_flash']) && !empty($_SESSION['error_flash'])){
    echo '<ul class="bg-danger" id="error_flash"><li>&nbsp;'.$_SESSION['error_flash'].'</li></ul>'; ?>
    <script type="text/javascript">
        setTimeout(function () {
            $("#error_flash").html("");
        }, 15000);
    </script>
    <?php
    unset($_SESSION['error_flash']);
}