<?php
function bulanIndo()
{
	return [
		"Januari",
		"Februari",
		"Maret",
		"April",
		"Mei",
		"Juni",
		"Juli",
		"Agustus",
		"September",
		"Oktober",
		"November",
		"Desember",
	];
}

function bulanEng()
{
	return [
		"January",
		"February",
		"March",
		"April",
		"May",
		"June",
		"Jule",
		"August",
		"September",
		"October",
		"November",
		"December",
	];
}

function hariInd()
{
	return [
		"Senin",
		"Selasa",
		"Rabu",
		"Kamis",
		"Jumat",
		"Sabtu",
		"Minggu",
	];
}

function hariEngSingkat()
{
	return [
		"Mon",
		"Tue",
		"Wed",
		"Thu",
		"Fri",
		"Sat",
		"Sun",
	];
}

function monthEngToInd($text)
{
	/*
	text = 01 March 2021
	return 01 maret 2021
	*/

	return str_replace(bulanEng(), bulanIndo(), $text);
}

function dayEngSingkatToInd($text)
{
	return str_replace(hariEngSingkat(), hariInd(), $text);
}