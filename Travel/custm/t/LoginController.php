<?php
session_start();
include("UserModel.php");

class LoginController {
    private $userModel;

    public function __construct($userModel) {
        $this->userModel = $userModel;
    }

    public function handleLoginRequest() {
        $error = '';
        $username = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['uname'] ?? '');
            $password = trim($_POST['pass'] ?? '');

            if (empty($username) || empty($password)) {
                $error = "Please complete all the fields.";
            } else {
                if ($this->userModel->authenticate($username, $password)) {
                    $_SESSION['username'] = $username;
                    if (isset($_POST['remember']) && $_POST['remember'] === 'on') {
                        setcookie('remember_username', $username, time() + 3600 * 24 * 30, '/');
                    }
                    header("location: index.php");
                    exit();
                } else {
                    $error = "Your Login Name or Password is invalid.";
                }
            }
        }

        include("loginView.php");
    }
}
?>
