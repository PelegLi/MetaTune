<?php 

	require_once "SearchItem.php";
	
	class Name extends SearchItem
	{
		private $name;
		private $headline_bio;
		private $genres = array();
		private $birth;
		private $death;
		
		public function __construct()
		{
			parent::setDataClusters(array("info"));
		}
	
		public function displayItemData()
		{
			echo "<h3>$this->name</h3>";
			if ($this->headline_bio != "")
				echo "$this->headline_bio </br>";
			echo "Genres: ";
			$this->printArrayValues($this->genres);
			echo "</br>$this->birth - ";
			echo "$this->death";
		}
		
		public function parseJSON($json_decoded, $dataCluster)
		{
			switch ($dataCluster)
			{
				case "info":
					$this->id = $json_decoded['name']['ids']['nameId'];
					$this->name = $json_decoded['name']['name'];
					$this->headline_bio = $json_decoded['name']['headlineBio'];
					$this->genres = array();
					if (isset($json_decoded['name']['musicGenres']))
						foreach ($json_decoded['name']['musicGenres'] as $genre)
							$this->genres[] = $genre['name'];
					$this->birth = parent::rectifyDate($json_decoded['name']['birth']['date']);
					$this->death = parent::rectifyDate($json_decoded['name']['death']['date']);
					break;
			}
		}
	}
	
?>