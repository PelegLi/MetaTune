<?php 

	include_once "../dostuff.php";
	require_once "Search.php";
	
?>

<!DOCTYPE html>
<html>

	<head>
		
		<meta charset="utf-8">
		<link rel="shortcut icon" href="../tigerrabbit.png" />
		<link rel="Stylesheet" href="../portfolio.css"/>
		<script src="scripts/AllMusicAPI.js"></script>
		<title>AllMusic.com API</title>
				
	</head>
	
	<body>
	
	<div id="main">
	
		<form method="get">
			
			<p>Search for: 
				<select id="searchItems" name="searchItems">
					<script>getSearchItems();</script>
				</select>
			
			<input type="text" name="search_value"/>
			<input type="submit" value="Search"/></p>					
		
		</form>
	
		<?php 
		
			if (isset($_GET["search_value"]) && ($_GET["search_value"]) != "")
			{
				$idSearch = isset($_GET["idSearch"]) ? "id" : "";
				$search = new Search($_GET["search_value"], $idSearch);				
				$search->searchItem->displayItemData();
			}
			
			/* TODO:
			 * 
			 * Display only artists' "real" albums on the artist view.
			 * Invert discography from old to new.
			 * Manage 404 error for bad search.
			 * 
			 */

		?>
		
	</div>
	
	</body>
	
</html>
