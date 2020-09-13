var checkedValue = "";
var flagCheckedValue = [];
var serviceId = "";
var msg = '';
var profileEmail;

function profileEmailPreventEdit() {
    if (document.getElementById('profile-section')) {
        document.querySelector('#profile-section [name="email"]').addEventListener("keydown", function(event) {
            event.preventDefault();
        }, false);
        profileEmail = document.querySelector('#profile-section [name="email"]').value.trim();
    }
}

function viewDervices() {
    if (document.querySelectorAll('#view-service-see-more')) {
        var el = document.querySelectorAll('#view-service-see-more div');
        el.forEach(function(value, index) {
            value.remove();
        });
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../services/seeMoreServices.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var res = this.responseText;
                if (res != '' && res != "not found" && res != "not ok") {
                    var results = JSON.parse(res);
                    if (results.length) {
                        results.forEach(function(value, index) {
                            var div = document.createElement('div');
                            div.setAttribute("class", "see-more-service");
                            var innerDiv = document.createElement('div');
                            div.appendChild(innerDiv);
                            for (const [k, v] of Object.entries(value)) {
                                if ((k != 'u_id') && (k != 'us_id')) {
                                    if (k == 'sname') {
                                        var h1 = document.createElement('h1');
                                        var txt = document.createTextNode(v);
                                        h1.appendChild(txt);
                                        div.insertBefore(h1, innerDiv);
                                    } else if (k == 'details') {
                                        var p = document.createElement('p');
                                        var txt = document.createTextNode(v);
                                        p.appendChild(txt);
                                        div.appendChild(p);
                                    } else if ((k == 'name')) {
                                        var p = document.createElement('p');
                                        p.setAttribute("class", "sub-title");
                                        p.setAttribute("data-uid", value.u_id);
                                        p.setAttribute("onclick", "browseUser(this)");
                                        p.classList.add('cursor');
                                        var txt = document.createTextNode(v);
                                        p.appendChild(txt);
                                        innerDiv.appendChild(p);
                                    } else if ((k == 'catagory') || (k == 'price')) {
                                        var p = document.createElement('p');
                                        p.setAttribute("class", "sub-title");
                                        var txt = document.createTextNode(v);
                                        p.appendChild(txt);
                                        innerDiv.appendChild(p);
                                    }
                                }
                            }
                            div.setAttribute("data-id", value.us_id);
                            document.querySelector('#view-service-see-more').appendChild(div);
                        });
                    }
                } else {
                    console.log('not ok');
                }
            }
        }
    }
}

function browseUser(p) {
    var id = p.getAttribute('data-uid');
    location.assign('viewProfile.php?uid=' + encodeURIComponent(id));
}

function back() {
    window.history.back();
}

function editEmailPrevent() {
    document.querySelector('#profile-section [name="email"]').preventDefault();
}

function validateMyForm() {
    return false;
}

function view(clicked) {
    var id = clicked.getAttribute('data-id');
    location.assign('viewServices.php?uid=' + encodeURIComponent(id));
}

function Search() {
    document.getElementById("see-more").classList.remove('de-active');

    var search = document.querySelector('[name="search"]').value.trim();
    var type = document.querySelector('[name="type"]').value.trim();

    if (type != '') {
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../services/searchService.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send('type=' + type + '&search=' + search);
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var res = this.responseText;

                if (res != '' && res != "not found" && res != "not ok") {
                    //document.getElementById("see-more").classList.add('active');
                    var results = JSON.parse(res);

                    if (results.length) {
                        results.forEach(function(value, index) {
                            var div = document.createElement('div');
                            div.setAttribute("class", "see-more-service");
                            var innerDiv = document.createElement('div');
                            div.appendChild(innerDiv);
                            for (const [k, v] of Object.entries(value)) {
                                if (k != 'u_id') {
                                    if (k == 'sname') {
                                        var h1 = document.createElement('h1');
                                        var txt = document.createTextNode(v);
                                        h1.appendChild(txt);
                                        div.insertBefore(h1, innerDiv);
                                    } else if (k == 'details') {
                                        var p = document.createElement('p');
                                        var txt = document.createTextNode(v);
                                        p.appendChild(txt);
                                        div.appendChild(p);
                                    } else if ((k == 'name') || (k == 'catagory') || (k == 'price')) {
                                        var p = document.createElement('p');
                                        p.setAttribute("class", "sub-title");
                                        var txt = document.createTextNode(v);
                                        p.appendChild(txt);
                                        innerDiv.appendChild(p);
                                    }
                                }
                            }
                            div.setAttribute("data-id", value.u_id);
                            document.querySelector('#see-more').appendChild(div);
                        });
                    }
                } else {
                    console.log('not ok');
                }
            }
        }
    }
}

function checkSearch() {
    if (document.querySelector('[name="search"]')) {
        var search = document.querySelector('[name="search"]').innerHTML;
        if (search == '') {
            document.getElementById("see-more").classList.add('de-active');
            var el = document.querySelectorAll('#see-more>div');
            el.forEach(function(value, index) {
                value.remove();
            });
        }
    }
}

function fun1() {
    document.querySelector('table[changeValue]').setAttribute("changeValue", "1");
}

