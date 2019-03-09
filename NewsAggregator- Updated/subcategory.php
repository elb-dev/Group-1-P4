<?php
//the Subcategory class

class Feed 
{
    public $feedID = 0;
    public $feedName = '';
    public $feedDescription = '';
    public $feedURL = '';
    public $categoryID = 0;
    public $feedImage = '';

    //constructor
    public function __construct($subcatID, $subcatName, $subcatDescription, $subcatRSS, $catID) {
        $this->feedID = (int) $subcatID;
        $this->feedName = $subcatName;
        $this->feedDescription = $subcatDescription;
        $this->feedURL = $subcatRSS;
        $this->categoryID = (int) $catID;
        $this->setImages($this->feedName);
    }//end of constructor
private function setImages($name) {
    switch($name) {
        case "Civil Engineering":
        $this->feedImage = "../images/civil_engineering.jpeg";
        break;
        case "Nanotechnology":
        $this->feedImage = "../images/nanotechnology.jpeg";
        break;
        case "Microwaves/Radiowaves":
        $this->feedImage = "../images/microwaves_radiowaves.jpeg";
        break;
        case "Music":
        $this->feedImage = "../images/music.jpeg";
        break;
        case "DVD/Music":
        $this->feedImage = "../images/dvd_music.jpeg";
        break;
        case "Art":
        $this->feedImage = "../images/art.jpg";
        break;
        case "MLB":
        $this->feedImage = "../images/mlb.jpeg";
        break;
        case "NFL":
        $this->feedImage = "../images/nfl.jpeg";
        break;
        case "NBA":
        $this->feedImage = "../images/nba.jpeg";
        break;
    }//end of switch
}//end of setImages function 

}//end of subcategory class