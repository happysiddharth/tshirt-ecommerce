<?php
session_start();
if (isset($_GET['_product_id'])){
    if (!empty($_GET['_product_id'])){
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

                .imgage img{
                    transform: scale(1);
                    width:inherit;height: inherit;
                    transition:all linear 0.3s;
                    cursor: pointer;
                }

                .imgage:hover img{
                    transform: scale(1.3);
                }
                .imgage {
                    transform: scale(1);
                    animation-name: zoom;
                    opacity: 1;
                    animation-duration: 0.3s;
                    -webkit-animation-iteration-count: 1;
                    -moz-animation-iteration-count: 1;
                    -o-animation-iteration-count: 1;
                    animation-iteration-count: 1;
                    transform: scale(1);
                    -webkit-transition: all linear  0.3s;
                    -moz-transition: all linear  0.3s;
                    -ms-transition: all linear  0.3s;
                    -o-transition: all linear  0.3s;
                    transition: all linear  0.3s;
                }
                .details

                {
                    opacity: 1;
                    transform: scale(1);
                    animation-name: zoom;
                    animation-delay: 0.3s;
                    animation-duration: 0.3s;
                    -webkit-animation-iteration-count: 1;
                    -moz-animation-iteration-count: 1;
                    -o-animation-iteration-count: 1;
                    animation-iteration-count: 1;
                    transform: scale(1);
                    -webkit-transition: all linear  0.3s;
                    -moz-transition: all linear  0.3s;
                    -ms-transition: all linear  0.3s;
                    -o-transition: all linear  0.3s;
                    transition: all linear  0.3s;
                }

                @keyframes zoom {
                    from{
                        opacity: 0;
                        -webkit-transform: scale(.5);
                        -moz-transform: scale(.5);
                        -ms-transform: scale(.5);
                        -o-transform: scale(.5);
                        transform: scale(.5);
                    }to{
                         opacity: 1;
                         transform: scale(1);
                     }

                }
            </style>
        </head>
        <body>
        <div class="container-fluid">
            <!--Navbar-->
            <?php
            include "./template/menu.php";
            require "config.php";
            $con = mysqli_connect($localhost, $un, $pw, $db);
            if (!$con) die("Something went wrong");
            $product_id = mysqli_real_escape_string($con,htmlspecialchars($_GET['_product_id']));
            $query = "select * from products WHERE id='$product_id'";
            if ($res = mysqli_query($con,$query)){
                $data = mysqli_fetch_assoc($res);

                $seller_id =$data['_sellor_id'];

                $query = "select * from seller where id = $seller_id";

                if ($result_seller = mysqli_query($con,$query)){
                    $seller  = mysqli_fetch_assoc($result_seller);
                }

            }
            ?>
            <div class="container-fluid">
                <div class="row" style="padding: 5px;">
                    <div class="col-lg-6 image_main" >
                        <div class="imgage" style="position:relative;height: 500px;width: 500px;margin-top: 10px;overflow: hidden;">
                            <img src="<?php echo substr($data['image_path'],1,strlen($data['image_path']));?>" style="">
                        </div>
                    </div>
                    <div class="col-lg-6 details">
                        <div class="row">
                            <h1 style="text-align: center;font-stretch: extra-expanded">
                                <?php
                                echo strtoupper($data['product_name']);
                                ?>
                            </h1>
                        </div>
                        <div class="row">

                            <strong>
                                ₹
                                <?php
                                echo $data['price'];
                                ?>
                            </strong>
                        </div>
                        <div class="row">
                            <span>Seller:</span>
                            <strong>

                                <?php
                                echo $seller['full name'];
                                ?>
                            </strong>
                        </div>
                        <div class="row">
                            <span>Highlights:</span>
                            <strong>

                                <?php
                                echo $data['product_description'];
                                ?>
                            </strong>
                        </div>
                        <div id="footer" style="position:fixed;width: 100%;height: 100px;bottom: -50px;box-sizing: border-box;margin-left: -50px">
                            <form method="post" action="cart">
                                <input type="hidden" name="_product_id" value="<?php echo $data['id'];?>">
                                <input type="submit" value="Add to cart" class="btn-block btn-primary" style="height: 50px">
                            </form>

                        </div>
                    </div>

                </div>



            </div>

        </div>

        </body>
        </html>

<?php
    }
}
?>