function fun2() {
    var inputElements = document.querySelectorAll('[name="selector"]');
    for (var i = 0; inputElements[i]; ++i) {
        if (inputElements[i].checked) {
            checkedValue = inputElements[i].value;
            break;
        }
    }
    if (checkedValue != null) {
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../services/getEditService.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send('s_id=' + checkedValue);

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText != "") {
                    var val = this.responseText.split("|");
                    serviceId = val[0];
                    document.querySelector('#edit>form [name="name"]').value = val[1];
                    document.querySelector('#edit>form [name="details"]').value = val[2];
                    document.querySelector('#edit>form [name="catagory"]').selectedIndex = val[3] + 1;
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

function fun3() {
    var inputElements = document.querySelectorAll('[name="selector"]');
    for (var i = 0; inputElements[i]; ++i) {
        if (inputElements[i].checked) {
            var valu = inputElements[i].value;
            flagCheckedValue.push(valu);
        }
    }
    if (flagCheckedValue != "") {
        document.querySelector('table[changeValue]').setAttribute("changeValue", "3");
    } else {
        location.reload();
    }
}

function fun4() {
    var inputElements = document.querySelectorAll('[name="selector"]');
    for (var i = 0; inputElements[i]; ++i) {
        if (inputElements[i].checked) {
            var valu = inputElements[i].value;
            flagCheckedValue.push(valu);
        }
    }
    if (flagCheckedValue != "") {
        document.querySelector('table[changeValue]').setAttribute("changeValue", "4");
    } else {
        location.reload();
    }
}

function fun5() {
    location.reload();
    document.querySelector('table[changeValue]').setAttribute("changeValue", "5");
}

function createService() {
    var name = document.querySelector('#add [name="name"]').value;
    var details = document.querySelector('#add [name="details"]').value;
    var c_id = document.querySelector('#add [name="catagory"]').value;
    if ((name != '') && (details != '') && (c_id != '')) {

        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../services/insertService.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send('name=' + name + '&details=' + details + '&catagory=' + c_id);
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var res = this.responseText;

                if (res == 'insert') {
                    document.querySelector('#add>form').reset();
                } else {}
            }
        }
    }
}

function deleteService() {
    if (flagCheckedValue != null) {
        for (var i = 0; i < flagCheckedValue.length; i++) {
            var xhttp = new XMLHttpRequest();
            xhttp.open('POST', '../services/deleteService.php', true);
            xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhttp.send('s_id=' + flagCheckedValue[i]);

            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {

                    if (this.responseText == "delete") {
                        location.reload();
                    }
                }
            }
        }
        location.reload();
    } else {
        location.reload();
    }
}

function updateService() {
    var s_id = serviceId;
    var name = document.querySelector('#edit>form [name="name"]').value.trim();
    var details = document.querySelector('#edit>form [name="details"]').value.trim();
    var c_id = document.querySelector('#edit>form [name="catagory"]').value.trim();

    if ((name != '') && (details != '') && (s_id != '') && (c_id != '')) {
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../services/updateService.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send('s_id=' + s_id + '&name=' + name + '&details=' + details + '&catagory=' + c_id);
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var res = this.responseText;
                if (res == 'update') {
                    location.reload();
                } else {}
            }
        }
    } else {
        console.log('emty data');
    }
}

function flagedService() {
    var flag = document.querySelector('#flag>form [name="flag"]').value;
    for (var i = 0; i < flagCheckedValue.length; i++) {
        var s_id = flagCheckedValue[i];

        if ((flag != '') && (s_id != '')) {
            var xhttp = new XMLHttpRequest();
            xhttp.open('POST', '../services/flagService.php', true);
            xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhttp.send('s_id=' + s_id + '&flag=' + flag);
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var res = this.responseText;
                    if (res == 'flaged') {
                        document.querySelector('#flag>form').reset();
                    } else {}
                }
            }
        }
    }
    location.reload();
}

function addfun1() {
    document.querySelector('table[changeValue]').setAttribute("changeValue", "1");
}

function editfun2() {
    var inputElements = document.querySelectorAll('[name="selector"]');
    for (var i = 0; inputElements[i]; ++i) {
        if (inputElements[i].checked) {
            checkedValue = inputElements[i].value;
            break;
        }
    }
    if (checkedValue != null) {
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../services/getEditUser.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send('u_id=' + checkedValue);

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText != "") {
                    var val = this.responseText.split("|");
                    serviceId = val[0];
                    document.querySelector('#edit>form [name="name"]').value = val[1];
                    document.querySelector('#edit>form [name="email"]').value = val[2];
                    document.querySelector('#edit>form [name="password"]').value = val[3];
                    document.querySelector('#edit>form [name="utype"]').selectedIndex = val[4];
                    document.querySelector('table[changeValue]').setAttribute("changeValue", "2");
                } else {

                }
            }
        }
    } else {
        document.querySelector('table[changeValue]').setAttribute("changeValue", "5");
    }
}

function flagfun3() {
    var inputElements = document.querySelectorAll('[name="selector"]');
    for (var i = 0; inputElements[i]; ++i) {
        if (inputElements[i].checked) {
            var valu = inputElements[i].value;
            flagCheckedValue.push(valu);
        }
    }
    if (flagCheckedValue != "") {
        document.querySelector('table[changeValue]').setAttribute("changeValue", "3");
    } else {

    }
}

function deletefun4() {
    var inputElements = document.querySelectorAll('[name="selector"]');
    for (var i = 0; inputElements[i]; ++i) {
        if (inputElements[i].checked) {
            var valu = inputElements[i].value;
            flagCheckedValue.push(valu);
        }
    }
    if (flagCheckedValue != "") {
        document.querySelector('table[changeValue]').setAttribute("changeValue", "4");
    } else {

    }
}

function viewfun5() {

    document.querySelector('table[changeValue]').setAttribute("changeValue", "5");
}

function createUsers() {
    var name = document.querySelector('#add [name="name"]').value;
    var email = document.querySelector('#add [name="email"]').value;
    var password = document.querySelector('#add [name="password"]').value;
    var utype = document.querySelector('#add [name="utype"]').value;
    if ((name != '') && (email != '') && (password != '') && (utype != '')) {
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../services/insertUser.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send('name=' + name + '&email=' + email + '&password=' + password + '&utype=' + utype);
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var res = this.responseText;
                if (res == 'insert') {
                    document.querySelector('#form').reset();
                } else {}
            }
        }
    }
}

