<?php

if(isset($_POST["submit"]))
{

    $name = $_POST["name"];
    $email = $_POST["email"];
    $message =$_POST["message"];

include "newform.html";
   

     if(empty($name) || empty($email) || empty($message))
     {
        echo "All feild are required";
       
     }

     else{

        $host= "localhost";
        $dbusername="root";
        $password="";
        $dbname="contact_form";
    
        $conn =new mysqli($host, $dbusername, $password, $dbname);
    
        $sql= "INSERT INTO form_info  (name,email,message) VALUES ('$name', '$email', '$message')";
    
        mysqli_query($conn, $sql);

        echo "your data is save";
     }
        

}
