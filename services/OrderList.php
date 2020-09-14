<?php 
    require_once('../db/db.php');
    $conn = dbConnection();
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    if(isset($_POST['filter'])) {
        $filter = $_POST['filter'];
        $uid = $_POST['uid'];
        if($filter == '500'){
            $sql = "SELECT t.bill, t.buyer_id, t.t_id, s.name
            FROM transaction t
            INNER JOIN us_services u 
            ON t.us_id = u.us_id 
            INNER JOIN services s 
            ON s.s_id = u.s_id 
            AND t.seller_id = '$uid'
            AND t.bill <= '500'";

            if (($result = $conn->query($sql)) !== FALSE){
                $data = array();
                while($row = $result->fetch_assoc()){
                    $id = $row['t_id'];
                    $service = $row['name'];
                    $buyer_id =  $row['buyer_id'];
                    $bill = $row['bill'];

                    $sqlGetBuyer = "SELECT name from users where u_id = '$buyer_id'";
                    if (($result1 = $conn->query($sqlGetBuyer)) !== FALSE){
                        while($row = $result1->fetch_assoc()){
                            $buyer_name = $row['name'];
                        }
                    }

                    $test = [
                            "ID" => $id,
                            "Service" => $service,
                            "Buyer" => $buyer_name,
                            "Bill" => $bill,
                        ];
                        array_push($data, $test);
                    }
                    echo json_encode($data);
            }
        } else if ($filter == '1000'){
            $sql = "SELECT t.bill, t.buyer_id, t.t_id, s.name
            FROM transaction t
            INNER JOIN us_services u 
            ON t.us_id = u.us_id 
            INNER JOIN services s 
            ON s.s_id = u.s_id 
            AND t.seller_id = '$uid' 
            AND t.bill >= '500'
            AND t.bill <= '1000'";

            if (($result = $conn->query($sql)) !== FALSE){
                $data = array();
                while($row = $result->fetch_assoc()){
                    $id = $row['t_id'];
                    $service = $row['name'];
                    $buyer_id =  $row['buyer_id'];
                    $bill = $row['bill'];

                    $sqlGetBuyer = "SELECT name from users where u_id = '$buyer_id'";
                    if (($result1 = $conn->query($sqlGetBuyer)) !== FALSE){
                        while($row = $result1->fetch_assoc()){
                            $buyer_name = $row['name'];
                        }
                    }

                    $test = [
                            "ID" => $id,
                            "Service" => $service,
                            "Buyer" => $buyer_name,
                            "Bill" => $bill,
                        ];
                    array_push($data, $test);
                }
                echo json_encode($data);
            }
        } else if ($filter == '1001'){
            $sql = "SELECT t.bill, t.buyer_id, t.t_id, s.name
            FROM transaction t
            INNER JOIN us_services u 
            ON t.us_id = u.us_id 
            INNER JOIN services s 
            ON s.s_id = u.s_id 
            AND t.seller_id = '$uid' 
            AND t.bill > '1000'";

            if (($result = $conn->query($sql)) !== FALSE) {
                $data = array();
                while($row = $result->fetch_assoc()){
                    $id = $row['t_id'];
                    $service = $row['name'];
                    $buyer_id =  $row['buyer_id'];
                    $bill = $row['bill'];

                    $sqlGetBuyer = "SELECT name from users where u_id = '$buyer_id'";
                    if (($result1 = $conn->query($sqlGetBuyer)) !== FALSE) {
                        while($row = $result1->fetch_assoc()) {
                            $buyer_name = $row['name'];
                        }
                    }

                    $test = [
                            "ID" => $id,
                            "Service" => $service,
                            "Buyer" => $buyer_name,
                            "Bill" => $bill,
                        ];
                    array_push($data, $test);
                }
                echo json_encode($data);
            }
        } else if($filter == 'default'){
            $sql = "SELECT t.bill, t.buyer_id, t.t_id, s.name
            FROM transaction t
            INNER JOIN us_services u 
            ON t.us_id = u.us_id 
            INNER JOIN services s 
            ON s.s_id = u.s_id 
            AND t.seller_id = '$uid'";

            if (($result = $conn->query($sql)) !== FALSE){
                $data = array();
                while($row = $result->fetch_assoc()){
                    $id = $row['t_id'];
                    $service = $row['name'];
                    $buyer_id =  $row['buyer_id'];
                    $bill = $row['bill'];

                    $sqlGetBuyer = "SELECT name from users where u_id = '$buyer_id'";
                    if (($result1 = $conn->query($sqlGetBuyer)) !== FALSE){
                        if($row1 = $result1->fetch_assoc()){
                            $buyer_name = $row1['name'];
                        }
                    }

                    $test = [
                            "ID" => $id,
                            "Service" => $service,
                            "Buyer" => $buyer_name,
                            "Bill" => $bill,
                        ];
                    array_push($data, $test);
                }
                echo json_encode($data);
            }
        }
    } else if(isset($_POST['sort'])){
        $sort = $_POST['sort'];
        $uid = $_POST['uid'];
        if($sort == 'AZ'){
            $sql = "SELECT t.bill, t.buyer_id, t.t_id, s.name
            FROM transaction t
            INNER JOIN us_services u 
            ON t.us_id = u.us_id 
            INNER JOIN services s 
            ON s.s_id = u.s_id 
            AND t.seller_id = '$uid' ORDER BY s.name ASC";

            if (($result = $conn->query($sql)) !== FALSE){
                $data = array();
                while($row = $result->fetch_assoc()){
                    $id = $row['t_id'];
                    $service = $row['name'];
                    $buyer_id =  $row['buyer_id'];
                    $bill = $row['bill'];

                    $sqlGetBuyer = "SELECT name from users where u_id = '$buyer_id'";
                    if (($result1 = $conn->query($sqlGetBuyer)) !== FALSE){
                        while($row = $result1->fetch_assoc()){
                            $buyer_name = $row['name'];
                        }
                    }

                    $test = [
                            "ID" => $id,
                            "Service" => $service,
                            "Buyer" => $buyer_name,
                            "Bill" => $bill,
                        ];
                    array_push($data, $test);
                }
                echo json_encode($data);
            }
        } else if($sort == 'ZA'){
            $sql = "SELECT t.bill, t.buyer_id, t.t_id, s.name
            FROM transaction t
            INNER JOIN us_services u 
            ON t.us_id = u.us_id 
            INNER JOIN services s 
            ON s.s_id = u.s_id 
            AND t.seller_id = '$uid' ORDER BY s.name DESC";

            if (($result = $conn->query($sql)) !== FALSE){
                $data = array();
                while($row = $result->fetch_assoc()){
                    $id = $row['t_id'];
                    $service = $row['name'];
                    $buyer_id =  $row['buyer_id'];
                    $bill = $row['bill'];

                    $sqlGetBuyer = "SELECT name from users where u_id = '$buyer_id'";
                    if (($result1 = $conn->query($sqlGetBuyer)) !== FALSE){
                        while($row = $result1->fetch_assoc()){
                            $buyer_name = $row['name'];
                        }
                    }

                    $test = [
                            "ID" => $id,
                            "Service" => $service,
                            "Buyer" => $buyer_name,
                            "Bill" => $bill,
                        ];
                    array_push($data, $test);
                }
                echo json_encode($data);
            }
        } else if($sort == 'HL'){
            $sql = "SELECT t.bill, t.buyer_id, t.t_id, s.name
            FROM transaction t
            INNER JOIN us_services u 
            ON t.us_id = u.us_id 
            INNER JOIN services s 
            ON s.s_id = u.s_id 
            AND t.seller_id = '$uid' ORDER BY t.bill DESC";

            if (($result = $conn->query($sql)) !== FALSE){
                $data = array();
                while($row = $result->fetch_assoc()){
                    $id = $row['t_id'];
                    $service = $row['name'];
                    $buyer_id =  $row['buyer_id'];
                    $bill = $row['bill'];

                    $sqlGetBuyer = "SELECT name from users where u_id = '$buyer_id'";
                    if (($result1 = $conn->query($sqlGetBuyer)) !== FALSE){
                        while($row = $result1->fetch_assoc()){
                            $buyer_name = $row['name'];
                        }
                    }

                    $test = [
                            "ID" => $id,
                            "Service" => $service,
                            "Buyer" => $buyer_name,
                            "Bill" => $bill,
                        ];
                    array_push($data, $test);
                }
                echo json_encode($data);
            }
        } else if($sort == 'LH'){
            $sql = "SELECT t.bill, t.buyer_id, t.t_id, s.name
            FROM transaction t
            INNER JOIN us_services u 
            ON t.us_id = u.us_id 
            INNER JOIN services s 
            ON s.s_id = u.s_id 
            AND t.seller_id = '$uid' ORDER BY t.bill ASC";

            if (($result = $conn->query($sql)) !== FALSE){
                $data = array();
                while($row = $result->fetch_assoc()){
                    $id = $row['t_id'];
                    $service = $row['name'];
                    $buyer_id =  $row['buyer_id'];
                    $bill = $row['bill'];

                    $sqlGetBuyer = "SELECT name from users where u_id = '$buyer_id'";
                    if (($result1 = $conn->query($sqlGetBuyer)) !== FALSE){
                        while($row = $result1->fetch_assoc()){
                            $buyer_name = $row['name'];
                        }
                    }

                    $test = [
                            "ID" => $id,
                            "Service" => $service,
                            "Buyer" => $buyer_name,
                            "Bill" => $bill,
                        ];
                    array_push($data, $test);
                }
                echo json_encode($data);
            }
        } else if($sort == 'default'){
            $sql = "SELECT t.bill, t.buyer_id, t.t_id, s.name
            FROM transaction t
            INNER JOIN us_services u 
            ON t.us_id = u.us_id 
            INNER JOIN services s 
            ON s.s_id = u.s_id 
            AND t.seller_id = '$uid'";

            if (($result = $conn->query($sql)) !== FALSE){
                $data = array();
                while($row = $result->fetch_assoc()){
                    $id = $row['t_id'];
                    $service = $row['name'];
                    $buyer_id =  $row['buyer_id'];
                    $bill = $row['bill'];

                    $sqlGetBuyer = "SELECT name from users where u_id = '$buyer_id'";
                    if (($result1 = $conn->query($sqlGetBuyer)) !== FALSE){
                        while($row = $result1->fetch_assoc()){
                            $buyer_name = $row['name'];
                        }
                    }

                    $test = [
                            "ID" => $id,
                            "Service" => $service,
                            "Buyer" => $buyer_name,
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
                            "Role" => 'Seller',
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
        }    
    }
?>