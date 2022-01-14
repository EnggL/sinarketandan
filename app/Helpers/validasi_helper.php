<?php
function validateDate($date, $format = 'Y-m-d'){
	$d = DateTime::createFromFormat($format, $date);
	return $d && $d->format($format) === $date;
}

function isValidImage($mediapath)
{
	if(@is_array(getimagesize($mediapath))){
		$image = true;
	} else {
		$image = false;
	}

	return $image;
}