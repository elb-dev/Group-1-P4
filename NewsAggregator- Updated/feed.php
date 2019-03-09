<?php
session_start();

if (!isset($_SESSION['feeds']))
{
    $_SESSION['feeds'] = array();
}
date_default_timezone_set('America/Los_Angeles');
?>

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
    <h3><a href="../">Home</a></h3>
<?php

$request = $_GET['rss'];
$time = date("m/d/y h:i:sa");

if (array_key_exists($request,$_SESSION['feeds']) == FALSE
    || strtotime($time) - strtotime($_SESSION['feeds'][$request][1]) >= 600 )
{
    $response = file_get_contents($request);
    $_SESSION['feeds'][$request] = array($response,$time);

}

elseif ($_POST) {
    echo "<h4>reloaded after clearing cache</h4>";
}
//without the else statement, the stored data never gets pulled from the session
else {
    //grab the response from the session
//    $response = $_SESSION['feeds'][$request];
    echo("<h4>built from session stored data</h4>");
}
$page = simplexml_load_string($_SESSION['feeds'][$request][0]);

echo '<h1>' . $page->channel->title . '</h1></header>';
echo '<h2>Feeds refreshed every 10 minutes. Last refreshed at: ' .  $_SESSION['feeds'][$request][1] . '</h2>';


//the images are not showing because they are under a namespace "media".
//get an array of namespace prefixes with their associated URIs.
//read more@: https://www.sitepoint.com/parsing-xml-with-simplexml/
$ns = $page->getNamespaces(true);
foreach($page->channel->item as $story)
{
    $thumbnail = $story->children($ns['media']);
    //display only stories that have thumbnail images
    if($thumbnail) {
        echo '<div><h3><a href="' . $story->link . '">' . $story->title . '</a></h3><br />';
        echo '<img src=' .$thumbnail->thumbnail->attributes()->url . '></img>';
        echo '<p>' . $story->description . '</p><br /></div>';
    }
}
?>
<footer>
    <form action="<?php echo './?rss=' . $request?>" method="post">
        <button  name="clearFeed" value="<?php echo $request?>">Clear feed cache</button>
        <button name="clearAll" value = "All cleared">Clear all cache</button>
    </form>
</footer>

<?php
/********Clear cache functions************/


function ClearFeed($request) {
    unset($_SESSION['feeds'][$request]);

}

function ClearAll() {
    unset($_SESSION['feeds']);
}

//check which button was clicked and call the appropriate function
if(isset($_POST['clearFeed'])) {
    ClearFeed($request);
}else if(isset($_POST['clearAll'])) {
    ClearAll();
}

if(isset($_SESSION['feeds'])){
    echo '<pre>';
    print_r(array_keys($_SESSION['feeds']));
    echo '</pre>';
}
else {
    echo "Session is empty";
}


/*********End of clear cache functions****/



