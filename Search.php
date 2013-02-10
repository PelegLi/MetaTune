<?php 

	require_once "SigGen.php";
	require_once "FactorySearchItem.php";

	class Search
	{
		public $id;
		public $json_decoded;
		public $searchItem;
		public $headers;
		public $response = array();
		
		function __construct($search_value, $idSearch)
		{
			$this->json_decoded = $this->getJSONSearchResults($search_value, $idSearch);
		}
		
		function getJSONSearchResults($search_value, $idSearch)
		{
			$sig = SigGen::createMD5Hash();
			$search_value = str_replace(' ', '+', $_GET["search_value"]);
			$this->setSearchId($sig);
			$this->searchItem = FactorySearchItem::createSearchItem($_GET["searchItems"]);

			foreach ($this->searchItem->dataClusters as $dataCluster)
			{
				$requestString = $this->searchItem->getRequestString($search_value, $sig, $dataCluster, $idSearch);
				
				try
				{
					$this->headers = get_headers($requestString);
					
					if (strpos($this->headers[0], "200"))
					{
						$json_request = @file_get_contents($requestString);
						$this->response["code"] = "200";
						$this->response["status"] = "ok";
						$this->json_decoded = json_decode($json_request, true);
						$this->searchItem->parseJSON($this->json_decoded, $dataCluster);
					}
					
					else if (strpos($this->headers[0], "404"))
					{
						$this->response["code"] = "404";
						$this->response["status"] = "error";
						$this->response["message"] = "$search_value";
					}
					
					else
						throw new Exception($search_value);						
				}
				
				catch (Exception $ex)
				{
					$this->response["code"] = "$this->headers[0]";
					$this->response["status"] = "error";
					$this->response["message"] = $ex->getMessage();
				}
			}
		}
		
		function setSearchId($sig)
		{
			$this->id = $sig;
		}
	}	