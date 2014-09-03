<?php 
    require_once('model.php');
    session_start();
    
    $results_templator = new MiniTemplator;
    $results_templator->readTemplateFromFile("output_template.html");
    
    if(isset($_SESSION['started'])){
        $results_templator->setVariable("href", "results.php");
        $results_templator->setVariable("text", "Wines viewed this session");
        $results_templator->addBlock("link");
    }
    
    if(isset($_GET['end']) && isset($_SESSION['started'])){
        session_destory();
    }
?>