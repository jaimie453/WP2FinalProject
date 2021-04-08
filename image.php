<?php

$imageId = -1;
if (!isset($_GET['id']) || $_GET['id'] == null) {
    header('Location: error.php');
} else {
    $imageId = $_GET['id'];
}

@include_once './database/dao/imagesDAO.php';

$images = new imagesDAO();
$image = $images->fetch($imageId);

if(is_null($image))
    header('Location: error.php');

?>


<!doctype html>
<html lang="en">

<head>
    <?php include 'components/head.php'; ?>

    <title>Image Details</title>

</head>

<body class="fixed-mountain-bg">
    <header>
        <?php include_once 'components/navbar.php'; ?>
    </header>

    <div class="container mt-5 mb-5">
        <div class="row">
            
        </div>
    </div>
</body>

</html>