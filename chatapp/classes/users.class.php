<?php

class Users extends Dbh{

    protected function getUser($email){
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email]);
        $results = $stmt->fetchAll();//Fetching all the data that was taken
        return $results;
    }

    protected function setUser($firstname, $lastname, $email, $gender, $password1){
        //Find existing email
        $find_email_query = "SELECT * FROM users WHERE email = ?";
        $email_stmt = $this->connect()->prepare($find_email_query);
        $email_stmt->execute([$email]);
        $results = $email_stmt->fetchAll();//Fetching all the data that was taken
        $existed_email = $results[0]['email'];
        //check if email are exist
        if($email != $existed_email){
            $users_unique_id = uniqid($firstname, true);
            $sql = "INSERT INTO users(unique_id, firstname, lastname, email, gender, password) VALUES(?, ?, ?, ?, ?, ?)";
            $stmt = $this->connect()->prepare($sql);
            $results = $stmt->execute([$users_unique_id, $firstname, $lastname, $email, $gender, $password1]);
            return $results;
        }else{
            $_SESSION['error_email'] = "<div style='color:red;'>Email was in used *</div> ";
        }
    }

    public function setActivestatus($active, $unique_id){
        $sql = "UPDATE users SET active_status = ? WHERE unique_id = '$unique_id' ";
        $stmt = $this->connect()->prepare($sql);
        $results = $stmt->execute([$active]);
    }

    protected function getActiveUsers(){
        $sql = "SELECT * FROM users WHERE active_status = ? && unique_id!=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(["active_now",$_SESSION['unique_id']]);
        $results = $stmt->fetchAll();//Fetching all the data that was taken
        return $results;
    }

    protected function getAccountDetails($unique_id){
        $sql = "SELECT * FROM users WHERE unique_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$unique_id]);
        $results = $stmt->fetchAll();//Fetching all the data that was taken
        return $results;
    }
    protected function getProfileImages(){
        $sql = "SELECT profile FROM users WHERE unique_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$_SESSION['unique_id']]);
        $results = $stmt->fetchAll();//Fetching all the data that was taken
        return $results;
    }
    protected function setProfile($new_img_name, $unique_id){
        $sql = "UPDATE users SET profile = ? WHERE unique_id = '$unique_id' ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$new_img_name]);
    }

    protected function setMessage($reciever_id, $sender_id, $message){
        $sql = "INSERT INTO chats(reciever_id, sender_id, msg) VALUES(?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $results = $stmt->execute([$reciever_id, $sender_id, $message]);
    }

    protected function getMessage($reciever_id, $sender_id){
        $sql = "SELECT * FROM chats WHERE reciever_id= ? && sender_id= ? OR reciever_id= ? && sender_id= ? ORDER BY id DESC LIMIT 50 ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$reciever_id, $sender_id, $sender_id, $reciever_id]);
        $results = $stmt->fetchAll();//Fetching all the data that was taken
        return $results;
    }
}