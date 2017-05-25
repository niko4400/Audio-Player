<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 2017-03-27
 * Time: 13:11
 */

session_name('audioplayer');
session_start();

function session_set($id,$user,$name,$admin) {
    $_SESSION['id']= $id;
    $_SESSION['login']=$user;
    $_SESSION['name'] = $name;
    $_SESSION['admin']=$admin;
}

function session_get_user() {
    return $_SESSION['user'];
}

function session_check() {
    if(isset($_SESSION['login']))
        return true;
    else
        return false;
}