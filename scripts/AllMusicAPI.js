var searchItems = ["Name", "Track", "Album"];

function getSearchItems() {
	
	var option;
	var selectElement = document.getElementById("searchItems");
	
	for (item in searchItems) {
		option = document.createElement("option");
		option.value = searchItems[item];
		option.innerText = searchItems[item];
		selectElement.appendChild(option);
	}
}