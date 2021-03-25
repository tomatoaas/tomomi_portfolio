<?php

    require_once "Database.php";

    class User extends Database{

        public function createAccount($username, $password){
            $sql = "INSERT INTO accounts(username, password) VALUES('$username', '$password')";

            $result = $this->conn->query($sql);

            if(!$result){
                die("CANNOT ADD ACCOUNTS: " . $this->conn->error);
            }else{
                return true;
            }
        }

        public function createUser($first_name, $last_name, $address, $email, $item_id){
            $user_account_id = $this->conn->insert_id;
            $sql = "INSERT INTO users(first_name, last_name, address, email, account_id) VALUES('$first_name', '$last_name', '$address', '$email', '$user_account_id')";

            $result = $this->conn->query($sql);

            if($result){
                if($item_id == 0){
                    header("Location: ../views/login.php");
                }else{
                    header("Location: ../views/login.php" . $item_id);
                }
                
            }else{
                die("CANNOT ADD USER: " . $this->conn->error);
            }

        }

        public function login($username, $password, $room){
            
            $sql = "SELECT * FROM accounts INNER JOIN users ON accounts.account_id = users.account_id WHERE username = '$username'";

            $result = $this->conn->query($sql);

            if($result->num_rows == 1){
                $row = $result->fetch_assoc();

                if(password_verify($password, $row['password'])){
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['status'] = $row['status'];
                
                    if($row['status'] == 'A'){
                        header("Location: ../views/addItem.php");
                    }elseif($room != 0){
                        header("Location: ../views/showRoom.php?room=". $room);
                    }else{
                        header("Location: ../views/index.php");
                    }
                    
                }else{
                    echo "Invaid Password";
                }
            }else{
                echo "Invaid Username";
            }

        }

        
    }

?>