<?php

function day_of_week($day_of_week_month_begin){
	
	switch($day_of_week_month_begin){
		case "Sun": $start_position = 1; break;
		case "Mon": $start_position = 2; break;
		case "Tue": $start_position = 3; break;
		case "Wed": $start_position = 4; break;
		case "Thu": $start_position = 5; break;
		case "Fri": $start_position = 6; break;
		case "Sat": $start_position = 7; break;
	}
	return $start_position;
}

function day_of_year_prior($month,$day,$year){
	$time_day_of_year = mktime(0,0,0,$month, $day, $year);
	$day_of_year =  date('z',$time_day_of_year);
	return $day_of_year;
}

function day_of_year_current($month,$day,$year){
	$time_day_of_year = mktime(0,0,0,$month, $day, $year);
	$day_of_year =  date('z',$time_day_of_year);
	return $day_of_year;
}

function day_of_year_post($month,$day,$year){
	$time_day_of_year = mktime(0,0,0,$month, $day, $year);
	$day_of_year =  date('z',$time_day_of_year);
	return $day_of_year;
}


?>