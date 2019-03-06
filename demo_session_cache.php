<?php
//Get Config file
require 'inc_0700/config_inc.php'; #provides configuration, pathing, error handling, db credentials

//This decides what we do specifically.
if(isset($_SESSION['timer']) and $_SESSION['timer'] > time()){
    showRSS();
}else{
    requestRSS();
    showRSS();
}

//F  U  N  C  T  I  O  N  S
function requestRSS()
{
    startSession();
    $request = "https://www.realwire.com/rss/?id=576&row=&view=Synopsis'";
    $response = file_get_contents($request);
    $xml = simplexml_load_string($response);
    $_SESSION['feed'] = $xml;
    $_SESSION['timer'] = time()+60*10;
}

function showRSS()
{
    echo 'Time until cache reset: '.($_SESSION['timer'] - time());
    print '<h1>' . $_SESSION['feed']->channel->title . '</h1>';
    foreach($_SESSION['feed']->channel->item as $story)
    {
        echo '<a href="' . $story->link . '">' . $story->title . '</a><br />'; 
        echo '<p>' . $story->description . '</p><br /><br />';
    }
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