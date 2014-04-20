<?php
/*
foreach ($_FILES["images"]["error"] as $key => $error) {
    if ($error == UPLOAD_ERR_OK) {
        $name = $_FILES["images"]["name"][$key];
        move_uploaded_file( $_FILES["images"]["tmp_name"][$key], "uploads/" . $_FILES['images']['name'][$key]);
    }
}


echo "<h2>Successfully Uploaded Images</h2>";
*/

use foundationphp\UploadFile;
require_once 'config.php';
require_once 'src/foundationphp/UploadFile.php';


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