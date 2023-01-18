<?php
include 'config.php';
if(!empty($_POST['Fullname']) && ($_POST['Email']) && ($_POST['Username']) && ($_POST['Password']) && ($_POST['Fullname']) && ($_POST['Confirm_Password'])){
    $Fullname = $_POST['Fullname'];
    $Email = $_POST['Email'];
    $Username = $_POST['Username'];
    $Password = md5($_POST['Password']);
    $Confirm_Password = md5($_POST['Confirm_Password']);

    if($Password == $Confirm_Password){
        $sql = "SELECT * FROM lto_userlist WHERE Username = '$Username'";
        $result = mysqli_query($con, $sql);
        if(!$result->num_rows > 0){
            $sql = "INSERT INTO lto_userlist (Fullname,Email,Username,Password,Confirm_Password) 
            VALUES('" . $Fullname . "','" . $Email . "','" . $Username . "','" . $Password . "','" . $Confirm_Password . "')";
            $result = mysqli_query($con, $sql);
            if($result){
                echo "Success";
                $Fullname = "";
                $Email = "";
                $Username = "";
                $Password = "";
                md5($_POST['Password']);
                md5($_POST['Confirm_Password']);
            } else {
                echo "Something went wrong";
            }
        } else {
            echo "Username and Email is Already Exist";
        }
    }else{
        echo "Password not Matched";    
    }
}else {
echo "All Fields are required";
}
