<?php
    require_once('db.php');
    if(!$dbconn = mysqli_connect(DB_HOST, DB_USER, DB_PW, DB_NAME)){
        echo 'Could not connect to mysql database ' . DB_NAME . ' on ' . DB_HOST . '\n';
        exit;
    }
    
    echo 'Connected to database ' . DB_NAME;
?>