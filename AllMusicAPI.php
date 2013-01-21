<?php 

	require_once "Search.php";
	require_once "HelpFunctions.php";
	
?>

<!DOCTYPE html>
<html>

	<head>
		
		<meta charset="utf-8">
		<link rel="shortcut icon" href="images/tigerrabbit.png" />
		<link rel="Stylesheet" href="style/AllMusicAPI.css"/>
		<script src="scripts/AllMusicAPI.js"></script>
		<title>AllMusic.com API</title>
				
	</head>
	
	<body>
		
		<div id="main">
		
			<form method="get">
					
					<fieldset id="searchItems">						
						<input type="radio" name="searchItems" value="Name" id="Name" title="Name" checked />
						<label for="Name"><img id="NameImage" alt="Name" src="images/name.png" onclick=chooseSearchItem(this.id);></label>
						<input type="radio" name="searchItems" value="Track" id="Track" title="Track" <?php if (isChecked("Track")) echo "checked"; ?> />
						<label for="Track"><img id="TrackImage" alt="Track" src="images/track.png" onclick=chooseSearchItem(this.id);></label>
						<input type="radio" name="searchItems" value="Album" id="Album" title="Album" <?php if (isChecked("Album")) echo "checked"; ?> />
						<label for="Album"><img id="AlbumImage" alt="Album" src="images/album.png" onclick=chooseSearchItem(this.id);></label>
					</fieldset>
				
					<div id="searchBox" >
						<input id="search" type="text" name="search_value"/>
						<input id="submit" type="submit" value="Search"/>				
					</div>					
			
			</form>
		
			<?php 
			
				if (isset($_GET["search_value"]) && ($_GET["search_value"]) != "")
				{
					$idSearch = isset($_GET["idSearch"]) ? "id" : "";
					$search = new Search($_GET["search_value"], $idSearch);	
					$search->searchItem->loadView($search->response);
				}
				
				/* TODO:
				 * 
				 * Display only artists' official albums on the artist view.
				 * Invert discography from old to new.
				 * 
				 */

			?>
			
		</div>
		
	</body>
	
</html>
