window.addEventListener('DOMContentLoaded', (event) => {
	document.querySelector('#view table tr').onclick = function() { 
    	document.querySelector('#view table tr').classList.add("selected");
	}
});