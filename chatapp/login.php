<?php
    include 'includes/autoloader.inc.php';

    $users_control = new UsersContr();

    if(isset($_POST['login'])){
        $email     = $_POST['email'];
        $pwd        = $_POST['password'];

        $users_control->login($email, $pwd);
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
            <h3>Login Account</h3>
            <form action="" method="POST">
                <input type="text" class="input" name="email" placeholder="E-mail *"   required><br>
                <?php
                    if(isset($_SESSION['pass_error'])){
                        echo $_SESSION['pass_error'];
                        unset($_SESSION['pass_error']);
                    }
                ?>
                <input type="password" class="input" name="password" placeholder="Password *" required><br>
                <input type="submit" class="btn" name="login" value="LOGIN">
                <p>Click here to <a href="register.php">create account</a></p>
            </form>
        </div>
    </div>
</body>
</html>

