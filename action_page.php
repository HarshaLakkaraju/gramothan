<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $uname = $_POST['uname'];
        
        $psw = $_POST['psw'];
        
      
      $servername = "localhost";
      $username = "root";
      $password = "";
      $database = "logindb";

      
      $conn = mysqli_connect($servername, $username, $password, $database);
      
      if (!$conn){
          die("Sorry we failed to connect: ". mysqli_connect_error());
      }
      else{ 
        
        $sql = "INSERT INTO `login` (`username`, `password`) VALUES ('$uname', '$psw')";
        $result = mysqli_query($conn, $sql);
 
        if($result){
        header('Location:home.html'); 
        }
        else{
           
            echo 'Entry is Unsuccessful';
        }

      }

    }

    
?>