function deleteUsers() {
    if (flagCheckedValue != null) {
        for (var i = 0; i < flagCheckedValue.length; i++) {
            var xhttp = new XMLHttpRequest();
            xhttp.open('POST', '../services/deleteUser.php', true);
            xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhttp.send('u_id=' + flagCheckedValue[i]);

            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {

                    if (this.responseText == "delete") {
                        document.querySelector('table[changeValue]').setAttribute("changeValue", "5");
                        location.reload();
                    }
                }
            }
        }
    } else {

    }
}

function updateUsers() {
    var u_id = serviceId;
    var name = document.querySelector('#edit>form [name="name"]').value;
    var email = document.querySelector('#edit>form [name="email"]').value;
    var password = document.querySelector('#edit>form [name="password"]').value;
    var utype = document.querySelector('#edit>form [name="utype"]').value;

    if ((name != '') && (email != '') && (password != '') && (utype != '') && (u_id != '')) {
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../services/updateUser.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send('u_id=' + u_id + '&name=' + name + '&email=' + email + '&password=' + password + '&utype=' + utype);
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var res = this.responseText;

                if (res == 'update') {
                    document.querySelector('#edit>form').reset();
                    document.querySelector('table[changeValue]').setAttribute("changeValue", "5");
                    location.reload();
                } else {}
            }
        }
    }
}

function flagedUsers() {
    var flag = document.querySelector('#flag>form [name="flag"]').value;

    for (var i = 0; i < flagCheckedValue.length; i++) {
        var u_id = flagCheckedValue[i];
        if ((flag != '') && (u_id != '')) {
            var xhttp = new XMLHttpRequest();
            xhttp.open('POST', '../services/flagUser.php', true);
            xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhttp.send('u_id=' + u_id + '&flag=' + flag);
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var res = this.responseText;
                    if (res == 'flaged') {
                        document.querySelector('#flag>form').reset();
                        document.querySelector('table[changeValue]').setAttribute("changeValue", "5");
                        location.reload();
                    } else {}
                }
            }
        }
    }
}

function Changeclick() {
    location.assign('changePass.php');
}

function updateProfile() {
    var u_id = document.querySelector('[name="id"]').value;
    var name = document.querySelector('[name="name"]').value;
    var email = document.querySelector('[name="email"]').value;
    var work = document.querySelector('[name="work"]').value;
    var number = document.querySelector('[name="pnumber"]').value;
    var address = document.querySelector('[name="address"]').value;
    var dob = document.querySelector('[name="dob"]').value;
    var bio = document.querySelector('[name="bio"]').value;

    var data = {
        'u_id': u_id,
        'name': name,
        'work': work,
        'number': number,
        'address': address,
        'dob': dob,
        'bio': bio
    };

    data = JSON.stringify(data);

    var xhttp = new XMLHttpRequest();
    xhttp.open('POST', '../services/profile.php', true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send('json=' + data);

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var res = this.responseText;
            if (res == 'update') {
                document.getElementById('msg').classList.add('g');
                document.getElementById('msg').innerHTML = 'Successfully Updated';
                document.querySelector('#profile-section [name="email"]').value = profileEmail;
                //location.reload();
            } else {
                document.getElementById('msg').classList.add('r');
                document.getElementById('msg').innerHTML = 'Try again';
            }
        }
    }
}

function ChangeclickProfile() {
    location.assign('profile.php');
}

function Pass() {
    var msg = '';
    var pass = document.querySelector('[name="pass"]').value.trim();
    if (pass != '') {
        msg = 'Success!';
    } else {
        msg = '*Password can not be empty';
    }
    if (msg != 'Success!') {
        document.getElementById('passMsg').innerHTML = msg;
        document.querySelector('[name="pass"]').classList.add('rb');
        document.querySelector('[name="pass"]').classList.remove('gb');
        document.getElementById('passMsg').classList.add('r');
    } else {
        document.getElementById('passMsg').innerHTML = '';
        document.getElementById('msg').innerHTML = '';
        document.getElementById('passMsg').classList.add('g');
        document.querySelector('[name="pass"]').classList.remove('rb');
        document.querySelector('[name="pass"]').classList.add('gb');
    }
}

function nPass() {
    var msg = '';
    var pass = document.querySelector('[name="npass"]').value.trim();
    if (pass != '') {
        msg = 'Success!';
    } else {
        msg = '*New Password can not be empty';
    }
    if (msg != 'Success!') {
        document.getElementById('npassMsg').innerHTML = msg;
        document.querySelector('[name="npass"]').classList.add('rb');
        document.querySelector('[name="npass"]').classList.remove('gb');
        document.getElementById('npassMsg').classList.add('r');
    } else {
        document.getElementById('npassMsg').innerHTML = '';
        document.getElementById('msg').innerHTML = '';
        document.getElementById('npassMsg').classList.add('g');
        document.querySelector('[name="npass"]').classList.remove('rb');
        document.querySelector('[name="npass"]').classList.add('gb');
    }
}

function cPass() {
    var msg = '';
    var pass = document.querySelector('[name="cpass"]').value.trim();
    if (pass != '') {
        msg = 'Success!';
    } else {
        msg = '*Confirm Password can not be empty';
    }
    if (msg != 'Success!') {
        document.getElementById('cpassMsg').innerHTML = msg;
        document.querySelector('[name="cpass"]').classList.add('rb');
        document.querySelector('[name="cpass"]').classList.remove('gb');
        document.getElementById('cpassMsg').classList.add('r');
    } else {
        document.getElementById('cpassMsg').innerHTML = '';
        document.getElementById('msg').innerHTML = '';
        document.getElementById('cpassMsg').classList.add('g');
        document.querySelector('[name="cpass"]').classList.remove('rb');
        document.querySelector('[name="cpass"]').classList.add('gb');
    }
}

