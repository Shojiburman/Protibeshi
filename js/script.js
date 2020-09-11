var checkedValue = "";
var flagCheckedValue = [];
var serviceId = "";

function validateMyForm() {
    return false;
}

function view(clicked) {
    var id = clicked.getAttribute('data-id');
    location.assign('viewServices.php?uid=' + encodeURIComponent(id));
}

function Search() {
    var el = document.querySelectorAll('#searchResult tbody tr');
    el.forEach(function(value, index) {
        value.remove();
    });
    var search = document.querySelector('[name="search"]').value.trim();
    var type = document.querySelector('[name="type"]').value.trim();

    if ((search != '') && (type != '')) {
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../services/serach.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send('search=' + search + '&type=' + type);
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var res = this.responseText;
                if (res != '' && res != "not found" && res != "not ok") {
                    document.getElementById("searchResult").classList.add('active');
                    var results = JSON.parse(res);
                    console.log(results);
                    if (results.length) {
                        results.forEach(function(value, index) {
                            var tr = document.createElement('tr');
                            tr.setAttribute("onclick", "view(this)");
                            for (const [k, v] of Object.entries(value)) {
                                if (k != 'u_id') {
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
                } else {
                    console.log(res);
                }
            }
        }
    }
}

function checkSearch() {
    var search = document.querySelector('[name="search"]').value.trim();
    if (search == '') {
        document.getElementById("searchResult").classList.remove('active');
        var el = document.querySelectorAll('#searchResult tbody tr');
        el.forEach(function(value, index) {
            value.remove();
        });
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
        console.log("12");
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../services/insertService.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send('name=' + name + '&details=' + details + '&catagory=' + c_id);
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var res = this.responseText;
                console.log(res);
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
        console.log(s_id);
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var res = this.responseText;
                console.log(res);
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
    console.log(flag);
    for (var i = 0; i < flagCheckedValue.length; i++) {
        var s_id = flagCheckedValue[i];
        console.log(s_id);
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
                console.log(res);
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
    console.log(flag);
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
        'email': email,
        'work': work,
        'number': number,
        'address': address,
        'dob': dob,
        'bio': bio
    };

    data = JSON.stringify(data);
    //console.log(data);

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
        //console.log(data);

        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../services/changePass.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send('json=' + data);

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var res = this.responseText;
                console.log(res);
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