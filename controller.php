<?php
    require_once('model.php');
    
    $error_msg = "";
    
    function echo_options_for_field($field){
        $values = get_values_of_field($field);
        for($i = 0; $i < count($values); $i++){
            echo "<option value = " . $values[$i] . ">$values[$i]</option>\n";
        }
        
    }
    
    function validate_query($query_array){
        global $error_msg;
        return $error_msg == "";
    }
    
    if(count($_GET) != 0){
        if(validate_query($_GET))
            get_results($_GET);
    }
?>