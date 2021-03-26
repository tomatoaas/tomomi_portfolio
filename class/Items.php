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
            $sql = "SELECT items.item_id, items.item_name, items.item_price, item_picture, buy_quantity, cart.cart_id FROM items INNER JOIN cart ON items.item_id = cart.item_id INNER JOIN users ON cart.user_id = users.user_id 
            INNER JOIN accounts ON accounts.account_id = users.account_id WHERE accounts.username = '$username'";
            
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

        public function displayBuyItem($item_id){
            $sql = "SELECT item_id, item_picture, item_name, item_price FROM items WHERE items.item_id = '$item_id'";
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

        //cartに入っている商品の数
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

        //totalPriceを計算
        public function calTotalPrice($item_id, $buy_quantity){
            $sql = "SELECT item_price FROM items WHERE item_id = '$item_id'";
            $result = $this->conn->query($sql)->fetch_assoc();
            $totalPrice = ($result['item_price'] * $buy_quantity);
            if($totalPrice){
                return $totalPrice;
            }else{
                echo "Not Price";
            }
        }

        //Orderに代入する処理
        public function InputOrder($username, $item_id, $buy_quantity){
            $user_sql = "SELECT user_id FROM accounts INNER JOIN users ON accounts.account_id = users.account_id WHERE username = '$username'";
            
            $result = $this->conn->query($user_sql)->fetch_assoc();
            $user_id = $result['user_id'];

            $sql = "INSERT INTO orders(user_id, item_id, buy_quantity, date_orderd) VALUES($user_id, $item_id, $buy_quantity, now())";
            if($this->conn->query($sql)){
                return true;
            }else{
                return false;
            }
        }

        //transactionにINSERTする
        public function InputTransaction($username, $totalPrice, $payment_method, $payment, $change){
            $user_sql = "SELECT user_id FROM accounts INNER JOIN users ON accounts.account_id = users.account_id WHERE username = '$username'";
            
            $result = $this->conn->query($user_sql)->fetch_assoc();
            $user_id = $result['user_id'];

            $order_sql = "SELECT max(order_id) AS order_id FROM orders";
            $result = $this->conn->query($order_sql)->fetch_assoc();
            $order_id = $result['order_id'];

            if($payment_method == "card"){
                $sql = "INSERT INTO transaction(user_id, order_id, total_price, payment_method) VALUES($user_id, $order_id, $totalPrice, '$payment_method')";
            }else{
                $sql = "INSERT INTO transaction(user_id, order_id, total_price, payment_method, payment, `changes`) VALUES($user_id, $order_id, $totalPrice, '$payment_method', $payment, $change)";
            }
            if($this->conn->query($sql)){
                return true;
            }else{
                return false;
            }
        }

        public function DeleteCart($cart_id){
            $sql = "DELETE FROM cart WHERE cart_id = '$cart_id'";
            if($this->conn->query($sql)){
                return true;
            }else{
                return false;
            }
        }
    }

?>