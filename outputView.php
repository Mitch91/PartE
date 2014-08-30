<?php
    require_once('controller.php');
    if($error_msg != "") header('Location: index.php?error_msg='. $error_msg);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Wine Store Database Results Page</title>
    </head>
    <body>
        <a href = "index.php">Return to Form</a>
        <?php if(count($query_result) != 0){ ?>
        
        <?php } else { ?>
            There were no wines that fit your criteria
        <?php } ?>
    </body>
</html>