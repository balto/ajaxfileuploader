<?php

require_once 'src/UploadFile.php';
require_once 'config.php';

$result = array();

try {
    $upload = new UploadFile($destination);
    $upload->setMaxSize($max);
    $upload->allowAllTypes();
    $upload->upload();
    $result = $upload->getMessages();
} catch (Exception $e) {
    $result[] = $e->getMessage();
}

$error = error_get_last();

if ($error) {
    echo "<li>{$error['message']}</li>";
}
if ($result) {
    foreach ($result as $message) {
        echo "<li>$message</li>";
    }
}