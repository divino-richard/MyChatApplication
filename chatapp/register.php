<?php
    include 'includes/autoloader.inc.php';

    $usersview = new UsersContr();

    if(isset($_POST['create-acc'])){
        $firstname         = $_POST['firstname'];
        $lastname        = $_POST['lastname'];
        $email          = $_POST['email'];
        $gender         = $_POST['gender'];
        $password1      = $_POST['password1'];
        $password2      = $_POST['password2'];

        $usersview->register($firstname, $lastname, $email, $gender, $password1, $password2);
    }
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS styles -->
    <link rel="stylesheet" href="css/style.css">
    <title>Home Page</title>
</head>
<body>
    <div class="form-container">
        <div class="wrapper">
            <h3>Create Account</h3>
            <form action="" method="POST">
                <input type="text" class="input" name="firstname" placeholder="Firstname *"   required><br>
                <input type="text" class="input" name="lastname" placeholder="Lastname *"   required><br>
                <?php
                    if(isset($_SESSION['error_email'])){
                        echo $_SESSION['error_email'];
                        unset($_SESSION['error_email']);
                    }
                ?>
                <input type="email" class="input" name="email" placeholder="Email *" required><br>
                <input type="radio" class="radio" name="gender" value="male"> Male
                <input type="radio" class="radio" name="gender" value="famale"> Famale<br>
                <input type="password" class="input" name="password1" placeholder="Password *"   required><br>
                <?php 
                    if(isset($_SESSION['create-acc'])) 
                    echo $_SESSION['create-acc'];
                    unset($_SESSION['create-acc']);
                ?>
                <input style="" type="password" class="input" name="password2" placeholder="Confirm *" required><br>
                <input type="submit" class="btn" name="create-acc" value="CREATE">
                <p>Click to here <a href="login.php">Login</a></p>
            </form>
        </div>
    </div>
</body>
</html>

