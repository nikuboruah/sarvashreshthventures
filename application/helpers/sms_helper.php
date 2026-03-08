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
    $epin = 'ANR'.substr(str_shuffle($str_result), 0, 10);
    $epinCount = $CI->Crud->ciCount("customer_master", " `epin` = '$epin'");
    if ($epinCount > 0) {
        epinValidator();
    } else {
        $epinCountEpin = $CI->Crud->ciCount("customer_master", " `epin` = '$epin'");
        if ($epinCountEpin > 0) {
            epinValidator();
        } else {
            return $epin;
        }
    }
}

function generateUniqueID() {
    $CI = &get_instance();
    $str_result = '0123456789';
    $customerID = "SSVT" . substr(str_shuffle($str_result), 0, 6);
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
