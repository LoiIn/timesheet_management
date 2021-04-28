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