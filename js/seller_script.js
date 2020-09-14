
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