function changePass() {
    var u_id = document.querySelector('[name="u_id"]').value;
    var pass = document.querySelector('[name="pass"]').value;
    var npass = document.querySelector('[name="npass"]').value;
    var cpass = document.querySelector('[name="cpass"]').value;

    if (u_id != '' && pass != '' && npass != '' && cpass != '') {
        var data = {
            'u_id': u_id,
            'pass': pass,
            'npass': npass,
            'cpass': cpass
        };

        data = JSON.stringify(data);

        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../services/changePass.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send('json=' + data);

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var res = this.responseText;
                if (res == 'update') {
                    document.getElementById('msg').classList.add('g');
                    document.getElementById('msg').classList.remove('r');
                    document.getElementById('msg').innerHTML = 'Successfully Updated';
                    //location.reload();
                } else if (res == 'dont match') {
                    document.getElementById('msg').classList.add('r');
                    document.getElementById('msg').innerHTML = 'Confirm password and new password don not match';
                } else if (res == 'match') {
                    document.getElementById('msg').classList.add('r');
                    document.getElementById('msg').innerHTML = 'Confirm password or new password can not be match with your current password';
                } else {
                    document.getElementById('msg').classList.add('r');
                    document.getElementById('msg').innerHTML = 'Try again';
                }
            }
        }
    } else {
        document.querySelector('[name="pass"]').classList.remove('gb');
        document.querySelector('[name="npass"]').classList.remove('gb');
        document.querySelector('[name="cpass"]').classList.remove('gb');
        document.querySelector('[name="pass"]').classList.add('rb');
        document.querySelector('[name="npass"]').classList.add('rb');
        document.querySelector('[name="cpass"]').classList.add('rb');
        document.getElementById('msg').classList.add('r');
        document.getElementById('msg').innerHTML = '*All fields are required';
    }
}

function FAQfun1() {
    document.querySelector('table[changeValue]').setAttribute("changeValue", "1");
}

function FAQfun2() {
    var inputElements = document.querySelectorAll('[name="selector"]');
    for (var i = 0; inputElements[i]; ++i) {
        if (inputElements[i].checked) {
            checkedValue = inputElements[i].value;
            break;
        }
    }
    if (checkedValue != null) {
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../services/getEditFaq.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send('f_id=' + checkedValue);

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText != "") {
                    var val = this.responseText.split("|");
                    serviceId = val[0];
                    document.querySelector('#edit>form [name="name"]').value = val[1];
                    document.querySelector('#edit>form [name="ans"]').value = val[2];
                    document.querySelector('#edit>form [name="date"]').value = val[3];
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

function FAQfun3() {
    var inputElements = document.querySelectorAll('[name="selector"]');
    for (var i = 0; inputElements[i]; ++i) {
        if (inputElements[i].checked) {
            var valu = inputElements[i].value;
            flagCheckedValue.push(valu);
        }
    }
    if (flagCheckedValue != "") {
        document.querySelector('table[changeValue]').setAttribute("changeValue", "3");
    } else {
        location.reload();
    }
}

function FAQfun4() {
    var inputElements = document.querySelectorAll('[name="selector"]');
    for (var i = 0; inputElements[i]; ++i) {
        if (inputElements[i].checked) {
            var valu = inputElements[i].value;
            flagCheckedValue.push(valu);
        }
    }
    if (flagCheckedValue != "") {
        document.querySelector('table[changeValue]').setAttribute("changeValue", "4");
    } else {
        location.reload();
    }
}

function FAQfun5() {
    location.reload();
    document.querySelector('table[changeValue]').setAttribute("changeValue", "5");
}

function FAQcreate() {
    var name = document.querySelector('#add [name="name"]').value;
    var ans = document.querySelector('#add [name="ans"]').value;
    var date = document.querySelector('#add [name="date"]').value;
    if ((name != '') && (ans != '') && (date != '')) {
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../services/insertFaq.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send('name=' + name + '&ans=' + ans + '&date=' + date);
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var res = this.responseText;
                if (res == 'insert') {
                    document.querySelector('#form').reset();
                } else {}
            }
        }
    }
}

function FAQDelete() {
    if (flagCheckedValue != null) {
        for (var i = 0; i < flagCheckedValue.length; i++) {
            var xhttp = new XMLHttpRequest();
            xhttp.open('POST', '../services/deleteFaq.php', true);
            xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhttp.send('f_id=' + flagCheckedValue[i]);

            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {

                    if (this.responseText == "delete") {}
                }
            }
        }
        location.reload();
    } else {
        location.reload();
    }
}

function FAQupdate() {
    var f_id = serviceId;
    var name = document.querySelector('#edit>form [name="name"]').value;
    var ans = document.querySelector('#edit>form [name="ans"]').value;
    var date = document.querySelector('#edit>form [name="date"]').value;

    if ((name != '') && (ans != '') && (date != '') && (f_id != '')) {
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../services/updateFaq.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send('f_id=' + f_id + '&name=' + name + '&ans=' + ans + '&date=' + date);
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

function FAQflaged() {
    var flag = document.querySelector('#flag>form [name="flag"]').value;
    for (var i = 0; i < flagCheckedValue.length; i++) {
        var f_id = flagCheckedValue[i];
        if ((flag != '') && (f_id != '')) {
            var xhttp = new XMLHttpRequest();
            xhttp.open('POST', '../services/flagFaq.php', true);
            xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhttp.send('f_id=' + f_id + '&flag=' + flag);
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var res = this.responseText;
                    if (res == 'flaged') {
                        document.querySelector('#flag>form').reset();
                    } else {}
                }
            }
        }
    }
    location.reload();
}

function COUfun1() {
    document.querySelector('table[changeValue]').setAttribute("changeValue", "1");
}

