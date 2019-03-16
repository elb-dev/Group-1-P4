<?php
require 'inc_0700/config_inc.php';
get_header();
?>
<header>
<h1>News Aggregator</h1>
</header>


<?php
//common classes and functions (Common and getCategoryData)
require "inc_0700/common.php";
//Category class
require "category.php";

//get the Category data
$result = getCategoryData();

//check if there are rows 
if(mysqli_num_rows($result) > 0) {
    //fetch each row
    while($row = mysqli_fetch_assoc($result)) 
    {
        //create an array of category objects
        $myCategories[] = new Category($row['CategoryID'], $row['CategoryName'], $row['CategoryDescription']);     
    }
    
    //build the html categories display by looping through the categories array
    foreach($myCategories as $category) 
    {
        
        echo '<div>
                <h2>' . $category->categoryName . '</h2>
                <a href="' . $category->feedURL . '"><img src="' . $category->categoryImage . '" alt=""></a>
                <p>' . $category->categoryDescription . '<br>
                <strong><a href="' . $category->feedURL . '">View ' . $category->categoryName . ' feeds</a></strong></p>
              </div>';
    }//end of foreach loop

}//end of if block
else
{
    //what should happen if we don't have data in the db?
}
get_footer();
