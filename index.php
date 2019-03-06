<?php
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
    SELECT c.category_id, f.subject feed_name, c.subject category_name, feed_id
    FROM feed f
    JOIN category c
    ON f.category_id = c.category_id
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
    
