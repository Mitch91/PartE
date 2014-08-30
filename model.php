<?php
    require_once('db.php');
    require_once('config.php');
    if(!$dbconn = mysqli_connect(DB_HOST, DB_USER, DB_PW, DB_NAME)){
        echo 'Could not connect to mysql database ' . DB_NAME . ' on ' . DB_HOST . '\n';
        exit;
    }
    
    function get_values_of_field($field){
        $query = "";
        if($field == 'grape'){
            $query = "SELECT variety FROM grape_variety";
        } elseif($field == 'region'){
            $query = "SELECT region_name FROM region";
        } else{
            // $field == 'year'
            $query = "SELECT DISTINCT year FROM wine ORDER BY year DESC";
        }
        
        global $dbconn;
        $i = 0;
        $values = array();
        
        $result = mysqli_query($dbconn, $query);
        while($row = mysqli_fetch_array($result))
                $values[$i++] = $row[0];
                
        return $values;
    }
    
    function get_results($query_array){
        global $dbconn;
    }
?>