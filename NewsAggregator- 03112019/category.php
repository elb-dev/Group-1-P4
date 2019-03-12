<?php

class Category {
    public $CategoryID = 0;
    public $CategoryName = '';
    public $CategoryImage = '';
    public $CategoryDescription = '';
    public $FeedURL = '';

//constructor
public function __construct($id, $name, $description) {
$this->CategoryID = (int)$id;
$this->CategoryName = $name;
$this->CategoryDescription = $description;
$this->FeedURL = "feed_list.php/?id=$this->CategoryID&name=$this->CategoryName";
$this->setImages($this->CategoryName);

}//end of Category constructor

private function setImages($name) {
    switch($name) {
        case "Engineer":
        $this->CategoryImage = "images/engineering.jpg";
        break;
        case "Entertainment":
        $this->CategoryImage = "images/entertainment.jpg";
        break;
        case "Sports":
        $this->CategoryImage = "images/sports.jpg";
        break;
    }//end of switch
}//end of setImages function 

}//end of Category class