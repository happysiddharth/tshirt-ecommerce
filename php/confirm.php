<?php

  session_start();

  if (isset($_SESSION['login_email'])){
      if (isset($_POST['_buy_address'])&&isset($_POST['payment_option'])){
          if (!empty($_POST['_buy_address'])&&!empty($_POST['payment_option'])){
              require "config.php";
              $con= mysqli_connect($localhost,$un,$pw,$db);
              if (!$con)die("error");
              require "template/get_user_id.php";
              $query = "SELECT * FROM cart WHERE user = '$_user_id'";
              if ($res = mysqli_query($con,$query)){
                  while($data = mysqli_fetch_assoc($res)){
                      $product = $data['product'];
                      date_default_timezone_set('Asia/Kolkata');
                      $date = date('Y/m/d h:i:s a', time());
                      $amount = $_SESSION['total_money_need_to_paid'];
                      $payment_mode = mysqli_real_escape_string($con,htmlspecialchars($_POST['payment_option']));
                      $address = mysqli_real_escape_string($con,htmlspecialchars($_POST['_buy_address']));
                      $query = "INSERT INTO `orders`(`id`, `product`, `user`, `date`, `payment_mode`, `paid_amount`, `address`,`status`) VALUES (NULL,$product,$_user_id,'$date','$payment_mode',$amount,$address,'pending')";
                      if (mysqli_query($con,$query)){
                          $cart_id = $data['id'];
                          $query = "DELETE FROM `cart` WHERE id=$cart_id";
                          if (mysqli_query($con,$query)){
                              echo "order placed";
                          }
                      }
                  }
              }
          }
      }
  }
?>