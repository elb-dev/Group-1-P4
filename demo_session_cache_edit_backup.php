<?php
/**
 * demo_postback_nohtml.php is a single page web application that allows us to request and view 
 * a customer's name
 *
 * This version uses no HTML directly so we can code collapse more efficiently
 *
 * This page is a model on which to demonstrate fundamentals of single page, postback 
 * web applications.
 *
 * Any number of additional steps or processes can be added by adding keywords to the switch 
 * statement and identifying a hidden form field in the previous step's form:
 *
 *<code>
 * <input type="hidden" name="act" value="next" />
 *</code>
 * 
 * The above live of code shows the parameter "act" being loaded with the value "next" which would be the 
 * unique identifier for the next step of a multi-step process
 *
 * @package ITC281
 * @author Bill Newman <williamnewman@gmail.com>
 * @version 1.1 2011/10/11
 * @link http://www.newmanix.com/
 * @license https://www.apache.org/licenses/LICENSE-2.0
 * @todo finish instruction sheet
 * @todo add more complicated checkbox & radio button examples
 */

# '../' works for a sub-folder.  use './' for the root  
require 'inc_0700/config_inc.php'; #provides configuration, pathing, error handling, db credentials
/*
$ducks[] = new Duck('Huey','Fishing',.15);
$ducks[] = new Duck('Dewey','Camping',.12);
$ducks[] = new Duck('Louie','Flying Kites',.11);

foreach($ducks as $duck){
    echo '<p>' . $duck . '</p>';
}
die;
*/

 
/*
$config->metaDescription = 'Web Database ITC281 class website.'; #Fills <meta> tags.
$config->metaKeywords = 'SCCC,Seattle Central,ITC281,database,mysql,php';
$config->metaRobots = 'no index, no follow';
$config->loadhead = ''; #load page specific JS
$config->banner = ''; #goes inside header
$config->copyright = ''; #goes inside footer
$config->sidebar1 = ''; #goes inside left side of page
$config->sidebar2 = ''; #goes inside right side of page
$config->nav1["page.php"] = "New Page!"; #add a new page to end of nav1 (viewable this page only)!!
$config->nav1 = array("page.php"=>"New Page!") + $config->nav1; #add a new page to beginning of nav1 (viewable this page only)!!
*/

//END CONFIG AREA ----------------------------------------------------------

# Read the value of 'action' whether it is passed via $_POST or $_GET with $_REQUEST
if(isset($_REQUEST['act'])){
	$myAction = (trim($_REQUEST['act']));
}else{
	$myAction = "";
}

switch ($myAction) 
{//check 'act' for type of process
	case "display": # 2)Display user's name!
	 	showDucks();
	 	break;
	 case "reset":
	 	session_destroy();
	 	duckForm();
	 	break;
	default: # 1)Ask user to enter their name 
	 	duckForm();
}

function duckForm()
{# shows form so user can enter their name.  Initial scenario
	//get_header(); #defaults to header_inc.php	
	
	echo 
	'<script type="text/javascript" src="' . VIRTUAL_PATH . 'include/util.js"></script>
	<script type="text/javascript">
		function checkForm(thisForm)
		{//check form data for valid info
			if(empty(thisForm.Name,"Please Enter Duck Name")){return false;}
			if(empty(thisForm.Hobby,"Please Enter Hobby")){return false;}
			if(empty(thisForm.Allowance,"Please Enter Allowance")){return false;}
			return true;//if all is passed, submit!
		}
	</script>
	<h3 align="center">' . smartTitle() . '</h3>
	<p align="center">Please enter your name</p> 
	<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);">
		<table align="center">
			<tr>
				<td align="right">
					Name
				</td>
				<td>
					<input type="text" name="Name" /><font color="red"><b>*</b></font> <em>(alphabetic only)</em>
				</td>
			</tr>
            
            <tr>
				<td align="right">
					Hobby
				</td>
				<td>
					<input type="text" name="Hobby" /><font color="red"><b>*</b></font> <em>(alphabetic only)</em>
				</td>
			</tr>
            
            
           <tr>
				<td align="right">
					Allowance
				</td>
				<td>
					<input type="text" name="Allowance" /><font color="red"><b>*</b></font> <em>(numeric only)</em>
				</td>
			</tr>
            
			<tr>
				<td align="center" colspan="2">
					<input type="submit" value="Please Enter Your Name"><em>(<font color="red"><b>*</b> required field</font>)</em>
					<input type="hidden" name="act" value="display" />
				</td>
			</tr>
			</form>
			<tr>
				<td align="center" colspan="2">
					<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);">
					<input type="submit" value="Reset">
					<input type="hidden" name="act" value="reset" />
					</form>
				</td>
			</tr>
		</table>
	';
	if(isset($_SESSION['Time'])){
		echo'Time until next destroy: '.(($_SESSION['Time']+60)-time());
	}
	
	//get_footer(); #defaults to footer_inc.php
}

function showDucks()
{#form submits here we show entered name
	//get_header(); #defaults to footer_inc.php
    
    
    //dumpDie($_POST);
    startSession();

    /*
    If no feeds yet, create feed array.
    If feeds exist, check to see if the current feed is stored.
    If the feed is stored, check the time to see if it's current.
    If the time is current on the feed, use the cache.
    If the time is out of date, get new data, refresh the cache.
    If no feed, create feed in cache, use website data.
    */
    
    if(!isset($_SESSION['Ducks'])){
       $_SESSION['Ducks'] = array();
       $_SESSION['Time'] = time();
    }
    
     $_SESSION['Ducks'][] = new Duck($_POST['Name'],$_POST['Hobby'],$_POST['Allowance']);
    
    echo'<p>';
    var_dump($_SESSION['Ducks']);
    echo'</p>';

	/*
	if(!isset($_POST['YourName']) || $_POST['YourName'] == '')
	{//data must be sent	
		feedback("No form data submitted"); #will feedback to submitting page via session variable
		myRedirect(THIS_PAGE);
	}  
	
	if(!ctype_alnum($_POST['YourName']))
	{//data must be alphanumeric only	
		feedback("Only letters and numbers are allowed.  Please re-enter your name."); #will feedback to submitting page via session variable
		myRedirect(THIS_PAGE);
	}
	
	$myName = strip_tags($_POST['YourName']);# here's where we can strip out unwanted data
	
	echo '<h3 align="center">' . smartTitle() . '</h3>';
	echo '<p align="center">Your name is <b>' . $myName . '</b>!</p>';
	echo '<p align="center"><a href="' . THIS_PAGE . '">RESET</a></p>';
	*/
	//session_unset();
	//session_destroy();
	//get_footer(); #defaults to footer_inc.php
}

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
    }//end toString()

}//end Duck class