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
            header("Location: ../views/login.php?item_id=". $_POST['item_id']);
        }else{
            header("Location: ../views/showRoom.php?room=". $_SESSION['room']);
        }
    }
?>