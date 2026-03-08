<?php
function sendsms($message, $mobile_no) {
    $xml_data = '<?xml version="1.0"?>
        <parent>
            <child>
                <user>sgumpl</user>
                <key>4e1d911076XX</key>
                <mobile>+91' . $mobile_no . '</mobile>
                <message>' . $message . '</message>
                <accusage>1</accusage>
                <senderid>SGUMPL</senderid>
            </child>
        </parent>';
    $URL = "http://login.otechnix.in/submitsms.jsp?";
    $ch = curl_init($URL);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_data");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
}

function epinValidator() {
    $CI = &get_instance();
    $str_result = '0123456789';
    $epin = "EPIN" . substr(str_shuffle($str_result), 0, 10);
    $epinCountEpin = $CI->Crud->ciCount("epins", " `epin` = '$epin'");
    if ($epinCountEpin > 0) {
        epinValidator();
    } else {
        return $epin;
    }
}

function generateUniqueID() {
    $CI = &get_instance();
    $str_result = '0123456789';
    $customerID = "AMPL" . substr(str_shuffle($str_result), 0, 6);
    $comboCount = $CI->Crud->ciCount("customer_master", " `customer_id` = '$customerID'");
    if ($comboCount > 0) {
        generateUniqueID();
    } else {
        $comboCountCombo = $CI->Crud->ciCount("customer_master", " `customer_id` = '$customerID'");
        if ($comboCountCombo > 0) {
            generateUniqueID();
        } else {
            return $customerID;
        }
    }
}

function diffInMonths($date1, $date2) {
    $date1 = new DateTime($date1);
    $date2 = new DateTime($date2);

    $diff = $date1->diff($date2);

    $difference = (int)($diff->format('%y') * 12) + $diff->format('%m');
    return $difference == 0 ? 1 : $difference;
}

function getBadges($epin) {
    $CI = &get_instance();
    $userDetails = $CI->Crud->ciRead('users', " `epin` = '$epin'");
    $badge = '';
    if ($userDetails[0]->is_silver == 1) {
        $badge .= '<span class="badge badge-secondary">Silver</span>';
    }
    if ($userDetails[0]->is_gold == 1) {
        $badge .= '&nbsp;<span class="badge badge-warning">Gold</span>';
    }
    return $badge;
}
