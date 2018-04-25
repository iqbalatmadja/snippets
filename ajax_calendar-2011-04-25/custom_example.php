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
//This is an example with all possible calendar customizations and generating calendar and ajax request in the same file
/*********************/
//All methods are divided in 2 groups
//One should be used in same file or scope, where calendar will be generated
//Other should be used in same file or scope, where ajax request will be made
//The ones used in if(isset($_GET['ajax_calendar'])) clause should be used within request file or scope
//The ones in else clause should be used within calendar generator file or scope

//you should always sepecify timezone when dealing with date function like used in calendar
date_default_timezone_set("Europe/Helsinki");

//declaring class instance
include("./calendar.class.php");
$calendar = new calendar();


if(isset($_GET['ajax_calendar']))
{
//if $_GET['ajax_calendar'] is set, it means request is beeing made by ajax to get days  of other months or year
//make sure that you do not output anything to browser, so you won't mess json structure of calendar
//other parameters that are passed with this request are
//$_GET['date'] - for date
//$_GET['month'] - for month
//$_GET['year'] - for year
//$_GET['start'] - which day to start week with
//and any other custom parameters added
//for this example it is parameter $_GET['param'] = "value"

	//set start month and year which is an oldest motnh to show
	$calendar->set_start_date(1,1987);
	//set end month and year which is a newest motnh to show
	$calendar->set_end_date(3,1987);
	
	//set url pattern, for all active days to be used as links where $1 will be replaced by date, $2 replaces by month and $3 by year, 
	$calendar->set_url_pattern("javascript:alert('Date selected $3-$2-$1');");
	//$arr = array(1 => "#beginning_of_a_month", 30 => "#end_of_a_month");
	//$calendar->set_events($arr);
	
	//if ajax request is made to the same page, make sure nothing other is outputted to browser
	//you can specify request url in the file where you generate calendar
	//if nothing is specified then request will be made to the same page
	$calendar->process_request();
}
else
{
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
	
	//adding request parameter name and value which will appear in ajax request
	$calendar->add_request_param("param", "value");
	
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
}
?>