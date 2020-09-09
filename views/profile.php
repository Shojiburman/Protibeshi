<?php
    session_start();
    include '../php/session.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="../css/body.css">
    <link rel="stylesheet" type="text/css" href="../css/adminNav.css">
    <link rel="stylesheet" type="text/css" href="../css/profile.css">
</head>

<body>
    <?php
        include 'adminNav.html';
    ?>

    <div id="hero_section">
        <div class="section">
            <div id="profilePic">
                <img src="<?php echo $c_pic; ?>">
            </div>
            <a id="editBtn" href="changeProfilePic.php"><img src="edit.svg"></a>
            <p id="name"><?php echo strtoupper($c_name);?></p>
            <p><?php echo ($c_email);?></p>
            <button class="btn" onclick="Changeclick()">Change Password</button>
        </div>

        <div class="section">
            <h3>EDIT PROFILE</h3>
            <form>
                <input type="hidden" name="id" value="<?php echo $_SESSION['id'] ?>" placeholder="Name">
                <input type="text" name="name" value="<?php echo $c_name ?>" placeholder="Name">
                <input type="text" name="email" value="<?php echo $c_email ?>" placeholder="Email">
                <input type="text" name="work" value="<?php echo $c_work ?>" placeholder="Work">
                <input type="text" name="pnumber" value="<?php echo $c_pnumber ?>" placeholder="Contact Number">
                <input type="text" name="address" value="<?php echo $c_address ?>" placeholder="Address">
                <input type="date" name="dob" value="<?php echo $c_dob ?>" placeholder="Birthdate">
                <textarea type="text" name="bio" value="" placeholder="Bio"><?php echo $c_bio ?></textarea>
                <input class="btn" type="button" name="submit" value="SAVE" onclick="update()">
            </form>
            <p id="msg"></p>
        </div>
    </div>
    <script type="text/javascript">
        function Changeclick(){
            location.assign('changePass.php');
        }

        function update(){
            console.log('hi');
            var u_id = document.querySelector('[name="id"]').value;
            var name = document.querySelector('[name="name"]').value;
            var email = document.querySelector('[name="email"]').value;
            var work = document.querySelector('[name="work"]').value;
            var number = document.querySelector('[name="pnumber"]').value;
            var address = document.querySelector('[name="address"]').value;
            var dob = document.querySelector('[name="dob"]').value;
            var bio = document.querySelector('[name="bio"]').value;

            var data  = {
                'u_id'  : u_id,
                'name'  : name,
                'email' : email,
                'work' : work,
                'number' : number,
                'address' : address,
                'dob' : dob,
                'bio' : bio
            };

            data = JSON.stringify(data);
            //console.log(data);

            var xhttp = new XMLHttpRequest();
            xhttp.open('POST', '../services/profile.php', true);
            xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhttp.send('json='+data);

            xhttp.onreadystatechange = function (){
                if(this.readyState == 4 && this.status == 200){
                    var res = this.responseText;
                     if(res == 'update'){
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
    </script>
</body>

</html>