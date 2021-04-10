<?php
    include 'includes/autoloader.inc.php';
    $users_controll = new UsersContr();//Instantiate the UserController class 
    $users_view = new UsersView();//Instantiate the UserView class 

    
    // Redirect the User to the login page if not logged in
    if(!isset($_SESSION['unique_id'])){
        header("Location: login.php");
    }else{
        $unique_id = $_SESSION['unique_id'];
    }
    if(isset($_POST['post_profile'])){
        $filename = $_FILES['profile']['name'];
        $users_controll->postProfile($filename);
    }
   
?>
<?php include "includes/header.inc.php";?>
   
        <div class="main">
            <div class="account-section">
                <h3>My account</h3>
                <div>
                    <?php
                        $accountDetails = $users_view->displayAccountDetails($unique_id);
                        ?>
                            <img src="<?php 
                                if(!empty($accountDetails[0]['profile'])){
                                    echo "img/profile/".$accountDetails[0]['profile'];
                                }else{
                                    echo"img/image_placeholder.jpeg";
                                }
                            ?>" id="profile-view" onclick="trigerProfile();">
                        <?php
                    ?>
                    <form action="" method="POST" enctype="multipart/form-data" style="padding:0 1rem; "> 
                        <input type="file" name="profile" id="profile" onchange="displayProfile(this);" style="display:none;">
                        <input class="btn" type="submit" name="post_profile" value="POST">
                    </form> 
                </div>
                <div style="padding:1rem 0; color:black; width:100%;">
                    <?php
                        ?>
                            <p><?php echo $accountDetails[0]['firstname']." ".$accountDetails[0]['lastname'] ; ?></p>
                        <?php
                    ?>
                </div><br>
            </div>

            <div class="acctive-users">
                <div style="display:flex;justify-content:center;align-items:center;">
                    <div class="active-indecator"></div>
                    <h3>Active now</h3>
                </div>
                <table >
                    <?php
                        $display_active = $users_view->displayActiveUsers();//Run displayActiveUsers method and store in a variable
                        for($i=0; $i<count($display_active); $i++){
                            ?>
                                <tr>
    
                                    <td >
                                        <a class="friends-profile" href="chat-room.php?receiver_id=<?php echo $display_active[$i]['unique_id']; ?>">
                                            <img src="<?php 
                                                if(!empty($display_active[$i]['profile'])){
                                                    echo "img/profile/".$display_active[$i]['profile'];
                                                }else{
                                                    echo"img/image_placeholder.jpeg";
                                                }
                                            ?>">
                                            <p><?php echo $display_active[$i]['firstname']." ".$display_active[$i]['lastname'] ; ?></p>

                                        </a>
                                    </td>
                                </tr>
                            <?php
                        }
                    ?>
                </table>
            </div>

            <div class="search-people">
                <div class="search-components">
                    <h3>Search People</h3>
                </div>
            </div>
        </div>
    </div>
</body>
</html>