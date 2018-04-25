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
//This is an example with all possible calendar customizations like in custom_example.php only here calendar generation and ajax request are in different files
//This is a ajax request file
//With another difference, that here for example, we will use set_events method to pass array, not url_pattern for all days
/*********************/

//you should always sepecify timezone when dealing with date function like used in calendar
date_default_timezone_set("Europe/Helsinki");

//declaring class instance
include("./calendar.class.php");
$calendar = new calendar();


if(isset($_GET['ajax_calendar']))
{
//$_GET['ajax_calendar'] is set, it means request is beeing made by ajax to get days  of other months or year
//make sure that you do not output anything to browser, so you won't mess json structure of calendar
//other parameters that are passed with this request are
//$_GET['date'] - for date
//$_GET['month'] - for month
//$_GET['year'] - for year
//$_GET['start'] - which day to start week with

	//set start month and year which is an oldest motnh to show
	$calendar->set_start_date(1,1987);
	//set end month and year which is a newest motnh to show
	$calendar->set_end_date(3,1987);
	
	
	//here for example, you can make request to database using values from $_GET['date'], $_GET['month'] and $_GET['year'] variables, to get urls for specific dates and pass the as array in set_events method
	
	//setting an example array with urls, where keys are the days of month and values are urls of that days for set_events method
	$arr = array(1 => "#beginning_of_a_month", 30 => "#end_of_a_month");
	$calendar->set_events($arr);
	
	//processing request and outputting json structure
	$calendar->process_request();
}
?>