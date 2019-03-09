<?php
//the Feed class

class Feed 
{
    public $FeedID = 0;
    public $FeedName = '';
    public $FeedURL = '';
    public $FeedDescription = '';
    public $CategoryID = 0;
    public $FeedImage = '';

    //constructor
    public function __construct($subcatID, $subcatName, $subcatDescription, $subcatRSS, $catID) {
        $this->FeedID = (int) $subcatID;
        $this->FeedName = $subcatName;
        $this->FeedDescription = $subcatDescription;
        $this->FeedURL = $subcatRSS;
        $this->CategoryID = (int) $catID;
        $this->setImages($this->FeedName);
    }//end of constructor
private function setImages($name) {
    switch($name) {
        case "Civil Engineering":
        $this->FeedImage = "../images/civil_engineering.jpg";
        break;
        case "Nanotechnology":
        $this->FeedImage = "../images/nanotechnology.jpg";
        break;
        case "Microwaves/Radiowaves":
        $this->FeedImage = "../images/microwaves_radiowaves.jpg";
        break;
        case "Music":
        $this->FeedImage = "../images/music.png";
        break;
        case "DVD/Music":
        $this->FeedImage = "../images/dvd_music.png";
        break;
        case "Art":
        $this->FeedImage = "../images/art.jpg";
        break;
        case "MLB":
        $this->FeedImage = "../images/mlb.png";
        break;
        case "NFL":
        $this->FeedImage = "../images/nfl.jpg";
        break;
        case "NBA":
        $this->FeedImage = "../images/nba.jpg";
        break;
    }//end of switch
}//end of setImages function 

}//end of Feed class