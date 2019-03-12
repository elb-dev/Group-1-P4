<?php
require 'inc_0700/config_inc.php';
startSession();
/**
* News Aggregator - index.php - home
* @package News Aggregator
* @author Group 1 
* @version 1 2.26.18
* @link http://
* 
* 
* @todo Link to database and look through options.
*/


echo  

$sql = '
    SELECT c.CategoryID, f.subject FeedName, c.subject CategoryName, FeedID
    FROM g1p4_feed f
    JOIN g1p4_categories c
    ON f.CategoryID = c.CategoryID
    ORDER BY c.subject';

$db = db_conn();              //Make db connection
$sql = $db->prepare($sql);    //Prepare SQL statement
$sql->execute();              //Execute SQL
$results = $sql->fetchAll();  //Store results
$sql->closeCursor();          //Close the connection - safety procedure

echo '<div class="panels">';

$i = 0;
$panel = 1;
//Loop through all entries
while($panel < count($results)) {
    
    $category = $results[$i]['category_name'];
    echo ' <div class="panel panel' . $panel . '">
        <h2>' . $category . '</h2>
        <ul>
        ';
    
 //Loop for feeds.
 while ($category == $results[$i]['category_name']) {
     
     echo'<li><a href="./view.php?id=' . $results[$i]['feed_id'] . '">' . $result[$i]['feed_name'] . '</a></li>';
     $i++;
 }
    echo '</ul>
        </div>';
    $panel++;
}

echo '</div>';
    
