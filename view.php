<?php

if(!isset($_SESSION)){  //Start Session if it hasn't already
    session_start();
}
$path = 'cache.php';
echo "Path : $path";

include $path; 


$now = time();//current time
$id = $_GET['id'];

if(!isset($_SESSION['news'][$id]) || $now > $_SESSION['news'][$id]->Expire){
    
    $sql = "
      SELECT feed_id, subject, feed_description
      FROM feed
      WHERE feed_id = ".$id.";
    ";//CLose sql query
    $db = db_conn();              //Make db connection
    $sql = $db->prepare($sql);    //Prepare SQL statement
    $sql->execute();              //Execute SQL
    $results = $sql->fetchAll();  //Store results
    $sql->closeCursor();          //Close the connection for safety
    $subject = $results[0][1];
    $subject = strtolower($subject);
    $subject = str_replace(' ', '+', $subject);
    
	//go to url
	$request = 'https://www.realwire.com/rss/feeds.asp'.$subject. '&output=rss';
	//get info from url and store
	$response = file_get_contents($request);
	//create object and store in Session array with same id as feed id
	$_SESSION['news'][$id] = new RssNews($id,$response,$now,$expire);
}

    echo 
      <div class="view">;
    echo "<h2>" . $results[0]['Subject'] . "</h2>";
	//This is either the persisting news var or newly created one.
	$news = $_SESSION['news'][$id];
	 

//Echo the time that this feed was cashed at
echo '<p class="right">News Cached at:'.date('h:i:s Y-m-d',$news->TimeCreated).'</p>';
//Take the $news->FeedXML and make it a xml string to parse
$xml = simplexml_load_string($news->FeedXML);
print '<h3>' . $xml->channel->title . '</h3>';
//Loop through each article and render it's data.
foreach($xml->channel->item as $story)
{
  echo '<a class="source" href="' . $story->link . '">' . $story->title . '</a><br />';
  echo '<p>' . $story->description . '</p><br /><br />';
}
echo '</div>';
