function checkURL(e) {
	var type = e.getAttribute('data-type');
	var url = e.value + "&&" + type + "&&" + '0';
	var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				controller = document.getElementById(type);
				controller.innerHTML = this.responseText;
 			}
		}
	xmlhttp.open("POST", "main/urlProc/" + url, true);
	xmlhttp.send();
}

function saveURL() {
	var url = document.getElementById('input_full').value;
	var user = document.getElementById('input_short').value;
	var controller = document.getElementById('res');
	//If User haven't insert short link
	//App get 0 and Know that User URL is empty
	if (!url) {
		controller.innerHTML = "There is no any URL";
		return 0;
	} else if (user || url) {
		url = url + "&&" + user + "&&" + '1';
	} else {
		url = url + "&&0&&1"; 
	}
	var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				controller.innerHTML = this.responseText;
 			}
		}
	xmlhttp.open("POST", "main/urlProc/" + url, true);
	xmlhttp.send();
}