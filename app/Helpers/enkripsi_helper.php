<?php
function simple_encrypt($plainText)
{
	$encrypter = \Config\Services::encrypter();
	return bin2hex($encrypter->encrypt($plainText));
}

function simple_decrypt($encrypt_text)
{
	$encrypter = \Config\Services::encrypter();
	return $encrypter->decrypt(hex2bin($encrypt_text));
}