
function filter()
{

    var el = document.querySelectorAll('#view table tbody tr');
        el.forEach(function (value, index) {
            value.remove();
        });

	var filter  =  document.querySelector('[name="catagory"]').value;
	console.log(filter);
	if(filter != '0')
	{
       var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../services/seller_orderlist.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send('filter='+filter);
        xhttp.onreadystatechange = function (){
            if(this.readyState == 4 && this.status == 200){
                var res = this.responseText;
                if(res != '' && res != "not found" && res != "not ok"){ 
                    var results = JSON.parse(res);
                    if (results.length) {
                        results.forEach(function (value, index) {
                            var tr = document.createElement('tr');
                            for (const [k, v] of Object.entries(value)) {
                                var td = document.createElement('td');
                                var txt = document.createTextNode(v);
                                td.appendChild(txt);
                                tr.appendChild(td);
                            }
                            document.querySelector('#view table tbody').appendChild(tr);
                        });
                    }
                }
                else {
                    console.log(res);
                }
            }   
        }
	}




}

function saveToDraft() {
    var s_id = document.querySelector('#add [name="service"]').getAttribute("val");
    var details = document.querySelector('#add [name="details"]').value;
    var price = document.querySelector('#add [name="price"]').value;
    var c_id = document.querySelector('#add [name="catagory"]').value;
    if ((s_id != '') && (details != '') && (price != '') && (c_id != '')) {
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../services/insertDraft.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send('s_id=' + s_id + '&details=' + details + '&price=' + price + '&catagory=' + c_id);
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var res = this.responseText;
                if (res == 'insert') {
                    document.querySelector('#add form').reset();
                } else {}
            }
        }
    }
}

function sellerDraftupdate() {
    var us_id = serviceId;
    var details = document.querySelector('#edit>form [name="details"]').value;
    var price = document.querySelector('#edit>form [name="price"]').value;

    if ((details != '') && (price != '') && (us_id != '')) {
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../services/updateSellerDraft.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send('us_id=' + us_id + '&details=' + details + '&price=' + price);
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var res = this.responseText;
                if (res == 'update') {
                    document.querySelector('#edit>form').reset();
                    location.reload();
                } else {}
            }
        }
    }
}

function sellerDraftEdit() {
    var inputElements = document.querySelectorAll('[name="selector"]');
    for (var i = 0; inputElements[i]; ++i) {
        if (inputElements[i].checked) {
            checkedValue = inputElements[i].value;
            break;
        }
    }
    if (checkedValue != null) {
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../services/getDraftEditServices.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send('us_id=' + checkedValue);

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText != "") {
                    var val = this.responseText.split("|");
                    serviceId = val[0];
                    document.querySelector('#edit>form [name="details"]').value = val[1];
                    document.querySelector('#edit>form [name="price"]').value = val[2];
                    document.querySelector('table[changeValue]').setAttribute("changeValue", "2");
                } else {
                    location.reload();
                }
            }
        }
    } else {
        document.querySelector('table[changeValue]').setAttribute("changeValue", "5");
    }
}

function sellerEditServices(){
    console.log('work');
    var inputElements = document.querySelectorAll('[name="selector"]');
    var usType = document.querySelector('#edit h1').getAttribute("usType");
    for (var i = 0; inputElements[i]; ++i) {
        if (inputElements[i].checked) {
            checkedValue = inputElements[i].value;
            break;
        }
    }
    console.log(checkedValue);
    if (checkedValue != null) {
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../services/getEditUserService.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send('draft=' + usType + '&us_id=' + checkedValue);

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                if (this.responseText != "") {
                    var val = this.responseText.split("|");
                    console.log(val);
                    serviceId = val[0];
                    document.querySelector('#edit>form [name="name"]').value = val[1];
                    document.querySelector('#edit>form [name="details"]').value = val[2];
                    document.querySelector('#edit>form [name="price"]').value = val[3];
                    document.querySelector('#edit>form [name="catagory"]').selectedIndex = val[4]-1;
                    document.querySelector('table[changeValue]').setAttribute("changeValue", "2");
                } else {
                    location.reload();
                }
            }
        }
    } else {
        document.querySelector('table[changeValue]').setAttribute("changeValue", "5");
    }
}


sellerDraftupdate(){

    var us_id = serviceId;
    var usType = document.querySelector('#edit h1').getAttribute("usType");
    console.log(usType);
    var details = document.querySelector('#edit>form [name="details"]').value;
    var price = document.querySelector('#edit>form [name="price"]').value;
    if ((details != '') && (price != '') && (us_id != '')) {
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../services/updateUSellerDraft.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send('draft='+usType+'&us_id=' + us_id + '&details=' + details + '&price=' + price);
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var res = this.responseText;
                console.log(res);
                if (res == '[update') {
                    document.querySelector('#edit>form').reset();
                    location.reload();
                } else {}
            }
        }
    }
}