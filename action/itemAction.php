<?php

    require_once "../class/Items.php";

    $item = new Item();
    session_start();

    if(isset($_POST['additem'])){
        $pic = $_FILES['picture']['name'];

        $target_dir = "../assets/img/";

        $target_file = $target_dir . basename($_FILES['picture']['name']);

        $result = $item->insertToTable($_POST['item_name'], $_POST['item_price'], $_POST['item_stocks'], $pic);

        if($result){
            //UPLOAD THE FILE
            move_uploaded_file($_FILES['picture']['tmp_name'], $target_file);

            header("Location: ../views/addItem.php");
        }else{
            echo "Error in Uploading the Picture";
        }
    }elseif(isset($_POST['cart'])){
        if(!isset($_SESSION['username'])){
            header("Location: ../views/login.php?room=". $_POST['room']);
        }else{
            $item->addCart($_SESSION['username'], $_POST['item_id'], $_POST['buy_quantity']);
        }
    }elseif(isset($_POST['choose'])){
        if(!isset($_SESSION['username'])){
            header("Location: ../views/login.php?room=". $_POST['room']);
        }else{
            if(isset($_SESSION['totalPrice'])){
                unset($_SESSION['totalPrice']);
                unset($_SESSION['item_id']);
                unset($_SESSION['buy_quantity']);
                unset($_SESSION['cart_id']);
            }
            $_SESSION['item_id'] = $_POST['item_id'];
            $_SESSION['buy_quantity'] = $_POST['buy_quantity'];
            $_SESSION['cart_id'] = $_POST['cart_id'];
            $_SESSION['totalPrice'] = $item->calTotalPrice($_SESSION['item_id'], $_SESSION['buy_quantity']);
            header("Location: ../views/payment.php");
        }
    }elseif(isset($_POST['next'])){
        $_SESSION['payment'] = $_POST['payment'];
        if($_SESSION['payment'] == "cash"){
            $_SESSION['money'] = $_POST['money'];
        }
        header("Location: ../views/buyItem.php");
    }elseif(isset($_POST['buy'])){
        $res = $item->InputOrder($_SESSION['username'], $_POST['item_id'], $_SESSION['buy_quantity']);
        if(!$res){
            echo "error dayo!!";
            return false;
        }
            if($_SESSION['payment'] == "card"){
                $item->InputTransaction($_SESSION['username'],  $_SESSION['totalPrice'], $_SESSION['payment'], 0, 0);
            }else{
                $item->InputTransaction($_SESSION['username'],  $_SESSION['totalPrice'], $_SESSION['payment'], $_SESSION['money'], $_SESSION['changes']);
            }
            $item->DeleteCart($_SESSION['cart_id']);
        header("Location: ../views/showCart.php");

    }
?>