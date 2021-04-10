<?php
    spl_autoload_register('myAutoloader3');//Run the autoloader function and pass-in the method created below  
    function myAutoloader3($className){//Autoload the flie when class name is called
        $extention = ".class.php";
        $fullPath = $className . $extention;
        include_once $fullPath;
    }
    
    class UsersContr extends Users{

        public function postProfile($fileName){
            // Check if input file is empty or not
            if($fileName != ""){
                //Remove the current profile img
                $profileImage = $this->getProfileImages();//get the image
                $currentProfileImage = $profileImage[0]['profile'];
                if( currentProfileImage != ""){
                    $path_to_remove = "img/profile/".$currentProfileImage;
                    unlink($path_to_remove);
                }
               
                // Generating a new unique name of a file 
                //Get the acctual extention of a file
                $ext = end(explode('.', $fileName));

                //Rename the file with the user first name and some random numbers
                $new_img_name = rand(0000000000, 9999999999).".".$ext;
                // set the file destination into a root folder
                $fileDestination = 'img/profile/'.$new_img_name;
                
                //Upload the file into a file destination    
                $upload = move_uploaded_file($_FILES['profile']['tmp_name'], $fileDestination);
                if($upload==TRUE){
                    if($this->setProfile($new_img_name, $_SESSION['unique_id']));
                    header("Location: index.php");
                }
            }
        }

        public function sendMessage($reciever_id, $sender_id, $message){
            $this->setMessage($reciever_id, $sender_id, $message);
        }

        public function register($firstname, $lastname, $email, $gender, $password1, $password2){
            //Check if all data are not empty
            if(!empty($firstname)&&
            !empty($lastname)&&
            !empty($email)&&
            !empty($gender)&&
            !empty($password1)&&
            !empty($password2)
            ){
                // Check if the password1 and password2 are thesame
                if($password1 == $password2){
                    $result = $this->setUser($firstname, $lastname, $email, $gender, $password1);
                    if($result==TRUE){
                        header("Location: login.php");
                    }
                }else{
                    $_SESSION['create-acc'] = "<div style='color:red'>Password not match *</div>";
                }
            }else{
                return;
            }
           
        }

        public function login($email, $pwd){
            $user_data = $this->getUser($email);
            $unique_id =  $user_data[0]['unique_id'];
            $password = $user_data[0]['password'];

            if($pwd==$password){
                $this->setSession($unique_id);//Run setSESSION function and pass-in the logged in ID
                $this->setActivestatus("active_now",$unique_id);//SET the active status to active 
                header("Location: index.php");
            }else{
                $_SESSION['pass_error'] = "<div style='color:red'>Wrong Password *</div>";

            }
        }

        public function setSession($unique_id){
            $_SESSION['unique_id'] = $unique_id;
        }
        
    }
    if(isset($_POST['reciever_id'])&&isset($_POST['sender_id'])&&isset($_POST['message'])){
        $reciever_id = $_POST['reciever_id'];
        $sender_id = $_POST['sender_id'];
        $message = $_POST['message'];
        if(!empty($message)){
            $user_controller = new UsersContr();
            $user_controller->sendMessage($reciever_id, $sender_id, $message);
        }
    }
    