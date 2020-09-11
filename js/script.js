function validateMyForm(){
    return false;
}

function view(clicked){
    var id = clicked.getAttribute('data-id');
    location.assign('viewServices.php?uid=' + encodeURIComponent(id));
}

function Search(){
    var el = document.querySelectorAll('#searchResult tbody tr');
    el.forEach(function (value, index) {
        value.remove();
    });
    var search = document.querySelector('[name="search"]').value.trim();
    var type = document.querySelector('[name="type"]').value.trim();

    if((search != '') && (type != '')){
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../services/serach.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send('search='+search+'&type='+type);
        xhttp.onreadystatechange = function (){
            if(this.readyState == 4 && this.status == 200){
                var res = this.responseText;
                if(res != '' && res != "not found" && res != "not ok"){
                    document.getElementById("searchResult").classList.add('active');
                    var results = JSON.parse(res);
                    console.log(results);
                    if (results.length) {
                        results.forEach(function (value, index) {
                            var tr = document.createElement('tr');
                            tr.setAttribute("onclick", "view(this)");
                            for (const [k, v] of Object.entries(value)) {
                                if(k != 'u_id'){
                                    var td = document.createElement('td');
                                    var txt = document.createTextNode(v);
                                    td.appendChild(txt);
                                    tr.appendChild(td);
                                }
                            }
                            tr.setAttribute("data-id", value.u_id);
                            document.querySelector('#searchResult tbody').appendChild(tr);
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

function checkSearch(){
    var search = document.querySelector('[name="search"]').value.trim();
    if(search == ''){
        document.getElementById("searchResult").classList.remove('active');
        var el = document.querySelectorAll('#searchResult tbody tr');
        el.forEach(function (value, index) {
            value.remove();
        });
    }
}