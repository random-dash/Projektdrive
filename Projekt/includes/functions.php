<?php

function emptyInputRegister($anrede, $vorname, $nachname, $username, $email, $pwd, $confpassword){
    if(empty($anrede) || empty($vorname) || empty($nachame) || empty($username) || empty($email) || empty($pwd) || empty($confpassword)){
        $result = true;
    }else{
        $result = false;
    }

    return $result;
}

function invalidUsername($username){
    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function invalidEmail($email){
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function passwordMatcher($pwd, $confpassword){
    if($pwd !== $confpassword){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}



function emailorusernameExists($connect, $username, $email){
    $sql = "SELECT * FROM user WHERE username = ? OR email = ?;";
    $stmt = mysqli_stmt_init($connect);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=statementfailed");
        exit();
    }


    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($result)){
        return $row;
    }else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($connect, $anrede, $vorname, $nachname, $username, $email, $pwd, $position){
    $sql = "INSERT INTO user (username, pwd, anrede, vorname, nachname, email, position) VALUES (?, ?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($connect);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=statementfailed");
        exit();
    }

    $hashedpwd = password_hash($pwd, PASSWORD_DEFAULT);


    mysqli_stmt_bind_param($stmt, "sssssss", $username, $hashedpwd, $anrede, $vorname, $nachname, $email, $position);
    mysqli_stmt_execute($stmt);
    
    mysqli_stmt_close($stmt);

    header("location: ../news.php?error=none");
    exit();
}

function emptyLogin($log, $logpwd){
    if(empty($log) || empty($logpwd)){
        $result = true;
    }else{
        $result = false;
    }
}

function loginUser($connect, $log, $logpwd){
    $userExists = emailorusernameExists($connect, $log, $log);

    if($userExists === false){
        header("location: ../index.php?error=wronglogin");
        exit();
    }

    $hashedpwd = $userExists["pwd"];


    $checkpwd = password_verify($logpwd, $hashedpwd);

    if($checkpwd === false){
        header("location: ../index.php?error=wrongpasswd");
        exit();
    }else if($checkpwd === true && $userExists["status"] == 'active'){
        session_start();
        $_SESSION["id"] = $userExists["ID"];
        $_SESSION["username"] = $userExists["username"];
        $_SESSION["vorname"] = $userExists["vorname"];
        $_SESSION["nachname"] = $userExists["nachname"];
        $_SESSION["anrede"] = $userExists["anrede"];
        $_SESSION["email"] = $userExists["email"];
        $_SESSION["position"] = $userExists["position"];
        header("location: ../news.php?error=success");
        exit();
    }else{
        header("location: ../index.php?error=incative");
        exit();
    }

}


function pwdChecker($connect, $pwd, $username){
    $sql = "SELECT * FROM user WHERE username = ?;";
    $stmt = mysqli_stmt_init($connect);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../profile.php?error=statementfailedch");
        exit();
    }


    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    $hashedpwd = $row["pwd"];

    $checkpwd = password_verify($pwd, $hashedpwd);
    
    if($checkpwd === false){
        header("location: ../profile.php?error=falsepwd");
        exit();
    }else{
        mysqli_stmt_close($stmt);
    }
}

function updateUser($connect, $anrede, $vorname, $nachname, $username, $email, $newpwd){
    $sql = "UPDATE user SET username = ?, pwd = ?, anrede = ?, vorname = ?, nachname = ?, email = ?  WHERE username = ?;";
    $stmt = mysqli_stmt_init($connect);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../profile.php?error=statementfaileduU");
        exit();
    }

    $hashedpwd = password_hash($newpwd, PASSWORD_DEFAULT);
     
    mysqli_stmt_bind_param($stmt, "sssssss", $username, $hashedpwd, $anrede, $vorname, $nachname, $email, $username);
    mysqli_stmt_execute($stmt);


    
}
function updateUserByAdmin($connect, $anrede, $vorname, $nachname, $username, $email, $newpwd, $position){

    $sql = "UPDATE user SET pwd = ?, anrede = ?, vorname = ?, nachname = ?, email = ?, position = ?  WHERE username = ?;";
    $stmt = mysqli_stmt_init($connect);

    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("location: ../index.php?error=statementfailed");
      exit();
    }
    
    $hashedpwd = password_hash($newpwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssssss", $hashedpwd, $anrede, $vorname, $nachname, $email, $position, $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function getUsername($id){
    include 'includes/dbaccess.php';
    $sql = "SELECT * FROM user  WHERE ID = ?;";
    $stmt = mysqli_stmt_init($connect);

    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("location: ../index.php?error=statementfailed");
      exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($result)){
      return $row["username"];
    }
  }