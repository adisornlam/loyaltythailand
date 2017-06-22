<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function auth() {
    session_start();
    return isset($_SESSION['authenticated']) && $_SESSION['user_type'] == 'admin';
}

$fm = new Filemanager();
