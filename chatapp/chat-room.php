<?php 
    include 'includes/autoloader.inc.php';
    include "includes/header.inc.php";

    $users_controller = new UsersContr();
    $users_view = new UsersView();

    $sender_id = $_SESSION['unique_id'];

    if(isset($_GET['receiver_id'])){
        $reciever_id = $_GET['receiver_id'];
    }else{
        header("Location: login.php");
    }
?>
    <div class="chat-room">
        <div class="friends-profile">
            <?php 
                $reciever_info = $users_view->recieverInfo($reciever_id); 
                ?>
                    <img src="img/profile/<?php echo $reciever_info[0]['profile']?>">
                    <p><?php echo $reciever_info[0]['firstname']." ".$reciever_info[0]['lastname'] ?></p>
                <?php
            ?>
        </div>

        <div class="convo" id="convo">
            <!-- The messages goes here -->
            <div id="conversation">
                <?php $users_view ->displayMessages($reciever_id, $sender_id ); ?>
            </div>
        </div>
        
        <div >
            <form class="typing-area">
                <textarea id="text-messages" placeholder="Type message here.."></textarea>
                <button type="button" onclick="sendMessages('<?php echo $reciever_id ?>','<?php echo $sender_id; ?>');"><img src="img/icons/send.png"></button>
            </form>
        </div>
    </div>
</div>
<script src="js/main.js"></script>
<script src="js/jquery-3.5.1.js"></script>

</body>
</html>