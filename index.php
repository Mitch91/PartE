<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Wine Store Database</title>
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
                    <option value = "default" selected>Select a Region</option>
                </select>
            </div>
            
            <div>
                Grape Variety:
                <select name = "grape">
                    <option value = "default" selected>Select a Grape Variety</option>
                </select>
            </div>
            
            <div>
                From:
                <select name = "from_year">
                    <option value = "default" selected>Select a Year</option>
                </select>
            </div>
            
            <div>
                To:
                <select name = "to_year">
                    <option value = "default" selected>Select a Year</option>
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
                <input type = "submit" value = "Submit" />
            </div>
        </form>
    </body>
</html>