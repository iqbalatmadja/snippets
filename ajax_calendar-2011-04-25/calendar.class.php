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
/*

This class can generate full month calendar for specified date, 
then user can browse calendar by switching months and years without page refresh
There is a jquery javascript file included for ajax requests
and CSS file, to customize look of calendar
Here is an example of this calendar inteface http://code-snippets.co.cc/AJAX/Generate-calendar-using-PHP-and-browse-it-using-AJAX
Aditionally you can set start and end dates, which will be the oldest and newest displayable months
You can also specify an url pattern for all active days, or provide and array with only specific days which should be clickable links with your specified urls
For more information try out example files included in package:
simple_example.php - the simpliest way to get it to work with all default options
custom_example.php - example with all possible customization options and url_pattern usage for all days
calendar_generation_part.php - example where calendar and ajax request files are apart, this is calendar part
ajax_request_part.php - example where calendar and ajax request files are apart, this is ajax part
*/
class calendar
{
	//default month names
	private $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
	//default names of days of week
	private $weekdays = array("Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun");
	//order of days of the week in calendar
	private $day_order = array("Mon" => 0, "Tue" => 1, "Wed" => 2, "Thu" => 3, "Fri" => 4, "Sat" => 5, "Sun" => 6);
	//which day to start week with
	private $start_week = 0;
	//error storage
	private $errors = array();
	//url pattern for events
	private $url_pattern = "";
	//array with date of day as key url as value
	//used if url_pattern is not specified
	private $events = array();
	//path to file where to send ajax request
	//if none specified, same file will be used where calculator is generated
	private $request = "";
	//request parameters to send with ajax request (pairs where key is name and value is value)
	private $request_params = array();
	//oldest month/year to display calendar
	private $start_date = "";
	//newest month/year to display calendar
	private $end_date = "";
	//calendar count
	private $cal_count = 0;
	
