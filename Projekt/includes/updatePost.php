<?php 

include 'dbaccess.php';

if(isset($_POST["updatePost"])){
    $sql = "DELETE FROM newsimg WHERE ID = ?;";
    $stmt = mysqli_stmt_init($connect);
    $id   = $_POST["id"];
    
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../news.php?error=statementfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $id);
    unlinker();
    mysqli_stmt_execute($stmt);

    

    header("location: ../news.php?error=none");
    exit();
}

function unlinker(){
    include 'dbaccess.php';
    $sql = "SELECT * FROM newsimg WHERE ID = ?;";
    $stmt = mysqli_stmt_init($connect);
    $id   = $_POST["id"];

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../news.php?error=statementfailedss");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $row = mysqli_fetch_assoc($result);

    unlink("../".$row["filepath"]);
}


