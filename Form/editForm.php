<?php
include("connect.php");
$input_data = file_get_contents('php://input');
$data = json_decode($input_data, true);
var_dump(isset($data['update']));
if ($data && isset($data['update'])) {
    $id = $data['id'];
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
    $fam = isset($data['fam']) ? ($data['fam'] == 'Yes' ? 'Yes' : 'No') : 'No';
    $com = isset($data['com']) ? ($data['com'] == 'Yes' ? 'Yes' : 'No') : 'No';
    $fbc = isset($data['fbc']) ? ($data['fbc'] == 'Yes' ? 'Yes' : 'No') : 'No';
    var_dump(isset($data['fam']), $data['fam']);
    var_dump(isset($data['com']), $data['com']);
    var_dump(isset($data['fbc']), $data['fbc']);
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


    $sql = "UPDATE `userdata` SET name = '$name', cname = '$cname', ctype = '$ctype', pri_address1 = '$pri_address1', pri_address2 = '$pri_address2', pri_zip = '$pri_zip', pri_city = '$pri_city', pri_state = '$pri_state', pri_country = '$pri_country',secondary_address1 = '$secondary_address1',secondary_address2 = '$secondary_address2',secondary_zip = '$secondary_zip', secondary_city = '$secondary_city', secondary_state = '$secondary_state', secondary_country = '$secondary_country', phone = '$phone', website = '$website', contact_type = '$contact_type', contact_title = '$contact_title', contact_name = '$contact_name', contact_email = '$contact_email', contact_phone = '$contact_phone',emp_count = $emp_count, contract = '$contract', comment = '$comment', fam = '$fam', com = '$com', fbc = '$fbc', cc = '$cc',start_date = '$start_date', end_date = '$end_date', associate = '$associate', acc_responsibility = '$acc_responsibility',billing_address1 = '$billing_address1', billing_address2 = '$billing_address2', billing_zip = '$billing_zip', billing_city = '$billing_city', billing_state = '$billing_state', billing_country = '$billing_country', billing_method = '$billing_method',fb_page = '$fb_page', linkedin = '$linkedin', twitter = '$twitter' WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo json_encode(array('success' => true, 'message' => 'Data updated successfully'));
    } else {
        echo json_encode(array('success' => false, 'message' => 'Failed to update data'));
    }
} else {
    echo json_encode(array('success' => false, 'message' => 'Form not submitted'));
}
