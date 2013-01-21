<?php

	require_once "models/SearchItem.php";
	include_once "models/Name.php";
	include_once "models/Track.php";
	include_once "models/Album.php";

	class FactorySearchItem
	{  
	    public static function createSearchItem($type)
	     {  
	        $class = $type;
	        if (class_exists($class))
	        	return new $class;
	        
	        throw new Exception('Error - can not find class ' . $class);
	    }  
	}

?>