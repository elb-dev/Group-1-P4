<!doctype html>
<html>
    
<head>
    <meta charset="UTF-8">
    <title>Feeds List</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="../css/style.css" type="text/css" rel="stylesheet">
</head>

<body>
<header>
<h1>News Aggregator</h1>
    
<?php
require 'config/common.php';
require 'Feed.php';
//get the category name from the URL
$catName = $_GET['name'];
echo'<h2>You are viewing the ' . $catName . ' feed</h2>';
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
        $myFeed[] = new Feed($row['FeedID'], $row['FeedName'], 
        $row['FeedDescription'], $row['FeedURL'], $row['CategoryID']);     
    }
    
    //build the html categories display by looping through the categories array
    foreach($myFeed as $Feed) 
    {
        
        echo '<div>
                <h2>' . $Feed->FeedName . '</h2>
                <a href=' . '../cache.php/?URL=' . $Feed->FeedURL . '><img src="' . $Feed->FeedImage . '" alt=""></a>
                <p>' . $Feed->FeedDescription . '<br>
                <strong><a href=' . '../cache.php/?URL=' . $Feed->FeedURL . '>Go to ' . $Feed->FeedName . ' news feeds</a></strong></p>
              </div>';
    }//end of foreach loop

}//end of if block
else
{
    //what should happen if we don't have data in the db?
}
    
        ?>
    
</body>
</html>