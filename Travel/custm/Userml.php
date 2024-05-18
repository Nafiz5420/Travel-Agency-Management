<?php
class UserModel {
    private $dbConnection;

    public function __construct($dbConnection) {
        $this->dbConnection = $dbConnection;
    }

    public function authenticate($username, $password) {
        $password = md5($password); 
        $sql = "SELECT * FROM users WHERE usname = ? AND password = ?";

        $stmt = mysqli_prepare($this->dbConnection, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_array($result);
    }
}
?>
