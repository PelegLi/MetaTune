<?php 

	abstract class SearchItem
	{
		public $id;
		public $sig;
		public $search_value;
		public $dataClusters = array();
		
		abstract public function displayItemData();
		abstract public function parseJSON($json_decoded, $dataCluster);
		
		public function getRequestString($search_value, $sig, $dataCluster, $id)
		{
			$class = strtolower(get_class($this));
			$requestString = "http://api.rovicorp.com/data/v1.1/" . $class . "/" . $dataCluster . "?" . $class . $id . "=" . $search_value . "&duration=10080&inprogress=0&country=US&language=en&format=json&apikey=f52a3zyhzt6ur5zwrz87xfp3&sig=" . $sig;
			return $requestString;
		}
		
		public function rectifyDate($date)
		{
			if (isset($date) && $date != null)
			{
				$parts = explode("-", $date);
				$date = $parts[0];
			}
			else
				$date = "????";
		
			return $date;
		}
		
		public function setDataClusters($clustersArray)
		{
			foreach ($clustersArray as $cluster)
				$this->dataClusters[] = $cluster; 
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
	}

?>