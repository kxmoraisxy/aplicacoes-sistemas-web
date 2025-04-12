<?php
    function emptyInputSignup($name, $phone, $email, $username, $pwd) {
        $result = null;
        if (empty($name) || empty($email) || empty($username) || empty($pwd) ||  empty($phone)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function emailExists($conn, $email) {

        $sql = "SELECT * FROM user WHERE email = ?;";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../register.html?error=stmtfailed");
            exit();
        }
        
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        
        $resultData = mysqli_stmt_get_result($stmt);
        
        if ($row = mysqli_fetch_assoc($resultData)) {
            return $row;
        } else {
            $result = false;
            return $result;
        }
        
        mysqli_stmt_close($stmt);
    }

    function phoneExists($conn, $phone) {

        $sql = "SELECT * FROM user WHERE phone = ?;";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../register.html?error=stmtfailed");
            exit();
        }
        
        mysqli_stmt_bind_param($stmt, "s", $phone);
        mysqli_stmt_execute($stmt);
        
        $resultData = mysqli_stmt_get_result($stmt);
        
        if ($row = mysqli_fetch_assoc($resultData)) {
            return $row;
        } else {
            $result = false;
            return $result;
        }
        
        mysqli_stmt_close($stmt);
    }

    function nifExists($conn, $nif) {

        $sql = "SELECT * FROM user WHERE nif = ?;";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../register.html?error=stmtfailed");
            exit();
        }
        
        mysqli_stmt_bind_param($stmt, "s", $nif);
        mysqli_stmt_execute($stmt);
        
        $resultData = mysqli_stmt_get_result($stmt);
        
        if ($row = mysqli_fetch_assoc($resultData)) {
            return $row;
        } else {
            $result = false;
            return $result;
        }
        
        mysqli_stmt_close($stmt);
    }

    function createUser($conn, $name, $phone, $nif, $email, $password) {
        $sql = "INSERT INTO user (name, phone, nif, email, password) VALUES (?, ?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../register.html?error=stmtfailed");
            exit();
        }

        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "sssss", $name, $phone, $nif, $email, $hashedPwd);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: ../projeto.php?error=none");
        exit();
    }

    function emptyInputLogin($email, $password) {
        $result = null;
        if (empty($email) || empty($password)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function loginUser($conn, $email, $password) {
        $emailExists = emailExists($conn, $email);

        if ($emailExists === false) {
            header("location: ../login.html?error=wronglogin");
            exit();
        }

        $pwdHashed = $emailExists["password"];
        $checkPwd = password_verify($password, $pwdHashed);

        if ($checkPwd === false) {
            header("location: ../login.html?error=wronglogin");
            exit();
        } else if ($checkPwd === true) {
            session_start();
            $_SESSION["useremail"] = $emailExists["email"];
            header("location: ../projeto.php");
            exit();
        }
    }