	//get array with errors
	public function get_errors(){
		return $this->errors;
	}
	//provide an array with 12 elements for month names starting from first month
	public function set_months($arr){
		if(sizeof($arr) == 12)
		{
			$this->months = $arr;
		}
		else
		{
			$this->errors[] = "Incorrect amount of months";
		}
	}
	//provide an array with 7 elements for names of the days of the week starting from Monday
	public function set_weekdays($arr){
		if(sizeof($arr) == 7)
		{
			$this->weekdays = $arr;
		}
		else
		{
			$this->errors[] = "Incorrect amount of weekdays";
		}
	}
	//set with which day should the week start values from 0 - Monday, to 6 - Sunday
	public function set_week_start($day){
		if(in_array($day, $this->day_order))
		{
			$arr = $this->weekdays;
			foreach($this->weekdays as $key => $value)
			{
				if($day != $key)
				{
					$elm = array_shift($arr);
					array_push($arr, $elm);
				}
				else
				{
					break;
				}
			}
			$this->weekdays = $arr;
			$this->start_week = $day;
		}
		else
		{
			$this->errors[] = "Incorrect day of the week";
		}
	}
	//set an path where to send ajax request to update calendar
	public function set_request_path($req){
		$this->request = $req;
	}
	//add request parameters
	public function add_request_param($name, $value){
		if(!in_array($name, array("date", "month", "year", "start", "ajax_calendar")))
		{
			$this->request_params[$name] = $value;
		}
		else
		{
			$this->errors[] = "Can not override main class parameters";
		}
	}
	//sets the url pttern where $1 will be replaced with date, $2 with month and $3 with year
	public function set_url_pattern($pattern){
		$this->url_pattern = $pattern;
	}
	//set event on specific dates using array, where key is number of day in month and value url where to go, when clicking on this day
	//it will be used only if url_pattern is not specified
	public function set_events($events){
		$this->events = $events;
	}
	//generate calendar
	public function generate_calendar($day = "", $month = "", $year = ""){
		$this->cal_count++;
		$this->calendar_headers();
		$now = time();
		if(trim($day) == "")
		{
			$day = date("j", $now);
		}
		if(trim($month) == "")
		{
			$month= date("n", $now);
		}
		if(trim($year) == "")
		{
			$year = date("Y", $now);
		}
		echo "<script type='text/javascript'>
			make_calendar".($this->cal_count)."(".$day.", ".$month.", ".$year.");
		</script>";
	}
	//set the oldest month/year in calendar
	public function set_start_date($month = "", $year = ""){
		$this->start_date = $year."-".$month;
	}
	//set the newest month/year in calendar
	public function set_end_date($month = "", $year = ""){
		$this->end_date = $year."-".$month;
	}
	//generating calendar using javascript from data received from request
	private function calendar_headers(){
		if(trim($this->request) == "")
		{
			$this->request = $_SERVER['REQUEST_URI'];
		}
		echo "<div id='ajax_calendar".($this->cal_count)."'></div>";
		echo '<script type="text/javascript">
				function make_calendar'.($this->cal_count).'(date, month, year)
				{
					jQuery.getJSON("'.($this->request).'",{date: date, month: month, year: year, ajax_calendar: "true", start: '.($this->start_week);
					if(!empty($this->request_params))
					{
						foreach($this->request_params as $key => $val);
						{
							echo ','.$key.':"'.$val.'"';
						}
					}
					echo '}, 
					function(j)
					{
						var months = new Array(""';
						$state = true;
						foreach($this->months as $val)
						{
							echo ',"'.$val.'"';
						}
						echo');
						if(month - 1 < 1)
						{
							var prev = 12;
							var pyear = year - 1;
						}
						else
						{
							var prev = month - 1;
							var pyear = year;
						}
						if(month + 1 > 12)
						{
							var next = 1;
							var nyear = year + 1;
						}
						else
						{
							var next = month + 1;
							var nyear = year;
						}
						var table = "<table class=\'ajax_calendar_header\'>";
						if(j.prev_year == "true")
						{
							table += "<tr><td class=\'ajax_calendar_prev_year_active\'><a href=\'javascript:void(0);\' onclick=\'make_calendar'.($this->cal_count).'(" + date + ", " + month + "," + parseInt(year-1) + ")\'><<</a></td>";
						}
						else
						{
							table += "<tr><td class=\'ajax_calendar_prev_year_inactive\'><<</td>";
						}
						if(j.prev_month == "true")
						{
							table += "<td class=\'ajax_calendar_prev_month_active\'><a href=\'javascript:void(0);\' onclick=\'make_calendar'.($this->cal_count).'(" + date + ", " + prev + "," + pyear + ")\'><</a></td>";
						}
						else
						{
							table += "<td class=\'ajax_calendar_prev_month_inactive\'><</td>";
						}
						table += "<td class=\'ajax_calendar_main_date\'>" + months[month] + "&nbsp;" + year + "</td>";
						if(j.next_month == "true")
						{
							table += "<td class=\'ajax_calendar_next_year_active\'><a href=\'javascript:void(0);\' onclick=\'make_calendar'.($this->cal_count).'(" + date + ", " + next + "," + nyear + ")\'>></a></td>";
						}
						else
						{
							table += "<td class=\'ajax_calendar_next_year_inactive\'>></td>";
						}
						if(j.next_year == "true")
						{
							table += "<td class=\'ajax_calendar_next_month_active\'><a href=\'javascript:void(0);\' onclick=\'make_calendar'.($this->cal_count).'(" + date + ", " + month + "," + parseInt(year+1) + ")\'>>></a></td></tr>";
						}
						else
						{
							table += "<td class=\'ajax_calendar_next_month_inactive\'>>></td></tr>";
						}
						table += "</table><table class=\'ajax_calendar\'>";
						table += "<tr class=\'ajax_calendar_weekdays\'>';
						foreach($this->weekdays as $val)
						{
							echo "<td>".$val."</td>";
						}
						echo '</tr>";
						for (var i = 0; i < j.table.length; i++) 
						{
							table += "<tr>";
							for (var k = 0; k < j.table[i].tr.length; k++) 
							{
								table += "<td ";
								table += "class=\'ajax_calendar_" + j.table[i].tr[k].type + "_days\'>";
								if(j.table[i].tr[k].type != "inactive" && j.table[i].tr[k].url != "")
								{
									table += \'<a href="\' + j.table[i].tr[k].url + \'">\';
								}
								table += j.table[i].tr[k].date;
								if(j.table[i].tr[k].type != "inactive" && j.table[i].tr[k].url != "")
								{
									table += "</a>";
								}
								table += "</td>";
							}
							table += "</tr>";
						}
						table += "</table>";';
						echo "document.getElementById('ajax_calendar".($this->cal_count)."').innerHTML = table;";
					echo '})
				}
			</script>';
	}
	//process and respond to ajax request with json structure of selected date
	public function process_request(){
		if(isset($_GET['date']) && isset($_GET['month']) && isset($_GET['year']) && isset($_GET['start']))
		{
			$first_day = mktime(0,0,0, $_GET['month'], 1, $_GET['year']);
			if($_GET['month']-1 == 0)
			{
				$prev = 12;
				$year = $_GET['year'] - 1;
			}
			else
			{
				$prev = $_GET['month']-1;
				$year = $_GET['year'];
			}
			$prev_month = cal_days_in_month(0, $prev, $year);
			$day_of_week = date("D", $first_day);
			if($_GET['start'] != 0)
			{
				$arr = array_flip($this->day_order);
				$start_key = array_search($_GET['start'], $this->day_order);
				foreach($this->day_order as $key => $value)
				{
					if($start_key != $key)
					{
						$elm = array_shift($arr);
						array_push($arr, $elm);
					}
					else
					{
						break;
					}
				}
				$this->day_order = array_flip($arr);
			}
			$blank = $this->day_order[$day_of_week];
			$days_in_month = cal_days_in_month(0, $_GET['month'], $_GET['year']);
			$day_count = 1;
			$str = '{';
			if(trim($this->start_date) != "")
			{
				$dates = explode("-", $this->start_date);
				if($_GET['year'] == $dates[0] && $_GET['month'] == $dates[1])
				{
					$str .= '"prev_year":"false", ';
					$str .= '"prev_month":"false", ';
				}
				else if($_GET['year'] == $dates[0])
				{
					$str .= '"prev_year":"false", ';
					$str .= '"prev_month":"true", ';
				}
				else
				{
					$str .= '"prev_year":"true", ';
					$str .= '"prev_month":"true", ';
				}
			}
			else
			{
				$str .= '"prev_year":"true", ';
				$str .= '"prev_month":"true", ';
			}
			if(trim($this->end_date) != "")
			{
				$dates = explode("-", $this->end_date);
				if($_GET['year'] == $dates[0] && $_GET['month'] == $dates[1])
				{
					$str .= '"next_year":"false", ';
					$str .= '"next_month":"false", ';
				}
				else if($_GET['year'] == $dates[0])
				{
					$str .= '"next_year":"false", ';
					$str .= '"next_month":"true", ';
				}
				else
				{
					$str .= '"next_year":"true", ';
					$str .= '"next_month":"true", ';
				}
			}
			else
			{
				$str .= '"next_year":"true", ';
				$str .= '"next_month":"true", ';
			}
			$str .= '"table":[{"tr":[';
			$prev_month -= $blank;
			while($blank > 0)
			{
				$str .= '{"date":'.(++$prev_month).', "type":"inactive"},';
				$blank--;
				$day_count++;
			}
			$day_num = 1;
			while($day_num <= $days_in_month)
			{	
				$url = "";
				if(trim($this->url_pattern) != "")
				{
					$url = str_replace("$3", $_GET['year'], str_replace("$2", $_GET['month'], str_replace("$1", $day_num, $this->url_pattern)));
				}
				else if(array_key_exists($day_num, $this->events))
				{
					$url = $this->events[$day_num];
				}
				if($day_num == $_GET['date'])
				{
					$str .= '{"date":'.$day_num.', "type":"today", "url":"'.$url.'"},';
				}
				else
				{
					$str .= '{"date":'.$day_num.', "type":"active", "url":"'.$url.'"},';
				}
				$day_num++;
				$day_count++;
				if($day_count > 7)
				{
					$str = substr($str, 0, strlen($str)-1).']}';
					if($day_num <= $days_in_month)
					{
						$str .= ',{"tr":[';
					}
					$day_count = 1;
				}
			}
			$cnt = 1;
			while($day_count > 1 && $day_count <=7)
			{
				$str .= '{"date":'.($cnt++).', "type":"inactive"},';
				$day_count++;
			}
			if($cnt == 1)
			{
				$str = substr($str, 0, strlen($str)-1)."}]}";
			}
			else
			{
				$str = substr($str, 0, strlen($str)-1)."]}]}";
			}
			echo $str;
		}
	}

	
}
?>