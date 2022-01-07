<?php
    session_start();
    

 if(isset($_POST["submit"])){
    $target_dir = "uploads/news/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    

    include 'includes/dbaccess.php';

    $text = filter_input(type: INPUT_POST, var_name: 'text', filter: FILTER_SANITIZE_STRING);

    function upload($connect, $target_file, $text){
        $sql = "INSERT INTO newsimg (filepath, txt) VALUES (?, ?);";
        $stmt = mysqli_stmt_init($connect);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: index.php?error=statementfailed");
            exit();
        }

        $desti = "uploads/news/".$target_file;

        mysqli_stmt_bind_param($stmt, "ss", $desti , $text);
        mysqli_stmt_execute($stmt);
        
        mysqli_stmt_close($stmt);

        header("location: news.php?error=none");
        exit();
    }
            

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    echo "Sorry, only JPG, JPEG, PNG files are allowed.";
    $uploadOk = 0;
    }
    else {
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        $newimg = imagecreatetruecolor(150, 150);
        $getpath = pathinfo($_FILES["fileToUpload"]["name"]);
        $newfile = time() . ".".$getpath["extension"];
        $target = $_SERVER["DOCUMENT_ROOT"] ."/Projekt/uploads/news/"
        . $newfile;
        if($getpath["extension"] == "png"){
            $img = imagecreatefrompng($target_file);
        }else{
            $img = imagecreatefromjpeg($target_file);
        }
        
        list($oWidth, $oHeight) = getimagesize($target_file);
        imagecopyresized($newimg, $img, 0, 0, 0, 0, 150, 150, $oWidth, $oHeight);
        
        imagejpeg($newimg, $target, 100);
        unlink($target_file);
        upload($connect, $newfile, $text);
        
    }


}else if(isset($_POST["createTicket"])){
    $target_dir = "uploads/tickets/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    include 'includes/dbaccess.php';

    $title = filter_input(type: INPUT_POST, var_name: 'title', filter: FILTER_SANITIZE_STRING);
    $text = filter_input(type: INPUT_POST, var_name: 'text', filter: FILTER_SANITIZE_STRING);

    function uploads($connect, $target_file, $title, $text){
        $sql = "INSERT INTO tickets (pic, title, txt, userID) VALUES (?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($connect);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: tickets.php?error=statementfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ssss", $target_file, $title, $text, $_SESSION["id"]);
        mysqli_stmt_execute($stmt);
        
        mysqli_stmt_close($stmt);

        header("location: tickets.php?error=none");
        exit();
    }


    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
    }
    else {
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        /*$newimg = imagecreatetruecolor(150, 150);
        $getpath = pathinfo($_FILES["fileToUpload"]["name"]);
        $newfile = time() . ".".$getpath["extension"];
        $target = $_SERVER["DOCUMENT_ROOT"] ."/Projekt/uploads/tickets/"
        . $newfile;
        if($getpath["extension"] == "png"){
            $img = imagecreatefrompng($target_file);
        }else{
            $img = imagecreatefromjpeg($target_file);
        }
        
        list($oWidth, $oHeight) = getimagesize($target_file);
        imagecopyresized($newimg, $img, 0, 0, 0, 0, 150, 150, $oWidth, $oHeight);
        
        imagejpeg($newimg, $target, 100);
        unlink($target_file);*/
        uploads($connect, $target_file, $title, $text);
    }
}