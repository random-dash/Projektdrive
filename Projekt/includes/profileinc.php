<?php 


$inputtype = INPUT_POST;

if(isset($_POST["submit"])){
    $anrede         = filter_input(type: $inputtype, var_name: 'anrede', filter: FILTER_SANITIZE_STRING);
    $vorname        = filter_input(type: $inputtype, var_name: 'vorname', filter: FILTER_SANITIZE_STRING);
    $nachname       = filter_input(type: $inputtype, var_name: 'nachname', filter: FILTER_SANITIZE_STRING);
    $username       = filter_input(type: $inputtype, var_name: 'username', filter: FILTER_SANITIZE_STRING);
    $email          = filter_input(type: $inputtype, var_name: 'email', filter: FILTER_SANITIZE_EMAIL);
    $pwd            = filter_input(type: $inputtype, var_name: 'pwd', filter: FILTER_SANITIZE_STRING);
    $newpwd         = filter_input(type: $inputtype, var_name: 'newpassword', filter: FILTER_SANITIZE_STRING);
    $confpassword   = filter_input(type: $inputtype, var_name: 'confpassword', filter: FILTER_SANITIZE_STRING);

    require_once 'dbaccess.php';
    require_once 'functions.php';
    
    pwdChecker($connect, $pwd, $username);
    if(!passwordMatcher($newpwd, $confpassword)){
        updateUser($connect, $anrede, $vorname, $nachname, $username, $email, $newpwd);
        header("location: ../profile.php?error=none");

    }else{
        header("location: ../profile.php?error=passwordsnotmatching");
        exit();
    }
    



}else{
    header("location: ../index.php?error=nosubmit");
    exit();
}
?>