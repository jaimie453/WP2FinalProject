<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- JQuery -->
<script src="static/jquery-3.6.0.min.js"></script>

<!-- Needed for Google Maps? -->
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

<!-- Custom CSS -->
<link rel="stylesheet" type="text/css" href="static/css/style.css?v=<?php echo time(); ?>">

<!-- FA Icons -->
<script src="https://kit.fontawesome.com/c5d82d405e.js" crossorigin="anonymous"></script>

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<?php
@include_once './database/dao/usersDAO.php';

if (session_status() !== PHP_SESSION_ACTIVE)
    session_start();

@include_once './utils/toastMessages.php';

// checks for toast flags
if (isset($_SESSION['showImageMessage']) && $_SESSION['showImageMessage'])
    showImageMessage($_SESSION['isAdding']);
else if (isset($_SESSION['showPostMessage']) && $_SESSION['showPostMessage'])
    showPostMessage($_SESSION['isAdding']);
else if(isset($_SESSION['showReviewMessage']) && $_SESSION['showReviewMessage'])
    showReviewMessage($_SESSION['isAdding']);


@include_once './components/accounts.php';
@include_once 'components/toast.php';

?>
