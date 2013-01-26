<?php 

	abstract class SearchItem
	{
		public $id;
		public $sig;
		public $search_value;
		public $dataClusters = array();
		public $genres = array();
		
		abstract public function parseJSON($json_decoded, $dataCluster);
		
		public function getRequestString($search_value, $sig, $dataCluster, $id)
		{
			$class = strtolower(get_class($this));
			$requestString = "http://api.rovicorp.com/data/v1.1/" . $class . "/" . $dataCluster . "?" . $class . $id . "=" . $search_value . "&duration=10080&inprogress=0&country=US&language=en&format=json&apikey=" . SigGen::getAPIKey() . "&sig=" . $sig;
			return $requestString;
		}
		
		public function loadView($response)
		{					
			switch ($response["code"])
			{
				case "200":
					$view = "views\\" . get_class($this) . ".php";
					break;
					
				case "404":
					$view = "views\Error.php";
					break;
			}
			
			require $view;
		}
		
		public function rectifyDate($date, $type)
		{
			if (isset($date) && $date != null)
			{
				$parts = explode("-", $date);
				switch ($type)
				{
					case "Name":
						$date = $parts[0];
						break;
						
					case "Album":
						$date = $parts[2] . "-" . $parts[1] . "-" . $parts[0];
						break;
				}
			}
			else
				$date = "????";
		
			return $date;
		}
		
		public function printArrayValues($arr)
		{
			$count = 1;
			foreach ($arr as $val)
			{
				echo "$val";
				if ($count < count($arr))
					echo ", ";
				$count++;
			}
		}
		
		public function parseRoviLinks($text)
		{
			$pattern = array("/\[/",
							 "/\]/",
							 "/roviLink=/",
							 "/roviLink[^=]/",
							 "/MN[0-9]{10}/",
							 "/MW[0-9]{10}/");
			
			$replacement = array("<",
								 ">",
								 "a href=",
								 "a>",
								 "allmusicapi.php?searchItems=Name&idSearch=id&search_value=$0",
								 "allmusicapi.php?searchItems=Album&idSearch=id&search_value=$0");
			
			$text = preg_replace($pattern, $replacement, $text);
			return $text;
		}

		public function displayArtists()
		{
			$count = 1;
			$urlPreFix = "allmusicapi.php?searchItems=Name&idSearch=id&search_value=";
			foreach ($this->artists as $artist)
				if (isset($artist->id) && isset($artist->name))
				{
					echo "<a href=$urlPreFix$artist->id>$artist->name</a>";
					if ($count < count($this->artists))
						echo ", ";
					$count++;
				}
		}
	}

?>