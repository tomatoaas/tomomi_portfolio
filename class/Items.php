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
    }

?>