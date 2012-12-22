<?php 

	require_once "SearchItem.php";
	
	class Track extends SearchItem
	{
		private $title;
		private $genres = array();
		//private $views;
		//private $albums = array();
		
		public function __construct()
		{
			parent::setDataClusters(array("info", "appearances"));
		}
		
		public function getRequestString($search_value, $sig, $dataCluster)
		{
			$class = strtolower(get_class($this));
			$requestString = "http://api.rovicorp.com/data/v1.1/song/" . $dataCluster . "?" . $class . "=" . $search_value . "&duration=10080&inprogress=0&country=US&language=en&format=json&apikey=f52a3zyhzt6ur5zwrz87xfp3&sig=" . $sig;
			return $requestString;
		}
		
		public function displayItemData()
		{
			echo "<h3>$this->title</h3>";
			echo "Genres: ";
			$count = 1;
			foreach ($this->genres as $genre)
			{
				echo "$genre";
				if ($count < count($this->genres))
					echo ", ";
				$count++;
			}
		}	

		public function parseJSON($json_decoded, $dataCluster)
		{
			
			switch ($dataCluster)
			{
				case "info":
					$this->id = $json_decoded['song']['ids']['trackId'];
					$this->title = $json_decoded['song']['title'];
					$this->genres = array();
					if (isset($json_decoded['song']['genres']))
						foreach ($json_decoded['song']['genres'] as $genre)
							$this->genres[] = $genre['name'];
					break;
				
				case "appearances":
					
					break;
			}
		}
	}

?>