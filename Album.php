<?php 

	require_once "SearchItem.php";
	
	class Album extends SearchItem
	{
		private $title;
		private $releaseDate;
		private $genres = array();
		//private $tracks = array();
		
		public function __construct()
		{
			parent::setDataClusters(array("info", "releases"));
		}

		public function displayItemData()
		{
			echo "<h3>$this->title</h3>";
			echo "Release date: $this->releaseDate </br>";
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
					$this->id = $json_decoded['album']['ids']['albumId'];
					$this->title = $json_decoded['album']['title'];
					$this->genres = array();
					if (isset($json_decoded['album']['genres']))
						foreach ($json_decoded['album']['genres'] as $genre)
							$this->genres[] = $genre['name'];
					$this->releaseDate = $json_decoded['album']['originalReleaseDate'];
					break;
					
				case "releases":
					
					break;
			}
		}
	}

?>