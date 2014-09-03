<?php
    require_once('model.php');
    session_start();
    
    if(isset($_GET['end']) && isset($_SESSION['started'])){
        session_destroy();
        header('Location: index.php');
    }
    
    $results_templator = new MiniTemplator;
    $results_templator->readTemplateFromFile("output_template.html");

    // has session
    if(isset($_SESSION['started'])){
        $results_templator->setVariable("href", "?end");
        $results_templator->setVariable("text", "End Session");
        $results_templator->addBlock("link");
        
        $results_templator->setVariable("href", "?other");
        if($_SESSION['last_page'] == "results"){
            $results_templator->setVariable("text", "Last Query");
            $_SESSION['last_page'] = "session";
            
            if($_SESSION['new_query']){
                foreach($_SESSION['last_query'] as $row){
                    array_push($_SESSION['wine_list'], $row); 
                }
                $_SESSION['new_query'] = false;
            }
            
            $results = $_SESSION['wine_list'];
        }else{
            // == "session" || "search"
            $results_templator->setVariable("text", 
                "Wines viewed this session");
            
            
            if($_SESSION['last_page'] == "search"){
                if(!validate_query($_GET))
                    header('Location: index.php?error_msg='. $error_msg);
            
                $results = get_results($_GET);
                $_SESSION['last_query'] = $results;
                
            } else{
                $results = $_SESSION['last_query'];
            }
            
            $results_templator->setVariable("wine_list", get_wine_names($results));
            $results_templator->addBlock("twitter");
            
            $_SESSION['last_page'] = "results";
        }
        $results_templator->addBlock("link");
        display_results($results); 
    } else{
        // no session
        if(!validate_query($_GET))
            header('Location: index.php?error_msg='. $error_msg);
            
        $results = get_results($_GET);
        display_results($results);
    }
    
    function get_wine_names($results){
        $wine_list = "";
        $char_count = 0;
        foreach($results as $wine){
            if(($char_count += strlen($wine[0]) + 2) > 140) break;
            $wine_list .= $wine[0] . ", ";
        }
        return $wine_list;
    }
    
    $error_msg = "";

    function validate_query($query_array){
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
        return $error_msg == "";
    }
    
    function display_results($results){
        global $results_templator;
        
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
    
?>
