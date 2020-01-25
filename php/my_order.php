<?php
session_start();
if (isset($_SESSION['login_email'])){
    ?>


    <!doctype html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Cart</title>
        <link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="css/navigation_bar.css">
        <script type="text/javascript" src="js/jquery/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="js/bootstrap/js/bootstrap.js"></script>
        <style>
            .main {

                transform: scale(1);
                animation-name: zoom;
                opacity: 1;
                animation-duration: 0.3s;
                -webkit-animation-iteration-count: 1;
                -moz-animation-iteration-count: 1;
                -o-animation-iteration-count: 1;
                animation-iteration-count: 1;
                transform: scale(1);
                -webkit-transition: all linear 0.3s;
                -moz-transition: all linear 0.3s;
                -ms-transition: all linear 0.3s;
                -o-transition: all linear 0.3s;
                transition: all linear 0.3s;
            }

            @keyframes zoom {
                from {
                    opacity: 0;
                    -webkit-transform: scale(.5);
                    -moz-transform: scale(.5);
                    -ms-transform: scale(.5);
                    -o-transform: scale(.5);
                    transform: scale(.5);
                }
                to {
                    opacity: 1;
                    transform: scale(1);
                }

            }
        </style>
    </head>
<body>
<?php
include "./template/menu.php";
?>
<div class="container" style="background-color: ;margin-top: 5px">



    <?php
    require "../php/config.php";
    $con = mysqli_connect($localhost,$un,$pw,$db);
    if (!$con)die("error");
    require "../php/template/get_user_id.php";
    $query = "SELECT * FROM orders WHERE user='$_user_id' ORDER BY `date` DESC ";
    if ($res=mysqli_query($con,$query)){
        if (mysqli_num_rows($res)>0){
            while ($data = mysqli_fetch_assoc($res)){
                $p_id=$data['product'];
                $query = "SELECT * FROM PRODUCTS WHERE id='$p_id'";

                if ($res_p = mysqli_fetch_assoc(mysqli_query($con,$query))){
                    $seller_id = $res_p['_sellor_id'];
                    $query_seller = "SELECT * FROM SELLER WHERE id='$seller_id'";
                    if ($res_s = mysqli_fetch_assoc(mysqli_query($con,$query_seller))){
                        ?>

                        <div class="card " style="margin-bottom: 10px">
                            <div class="card-header">
                                <div class="row" >
                                    <div class="order_id col-lg-3"  style="height: 40px;border-radius:5px;;text-align:center;;color: black;background-color: #E0E0E0;">
                                        <?php
                                        echo $data['id'];
                                        ?>
                                    </div>
                                    <div class="col-lg-6">

                                    </div>
                                    <div class="col-lg-3" style="background-color:#E0E0E0;text-align: center;vertical-align: 100%">
                                        <span >
                                            Order status
                                        </span>
                                        <strong>
                                            <?php
                                            echo $data['status']
                                            ?>
                                        </strong>

                                    </div>

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <a href="detail_view?_product_id=<?php echo $res_p['id'];?>">
                                            <img src="<?php echo substr($res_p['image_path'],1,strlen($res_p['image_path']));?> " style="height: 100px;width: 150px;">

                                        </a>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <p style="font-weight: bold">
                                                <?php
                                                echo $res_p['product_name'];
                                                ?>
                                            </p>
                                        </div>
                                        <div class="row">
                                    <span style="color:gray">
                                        Seller:
                                    </span>
                                            <?php
                                            echo " ".$res_s['full name'];
                                            ?>
                                        </div>
                                        <div class="row">
                                    <span style="color:gray">
                                        Description:
                                        <?php
                                        echo " ".$res_p['product_description'];
                                        ?>
                                    </span>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <?php
                                        if (strcasecmp($data['status'],'pending')==0){
                                            ?>
                                            <form>
                                                <input type="hidden" name="order_id" value="<?php echo $data['id'];?>">
                                                <div class="form-group">
                                                    <input type="submit" value="CANCEL"
                                                           class="btn  btn-block btn-danger">
                                                </div>
                                            </form>
                                            <?php
                                        }
                                        ?>
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer text-muted">
                                <div class="row">
                                    <div class="order_id col-lg-3">
                                        <span>Ordered on </span>
                                        <strong><?php
                                            echo $data['date'];
                                            ?></strong>
                                    </div>
                                    <div class="col-lg-6">

                                    </div>
                                    <div class="col-lg-3">
                                <span>
                                    Order Total
                                </span>
                                        <strong>
                                            <?php
                                            echo  $data['paid_amount'];
                                            ?>
                                        </strong>

                                    </div>
                                </div>


                            </div>
                        </div>
                        <?php
                    }

                }



            }

        }else{
?>
    <h3>On orders
    </h3>
    <?php
        }
    }
    ?>
</div>

</body>
    </html>
    <?php

}?>