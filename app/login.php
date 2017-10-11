<?php
if (isset($_POST) && $_POST['password'] !== null) {
    echo "<h1>Success</h1>";
    echo var_dump($_POST);
} else {
    echo "<h1>Failure</h1>";
}
