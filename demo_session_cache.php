<?php
require 'inc_0700/config_inc.php';
startSession();
//session_destroy();
//die();

//This decides what we do specifically.
connectionTest();
if(isset($_SESSION['Timer']) && isset($_SESSION['Feed']) && $_SESSION['Timer'] > time()){
    echo 'Only show';
    showRSS();
}else{
    echo 'Request and show';
    requestRSS();
    showRSS();
}
connectionTest();

//F  U  N  C  T  I  O  N  S
function requestRSS()
{
        
    $request = "https://www.realwire.com/rss/?id=576&row=&view=Synopsis";
    $response = file_get_contents($request);
    $xml = simplexml_load_string($response);
    $_SESSION['Timer'] = time()+60*10;
    
    foreach($xml->channel->item as $story)
    {
        
        $_SESSION['Feed'][] = array(
            'Link' => strval($story->link),
            'Title' => strval($story->title),
            'Description' => strval($story->description),
        );
    }
}

function showRSS()
{
    
    //echo 'Time until cache reset: '.($_SESSION['Timer'] - time());
    //print '<h1>' . $_SESSION['Feed']->channel->Title . '</h1>';
    foreach($_SESSION['Feed'] as $item)
    {
        echo '<a href="' . $item['Link'] . '">' . $item['Title'] . '</a> <br /> <p>' . $item['Description'] . '</p><br /><br />';
    }
}

function connectionTest()
{
    echo'<br>';

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
    echo '<br>';
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
/*
class RSSItem{
    public $Link = '';
    public $Title = '';
    public $Description = '';
    
    public function __construct($Link, $Title, $Description){
        $this->Link = $Link;
        $this->Title = $Title;
        $this->Description = $Description;
    }

    public function toArray(){
        $output['Link'] = $Link;
        $output['Title'] = $Title;
        $output['Description'] = $Description;
        return $output;
    }

    public static function fromArray( $array ) {
        $instance = new self($array->Link, $array->Title, $array->Description);
        return $instance;
    }

    public function displayRSS(){
        return '<a href="' . $Link . '">' . $Title . '</a> <br /> <p>' . $Description . '</p><br /><br />';
    }
}
*/