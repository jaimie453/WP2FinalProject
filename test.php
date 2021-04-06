<!doctype html>
<html lang="en">

<head>
    <?php include 'components/head.php'; ?>

    <title>Home</title>
</head>

<body class="fixed-mountain-bg">
    <header>
        <?php include_once 'components/navbar.php'; ?>
    </header>

    <div class="container mt-3">
        <div class="row">
            <?php

            @include_once './database/dao/postsDAO.php';

            $posts = new postsDAO();

            echo '<h3>Get first 10 posts</h3>';
            print_r($posts->getAll(0, 10));

            echo "<h3>Post with id 1</h3>";
            print_r($posts->fetch(1));

            echo "<h3>Post with nonexistent id</h3>";
            print_r($posts->fetch(457894));

            echo "<h3>get posts for user with id 1</h3>";
            print_r($posts->fetch(1, 'UID'));
    
            @include_once './database/dao/usersDAO.php';

            $users = new usersDAO();

            echo "<h3>All users</h3>";
            print_r($users->getAll());

            echo "<h3>User with id 1</h3>";
            print_r($users->fetch(1));

            @include_once './database/dao/citiesDAO.php';

            $cities = new citiesDAO();
            echo "<h3>get single city</h3>";
            print_r($cities->fetch(2960));

            // needed pagination for this table specifically lol
            echo "<h3>1st 10 cities</h3>";
            print_r($cities->getAll(0, 10));

            echo "<h3>2nd 10 cities</h3>";
            print_r($cities->getAll(1, 10));

            @include_once './database/dao/countriesDAO.php';

            $countries = new countriesDAO();

            echo "<h3>get single country</h3>";
            print_r($countries->fetch('US'));

            echo "<h3>1st 10 countries</h3>";
            print_r($countries->getAll(0, 10));

            @include_once './database/dao/imagesDAO.php';

            $images = new imagesDAO();

            echo "<h3>get single image</h3>";
            print_r($images->fetch(1));

            echo "<h3>1st 10 images</h3>";
            print_r($images->getAll(0, 10));

            ?>        
        </div>
    </div>
</body>

</html>