<?php

function request($uri, $method, $formData = null) {
    $url    = getenv('API_URL') . $uri;
    $token  = getenv('API_KEY');
    $ch     = curl_init();
    $authorization = "Authorization: Bearer " . $token;
    curl_setopt($ch, CURLOPT_URL, $url);
    // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data' , $authorization ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $formData);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);
    return json_decode($result);
}

function importancies($key = null) {
    $level = [
        3 => 'Minor',
        2 => 'Major',
        1 => 'Critical'
    ];

    if ( $key ) {
        return $level[$key];
    }
    
    return $level;
}

function statuses($key = null) {
    $status = [
        'todo' => 'Todo',
        'inprogress' => 'In Progress',
        'done' => 'Done'
    ];

    if ( $key ) {
        return $status[$key];
    }

    return $status;
}