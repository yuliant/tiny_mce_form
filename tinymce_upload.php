<?php
function _random($n)
{
    $characters = '0123456789';
    $randomString = '';
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
    return $randomString;
}

// $fileName = $_FILES['file']['name'];
$fileName = _random(10) . $_FILES['file']['name'];
$fileType = $_POST['filetype'];
if ($fileType == 'image') {
    $validExtension = array('png', 'jpeg', 'jpg');
}
$uploadDir = "upload/" . $fileName;
$fileExtension = pathinfo($uploadDir, PATHINFO_EXTENSION);
$fileExtension = strtolower($fileExtension);
if (in_array($fileExtension, $validExtension)) {
    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadDir)) {
        echo $fileName;
    }
}
