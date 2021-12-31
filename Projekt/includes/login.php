<?php 

$inputtype = INPUT_POST;

if(isset($_POST["submit"])){
    $log = filter_input(type: $inputtype, var_name: 'log', filter: FILTER_SANITIZE_STRING);
    $logpwd = filter_input(type: $inputtype, var_name: 'logpwd', filter: FILTER_SANITIZE_STRING);

    require_once 'dbaccess.php';
    require_once 'functions.php';

    if(emptyLogin($log, $logpwd)){
        header("location: ../index.php?error=emptyInput");
        exit();
    }
    
    
    loginUser($connect, $log, $logpwd);


}else{
    header("location: ../index.php?error=nosubmit");
    exit();
}
?>