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
//This is a calendar generation file
/*********************/

//you should always sepecify timezone when dealing with date function like used in calendar
date_default_timezone_set("Europe/Helsinki");

//declaring class instance
include("./calendar.class.php");
$calendar = new calendar();

//defining path to jquery and style css included in package
echo '<script type="text/javascript" src="./jquery.js"></script>';
echo '<style type="text/css" media="all">@import "./style.css";</style>';
//array with custom month names
$months = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
//applying custom month names
$calendar->set_months($months);

//array with custom days of week names
$weekdays = array("M", "T", "W", "Th", "F", "S", "Sun");
//applying custom days of week names
$calendar->set_weekdays($weekdays);

//define with which day to start week 0 - Monday, ..., 6 - Sunday
//here in example it is Tuesday
$calendar->set_week_start(1);

//Now this is new, we are setting request url, to other file
//you may want to edit it to match your directory path
$calendar->set_request_path("/calendar/ajax_request_part.php");

//getting errors
$errors = $calendar->get_errors();
if(!empty($errors))
{
	foreach($errors as $error)
	{
		echo "<p>".$error."</p>";
	}
}

//generating calendar, you can specify date like in example
//if no date is specified, than todays date will be used
$calendar->generate_calendar(23,2,1987);
?>