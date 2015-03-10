<?php

function debug($var)
{
	echo '<pre>';
	var_export($var);
	echo '</pre>';
	
	exit;
}