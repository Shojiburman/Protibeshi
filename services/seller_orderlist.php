<?php 
    require_once('../db/db.php');
    $conn = dbConnection();
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    if(isset($_POST['filter'])){
        $filter = $_POST['filter'];

    if($filter == 'p_high'){
        //echo "string";
        $sql = "SELECT * from cart order by bill DESC";
        if (($result = $conn->query($sql)) !== FALSE){
        $data = array();
        while($row = $result->fetch_assoc()){
            $id = $row['cart_id'];
            $u_id =  $row['u_id'];
            $us_id = $row['us_id'];
            $bill = $row['bill'];
            $test = [
                    "ID" => $id,
                    "Buyer" => $u_id,
                    "Service" => $us_id,
                    "Bill" => $bill,
                ];
                array_push($data, $test);
            }
            echo json_encode($data);
        }
    } else if ($filter == 'p_low'){
        $sql = "SELECT * from cart order by bill ASC";
        if (($result = $conn->query($sql)) !== FALSE){
        $data = array();
        while($row = $result->fetch_assoc()){
            $id = $row['cart_id'];
            $u_id =  $row['u_id'];
            $us_id = $row['us_id'];
            $bill = $row['bill'];
            $test = [
                    "ID" => $id,
                    "Buyer" => $u_id,
                    "Service" => $us_id,
                    "Bill" => $bill,
                ];
                array_push($data, $test);
            }
            echo json_encode($data);
        }
    } else if ($filter == '0'){
        $sql = "SELECT * from cart";
        if (($result = $conn->query($sql)) !== FALSE){
        $data = array();
        while($row = $result->fetch_assoc()){
            $id = $row['cart_id'];
            $u_id =  $row['u_id'];
            $us_id = $row['us_id'];
            $bill = $row['bill'];
            $test = [
                    "ID" => $id,
                    "Buyer" => $u_id,
                    "Service" => $us_id,
                    "Bill" => $bill,
                ];
                array_push($data, $test);
            }
            echo json_encode($data);
        }
    }

    } else {
        $sql = "SELECT * from cart";
        if (($result = $conn->query($sql)) !== FALSE){
        $data = array();
        while($row = $result->fetch_assoc()){
            $id = $row['cart_id'];
            $u_id =  $row['u_id'];
            $us_id = $row['us_id'];
            $bill = $row['bill'];
            $test = [
                    "ID" => $id,
                    "Buyer" => $u_id,
                    "Service" => $us_id,
                    "Bill" => $bill,
                ];
                array_push($data, $test);
            }
            echo json_encode($data);
        }
    }
    
?>