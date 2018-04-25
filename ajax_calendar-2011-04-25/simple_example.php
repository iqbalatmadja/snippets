/*************************************************************
 * This script is developed by Arturs Sosins aka ar2rsawseen, http://webcodingeasy.com
 * Fee free to distribute and modify code, but keep reference to its creator
 *
 * This can be used to display month calendars browsable using AJAX.
 * It can generate HTML and JavaScript to display a month calendar with
 * links to browse the months using AJAX to avoid page reloading.
 *
 * For more information, examples and online documentation visit: 
 * http://webcodingeasy.com/PHP-classes/Ajax-calendar-class
**************************************************************/
<?php

/*********************/
//This is an example of simply generating calendar without any customixations
/*********************/

//you should always sepecify timezone when dealing with date function like used in calendar
date_default_timezone_set("Europe/Helsinki");

		
//declaring class instance
include("./calendar.class.php");
$calendar = new calendar();


if(isset($_GET['ajax_calendar']))
{
	//processing request
	$calendar->process_request();
}
else
{
	//defining path to jquery and style css included in package
	echo '<script type="text/javascript" src="./jquery.js"></script>';
	echo '<style type="text/css" media="all">@import "./style.css";</style>';
	
	//generating calendar with todays date
	$calendar->generate_calendar();
}
?>