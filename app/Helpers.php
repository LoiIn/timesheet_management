<?php

function getAvatarUrl($link, $type =''){
    if(empty($link)){
        if(empty($type)) return 'assets/images/man.jpg';
        else{
            $curURI = $_SERVER["REQUEST_URI"];
            $arr = explode("/user-profiles", $curURI);
            return $arr[0].'/assets/images/man.jpg';
        }
    }else{
        return 'uploads/avatar/'.$link;
    }
}

function convertFormatDate($date_str){
    return date('Y-m-d', strtotime($date_str));
}

function convertRolesArrayToString($roles){
    $sortedRoles = sort($roles);
    return implode(", ", $roles);
}