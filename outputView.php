<?php
    require_once('controller.php');
    if($error_msg != "") header('Location: index.php?error_msg='. $error_msg);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Wine Store Database Results Page</title>
        <style>
            table,th,td{border:1px solid black;}
        </style>
    </head>
    <body>
        <a href = "index.php">Return to Form</a>
        <?php 
            if(count($query_result) != 0){
        ?>
            <table>
                <tr>
                    <td>Wine</td>
                    <td>Variety</td>
                    <td>Year</td>
                    <td>Winery</td>
                    <td>Region</td>
                    <td>Cost</td>
                    <td> Available</td>
                    <td>Stock Sold</td>
                    <td>Sales Revenues</td>
                </tr>
        <?php
                for($i = 0; $i < count($query_result); $i++){
                    echo "<tr>\n";
                    foreach ($query_result[$i] as $field => $value){
                        echo "<td>" . $value . "</td>\n";
                    }
                    echo "</tr>\n";
                }
        ?>
            </table>
        <?php 
            } else{ 
        ?>
            There were no wines that fit your criteria
        <?php 
            } 
        ?>
    </body>
</html>