function COUfun2() {
    var inputElements = document.querySelectorAll('[name="selector"]');
    for (var i = 0; inputElements[i]; ++i) {
        if (inputElements[i].checked) {
            checkedValue = inputElements[i].value;
            break;
        }
    }
    if (checkedValue != null) {
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../services/getEditCoupon.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send('coupon_id=' + checkedValue);

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText != "") {
                    var val = this.responseText.split("|");
                    serviceId = val[0];
                    document.querySelector('#edit>form [name="name"]').value = val[1];
                    document.querySelector('#edit>form [name="percentage"]').value = val[2];
                    document.querySelector('#edit>form [name="expiredate"]').value = val[3];
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

function COUfun4() {
    var inputElements = document.querySelectorAll('[name="selector"]');
    for (var i = 0; inputElements[i]; ++i) {
        if (inputElements[i].checked) {
            var valu = inputElements[i].value;
            flagCheckedValue.push(valu);
        }
    }
    if (flagCheckedValue != "") {
        document.querySelector('table[changeValue]').setAttribute("changeValue", "4");
    } else {
        location.reload();
    }
}

function COUfun5() {
    location.reload();
    document.querySelector('table[changeValue]').setAttribute("changeValue", "5");
}

function COUcreate() {
    var name = document.querySelector('#add [name="name"]').value;
    var percentage = document.querySelector('#add [name="percentage"]').value;
    var expiredate = document.querySelector('#add [name="expiredate"]').value;
    if ((name != '') && (percentage != '') && (expiredate != '')) {
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../services/insertCoupon.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send('name=' + name + '&percentage=' + percentage + '&expiredate=' + expiredate);
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var res = this.responseText;
                if (res == 'insert') {
                    document.querySelector('#form').reset();
                } else {}
            }
        }
    }
}

function COUDelete() {
    if (flagCheckedValue != null) {
        for (var i = 0; i < flagCheckedValue.length; i++) {
            var xhttp = new XMLHttpRequest();
            xhttp.open('POST', '../services/deleteCoupon.php', true);
            xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhttp.send('coupon_id=' + flagCheckedValue[i]);

            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {

                    if (this.responseText == "delete") {}
                }
            }
        }
        location.reload();
    } else {
        location.reload();
    }
}

function COUupdate() {
    var coupon_id = serviceId;
    var name = document.querySelector('#edit>form [name="name"]').value;
    var percentage = document.querySelector('#edit>form [name="percentage"]').value;
    var expiredate = document.querySelector('#edit>form [name="expiredate"]').value;

    if ((name != '') && (percentage != '') && (expiredate != '') && (coupon_id != '')) {
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../services/updateCoupon.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send('coupon_id=' + coupon_id + '&name=' + name + '&percentage=' + percentage + '&expiredate=' + expiredate);
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

function CATfun1() {
    document.querySelector('table[changeValue]').setAttribute("changeValue", "1");
}

function CATfun2() {
    checkedValue = '';
    var inputElements = document.querySelectorAll('[name="selector"]');
    for (var i = 0; inputElements[i]; ++i) {
        if (inputElements[i].checked) {
            checkedValue = inputElements[i].value;
            break;
        }
    }
    if (checkedValue != null) {
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../services/getEditCatagory.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send('c_id=' + checkedValue);

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText != "") {
                    var val = this.responseText.split("|");
                    serviceId = val[0];
                    document.querySelector('#edit>form [name="name"]').value = val[1];
                    document.querySelector('#edit>form [name="details"]').value = val[2];
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

function CATfun3() {
    var inputElements = document.querySelectorAll('[name="selector"]');
    for (var i = 0; inputElements[i]; ++i) {
        if (inputElements[i].checked) {
            var valu = inputElements[i].value;
            flagCheckedValue.push(valu);
        }
    }
    if (flagCheckedValue != "") {
        document.querySelector('table[changeValue]').setAttribute("changeValue", "3");
    } else {
        location.reload();
    }
}

function CATfun4() {
    var inputElements = document.querySelectorAll('[name="selector"]');
    for (var i = 0; inputElements[i]; ++i) {
        if (inputElements[i].checked) {
            var valu = inputElements[i].value;
            flagCheckedValue.push(valu);
        }
    }
    if (flagCheckedValue != "") {
        document.querySelector('table[changeValue]').setAttribute("changeValue", "4");
    } else {
        location.reload();
    }
}

function CATfun5() {
    location.reload();
    document.querySelector('table[changeValue]').setAttribute("changeValue", "5");
}

function createCatagory() {
    var name = document.querySelector('#add [name="name"]').value;
    var details = document.querySelector('#add [name="details"]').value;
    if ((name != '') && (details != '')) {
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../services/insertCatagory.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send('name=' + name + '&details=' + details);
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var res = this.responseText;
                if (res == 'insert') {
                    document.querySelector('#add>form').reset();
                } else {}
            }
        }
    }
}

function deleteCatagory() {
    if (flagCheckedValue != null) {
        for (var i = 0; i < flagCheckedValue.length; i++) {
            var xhttp = new XMLHttpRequest();
            xhttp.open('POST', '../services/deleteCatagory.php', true);
            xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhttp.send('c_id=' + flagCheckedValue[i]);

            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {

                    if (this.responseText == "delete") {
                        location.reload();
                    }
                }
            }
        }
        location.reload();
    } else {
        location.reload();
    }
}

function updateCatagory() {
    var c_id = serviceId;
    var name = document.querySelector('#edit>form [name="name"]').value.trim();
    var details = document.querySelector('#edit>form [name="details"]').value.trim();

    if ((name != '') && (details != '') && (c_id != '')) {
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../services/updateCatagory.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send('c_id=' + c_id + '&name=' + name + '&details=' + details);

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var res = this.responseText;

                if (res == 'update') {
                    location.reload();
                } else {}
            }
        }
    } else {
        console.log('emty data');
    }
}

