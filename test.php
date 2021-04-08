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
            print_r($posts->getById(1));

            echo "<h3>Post with nonexistent id</h3>";
            print_r($posts->getById(457894));

            // echo "<h3>get posts for user with id 1</h3>";
            // print_r($posts->getById(1, 'UID'));
    
            @include_once './database/dao/usersDAO.php';

            $users = new usersDAO();

            echo "<h3>All users</h3>";
            print_r($users->getAll());

            echo "<h3>User with id 1</h3>";
            print_r($users->getById(1));

            @include_once './database/dao/citiesDAO.php';

            $cities = new citiesDAO();
            echo "<h3>get single city</h3>";
            print_r($cities->getById(2960));

            //needed pagination for this table specifically lol
            echo "<h3>1st 10 cities</h3>";
            print_r($cities->getAll(0, 10));

            echo "<h3>2nd 10 cities</h3>";
            print_r($cities->getAll(1, 10));

            @include_once './database/dao/countriesDAO.php';

            $countries = new countriesDAO();

            echo "<h3>get single country</h3>";
            print_r($countries->getById('US'));

            echo "<h3>1st 10 countries</h3>";
            print_r($countries->getAll(0, 10));

            @include_once './database/dao/imagesDAO.php';

            $images = new imagesDAO();

            echo "<h3>get single image id 1</h3>";
            print_r($images->getById(1));

            echo "<h3>top 5 rated images</h3>";
            print_r($images->getTopImages(5));

            echo "<h3>top 5 rated images</h3>";
            print_r($images->getNewestImages(5));

            @include_once './database/dao/continentsDAO.php';

            $continents = new continentsDAO();

            echo "<h3>get single continent</h3>";
            print_r($continents->getById("AF"));

            echo "<h3>get all continents</h3>";
            print_r($continents->getAll());

            ?>        
        </div>
    </div>
</body>

</html>