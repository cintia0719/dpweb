<?php
require_once "./control/views_control.php";

$view = new viewsControl();
$mostrar = $view->getViewControl();

if ($mostrar == "login" or $mostrar == "404") {
    require_once "./view/".$mostrar.".php";
} else {
    include $mostrar;
}
?>