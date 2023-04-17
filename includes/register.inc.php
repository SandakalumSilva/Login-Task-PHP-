<?php

require_once "./dbh.inc.php";

// validation file 
require_once "./validation.inc.php";

if (isset($_POST["register-btn"])) {

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    $password = $_POST["password"];
    $re_password = $_POST["re_password"];

    if (inputsEmptyRegister($fname, $lname, $email, $mobile, $password, $re_password)) {
        header("location: ../index.php?err=empty_inputs");
    } elseif (nameInvalid($fname, $lname)) {
        header("location: ../index.php?err=invalid_name");
    } elseif (emailInvalid($email)) {
        header("location: ../index.php?err=invalid_email");
    } elseif (mobileInvalid($mobile)) {
        header("location: ../index.php?err=invalid_mobile");
    } elseif (passwordInvalid($password)) {
        header("location: ../index.php?err=invalid_password");
    } elseif (notMatch($password, $re_password)) {
        header("location: ../index.php?err=different_password");
    } elseif (emailormobileavailable($conn, $mobile, $email)) {
        header("location: ../index.php?err=available_emailormobile");
    } else {
        RegiasaterNewuser($conn, $fname, $lname, $email, $mobile, $password, $re_password);
    }
} else {
    header("location: ../index.php");
    exit();
}
