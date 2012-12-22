<?php

	require_once "SearchItem.php";
	include_once "Name.php";
	include_once "Track.php";
	include_once "Album.php";

	class FactorySearchItem
	{  
	    public static function getType($type)
	     {  
	        $class = $type;
	        if (class_exists($class))
	        	return new $class;
	        
	        throw new Exception('Error - can not find class ' . $class);
	    }  
	}

?>