<?php
//Get Config file
require 'inc_0700/config_inc.php'; #provides configuration, pathing, error handling, db credentials

//session_destroy();
startSession();

if(isset($_SESSION['Timer'])){
    echo 'Timer set!';
}else{
    echo 'Timer not set!';
}
echo '<br>';

if(isset($_SESSION['Feed'])){
    echo 'Feed set!';
}else{
    echo 'Feed not set!';
}
echo '<br>';

//This decides what we do specifically.
if(isset($_SESSION['Timer'])/* && $_SESSION['Timer'] > time()*/){
    showRSS();
}else{
    requestRSS();
    showRSS();
}

//F  U  N  C  T  I  O  N  S
function requestRSS()
{
        
    $request = "https://www.realwire.com/rss/?id=576&row=&view=Synopsis'";
    $response = file_get_contents($request);
    $xml = simplexml_load_string($response);
    $_SESSION['Timer'] = time()+60*10;
    foreach($xml->channel->item as $story)
    {
        $_SESSION['Feed'][] = new RSSItem($story->link, $story->title, $story->description);
    }
}

function showRSS()
{
    
    //echo 'Time until cache reset: '.($_SESSION['Timer'] - time());
    //print '<h1>' . $_SESSION['Feed']->channel->title . '</h1>';
    foreach($_SESSION['Feed'] as $story)
    {
        echo '<a href="' . $story->Link . '">' . $story->Title . '</a><br />'; 
        echo '<p>' . $story->Description . '</p><br /><br />';
    }
    
    /*
    echo 'Time until cache reset: '.($_SESSION['Timer'] - time());
    print '<h1>' . $xml->channel->title . '</h1>';
    foreach($xml->channel->item as $story)
    {
        echo '<a href="' . $story->link . '">' . $story->title . '</a><br />'; 
        echo '<p>' . $story->description . '</p><br /><br />';
    }
    */
}

//C  L  A  S  S  E  S
class Duck{
    public $Name = '';
    public $Hobby = '';
    public $Allowance = 0;
    
    public function __construct($Name,$Hobby,$Allowance){
        $this->Name = $Name;
        $this->Hobby = $Hobby;
        $this->Allowance = $Allowance;
    }//end Duck constructor
    
    public function __toString(){
        setlocale(LC_MONETARY,'en_US');
        $Allowance = money_format('%i',$this->Allowance);

        $myReturn = '';
        $myReturn .= 'Name: ' . $this->Name . ' ';
        $myReturn .= 'Hobby: ' . $this->Hobby . ' ';
        $myReturn .= 'Allowance: ' . $Allowance . ' ';

        return $myReturn;
    }
}

class RSSItem{
    public $Link = '';
    public $Title = '';
    public $Description = '';
    
    public function __construct($Link, $Title, $Description){
        $this->Link = $Link;
        $this->Title = $Title;
        $this->Description = $Description;
    }
}