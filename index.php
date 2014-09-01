<?php
    require_once('model.php');
    
    $error_msg = "";

    function validate_query($query_array, $templator){
        global $error_msg;
        
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
        
        $templator->setVariable("error_msg", $error_msg);
        $templator->addBlock("error_msg");
        return $error_msg == "";
    }
    
    function populate_dropdown_for_field($field){
        global $query_templator;
        
        $values = get_values_of_field($field);
        for($i = 0; $i < count($values); $i++){
            $query_templator->setVariable($field, $values[$i]);
            $query_templator->addBlock($field);
        }
    }
    
    function display_results($results){
        $results_templator = new MiniTemplator;
        $results_templator->readTemplateFromFile("output_template.html");
        
        if(count($results) == 0){ 
            $results_templator->addBlock("no_results");
        } else{
            for($i = 0; $i < count($results); $i++){
                for($j = 0; $j < count($results[$i]) / 2; $j++){
                    $results_templator->setVariable("value", $results[$i][$j]);
                    $results_templator->addBlock("value");
                }
                $results_templator->addBlock("record");
            }
            $results_templator->addBlock("yes_results");
            $results_templator->generateOutput();
        }
    }
    
    $query_templator = new MiniTemplator;
    $query_templator->readTemplateFromFile("search_template.html");
    
    if(count($_GET) == 11 && validate_query($_GET, $query_templator)){
        $results = get_results($_GET);
        display_results($results);
    } else{
        populate_dropdown_for_field("region");
        populate_dropdown_for_field("grape");
        populate_dropdown_for_field("from_year");
        populate_dropdown_for_field("to_year");
        
        $query_templator->generateOutput();
    }
?>