function flagedCatagory() {
    var flag = document.querySelector('#flag>form [name="flag"]').value;
    for (var i = 0; i < flagCheckedValue.length; i++) {
        var c_id = flagCheckedValue[i];
        if ((flag != '') && (c_id != '')) {
            var xhttp = new XMLHttpRequest();
            xhttp.open('POST', '../services/flagCatagory.php', true);
            xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhttp.send('c_id=' + c_id + '&flag=' + flag);
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var res = this.responseText;
                    if (res == 'flaged') {
                        document.querySelector('#flag>form').reset();
                    } else {}
                }
            }
        }
    }
    location.reload();
}


function sellerManagefun1() {
    document.querySelector('table[changeValue]').setAttribute("changeValue", "1");
}

function sellerManagefun2() {
    var inputElements = document.querySelectorAll('[name="selector"]');
    for (var i = 0; inputElements[i]; ++i) {
        if (inputElements[i].checked) {
            checkedValue = inputElements[i].value;
            break;
        }
    }
    if (checkedValue != null) {
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../services/getEditUserService.php', true);
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

function sellerManagefun4() {
    var inputElements = document.querySelectorAll('[name="selector"]');
    for (var i = 0; inputElements[i]; ++i) {
        if (inputElements[i].checked) {
            var valu = inputElements[i].value;
            flagCheckedValue.push(valu);
        }
    }
    if (flagCheckedValue != "") {
        document.querySelector('table[changeValue]').setAttribute("changeValue", "4");
    } else {
        location.reload();
    }
}

function sellerManagefun5() {
    location.reload();
    document.querySelector('table[changeValue]').setAttribute("changeValue", "5");
}

function sellerManagecreate() {
    var s_id = document.querySelector('#add [name="service"]').getAttribute("val");
    var details = document.querySelector('#add [name="details"]').value;
    var price = document.querySelector('#add [name="price"]').value;
    var c_id = document.querySelector('#add [name="catagory"]').value;
    if ((s_id != '') && (details != '') && (price != '') && (c_id != '')) {
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../services/insertUserService.php', true);
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

function sellerManageDelete() {
    if (flagCheckedValue != null) {
        for (var i = 0; i < flagCheckedValue.length; i++) {
            var xhttp = new XMLHttpRequest();
            xhttp.open('POST', '../services/deleteUserService.php', true);
            xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhttp.send('us_id=' + flagCheckedValue[i]);

            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var res = this.responseText;
                    if (res == "delete") {
                        location.reload();
                    }
                }
            }
        }
    } else {
        location.reload();
    }
}

function sellerManageupdate() {
    var us_id = serviceId;
    var details = document.querySelector('#edit>form [name="details"]').value;
    var price = document.querySelector('#edit>form [name="price"]').value;

    if ((details != '') && (price != '') && (us_id != '')) {
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../services/updateUserService.php', true);
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

function sellerAddSearchService() {
    var el = document.querySelectorAll('#seller-add-searched-service tbody tr');
    el.forEach(function(value, index) {
        value.remove();
    });
    var type = document.querySelector('[name="catagory"]').value.trim();
    var search = document.querySelector('[name="service"]').value.trim();


    if (search != '' && type != '') {
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../services/searchService.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send('search=' + search + '&type=' + type);
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var res = this.responseText;
                if (res != '' && res != "not found" && res != "not ok") {
                    document.getElementById("seller-add-searched-service").classList.add('active');
                    var results = JSON.parse(res);
                    if (results.length) {
                        results.forEach(function(value, index) {
                            var tr = document.createElement('tr');
                            tr.setAttribute("onclick", "sellerAddServiceView(this)");
                            for (const [k, v] of Object.entries(value)) {
                                if (k != 's_id') {
                                    var td = document.createElement('td');
                                    var txt = document.createTextNode(v);
                                    td.appendChild(txt);
                                    tr.appendChild(td);
                                }
                            }
                            tr.setAttribute("data-id", value.s_id);
                            document.querySelector('#seller-add-searched-service tbody').appendChild(tr);
                        });
                    }
                } else {
                    console.log('not ok');
                }
            }
        }
    } else {
        document.getElementById("seller-add-searched-service").classList.remove('active');
    }
}

function sellerAddServiceView(clicked) {
    var id = clicked.getAttribute('data-id');
    document.querySelector('[name="service"]').value = clicked.getElementsByTagName('td')[0].innerHTML;
    document.querySelector('[name="service"]').setAttribute("val", id);
    document.getElementById("seller-add-searched-service").classList.remove('active');
    var el = document.querySelectorAll('#seller-add-searched-service tbody tr');
    el.forEach(function(value, index) {
        value.remove();
    });
}

function sellerManagechange() {
    document.querySelector('[name="service"]').value = '';
}

function Name() {
    var name = document.querySelector('[name="name"]').value.trim();
    if (name != '') {
        msg = 'Success!';
        if (name.split(' ').length > 1) {
            msg = 'Success!';
            if (name.charAt(0).toLowerCase() != name.charAt(0).toUpperCase()) {
                msg = 'Success!';
                if (!validateName(name)) {
                    msg = '*Name must contain a-z, A-Z, dot(.) or dash(-)';
                } else {
                    msg = 'Success!';
                }
            } else {
                msg = '*Name must start with a letter';
            }
        } else {
            msg = '*Name can not be less than two words';
        }
    } else {
        msg = '*Name can not be empty';
    }
    if (msg != 'Success!') {
        document.getElementById('nameformmsg').innerHTML = msg;
        document.querySelector('[name="name"]').style.cssText = "border: 1px solid red;";
        document.getElementById('nameformmsg').style.cssText = "display: block; color: red";
    } else {
        document.getElementById('nameformmsg').innerHTML = '';
        document.getElementById('nameformmsg').style.cssText = "display: none;";
        document.querySelector('[name="name"]').style.cssText = "border: 1px solid #0aab8e;";
    }
}

function Email() {
    var email = document.querySelector('[name="email"]').value.trim();
    if (email != '') {
        msg = "Success!";
        if (email.indexOf(" ") == -1) {
            msg = 'Success!';
            if (multipleAT(email)) {
                msg = 'Success!';
                if (email.indexOf("@") > 0) {
                    msg = 'Success!';
                    if (email.indexOf(".") > -1) {
                        msg = 'Success!';
                        var domainExt = email.split("@")[1];
                        var domain = domainExt.split(".")[0];
                        var ext = domainExt.replace(domain, '');
                        if (domain.length != 0 && validateDomainName(domain)) {
                            msg = 'Success!';
                            if (ext.length > 1 && validateDomainExt(ext)) {
                                msg = 'Success!';
                            } else {
                                msg = '*Email must have more than 1 letter and letters only after last ".", should not have number.';
                            }
                        } else {
                            msg = '*Email can only have dot(.), dash(-), chracters and numbers between "@" and last "." with no adjacent "@" or "."';
                        }
                    } else {
                        msg = '*Email must have "."';
                    }
                } else {
                    msg = '*Email can not start with "@"';
                }
            } else {
                msg = '*Email can not have multiple "@"';
            }
        } else {
            msg = '*Email can not have spaces';
        }
    } else {
        msg = '*Email can not be empty';
    }
    if (msg != 'Success!') {
        document.getElementById('emailformmsg').innerHTML = msg;
        document.querySelector('[name="email"]').style.cssText = "border: 1px solid red;";
        document.getElementById('emailformmsg').style.cssText = "display: block; color: red";
    } else {
        document.getElementById('emailformmsg').innerHTML = '';
        document.getElementById('emailformmsg').style.cssText = "display: block;";
        document.querySelector('[name="email"]').style.cssText = "border: 1px solid #0aab8e;";
    }
}

function Password() {
    var pass = document.querySelector('[name="pass"]').value.trim();
    if (pass == "") {
        msg = '*password cant empty';
        document.querySelector('[name="pass"]').style.cssText = "border: 1px solid red;";
        document.getElementById('passformmsg').innerHTML = '*password cant empty';
        document.getElementById('passformmsg').style.cssText = "display: block;";
        document.getElementById('passformmsg').style.color = "red";
    } else if (pass.length < 6) {
        msg = 'password is too weak';
        document.querySelector('[name="pass"]').style.cssText = "border: 1px solid 0aab8e;";
        document.getElementById('passformmsg').innerHTML = 'password is too weak';
        document.getElementById('passformmsg').style.cssText = "display: block;";
        document.getElementById('passformmsg').style.color = "#FF9800";
    } else if (pass.length >= 6 && pass.length < 7) {
        msg = 'Success!';
        document.querySelector('[name="pass"]').style.cssText = "border: 1px solid 0aab8e;";
        document.getElementById('passformmsg').innerHTML = 'password is weak';
        document.getElementById('passformmsg').style.cssText = "display: block;";
        document.getElementById('passformmsg').style.color = "#3d791f";
    } else if (pass.length >= 8 && pass.length < 9) {
        msg = 'Success!';
        document.querySelector('[name="pass"]').style.cssText = "border: 1px solid 0aab8e;";
        document.getElementById('passformmsg').innerHTML = 'password is strong';
        document.getElementById('passformmsg').style.cssText = "display: block;";
        document.getElementById('passformmsg').style.color = "#4CAF50";
    } else if (pass.length >= 12) {
        msg = 'Success!';
        document.querySelector('[name="pass"]').style.cssText = "border: 1px solid 0aab8e;";
        document.getElementById('passformmsg').innerHTML = 'password is too strong';
        document.getElementById('passformmsg').style.cssText = "display: block;";
        document.getElementById('passformmsg').style.color = "green";
    }
}

function userType() {
    if (document.querySelector('[name="uType"]').value.trim() == '0') {
        document.querySelector('[name="uType"]').style.cssText = "border: 1px solid red;";
    } else {
        document.querySelector('[name="uType"]').style.cssText = "border: 1px solid #0aab8e;";
    }
}

function Submit() {
    var name = document.querySelector('[name="name"]').value.trim();
    var email = document.querySelector('[name="email"]').value.trim();
    var pass = document.querySelector('[name="pass"]').value.trim();
    var uType = document.querySelector('[name="uType"]').value.trim();
    if ((name != '') && (email != '') && (pass != '') && (uType != '') && (msg == 'Success!')) {
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../services/registration.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send('name=' + name + '&email=' + email + '&pass=' + pass + '&uType=' + uType);
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var res = this.responseText;
                if (res == 'insert') {
                    document.querySelector('#reg form').reset();
                    location.assign('login.php');
                } else {
                    document.getElementById('submitformmsg').innerHTML = 'Try again';
                    document.getElementById('submitformmsg').style.cssText = "display: block; color: red";
                }
            }
        }
    }
}

