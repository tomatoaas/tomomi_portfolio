<?php

    require_once "../class/Users.php";

    $user = new User();
    session_start();

    if(isset($_POST['registration'])){
        $create_result = $user->createAccount($_POST['username'], password_hash($_POST['password'], PASSWORD_DEFAULT));

        $item_id = 0;
        if(isset($_POST['item_id'])){
            $item_id = $_POST['item_id'];
        }

        if($create_result){
            $user->createUser($_POST['first_name'], $_POST['last_name'], $_POST['address'], $_POST['email'], $item_id);
        }
    }elseif(isset($_POST['login'])){

        $item_id = 0;
        if(isset($_POST['item_id'])){
            $item_id = $_POST['item_id'];
        }

        $user->login($_POST['username'], $_POST['password'], $item_id);
    }

?>