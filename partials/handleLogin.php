    <?php
    $showError = "false";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include('connection.php');
        $login_user = $_POST['username'];
        // $loginEmail = $_POST['loginEmail'];
        $loginPwd = $_POST['loginPassword'];

        $query = "SELECT * FROM users WHERE username = '$login_user'";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) == '1') {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($loginPwd, $row['user_pwd'])) {
                $showError = true;
                session_start();
                $_SESSION['loggedIn'] = true;
                $_SESSION['ID'] = $row['user_id'];
                $_SESSION['loggedUser'] = $row['user_first_name'];
                // $_SESSION['loggedEmail'] = $loginEmail;
                header("Location: /index.php?loginsuccess='.$showError.'");
                exit();
            }else{
                $showError = "Incorrect Password";
            }
            header("Location: /index.php?loginsuccess=false&error=$showError");
        }
    }
    ?>