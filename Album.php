<?php 

	require_once "SearchItem.php";
	
	class Album extends SearchItem
	{
		public $title;
		public $artists = array();
		public $releaseDate;
		private $genres = array();
		//private $tracks = array();
		
		public function __construct()
		{
			parent::setDataClusters(array("info", "releases"));
			if (func_num_args() > 0)
			{
				$this->id = func_get_args(0)[0];
				$this->title = func_get_args(0)[1];
				$this->releaseDate = func_get_args(0)[2];
			}
		}

		public function displayItemData()
		{
			echo "<h3>$this->title</h3>";
			$this->printArrayValues($this->artists);
			echo "</br>Release date: $this->releaseDate </br>";
			echo "Genres: ";
			$this->printArrayValues($this->genres);	
		}
		
		public function parseJSON($json_decoded, $dataCluster)
		{
			switch ($dataCluster)
			{
				case "info":
					$this->id = $json_decoded['album']['ids']['albumId'];
					$this->title = $json_decoded['album']['title'];
					if (isset($json_decoded['album']['primaryArtists']))
						foreach ($json_decoded['album']['primaryArtists'] as $artist)
							$this->artists[] = $artist['name'];
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