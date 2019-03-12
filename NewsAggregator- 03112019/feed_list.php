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
require 'subcategory.php';
//get the category name from the URL
$FeedName = $_GET['name'];
/*    echo '<pre>';
    var_dump($_GET);
    echo '</pre>'; */
echo'<h2>You are viewing the ' . $FeedName . ' RSS Feed</h2>';
;?>
<h3><a href="../">Home</a></h3>
</header>
    
<?php


//grab the categoryID from the URL
$FeedID = (int) $_GET['id'];
$result = getFeedData($FeedID);
    


//check if there are rows 
if(mysqli_num_rows($result) > 0) {
    //fetch each row
    while($row = mysqli_fetch_assoc($result)) 
    {
        //create an array of category objects
        $myFeed[] = new Feed($row['FeedID'], $row['FeedName'], 
        $row['FeedDescription'], $row['FeedURL'], $row['CategoryID']);     
    }
    
    //build the html categories display by looping through the categories array
    foreach($myFeed as $feed) 
    {
        
        echo '
        <div>
                <h2>' . $feed->FeedName . '</h2>
                <a href=' . '../feed.php/?rss=' . $feed->FeedURL . '><img src="' . $feed->FeedImage . '" alt=""></a>
                <p>' . $feed->FeedDescription . '<br>
                <strong><a href=' . '../feed.php/?rss=' . $feed->FeedURL . '>Go to ' . $feed->FeedName . ' news feeds</a></strong></p>
              </div>
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