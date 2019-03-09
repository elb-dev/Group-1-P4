<!doctype html>
<html>
    
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow" />
        <meta name="author" content="Elly Boyd" />
        <meta name="description" content="Test page for P4 Styles" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="stylesheet" href="main.css" />
        <title>ITC250 | Winter 2019 | Group 1 | Project 4 | Article Style Test Page </title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
</head>

<body>
<header>
<h1>News Aggregator</h1>
</header>


<?php
//common classes and functions (IDB and getCategoryData)
require "config/common.php";
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
        
        echo '
         <main>
         <section id="mainSection" class="section">
                <article id="article1" class="article">
        <div>
                <h2>' . $category->CategoryName . '</h2>
                <a href="' . $category->FeedURL . '"><img src="' . $category->CategoryImage . '" alt=""></a>
                <p>' . $category->CategoryDescription . '<br>
                <strong><a href="' . $category->FeedURL . '">View ' . $category->CategoryName . ' feeds</a></strong></p>
              </div>
               </article>
            </section>
        </main>
              
              ';
    }//end of foreach loop

}//end of if block
else
{
    echo 'Sorry, No Data Found';
}
    echo ' <footer>
            <p id="footContent" class="footTxt">
                &copy; Group 1. All rights reserved. 2019.
            </p> 
        </footer>';
    ?>
    
</body>
</html>