<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 2017-03-27
 * Time: 13:28
 */
session_unset();
session_destroy();
header('Location:?p=main');