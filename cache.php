<?php
require 'inc_0700/config_inc.php';
require 'inc_0700/p4_common_inc.php';
get_header();
startSession();



if (!isset($_SESSION['feeds']))
{
    $_SESSION['feeds'] = array();
}

date_default_timezone_set('America/Los_Angeles');

?>

    <header>
    <h3><a href="../">Home</a></h3>

<?php
$request = $_GET['URL'];
$time = date("m/d/y h:i:sa");

if (array_key_exists($request,$_SESSION['feeds']) == FALSE
    || strtotime($time) - strtotime($_SESSION['feeds'][$request][1]) >= 600 ){
    $response = file_get_contents($request);
    $_SESSION['feeds'][$request] = array($response,$time);
}elseif ($_POST) {
    echo "<h4>reloaded after clearing cache</h4>";
}else {
    //grab the response from the session
//    $response = $_SESSION['feeds'][$request];
    echo("<h4>built from session stored data</h4>");
}

$page = simplexml_load_string($_SESSION['feeds'][$request][0]);

echo '<h1>' . $page->channel->title . '</h1></header>';
echo '<h2>Feeds refreshed every 10 minutes. Last refreshed at: ' .  $_SESSION['feeds'][$request][1] . '</h2>';


$ns = $page->getNamespaces(true);
foreach($page->channel->item as $story)
{
    echo '<div><h3><a href="' . $story->link . '">' . $story->title . '</a></h3><br />';
    echo '<p>' . $story->description . '</p><br /></div>';
}
?>
<footer>
    <form action="<?php echo './?URL=' . $request?>" method="post">
        <button  name="clearFeed" value="<?php echo $request?>">Clear feed cache</button>
        <button name="clearAll" value = "All cleared">Clear all cache</button>
    </form>
</footer>

<?php
//check which button was clicked and call the appropriate function
if(isset($_POST['clearFeed'])) {
    ClearFeed($request);
}else if(isset($_POST['clearAll'])) {
    ClearAll();
}

get_footer();
