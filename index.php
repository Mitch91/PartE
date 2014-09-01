<?php
    require_once('model.php');
    
    $error_msg = "";

    function validate_query($query_array){
        global $error_msg;
        global $query_templator;
        
        if(intval($query_array['from_year']) > intval($query_array['to_year'])
            && $query_array['from_year'] != "default" 
            && $query_array['to_year'] != "default"){
            $error_msg = "The from year must be less than or equal to the to year.";
        } elseif(intval($query_array['min_stock']) <= 0 && $query_array['min_stock'] != ""){
            $error_msg = "Minimum stock must be a positive integer.";
        } elseif(intval($query_array['min_ordered']) <= 0 && $query_array['min_ordered'] != ""){
            $error_msg = "Minimum ordered must be a positive integer.";
        } elseif(intval($query_array['min_cost']) <= 0 && $query_array['min_cost'] != ""){
            $error_msg = "Minimum cost must be a positive integer.";
        } elseif((intval($query_array['min_cost']) > intval($query_array['max_cost'])
                 || intval($query_array['max_cost']) <= 0)
                 && $query_array['max_cost'] != ""){
            $error_msg = "Maximum cost must be an integer greater " .
                          "than or equal to minimum cost. If minimum cost" .
                          " isn't specified, maximum cost must be greater than zero.";
        }
        
        $query_templator->setVariable("error_msg", $error_msg);
        $query_templator->addBlock("error_msg");
        return $error_msg == "";
    }
    
    if(count($_GET) == 11){
        if(validate_query($_GET))
            get_results($_GET);
    }
    
    $query_templator = new MiniTemplator;
    $query_templator->readTemplateFromFile("search_template.html");
    
    populate_dropdown_for_field("region");
    populate_dropdown_for_field("grape");
    populate_dropdown_for_field("from_year");
    populate_dropdown_for_field("to_year");
    
    $query_templator->generateOutput();
    function populate_dropdown_for_field($field){
        global $query_templator;
        
        $values = get_values_of_field($field);
        for($i = 0; $i < count($values); $i++){
            $query_templator->setVariable($field, $values[$i]);
            $query_templator->addBlock($field);
        }
    }
?>