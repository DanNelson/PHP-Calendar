<?php
//Turns on error printing to the browser
error_reporting(E_ALL);
ini_set('display_errors','On');
include('functions.php');

//Get from URL the month and year the user has requested
$year = $_GET['year_in'];
$month = $_GET['month_in'];

//Array for the days in a week
$days_of_week = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursay", "Friday", "Saturday");

//Find the number of days in the month
$num_days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
$first_day = mktime(0,0,0,$month, 1, $year);
$day_of_week_month_begin =  date('D',$first_day);
$month_string =  date('F',$first_day);
//Statments to determine the number of days to print before and after the current month
 if($month==1){
	$month_prior = 12;
	$month_post = 2;
	$year_prior = $year - 1;
	$year_post = $year;
}
else if($month == 12){
	$month_prior = 11;
	$month_post = 1;
	$year_prior = $year;
	$year_post = $year +1;
}
else{
	$month_prior = $month - 1;
	$month_post = $month + 1;
	$year_prior = $year;
	$year_post = $year;
}
$num_days_in_month_prior = cal_days_in_month(CAL_GREGORIAN, $month_prior, $year);


$start_position = day_of_week($day_of_week_month_begin);
$number_of_predays = ($start_position-1);
$total_spaces_needed = $number_of_predays + $num_days_in_month;
$num_rows=0;
if($total_spaces_needed>35){
	$num_rows = 7;
}
else{
	$num_rows = 6;
}
$day_prior = $num_days_in_month_prior+1-($number_of_predays);

$day_count = 1;
$continue_printing = false;
$post_days = 1;

//Display calendar
echo "<h1><center>".$month_string." ".$year."</center></h1>";
echo "<table>";
for($outside=1;$outside<=$num_rows;$outside++){
	$post_printing = false;
	if($outside == 1){
		echo "\n"."<tr class=\"tr_days\">";
	}
	else{
		echo "\n"."<tr class=\"tr_normal\">";
	}
	for($inside=1;$inside<=7;$inside++){
		if($outside==1){
			echo "<td class=\"td_days\" >";
			echo $days_of_week[$inside-1];
			echo "</td>";
		}
		if($outside==2){
			
			//pre start date
			if (!($inside == $start_position)&&!($continue_printing)){
				echo "<td class=\"td_days_normal\" id=\"".day_of_year_prior($month_prior,$day_prior,$year_prior)."\">";
				echo "<div class=\"post_days\">";
				echo $day_prior;
				$day_prior++;
				echo "</div>";
			}
			else if($inside == $start_position){
				echo "<td class=\"td_days_normal\" id=\"".day_of_year_current($month, $day_count, $year)."\">";
				echo "<div class=\"day_numbers\">";
				echo $day_count;
				$continue_printing=true;
				$day_count++;
				echo "</div>";
				echo "</td>";
			}
			else if($continue_printing){
				echo "<td class=\"td_days_normal\" id=\"".day_of_year_current($month, $day_count, $year)."\">";
				echo "<div class=\"day_numbers\">";
				echo $day_count;
				$day_count++;
				echo "</div>";
				echo "</td>";
			}
			
			
		}
		else if($outside > 2){
			
			if($day_count<=$num_days_in_month){
				echo "<td class=\"td_days_normal\" id=\"".day_of_year_current($month, $day_count, $year)."\">";
				echo "<div class=\"day_numbers\">";
				echo $day_count;
				$day_count++;
				echo "</div>";
				echo "</td>";
			}
			//post start date
			else if(!($day_count<=$num_days_in_month)){	
				echo "<td class=\"td_days_normal\" id=\"".day_of_year_post($month_post, $post_days, $year_post)."\">";
				echo "<div class=\"post_days\">";
				echo $post_days;
				$post_days++;
				echo "</div>";
				echo "</td>";
			}
			
		}
		
	
		
	}
	echo "</tr>"."\n";
}

echo "</table> <div id=\"under_table\"></div>";





?>