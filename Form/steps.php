<?php
include("connect.php");
$input_data = file_get_contents('php://input');
$data = json_decode($input_data, true);
var_dump($data);
if ($data && isset($data['step']) && $data['step'] == 1) {
    $name = $_POST['name'];
    $cname = $_POST['cname'];
    $ctype = $_POST['ctype'];
    $pri_address1 = $_POST['pri_address1'];
    $pri_address2 = $_POST['pri_address2'];
    $pri_zip = $_POST['pri_zip'];
    $pri_city = $_POST['pri_city'];
    $pri_state = $_POST['pri_state'];
    $pri_country = $_POST['pri_country'];
    $secondary_address1 = $_POST['secondary_address1'];
    $secondary_address2 = $_POST['secondary_address2'];
    $secondary_zip = $_POST['secondary_zip'];
    $secondary_city = $_POST['secondary_city'];
    $secondary_state = $_POST['secondary_state'];
    $secondary_country = $_POST['secondary_country'];
    $phone = $_POST['phone'];
    $website = $_POST['website'];
}

if ($data && isset($data['step']) && $data['step'] == 2) {
    $contact_type = $_POST['contact_type'];
    $contact_title = $_POST['contact_title'];
    $contact_name = $_POST['contact_name'];
    $contact_email = $_POST['contact_email'];
    $contact_phone = $_POST['contact_phone'];
    $emp_count = $_POST['emp_count'];
    $contract = isset($_POST['contract']) ? ($_POST['contract'] == 'Yes' ? 1 : 0) : 0;
    $comment = $_POST['comment'];
}

if ($data && isset($data['step']) && $data['step'] == 3) {
    $fam = isset($_POST['fam']) ? 1 : 0;
    $com = isset($_POST['com']) ? 1 : 0;
    $fbc = isset($_POST['fbc']) ? 1 : 0;
    $cc = isset($_POST['cc']) ? ($_POST['cc'] == 'Yes' ? 1 : 0) : 0;
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
}

if ($data && isset($data['step']) && $data['step'] == 4) {
    $associate = $_POST['associate'];
    $acc_responsibility = $_POST['acc_responsibility'];
    $billing_address1 = $_POST['billing_address1'];
    $billing_address2 = $_POST['billing_address2'];
    $billing_zip = $_POST['billing_zip'];
    $billing_city = $_POST['billing_city'];
    $billing_state = $_POST['billing_state'];
    $billing_country = $_POST['billing_country'];
    $billing_method = $_POST['billing_method'];
}

if ($data && isset($data['step']) && $data['step'] == 5) {
    $fb_page = $_POST['fb_page'];
    $twitter = $_POST['twitter'];
    $linkedin = $_POST['linkedin'];
}
