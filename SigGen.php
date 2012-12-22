<?php 
	class SigGen
	{
		public static function getTimeStamp()
		{
			return time();
		}
	
		public static function getSharedSecret()
		{
			return "DYeqwNPrCv";
		}
	
		public static function getAPIKey()
		{
			return "f52a3zyhzt6ur5zwrz87xfp3";
		}
	
		public static function createMD5Hash()
		{
			$string = self::getAPIKey() . self::getSharedSecret() . self::getTimeStamp();
			$md = md5($string);
			return $md;
		}
	
		public static function getResult() //example
		{
			$url = "http://api.rovicorp.com/data/v1/album/images?albumid=MW0000111184&apikey=";
			$url = $url .  self::getAPIKey() . "&sig=" . self::createMD5Hash();
			$contents = file_get_contents($url);
			return $contents;
		}
	}
	
?>
