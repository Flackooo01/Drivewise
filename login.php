<?php
include 'config.php';
if(!empty($_POST['Username']) && ($_POST['Password'])){
    $Username = $_POST['Username'];
    $Password = md5($_POST['Password']);
    $res = array();


    $sql = "SELECT * FROM lto_userlist WHERE Username = '$Username' AND Password = '$Password'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
        if($Username == $row['Username'] && md5($Password, $row['Password'])){
            try{
                $ApiKey = bin2hex(random_bytes(23));
            }catch (Exception $e){
                $ApiKey = bin2hex(uniqid($Username, true));
            }
            $sqlUpdate = "UPDATE lto_userlist SET ApiKey = '" . $ApiKey . "' WHERE Username = '" . $Username . "'";
            $connect = mysqli_query($con, $sqlUpdate);
                if($connect){
                    $res = array(
                        "status" => "success",
                        "message" => "login successful",
                        "Fullname" => $row['Fullname'],
                        "Email" => $row['Email'],
                        "ApiKey" => $ApiKey
                    );
            } else
                $res = array(
                    "status" => "failed",
                    "message" => "Login failed try again"
                );
    } else
        echo "Something Went Wrong";
} else
    echo "All Fields are required";

echo json_encode($res, JSON_PRETTY_PRINT);