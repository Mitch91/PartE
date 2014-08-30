<?php
    require_once('controller.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Wine Store Database Query Page</title>
        <style>
            div {margin-top:20px;}
        </style>
    </head>
    <body>
        <form name = "query_form" action = "outputView.php" method = "get">
            <div>
                Wine name:
                <input type = "text" name = "wine_name" />
            </div>
            
            <div>
                Winery name:
                <input type = "text" name = "winery_name" />
            </div>
            
            <div>
                Region:
                <select name = "region">
                    <?php echo_options_for_field('region'); ?>
                </select>
            </div>
            
            <div>
                Grape Variety:
                <select name = "grape">
                    <?php echo_options_for_field('grape') ?>
                </select>
            </div>
            
            <div>
                From:
                <select name = "from_year">
                    <?php echo_options_for_field('year') ?>
                </select>
            </div>
            
            <div>
                To:
                <select name = "to_year">
                    <?php echo_options_for_field('year') ?>
                </select>
            </div>
            
            <div>
                Minimum Stock:
                <input type = "text" name = "min_stock" />
            </div>
            
            <div>
                Minimum Ordered:
                <input type = "text" name = "min_ordered" />
            </div>
            
            <div>
                Minimum Cost:
                <input type = "text" name = "min_cost" />
            </div>
            
            <div>
                Maximum Cost:
                <input type = "text" name = "max_cost" />
            </div>
            
            <div>
                <input type = "submit" value = "Submit" name = "submit"/>
            </div>
            
            <div>
                <?php if(isset($_GET['error_msg'])) echo $_GET['error_msg']; ?>
            </div>
        </form>
    </body>
</html>