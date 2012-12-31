<?php 

	require_once "SearchItem.php";
	require_once "Album.php";
	
	class Track extends SearchItem
	{
		public $title;
		public $views;
		public $genres = array();
		public $albums = array();
		public $dataClusters = array("info", "appearances");
		
		public function __construct()
		{
			if (func_num_args() > 0)
			{
				$this->id = func_get_args(0)[0];
				$this->title = func_get_args(0)[1];
			}
		}
		
		public function getRequestString($search_value, $sig, $dataCluster, $id)
		{
			$class = strtolower(get_class($this));
			$requestString = "http://api.rovicorp.com/data/v1.1/song/" . $dataCluster . "?" . $class . $id . "=" . $search_value . "&duration=10080&inprogress=0&country=US&language=en&format=json&apikey=f52a3zyhzt6ur5zwrz87xfp3&sig=" . $sig;
			return $requestString;
		}
		
		public function displayItemData()
		{
			echo "<h3>$this->title</h3>";
			echo "Genres: ";
			$this->printArrayValues($this->genres);
			$this->removeDuplicateAlbums($this->albums);
			echo "</br>Appears in $this->views album";
			if ($this->views > 1) echo "s";
				echo ":</br>";
			$this->displayAlbums();
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
					$this->views = $json_decoded['view']['total'];
					$this->albums = $json_decoded['appearances'];
					if (isset($json_decoded['appearances']))
						foreach ($json_decoded['appearances'] as $album)
						{
							$newAlbum = new Album($album['ids']['albumId'], $album['title'], $album['year']);
							$this->albums[] = $newAlbum;
						}
					break;
			}
		}
		
		public function removeDuplicateAlbums($albums)
		{
			usort($this->albums, function($a, $b)
			{
				if (isset($a->id) && isset($b->id))
					return strcmp($a->id, $b->id);
			});
			
			for ($i = 0; $i < count($this->albums) - 1; $i += 1)
			{
				if (isset($this->albums[$i]->id) && isset($this->albums[$i+1]->id))
					if ($this->albums[$i]->id == $this->albums[$i+1]->id)
					{
						unset($this->albums[$i]);
						$this->views -= 1;
					}
			}
		}
	}

?>