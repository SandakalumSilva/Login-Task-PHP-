<?php
// check if register inputs are empty 

function inputsEmptyRegister($fname, $lname, $email, $mobile, $password, $re_password)
{
    $value;

    if (empty($fname) || empty($lname) || empty($email) || empty($mobile) || empty($password) || empty($re_password)) {
        $value = true;
    } else {
        $value = false;
    }

    return $value;
}

function nameInvalid($fname, $lname)
{
    $value;
    if (!preg_match("/^[a-zA-Z]+$/", $fname)) {
        $value = true;
    } elseif (!preg_match("/^[a-zA-Z]+$/", $lname)) {
        $value = true;
    } else {
        $value = false;
    }

    return $value;
}


function emailInvalid($email)
{
    $value;
    if (!preg_match("/^[a-zA-Z\d\._-]+@[a-zA-Z\d\._-]+\.[a-zA-Z\d\._-]{2,}$/", $email)) {
        $value = true;
    } else {
        $value = false;
    }
    return $value;
}

function mobileInvalid($mobile)
{
    $value;
    if (!preg_match("/^[0][\d]{9}$/", $mobile)) {
        $value = true;
    } else {
        $value = false;
    }
    return $value;
}

function passwordInvalid($password)
{
    $value;
    if (!preg_match("/^.{5,}$/", $password)) {
        $value = true;
    } else {
        $value = false;
    }
    return $value;
}

function notMatch($password, $re_password)
{
    $value;
    if ($password !== $re_password) {
        $value = true;
    } else {
        $value = false;
    }
    return $value;
}

function emailormobileavailable($conn, $mobile, $email)
{
    $value;

    $sql = "SELECT*FROM users WHERE email = ? OR mobile = ?;";
    $tsmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($tsmt, $sql)) {
        header("location: ../index.php?err=failedstmt");
        exit();
    } else {
        mysqli_stmt_bind_param($tsmt, "si", $email, $mobile);

        mysqli_stmt_execute($tsmt);

        $data = mysqli_stmt_get_result($tsmt);

        if (mysqli_fetch_assoc($data)) {
            $value = false;
        } else {
            $value = true;
        }
    }

    mysqli_stmt_close($tsmt);
    return $value;
}
