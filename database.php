<?php


        $host= "localhost";
        $dbusername="root";
        $password="";
        $dbname="contact_form";
    
        $conn = mysqli_connect($host, $dbusername, $password, $dbname);

        if(!$conn){

            die("Connection is failed: ".mysqli_connect_error());   
             

        }