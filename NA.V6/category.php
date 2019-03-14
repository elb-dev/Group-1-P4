<?php

class Category {
    public $categoryID = 0;
    public $categoryName = '';
    public $categoryImage = '';
    public $categoryDescription = '';
    public $feedURL = '';

//constructor
public function __construct($id, $name, $description) {
$this->categoryID = (int)$id;
$this->categoryName = $name;
$this->categoryDescription = $description;
$this->feedURL = "Feed_list.php/?id=$this->categoryID&name=$this->categoryName";
$this->setImages($this->categoryName);

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