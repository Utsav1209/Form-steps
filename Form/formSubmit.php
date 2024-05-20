<?php

include("connect.php");
$input_data = file_get_contents('php://input');
$data = json_decode($input_data, true);

if ($data && isset($data['final_submit'])) {
    $name = $data['name'];
    $cname = $data['cname'];
    $ctype = $data['ctype'];
    $pri_address1 = $data['pri_address1'];
    $pri_address2 = $data['pri_address2'];
    foreach ($data as $key => $value) {
        if (strpos($key, 'pri_address2') === 0 && $key !== 'pri_address2') {
            $pri_address2 .= ', ' . $value;
        }
    }
    $pri_zip = $data['pri_zip'];
    $pri_city = $data['pri_city'];
    $pri_state = $data['pri_state'];
    $pri_country = $data['pri_country'];
    $secondary_address1 = $data['secondary_address1'];
    $secondary_address2 = $data['secondary_address2'];
    $secondary_zip = $data['secondary_zip'];
    $secondary_city = $data['secondary_city'];
    $secondary_state = $data['secondary_state'];
    $secondary_country = $data['secondary_country'];
    $phone = $data['phone'];
    $website = $data['website'];
    $contact_type = $data['contact_type'];
    $contact_title = $data['contact_title'];
    $contact_name = $data['contact_name'];
    $contact_email = $data['contact_email'];
    $contact_phone = $data['contact_phone'];
    $emp_count = $data['emp_count'];
    $contract = isset($data['contract']) ? ($data['contract'] == 'Yes' ? 'Yes' : 'No') : 'No';
    $comment = $data['comment'];
    $fam = isset($data['fam']) ? 'Yes' : 'No';
    $com = isset($data['com']) ? 'Yes' : 'No';
    $fbc = isset($data['fbc']) ? 'Yes' : 'No';
    $cc = isset($data['cc']) ? $data['cc'] : 'No';
    $start_date = $data['start_date'];
    $end_date = $data['end_date'];
    $associate = $data['associate'];
    $acc_responsibility = $data['acc_responsibility'];
    $billing_address1 = $data['billing_address1'];
    $billing_address2 = $data['billing_address2'];
    $billing_zip = $data['billing_zip'];
    $billing_city = $data['billing_city'];
    $billing_state = $data['billing_state'];
    $billing_country = $data['billing_country'];
    $billing_method = $data['billing_method'];
    $fb_page = $data['fb_page'];
    $twitter = $data['twitter'];
    $linkedin = $data['linkedin'];

    $sql_check = "SELECT * FROM `userdata` WHERE `contact_email` = '$contact_email'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        echo "Error: A record with this email already exists.";
    } else {
        $sql = "INSERT INTO `userdata` (name, cname, ctype, pri_address1, pri_address2, pri_zip, pri_city, pri_state, pri_country, secondary_address1, secondary_address2, secondary_zip, secondary_city, secondary_state, secondary_country, phone, website, contact_type, contact_title, contact_name, contact_email, contact_phone, emp_count, contract, comment, fam, com, fbc, cc, start_date, end_date, associate, acc_responsibility, billing_address1, billing_address2, billing_zip, billing_city, billing_state, billing_country, billing_method, fb_page, linkedin, twitter) 
        VALUES ('$name', '$cname', '$ctype', '$pri_address1', '$pri_address2', '$pri_zip', '$pri_city', '$pri_state', '$pri_country', '$secondary_address1', '$secondary_address2', '$secondary_zip', '$secondary_city', '$secondary_state', '$secondary_country', '$phone', '$website', '$contact_type', '$contact_title', '$contact_name', '$contact_email', '$contact_phone', $emp_count, '$contract', '$comment', '$fam', '$com', '$fbc', '$cc', '$start_date', '$end_date', '$associate', '$acc_responsibility', '$billing_address1', '$billing_address2', '$billing_zip', '$billing_city', '$billing_state', '$billing_country', '$billing_method', '$fb_page', '$linkedin', '$twitter')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
