<?php
include  'Includes/head.php';
include  'Includes/menu.php';
include  '../Core/info.php';

?>


<div class="container" style="margin: 5vh 20%">
    <h4 class="text-center">Informacje</h4>
    <div class="my-5">
        <p>Jesteś na www.gshop.pl/admin</p>
        <p>Jest to panel administratora dla strony www.gshop.pl</p>
        <div class="form-group m-5" style="border: 1px solid red;">
            <h5 class="text-danger">Tajne hasła:</h5>
            <ul>
                <li>Użytkownik (bez uprawnień)<br>login: user<br>hasło: user</li>
                <li>Edytor (dostęp do większości funkcji)<br>login: editor<br>hasło: editor</li>
                <li>Administraotr (pełna władza)<br>login: admin<br>hasło: admin</li>
            </ul>
        </div>
        <p class="text-danger">Uwaga</p>
        <p>Upload plików jest dostępny, jednak proszę o nie wrzucanie na serwer niodpowiednich plików</p>
        <p>Strona jest wciąż w trakcie rozwoju, to też niektóre funkcje mogą nie być jeszcze dostępne</p>
        <p>W przypadku uploadu zdjęć należy zachować proporcje obrazu 1:1</p>
    </div>
</div>






<?php
include 'Includes/footer.php';
