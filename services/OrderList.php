<?php 
    session_start();
    require_once('../db/db.php');
    $conn = dbConnection();
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $userid = $_SESSION['id'];
    $sql = "SELECT admin FROM users WHERE u_id = '$userid'";
    if (($result = $conn->query($sql)) !== FALSE){
        while($row = $result->fetch_assoc()){
            $admin = $row['admin'];
        }
    }

    if($admin == '3'){
        if(isset($_POST['filter'])) {
            $filter = $_POST['filter'];
            if($filter == '500'){
                $sql = "SELECT bill, buyer_id, t_id
                FROM transaction WHERE
                bill <= '500'";

                if (($result = $conn->query($sql)) !== FALSE){
                    $data = array();
                    while($row = $result->fetch_assoc()){
                        $id = $row['t_id'];
                        $b_id = $row['buyer_id'];
                        $bill = $row['bill'];

                        $test = [
                                "ID" => $id,
                                "bid" => $b_id,
                                "Bill" => $bill,
                            ];
                            array_push($data, $test);
                        }
                        echo json_encode($data);
                }
            } else if ($filter == '1000'){
                $sql = "SELECT bill, buyer_id, t_id
                FROM transaction WHERE
                bill >= '500'
                AND bill <= '1000'";

                if (($result = $conn->query($sql)) !== FALSE){
                    $data = array();
                    while($row = $result->fetch_assoc()){
                        $id = $row['t_id'];
                        $b_id = $row['buyer_id'];
                        $bill = $row['bill'];

                        $test = [
                                "ID" => $id,
                                "bid" => $b_id,
                                "Bill" => $bill,
                            ];
                        array_push($data, $test);
                    }
                    echo json_encode($data);
                }
            } else if ($filter == '1001'){
                $sql = "SELECT bill, buyer_id, t_id
                FROM transaction WHERE
                bill > '1000'";

                if (($result = $conn->query($sql)) !== FALSE) {
                    $data = array();
                    while($row = $result->fetch_assoc()){
                        $id = $row['t_id'];
                        $b_id = $row['buyer_id'];
                        $bill = $row['bill'];

                        $test = [
                                "ID" => $id,
                                "bid" => $b_id,
                                "Bill" => $bill,
                            ];
                        array_push($data, $test);
                    }
                    echo json_encode($data);
                }
            } else if($filter == 'default'){
                $sql = "SELECT bill, buyer_id, t_id
                FROM transaction";

                if (($result = $conn->query($sql)) !== FALSE){
                    $data = array();
                    while($row = $result->fetch_assoc()){
                        $id = $row['t_id'];
                        $b_id = $row['buyer_id'];
                        $bill = $row['bill'];

                        $test = [
                                "ID" => $id,
                                "bid" => $b_id,
                                "Bill" => $bill,
                            ];
                        array_push($data, $test);
                    }
                    echo json_encode($data);
                }
            }
        } else if(isset($_POST['sort'])){
            $sort = $_POST['sort'];
            if($sort == 'LH'){
                $sql = "SELECT bill, buyer_id, t_id
                FROM transaction ORDER BY bill ASC";

                if (($result = $conn->query($sql)) !== FALSE){
                    $data = array();
                    while($row = $result->fetch_assoc()){
                        $id = $row['t_id'];
                        $b_id = $row['buyer_id'];
                        $bill = $row['bill'];

                        $test = [
                                "ID" => $id,
                                "bid" => $b_id,
                                "Bill" => $bill,
                            ];
                        array_push($data, $test);
                    }
                    echo json_encode($data);
                }
            } else if($sort == 'HL'){
                $sql = "SELECT bill, buyer_id, t_id
                FROM transaction ORDER BY bill DESC";

                if (($result = $conn->query($sql)) !== FALSE){
                    $data = array();
                    while($row = $result->fetch_assoc()){
                        $id = $row['t_id'];
                        $b_id = $row['buyer_id'];
                        $bill = $row['bill'];

                        $test = [
                                "ID" => $id,
                                "bid" => $b_id,
                                "Bill" => $bill,
                            ];
                        array_push($data, $test);
                    }
                    echo json_encode($data);
                }
            } else if($sort == 'default'){
                $sql = "SELECT bill, buyer_id, t_id
                FROM transaction";

                if (($result = $conn->query($sql)) !== FALSE){
                    $data = array();
                    while($row = $result->fetch_assoc()){
                        $id = $row['t_id'];
                        $b_id = $row['buyer_id'];
                        $bill = $row['bill'];

                        $test = [
                                "ID" => $id,
                                "bid" => $b_id,
                                "Bill" => $bill,
                            ];
                        array_push($data, $test);
                    }
                    echo json_encode($data);
                }
            }
        } else if(isset($_POST['leaderFilter'])){
            $leaderFilter = $_POST['leaderFilter'];

            if($leaderFilter == '1'){
                $sql = "SELECT usr.name, usr.bio, l.income, usr.admin
                        FROM leaderboard l
                        INNER JOIN users usr
                        ON l.u_id = usr.u_id
                        AND usr.admin = '0' ORDER BY l.income DESC";

                if (($result = $conn->query($sql)) !== FALSE){
                    $data = array();
                    $i = 1;
                    while($row = $result->fetch_assoc()){
                        $test = [
                                "ID" => $i,
                                "Name" => $row['name'],
                                "Bio" => $row['bio'],
                                "Income" => $row['income'],
                                "Role" => 'Seller',
                            ];
                        $i++;
                        array_push($data, $test);
                    }
                    echo json_encode($data);
                }
            } else if($leaderFilter == '2'){
                $sql = "SELECT usr.name, usr.bio, l.income, usr.admin
                        FROM leaderboard l
                        INNER JOIN users usr
                        ON l.u_id = usr.u_id
                        AND usr.admin = '2' ORDER BY l.income DESC";

                if (($result = $conn->query($sql)) !== FALSE){
                    $data = array();
                    $i = 1;
                    while($row = $result->fetch_assoc()){
                        $test = [
                                "ID" => $i,
                                "Name" => $row['name'],
                                "Bio" => $row['bio'],
                                "Income" => $row['income'],
                                "Role" => 'Dealer',
                            ];
                        $i++;
                        array_push($data, $test);
                    }
                    echo json_encode($data);
                }
            } else if($leaderFilter == 'default'){
                $sql = "SELECT usr.name, usr.bio, l.income, usr.admin
                        FROM leaderboard l
                        INNER JOIN users usr
                        ON l.u_id = usr.u_id
                        ORDER BY l.income DESC";

                if (($result = $conn->query($sql)) !== FALSE){
                    $data = array();
                    $i = 1;
                    $role = '';
                    while($row = $result->fetch_assoc()){
                        if($row['admin'] == '0'){
                            $role = 'Seller';
                        } else if($row['admin'] == '2'){
                            $role = 'Dealer';
                        }

                        $test = [
                                "ID" => $i,
                                "Name" => $row['name'],
                                "Bio" => $row['bio'],
                                "Income" => $row['income'],
                                "Role" => $role,
                            ];
                        $i++;
                        array_push($data, $test);
                    }
                    echo json_encode($data);
                }
            }    
        }
    } else {
        if(isset($_POST['filter'])) {
            $filter = $_POST['filter'];
            if($filter == '500'){
                $sql = "SELECT bill, buyer_id, t_id
                FROM transaction WHERE
                buyer_id = '$userid'
                AND bill <= '500'";

                if (($result = $conn->query($sql)) !== FALSE){
                    $data = array();
                    while($row = $result->fetch_assoc()){
                        $id = $row['t_id'];
                        $bill = $row['bill'];

                        $test = [
                                "ID" => $id,
                                "Bill" => $bill,
                            ];
                            array_push($data, $test);
                        }
                        echo json_encode($data);
                }
            } else if ($filter == '1000'){
                $sql = "SELECT bill, buyer_id, t_id
                FROM transaction WHERE
                buyer_id = '$userid'
                AND bill >= '500'
                AND bill <= '1000'";

                if (($result = $conn->query($sql)) !== FALSE){
                    $data = array();
                    while($row = $result->fetch_assoc()){
                        $id = $row['t_id'];
                        $bill = $row['bill'];

                        $test = [
                                "ID" => $id,
                                "Bill" => $bill,
                            ];
                        array_push($data, $test);
                    }
                    echo json_encode($data);
                }
            } else if ($filter == '1001'){
                $sql = "SELECT bill, buyer_id, t_id
                FROM transaction WHERE
                buyer_id = '$userid'
                AND bill > '1000'";

                if (($result = $conn->query($sql)) !== FALSE) {
                    $data = array();
                    while($row = $result->fetch_assoc()){
                        $id = $row['t_id'];
                        $bill = $row['bill'];

                        $test = [
                                "ID" => $id,
                                "Bill" => $bill,
                            ];
                        array_push($data, $test);
                    }
                    echo json_encode($data);
                }
            } else if($filter == 'default'){
                $sql = "SELECT bill, buyer_id, t_id
                FROM transaction WHERE
                buyer_id = '$userid'";

                if (($result = $conn->query($sql)) !== FALSE){
                    $data = array();
                    while($row = $result->fetch_assoc()){
                        $id = $row['t_id'];
                        $bill = $row['bill'];

                        $test = [
                                "ID" => $id,
                                "Bill" => $bill,
                            ];
                        array_push($data, $test);
                    }
                    echo json_encode($data);
                }
            }
        } else if(isset($_POST['sort'])){
            $sort = $_POST['sort'];
            if($sort == 'LH'){
                $sql = "SELECT bill, buyer_id, t_id
                FROM transaction WHERE
                buyer_id = '$userid' ORDER BY bill ASC";

                if (($result = $conn->query($sql)) !== FALSE){
                    $data = array();
                    while($row = $result->fetch_assoc()){
                        $id = $row['t_id'];
                        $bill = $row['bill'];

                        $test = [
                                "ID" => $id,
                                "Bill" => $bill,
                            ];
                        array_push($data, $test);
                    }
                    echo json_encode($data);
                }
            } else if($sort == 'HL'){
                $sql = "SELECT bill, buyer_id, t_id
                FROM transaction WHERE
                buyer_id = '$userid' ORDER BY bill DESC";

                if (($result = $conn->query($sql)) !== FALSE){
                    $data = array();
                    while($row = $result->fetch_assoc()){
                        $id = $row['t_id'];
                        $bill = $row['bill'];

                        $test = [
                                "ID" => $id,
                                "Bill" => $bill,
                            ];
                        array_push($data, $test);
                    }
                    echo json_encode($data);
                }
            } else if($sort == 'default'){
                $sql = "SELECT bill, buyer_id, t_id
                FROM transaction WHERE
                buyer_id = '$userid'";

                if (($result = $conn->query($sql)) !== FALSE){
                    $data = array();
                    while($row = $result->fetch_assoc()){
                        $id = $row['t_id'];
                        $bill = $row['bill'];

                        $test = [
                                "ID" => $id,
                                "Bill" => $bill,
                            ];
                        array_push($data, $test);
                    }
                    echo json_encode($data);
                }
            }
        } else if(isset($_POST['leaderFilter'])){
            $leaderFilter = $_POST['leaderFilter'];

            if($leaderFilter == '1'){
                $sql = "SELECT usr.name, usr.bio, l.income, usr.admin
                        FROM leaderboard l
                        INNER JOIN users usr
                        ON l.u_id = usr.u_id
                        AND usr.admin = '0' ORDER BY l.income DESC";

                if (($result = $conn->query($sql)) !== FALSE){
                    $data = array();
                    $i = 1;
                    while($row = $result->fetch_assoc()){
                        $test = [
                                "ID" => $i,
                                "Name" => $row['name'],
                                "Bio" => $row['bio'],
                                "Income" => $row['income'],
                                "Role" => 'Seller',
                            ];
                        $i++;
                        array_push($data, $test);
                    }
                    echo json_encode($data);
                }
            } else if($leaderFilter == '2'){
                $sql = "SELECT usr.name, usr.bio, l.income, usr.admin
                        FROM leaderboard l
                        INNER JOIN users usr
                        ON l.u_id = usr.u_id
                        AND usr.admin = '2' ORDER BY l.income DESC";

                if (($result = $conn->query($sql)) !== FALSE){
                    $data = array();
                    $i = 1;
                    while($row = $result->fetch_assoc()){
                        $test = [
                                "ID" => $i,
                                "Name" => $row['name'],
                                "Bio" => $row['bio'],
                                "Income" => $row['income'],
                                "Role" => 'Dealer',
                            ];
                        $i++;
                        array_push($data, $test);
                    }
                    echo json_encode($data);
                }
            } else if($leaderFilter == 'default'){
                $sql = "SELECT usr.name, usr.bio, l.income, usr.admin
                        FROM leaderboard l
                        INNER JOIN users usr
                        ON l.u_id = usr.u_id
                        ORDER BY l.income DESC";

                if (($result = $conn->query($sql)) !== FALSE){
                    $data = array();
                    $i = 1;
                    $role = '';
                    while($row = $result->fetch_assoc()){
                        if($row['admin'] == '0'){
                            $role = 'Seller';
                        } else if($row['admin'] == '2'){
                            $role = 'Dealer';
                        }

                        $test = [
                                "ID" => $i,
                                "Name" => $row['name'],
                                "Bio" => $row['bio'],
                                "Income" => $row['income'],
                                "Role" => $role,
                            ];
                        $i++;
                        array_push($data, $test);
                    }
                    echo json_encode($data);
                }
            }    
        }
    }
?>