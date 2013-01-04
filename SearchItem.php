<?php 

	abstract class SearchItem
	{
		public $id;
		public $sig;
		public $search_value;
		public $dataClusters = array();
		public $genres = array();
		
		abstract public function displayItemData();
		abstract public function parseJSON($json_decoded, $dataCluster);
		
		public function getRequestString($search_value, $sig, $dataCluster, $id)
		{
			$class = strtolower(get_class($this));
			$requestString = "http://api.rovicorp.com/data/v1.1/" . $class . "/" . $dataCluster . "?" . $class . $id . "=" . $search_value . "&duration=10080&inprogress=0&country=US&language=en&format=json&apikey=f52a3zyhzt6ur5zwrz87xfp3&sig=" . $sig;
			return $requestString;
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
		
		public function displayAlbums()
		{
			$count = 1;
			$urlPreFix = "allmusicapi.php?searchItems=Album&idSearch=id&search_value=";
			foreach ($this->albums as $album)
				if (isset($album->id) && isset($album->title) && isset($album->releaseDate))
				{
					echo "<a href=$urlPreFix$album->id>$album->title</a>";
					if ($album->releaseDate)
						echo " - $album->releaseDate";
					if ($count < count($this->albums))
						echo "</br> ";
					$count++;
				}
		}	
		
		public function displayTracks()
		{
			echo "</br>";
			$count = 1;
			$urlPreFix = "allmusicapi.php?searchItems=Track&idSearch=id&search_value=";
			foreach ($this->tracks as $track)
				if (isset($track->id) && isset($track->title))
				{
					echo "<a href=$urlPreFix$track->id>$track->title</a>";
					if ($count < count($this->tracks))
						echo "</br> ";
					$count++;
				}
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
						echo "</br> ";
					$count++;
				}
		}
	}

?>