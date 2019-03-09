<!doctype html>
<html>
    
<head>
    <meta charset="UTF-8">
    <title>Feeds List</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
     <meta name="robots" content="noindex,nofollow" />
        <meta name="author" content="Elly Boyd" />
        <meta name="description" content="Test page for P4 Styles" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="../css/style.css" type="text/css" rel="stylesheet">
</head>

<body>
<header>
<h1>News Aggregator</h1>
    
<?php
require 'config/common.php';
require 'config/config.php';
require 'subcat.php';
//get the category name from the URL
$catName = $_GET['name'];
    /*echo '<pre>';
    var_dump($_GET);
    echo '</pre>';*/
echo'<h2>You are viewing the ' . $catName . ' RSS Feed</h2>';
;?>
<h3><a href="../">Home</a></h3>
</header>
    
<?php


//grab the categoryID from the URL
$catID = (int) $_GET['id'];
$result = getFeedData($catID);
    


//check if there are rows 
if(mysqli_num_rows($result) > 0) {
    //fetch each row
    while($row = mysqli_fetch_assoc($result)) 
    {
        //create an array of category objects
        $mySubcategories[] = new Subcategory($row['FeedID'], $row['FeedName'], 
        $row['FeedDescription'], $row['FeedURL'], $row['CategoryID']);     
    }
    
    //build the html categories display by looping through the categories array
    foreach($mySubcategories as $subcategory) 
    {
        
        echo '
        <main>
            <section id="mainSection" class="section">
                <article id="article1" class="article">
        <div>
                <h2>' . $subcategory->FeedName . '</h2>
                <a href=' . '../feed.php/?rss=' . $subcategory->FeedURL . '><img src="' . $subcategory->FeedImage . '" alt=""></a>
                <p>' . $subcategory->FeedDescription . '<br>
                <strong><a href=' . '../feed.php/?rss=' . $subcategory->FeedURL . '>Go to ' . $subcategory->FeedName . ' news feeds</a></strong></p>
              </div>
              
              
              </article>
            </section>
        </main>
              
              ';
    }//end of foreach loop

}//end of if block
else
{
    echo 'Sorry, There is no data to work with';

}
    echo ' <footer>
            <p id="footContent" class="footTxt">
                &copy; Group 1. All rights reserved. 2019.
            </p> 
        </footer>';
    
        ?>
    
    
</body>
</html>