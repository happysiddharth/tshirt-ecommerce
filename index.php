<?php
session_start();
if (isset($_GET['logout'])){

unset($_SESSION['login_email']);


}
if (isset($_GET['logout_seller'])){
    unset($_SESSION['seller_login_email']);
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="online shop where you can buy all type of electric goods">
    <title>Online Shopping</title>
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/navigation_bar.css">
    <script type="text/javascript" src="js/jquery/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="js/bootstrap/js/bootstrap.js"></script>
    <style>
        .hover_image{
            height: 200px;width: 18rem;z-index: 10;position:absolute;top:200px;transition: all linear 0.3s;cursor: pointer;
            background-color: rgba(0,0,0,0.5);
        }
        ..p_img{
            z-index: 5;
            position:relative;
            transform: scale(1);

            transition: transform linear 0.3s;
        }
        ._on_hover:hover .p_img{

            transform: scale(1.2);
        }
        ._on_hover:hover .hover_image{
            top:0px;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <!--Navbar-->
    <?php

    include "php/template/menu.php";
    ?>
    <div class="row">
        <div class="col">
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1>Learn to Create Websites</h1>
                    <p class="lead">In today's world internet is the most popular way of connecting with the people...</p>
                    <p><a href="#" class="btn btn-primary btn-lg">Start learning today</a></p>
                </div>
            </div>
        </div>
    </div>
    <h4 style="padding: 10px">Electronic..<a href="#">View more</a></h4>
    <div class="container">
    <div class="row">
        <?php
        require "php/config.php";
        $con = mysqli_connect($localhost,$un,$pw,$db);
        if(!$con)die("Something went wrong");

        $email = isset($_SESSION['seller_login_email'])?$_SESSION['seller_login_email']:null;

        $query  = "SELECT id FROM `users` WHERE email='$email'";

        if ( $result = mysqli_query($con,$query)){
            $id = mysqli_fetch_assoc($result)['id'];
        }else{
            die("error");
        }

        $query ="SELECT `id`, `image_path`, `product_name`, `product_description`,`price`, `instock`, `product_category`, `added_on`, `_sellor_id` FROM `products` WHERE  product_category='electrical' limit 6";
        if ($result=mysqli_query($con,$query)){



        while ($data= mysqli_fetch_assoc($result)){
        ?>
        <div class="col-lg-4 col-sm-12" style="padding: 10px;">
            <div class="card" style="width: 18rem;position:relative; ">
                <div class="_on_hover" style="position: relative;height: 200px;width: 18rem;overflow: hidden">
                    <div class="hover_image" style="">
                        <form method="get" action="detail_view">
                            <input type="hidden" name="_product_id" value="<?php echo $data['id'];?>">
                            <input type="submit" value="View details" class="btn-group-sm btn-primary" style="position: absolute;left: 100px;top:90px">
                        </form>
                    </div>
                    <img class="card-img p_img" style="" src="<?php echo substr($data['image_path'],1,strlen($data['image_path']));?>" alt="Card image cap">

                </div>

                <div class="card-body">
                    <h5 class="card-title"><?php echo $data['product_name'];    ?></h5>
                    <p class="card-text"> ₹
                        <?php
                        echo $data['price'];
                        ?></p>
                    <?php
            if ($data['instock']>0){

                if (isset($_SESSION['login_email'])){


                        ?>
                        <form method="post" action="cart">
                            <input type="hidden" name="_product_id" value="<?php echo $data['id'];?>">
                            <input type="submit" value="Add to cart" class="btn-block btn-primary">
                        </form>


                        <?php



                    }else {
                        ?>                    <form method="post" action="login">
                        <input type="submit" value="BUY" class="btn-block btn-primary">
                    </form>

                        <?php
                    }
                    }else{

                if (isset($_SESSION['login_email'])){


                ?>
                    <input type="button" value="OUT OF STOCK" class="btn-block btn-danger " disabled    >


                <?php



            }else {
                ?>
                    <input type="button" value="OUT OF STOCK" class="btn-block btn-danger " disabled    >


                    <?php
            }



            }
                    ?>
                </div>
            </div>
        </div>

<?php
}
        }
    ?>   </div>
    </div>
</div>
</body>
</html>