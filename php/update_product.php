<?php
session_start();
if (isset($_SESSION['seller_login_email'])){
    if (isset($_POST['update'])){


        require "config.php";
        $con = mysqli_connect($localhost, $un, $pw, $db);
        if (!$con) die("Something went wrong");

        $email = $_SESSION['seller_login_email'];

        $product_name = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['product_name'])));
        $product_description = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['procduct_description'])));
        $instock = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['procduct_instock'])));
        $_procduct_price = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['procduct_price'])));
        $id = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['id'])));
        $date = date("y-m-d m:s:i");






        if ($_FILES["img_file"]['size']!=0) {
            $img_file = $_FILES["img_file"]["name"];
            $validExt = array("jpg", "png", "jpeg");

            // upload script here
            $folderName = "../images/products/product";



            //getting file extension
            $imageFileType = strtolower(pathinfo($img_file, PATHINFO_EXTENSION));

            // Generate a unique name for the image
            // to prevent overwriting the existing image
            $filePath = $folderName . rand(10000, 990000) . '_' . time() . '.' . "$imageFileType";

            if (move_uploaded_file($_FILES["img_file"]["tmp_name"], $filePath)) {



                $query = "UPDATE `products` SET `image_path`='$filePath',`product_name`='$product_name',`product_description`='$product_description',`instock`='$instock',`added_on`='$date',`price`=$_procduct_price WHERE id =$id";


                if (mysqli_query($con, $query)) {
                    header("location:../sellerdashboard?upload=true");

                } else {
                    die("errorr");
                }

            }
        }
        else{

            $query = "UPDATE `products` SET `product_name`='$product_name',`product_description`='$product_description',`instock`='$instock',`added_on`='$date',`price`=$_procduct_price WHERE id =$id";


            if (mysqli_query($con, $query)) {
                header("location:../sellerdashboard?upload=true");

            } else {
                die("errorr");
            }


        }


    }
}