function validateName(string) {
    var array = string.split('');
    var flag = true;
    array.forEach(function(value) {
        if ((value == '.') || (value == '-') || (value == ' ') || (value.toLowerCase() != value.toUpperCase())) {} else {
            flag = false;
        }
    });
    return flag;
}

function multipleAT(string) {
    var array = string.split('@');
    if (array.length == 2) {
        return true
    }
    return false;
}

function validateDomainName(string) {
    var array = string.split('');
    var flag = true;
    array.forEach(function(value) {
        if ((value == '')) {
            flag = false;
        } else {
            if (value == '-' || value == '.' || ((value.toLowerCase() != value.toUpperCase()))) {} else {
                flag = false;
            }
        }
    });
    return flag;
}

function validateDomainExt(string) {
    var array = string.replace('.', '');
    array = array.split('');
    var flag = true;
    array.forEach(function(value) {
        if (value == ' ') {
            flag = false;
        } else {
            if ((value.toLowerCase() != value.toUpperCase())) { flag = true; } else {
                flag = false;
            }
        }
    });
    return flag;
}

function validateEmail() {
    var email = document.querySelector('[name="email"]').value.trim();
    if ((email != '')) {
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../services/email.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send('email=' + email);
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var res = this.responseText;
                if (res == 'found') {
                    document.getElementById('emailformmsg').innerHTML = "*Email is taken.";
                    document.querySelector('[name="email"]').style.cssText = "border: 1px solid red;";
                    document.getElementById('emailformmsg').style.cssText = "display: block; color: red";
                } else if (res == 'not found') {
                    document.getElementById('emailformmsg').innerHTML = '';
                    document.getElementById('nameformmsg').style.cssText = "display: none;";
                    document.querySelector('[name="name"]').style.cssText = "border: 1px solid #0aab8e;";

                } else if (res == 'not ok') {
                    document.getElementById('emailformmsg').innerHTML = '*Email can not be Empty';
                    document.getElementById('emailformmsg').style.cssText = "display: block; color: red;";
                    document.querySelector('[name="email"]').style.cssText = "border: 1px solid red;";
                } else {
                    document.getElementById('emailformmsg').innerHTML = '';
                    document.getElementById('nameformmsg').style.cssText = "display: none;";
                }
            }
        }
    }
    return false;
}


