<?php

if(isset($_POST["signup_submit"]))
{
    require ("database.php");

    

$username=$_POST["username"];


$useremail=$_POST["usermailid"];
$password=$_POST["userpwd"];
$repeatpassword=$_POST["reptuserpwd"];


if(empty($username) || empty($useremail) || empty($password) || empty($repeatpassword) ){

header("Location: ../contactform/signup.html?error=emptyfield&username=".$username."&usermailid=".$useremail);
exit();
}
elseif(!filter_var($useremail, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/",$username)){

    header("Location: ./signup.html?error=emptyusername&usermailid");
    exit();
}

elseif(!filter_var($useremail, FILTER_VALIDATE_EMAIL)){
    header("Location: ./signup.html?error=emptyusername&usermailid=".$username);
    exit();
}
elseif(!preg_match("/^[a-zA-Z0-9]*$/",$username)){

header("Location: ./signup.html?error=invalidusername&usermailid=".$useremail);
 
exit();

}
elseif($password !==$repeatpassword)
{
    header("Location: ./sigup.php?error=passwordcheck&username=".$username. "&usermailid=".$useremail);
    exit();

}
else{


$sql = "SELECT userMail FROM signup where userMail=?";



$stmt= mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt, $sql))
{

    header("Location: ./signup.html?error=sqlerror");
    exit();
}else{

    mysqli_stmt_bind_param($stmt, 's', $useremail);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $checkresult= mysqli_stmt_num_rows($stmt);

    if($checkresult >0){
        header("Location: ./signup.html?error=usertaken&mail=".$useremail);
        exit();
    }else{

        $sql = "INSERT INTO signup (userId, userMail, userPassword) VALUES(?, ?, ?)";
        $stmt= mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt, $sql))
{

    header("Location: ./signup.html?error=sqlerror");
    exit();

}else{
        $hashpassword = password_hash($password,PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, 'sss', $username, $useremail, $hashpassword);
        mysqli_stmt_execute($stmt);


        
        
        header("Location: ./signin.html?signup=success");
        exit();
    }

}

}


}


mysqli_stmt_close($stmt);
mysqli_close($conn);
}

else{

    header("Location: ./signup.html");
    exit();
}