<?php

function getAvatarUrl($link){
    if(empty($link)){
        return 'assets/images/avatar.man.jpg';
    }else{
        return 'uploads/avatar/'.$link;
    }
}

function convertFormatDate($date_str){
    return date('Y-m-d', strtotime($date_str));
}

function convertRolesArrayToString($roles){
    $roles_arr = [];
    foreach($roles as $role){
        $roles_arr[] = $role->name;
    }
    return implode(", ", $roles_arr);
}