function logEmail() {
    var email = document.querySelector('[name="email"]').value.trim();
    if (email != '') {
        msg = 'Success!';
    } else {
        msg = '*Email can not be empty';
    }
    if (msg != 'Success!') {
        document.getElementById('emailformmsg').innerHTML = msg;
        document.querySelector('[name="email"]').style.cssText = "border: 1px solid red;";
        document.getElementById('emailformmsg').style.cssText = "display: block; color: red";
    } else {
        document.getElementById('emailformmsg').innerHTML = '';
        document.getElementById('emailformmsg').style.cssText = "display: none;";
        document.querySelector('[name="email"]').style.cssText = "border: 1px solid #0aab8e;";
    }
}

function logPassword() {
    var pass = document.querySelector('[name="pass"]').value.trim();
    if (pass != '') {
        msg = 'Success!';
    } else {
        msg = '*Password can not be empty';
    }
    if (msg != 'Success!') {
        document.getElementById('passformmsg').innerHTML = msg;
        document.querySelector('[name="pass"]').style.cssText = "border: 1px solid red;";
        document.getElementById('passformmsg').style.cssText = "display: block; color: red";
    } else {
        document.getElementById('passformmsg').innerHTML = '';
        document.getElementById('passformmsg').style.cssText = "display: none;";
        document.querySelector('[name="pass"]').style.cssText = "border: 1px solid #0aab8e;";
    }
}

function logSubmit() {
    var email = document.querySelector('[name="email"]').value.trim();
    var pass = document.querySelector('[name="pass"]').value.trim();
    if ((email != '') && (pass != '') && (msg == "Success!")) {
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../services/login.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send('email=' + email + '&pass=' + pass);
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var res = this.responseText;
                if ((res == '0') || (res == '1') || (res == '2') || (res == '3')) {
                    //document.querySelector('#log form').reset();
                    location.assign('dashboard.php');
                } else {
                    document.getElementById('submitformmsg').style.cssText = "display: block; color: red";
                    document.getElementById('submitformmsg').innerHTML = "Invalid Credential";
                }
            }
        }
    } else {
        document.getElementById('passformmsg').innerHTML = 'Fillup all field';
        document.querySelector('[name="email"]').style.cssText = "border: 1px solid red;";
        document.querySelector('[name="pass"]').style.cssText = "border: 1px solid red;";
        document.getElementById('passformmsg').style.cssText = "display: block; color: red";
    }
}

function addFrnd() {
    var rg = document.getElementById('addBtn').getAttribute('frndrg');
    var rs = document.getElementById('addBtn').getAttribute('frndrs');
    if ((rg != '') && (rs != '')) {
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../services/addFrnd.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send('rg=' + rg + '&rs=' + rs);
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var res = this.responseText;
                if (res == 'insert') {
                    
                } else if(res == 'sent'){
                    console.log(res);
                    document.querySelector('#addBtn img').setAttribute("src", "frnd.svg");
                } else if(res == 'frnd'){
                    console.log(res);
                    document.querySelector('#addBtn img').setAttribute("src", "friends.svg");
                }
                else {
                    console.log(res);
                }
            }
        }
    }
}

function checkFrnd(){
    console.log('checkFrnd');
    var rg = document.getElementById('addBtn').getAttribute('frndrg');
    var rs = document.getElementById('addBtn').getAttribute('frndrs');
    if ((rg != '') && (rs != '')) {
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../services/addFrnd.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send('check='+'check'+'&rg=' + rg + '&rs=' + rs);
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var res = this.responseText;
                console.log(res);
                if (res == 'insert') {
                    
                } else if(res == 'sent'){
                    console.log(res);
                    document.querySelector('#addBtn img').setAttribute("src", "frnd.svg");
                } else if(res == 'frnd'){
                    console.log(res);
                    document.querySelector('#addBtn img').setAttribute("src", "friends.svg");
                }
                else {
                    console.log(res);
                }
            }
        }
    }
}


function filter()
{
    var el = document.querySelectorAll('#view table tbody tr');
        el.forEach(function (value, index) {
            value.remove();
        });
    var filter  =  document.querySelector('[name="selectFilter"]').value;
    var uid = document.getElementById('content').getAttribute('uid');
    console.log(filter);
    if(filter != '')
    {
       var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../services/dealerOrderList.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send('filter='+filter+'&uid='+uid);
        xhttp.onreadystatechange = function (){
            if(this.readyState == 4 && this.status == 200){
                var res = this.responseText;
                console.log(filter);
                console.log(res);
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