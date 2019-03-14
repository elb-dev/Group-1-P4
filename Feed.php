<?php
//the Feed class

class Feed 
{
    public $FeedID = 0;
    public $FeedName = '';
    public $FeedDescription = '';
    public $FeedURL = '';
    public $categoryID = 0;
    public $FeedImage = '';

    //constructor
    public function __construct($fID, $fName, $fDescription, $fURL, $catID) {
        $this->FeedID = (int) $fID;
        $this->FeedName = $fName;
        $this->FeedDescription = $fDescription;
        $this->FeedURL = $fURL;
        $this->CategoryID = (int) $catID;
        $this->setImages($this->FeedName);
    }//end of constructor
private function setImages($name) {
    switch($name) {
        case "Civil Engineering":
        $this->feedImage = "../images/civil_engineering.jpg";
        break;
        case "Nanotechnology":
        $this->feedImage = "../images/nanotechnology.jpg";
        break;
        case "Microwaves/Radiowaves":
        $this->feedImage = "../images/microwaves_radiowaves.jpg";
        break;
        case "Music":
        $this->feedImage = "../images/music.png";
        break;
        case "DVD/Music":
        $this->feedImage = "../images/dvd_music.png";
        break;
        case "Art":
        $this->feedImage = "../images/art.jpg";
        break;
        case "MLB":
        $this->feedImage = "../images/mlb.png";
        break;
        case "NFL":
        $this->feedImage = "../images/nfl.jpg";
        break;
        case "NBA":
        $this->feedImage = "../images/nba.jpg";
        break;
    }//end of switch
}//end of setImages function 

}//end of Feed class