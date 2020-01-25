<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin login</title>
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/navigation_bar.css">
    <link rel="stylesheet" href="css/admin.css">
    <script type="text/javascript" src="js/jquery/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="js/bootstrap/js/bootstrap.js"></script>
    <style>
        body{
            padding:0;
            margin: 0;
            background-image: url("images/brooke-cagle-195777-unsplash.jpg");
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }


    </style>
</head>
<body>
<div class="container-fluid">
    <?php
include "template/menu.php";
    include "template/login_admin_user.php";

?>
</div>

</body>
</html>