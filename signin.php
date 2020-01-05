<?php

if(isset($_POST["submit_login"]))
{

require 'database.php';

$loginId = $_POST["loginId"];
$loginPassword = $_POST["password"];



if(empty($loginId) || empty($loginPassword)){

    header("Location: ../signin.php?error=empityfields");
    exit();
}else{

    $sql = "SELECT *FROM signup WHERE userId=? or userMail=?;";
    $stmt = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt,$sql)){

        header("Location: ../signin.php?error=sqlerror");
        exit();
    }else{

        mysqli_stmt_bind_param($stmt, "ss", $loginId, $loginId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if($row=mysqli_fetch_assoc($result)){

            $pwdcheck= password_verify($loginPassword, $row['userPassword']);
            if($pwdcheck == false){

                header("Location: ../signin.php?error=wrongpassword");
                exit();

            }else if($pwdcheck == true){

                session_start();
                $_SESSION['userId']= $row['id'];
                $_SESSION['userUid'] = $row['userId'];
                header("Location: ../signin.php?login=success");
                exit();
            }

            }else{
                header("Location: ../signin.php?error=wrongpassword");
                exit();
            }

                }
    }
}







else{

    header("Location: ../signin.php");
    exit();
}