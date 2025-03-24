<?php
    $showError = "false";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include('connection.php');
        $user_first_name = $_POST['firstName'];
        $user_last_name = $_POST['lastName'];
        $user_name = $_POST['username'];
        $user_email = $_POST['signupEmail'];
        $pwd = $_POST['password'];
        $cpwd = $_POST['cnfPassword'];

        $existingQuery = "SELECT * FROM `users` WHERE user_email = '$user_email'";
        $result = mysqli_query($connection, $existingQuery);
        $numRows = mysqli_num_rows($result);
        // echo $numRows;
        if ($numRows > 0) {
            echo "Email already exists!";
        }
        else{
            if ($pwd == $cpwd) {
                $hash = password_hash($pwd, PASSWORD_DEFAULT);
                $query = "INSERT INTO `users` (`user_first_name`, `user_last_name`, `username`, `user_email`, `user_pwd`, `timestamp`) VALUES ('$user_first_name' ,'$user_last_name', '$user_name','$user_email', '$hash', CURRENT_TIMESTAMP)";
                $result = mysqli_query($connection, $query);
                if ($result) {
                    $showAlert = true;
                    header("Location: /../index.php?signupsuccess=true");
                    exit();
                }
            }else{
                $showError = "Passwords do not match";
            }
            header("Location: /index.php?signupsuccess=false&error=$showError");
        }
    }
?>