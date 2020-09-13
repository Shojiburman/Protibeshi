filter();
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
                console.log(filter);
                console.log(res);
                if(res != '' && res != "not found" && res != "not ok"){ 
                    var results = JSON.parse(res);
                    console.log(results);
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