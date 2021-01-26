<?php
function autoloader($name)
{
    $arrToken = explode('\\', $name);
    $arrToken[0] = '/include';
    $filename = '..' . implode("/", $arrToken) . '.class.php';
    if (file_exists($filename)) {
        require_once($filename);
    }
}