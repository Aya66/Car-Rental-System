<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carrentalsystem";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$input = filter_input_array(INPUT_POST);
if ($input['action'] == 'edit') {

    $update_field='';

    if(isset($input['model'])) {
        $update_field.= "model='".$input['model']."'";
    } else if(isset($input['body'])) {
        $update_field.= "body='".$input['body']."'";
    } else if(isset($input['brand'])) {
        $update_field.= "brand='".$input['brand']."'";
    } else if(isset($input['color'])) {
        $update_field.= "color='".$input['color']."'";
    } else if(isset($input['year'])) {
        $update_field.= "year='".$input['year']."'";
    } else if(isset($input['status'])) {
        $update_field.= "status='".$input['status']."'";
    } else if(isset($input['office_id'])) {
        $update_field.= "office_id='".$input['office_id']."'";
    } else if(isset($input['price_day'])) {
        $update_field.= "price_day='".$input['price_day']."'";
    }

    if($update_field && $input['plate_id']) {
        $sql_query = "  UPDATE car
                        SET $update_field
                        WHERE plate_id='" . $input['plate_id'] . "'";
        mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
    }

}

// $conn->close();

?>