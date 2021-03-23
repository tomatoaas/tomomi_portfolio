<?php

    require_once "Database.php";

    class Item extends Database{
        public function insertToTable($item_name, $item_price, $item_stocks, $pic){
            $sql = "INSERT INTO items(item_name, item_price, item_stocks, item_picture) VALUES('$item_name', '$item_price', '$item_stocks', '$pic')";

            if($this->conn->query($sql)){
                return true;
            }else{
                return false;
            }
        }

        public function showAllImages(){
            $sql = "SELECT user_picture FROM users";

            $rows = array();

            $result = $this->conn->query($sql);

            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $rows[] = $row;
                }

                return $rows;
            }
        }

        public function showSpecificImage($id){
            $sql = "SELECT user_picture FROM users WHERE user_id = '$id'";

            $result = $this->conn->query($sql);

            return $result->fetch_assoc();

        }

        public function displayRoomItem($room){
            unset($_SESSION['room']);
            $_SESSION['room'] = $room;
            $room_name = "room" . $room;
            $sql = "SELECT * FROM items WHERE item_picture LIKE '%$room_name%'";

            $result = $this->conn->query($sql);

            $row = array();

            if($result->num_rows > 0){
                while($room_items = $result->fetch_assoc()){
                    $row[] = $room_items;
                }

                return $row;
            }else{
                return false;
            }
        }

        public function displayCartItem($username){
            $sql = "SELECT items.item_name, items.item_price, item_picture, buy_quantity FROM items INNER JOIN cart ON items.item_id = cart.item_id INNER JOIN users ON cart.user_id = users.user_id 
            INNER JOIN accounts ON accounts.account_id = users.account_id WHERE accounts.username = '$username'";
            // die($sql);
            $result = $this->conn->query($sql);

            $row = array();

            if($result->num_rows > 0){
                while($cart_items = $result->fetch_assoc()){
                    $row[] = $cart_items;
                }

                return $row;
            }else{
                return false;
            }

        }

        public function addCart($username, $item_id, $buy_quantity){
            $user_sql = "SELECT user_id FROM accounts INNER JOIN users ON accounts.account_id = users.account_id WHERE username = '$username'";
            
            $result = $this->conn->query($user_sql)->fetch_assoc();
            $user_id = $result['user_id'];

            if($user_id){
                if($this->editBuyQuentity($item_id, $buy_quantity)){
                    $sql = "INSERT INTO cart(user_id, item_id, buy_quantity) VALUES('$user_id', '$item_id', '$buy_quantity')";
                
                    $result = $this->conn->query($sql);
    
                    if($result == true){
                        header("Location: ../views/showRoom.php?room=". $_SESSION['room']);
                    }
                }
            }
        }

        public function editBuyQuentity($item_id, $buy_quantity){
            $sql = "UPDATE items SET item_stocks = items.item_stocks - '$buy_quantity' WHERE item_id = '$item_id'";

            if($this->conn->query($sql)){
                return true;
            }else{
                return false;
            }
        }

        public function countCart($username){
            $sql = "SELECT count(cart_id) FROM cart INNER JOIN users ON cart.user_id = users.user_id INNER JOIN accounts ON accounts.account_id = users.account_id WHERE accounts.username = '$username'";
            $result = $this->conn->query($sql)->fetch_assoc();
            $count_cart = $result['count(cart_id)'];
            if($count_cart){
                return $count_cart;
            }else{
                return 0;
            }

        }
    }

?>