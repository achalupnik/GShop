<?php
include  'Includes/head.php';
include  'Includes/menu.php';
include  '../Core/info.php';

?>


<div class="container" style="margin: 5vh 20%">
    <h4 class="text-center">Informacje</h4>
    <div class="my-5">
        <p>Wszedłeś na <a href="#">www.gshop.pl/admin</a></p>
        <p>Jest to panel administratora dla strony <a href="../index.php">www.gshop.pl</a></p>
        <div class="form-group m-5" style="border: 1px solid red;">
            <h5 class="text-danger">&nbsp;Tajne hasła:</h5>
            <ul>
                <li class="mt-2"><b>Użytkownik</b> (bez uprawnień)<br>login: user<br>hasło: user</li>
                <li class="mt-3"><b>Edytor</b> (dostęp do większości funkcji)<br>login: editor<br>hasło: editor</li>
                <li class="mt-3"><b>Administraotr</b> (pełna władza)<br>login: admin<br>hasło: admin</li>
            </ul>
        </div>
        <p class="text-danger">Uwaga</p>
        <p>Upload plików jest dostępny, jednak proszę o niewrzucanie na serwer niostosownych/nieprzyzwoitych plików i treści</p>
        <p>Strona jest wciąż w trakcie rozwoju, to też niektóre funkcje mogą nie być jeszcze dostępne</p>
    </div>
</div>







<?php
include 'Includes/footer.php';
