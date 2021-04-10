<?php
    spl_autoload_register('myAutoloader2');//Run the autoloader function and pass-in the method created below  
    function myAutoloader2($className){//Autoload the flie when class name is called
        $extention = ".class.php";
        $fullPath = $className . $extention;
        include_once $fullPath;
    }
    
    class UsersView extends Users{

        public function displayActiveUsers(){
            $active_users = $this->getActiveUsers();
            return $active_users;
        }
        public function displayAccountDetails($unique_id){
            $accountDetails = $this->getAccountDetails($unique_id);
            return $accountDetails;
        }

        public function displayMessages($reciever_id, $sender_id){
            $reciever_account = $this->getAccountDetails($reciever_id);
            $sender_account = $this->getAccountDetails($sender_id);

            $message_info = $this->getMessage($reciever_id, $sender_id);
            if(!empty($message_info)){
                $output = "";
                for($i=count($message_info)-1; $i>=0; $i--){
                    if($message_info[$i]['sender_id'] == $sender_id){
                        $output .= '
                            <div class="coming-out" >
                                
                                <p>
                                '.$message_info[$i]['msg'].'
                                <br><span style="font-size: 12px; color: grey;">'.$message_info[$i]['date'].'</span>
                                </p>
                                <div class="msg-profile">
                                    <img src="img/profile/'.$sender_account[0]['profile'].'?>">
                                </div>
                            </div>
                        ';
                    }else{
                        $output .= '
                            <div class="coming-in">
                              
                                <div class="msg-profile">
                                    <img src="img/profile/'.$reciever_account[0]['profile'].'?>">
                                </div>
                                <p>
                                '.$message_info[$i]['msg'].'
                                <br><span style="font-size: 12px; color: grey;">'.$message_info[$i]['date'].'</span>
                                </p>
                            </div>
                        ';
                    }
                    
                }
                echo $output;
            }else{
                echo "<div style='text-align: center;'>No conversation yet!</div>";
            };
        }

        public function recieverInfo($reciever_id){
            return $this->getAccountDetails($reciever_id);
        }
    }

    
    

