<?php
function upload_imgbb($base64)
{
	$post = [
		'key' => '56cd9aa1bde68b7a0931eee037ed6e66',
		'image' => $base64
	];

	$ch = curl_init('https://api.imgbb.com/1/upload');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	$response = curl_exec($ch);
	curl_close($ch);

	$result = json_decode($response);
	
	return isset($result->data->url) ? $result->data->url:null;
}