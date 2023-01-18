<?php
include 'config.php';
if (!empty($_POST['Fullname']) && !empty($_POST['ApiKey'])) {
    $Fullname = $_POST['Fullname'];
    $ApiKey = $_POST['ApiKey'];
    require_once 'config.php';
    if ($con) {
        $sql = "SELECT * FROM lto_userlist WHERE Fullname = '" . $Fullname . "' AND ApiKey = '" . $ApiKey . "'";
        $res = mysqli_query($con, $sql);
        if (mysqli_num_rows($res) != 0) {
            $row = mysqli_fetch_assoc($res);
            $sqlUpdate = "UPDATE lto_userlist SET ApiKey = '' WHERE Fullname = '" . $Fullname . "'";
            if (mysqli_query($con, $sqlUpdate)) {
                echo "success";
            } else echo "Logout Failed";
        } else echo "Unauthorised to access";
    } else echo "Database connection failed";
} else echo "All fields are required";