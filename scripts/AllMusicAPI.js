var searchItems = ["Name", "Track", "Album"];
window.onload = init;

function init()
{
	defineSelectedSearchItem();
}

function getSearchItems()
{
	var input, label;
	var selectElement = document.getElementById("searchItems");
	
	for (item in searchItems) {
		input = document.createElement("input");
		input.type = "radio";
		input.name = "searchItems";
		input.id = searchItems[item];
		input.value = searchItems[item];
		input.checked = "<?php if (isChecked('" + searchItems[item] + "')) echo 'checked'; ?>";
		selectElement.appendChild(input);
		label = document.createElement("label");
		label.for = searchItems[item];
		label.innerText = searchItems[item];
		label.title = searchItems[item];
		selectElement.appendChild(label);		
	}
}

function getSelectedItem()
{
    var searchItems = document.getElementsByName('searchItems');
	
    for (var i=0; i<searchItems.length; i++)
    	if(searchItems[i].checked)
    		return searchItems[i].value;
    return null;
}

function chooseSearchItem(id)
{
	var parent = document.getElementById("searchItems");
	var images = parent.getElementsByTagName("img");
	var inputs = parent.getElementsByTagName("input");
	
	for (var i=0; i<images.length; i++)
		images[i].className = images[i].id == id ? "checked" : "";	
}

function defineSelectedSearchItem()
{
	var url = document.URL;
	var n = url.indexOf("searchItems");
	if (n > 0)
	{
		n += "searchItems".length + 1;
		item = url.charAt(n);
		item = item == 'N' ? url.substr(n,4) : url.substr(n,5);
	}
	else	
		item = "Name";
		
	var currentItem = document.getElementById(item + "Image");
	currentItem.className = "checked";
}