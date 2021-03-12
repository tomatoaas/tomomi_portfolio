<?php

    require_once "../class/Users.php";

    $user = new User();
    session_start();

    if(isset($_POST['registration'])){
        $create_result = $user->createAccount($_POST['username'], password_hash($_POST['password'], PASSWORD_DEFAULT));

        if($create_result){
            $user->createUser($_POST['first_name'], $_POST['last_name'], $_POST['address'], $_POST['email']);
        }
    }elseif(isset($_POST['login'])){
        $user->login($_POST['username'], $_POST['password']);
    }

?>