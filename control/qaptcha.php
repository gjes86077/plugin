<?php
session_start();
$aResponse['error'] = false;
$action             = htmlentities($_POST['action'], ENT_QUOTES);
$qaptcha_key        = htmlentities($_POST['qaptcha_key'], ENT_QUOTES);
if (isset($action) && isset($qaptcha_key)) {
    $_SESSION['Vertified'] = false;
    if ('qaptcha' == $action) {
        $_SESSION['adminVertifyCode'] = $qaptcha_key;
        $aResponse['vertified_code']  = $qaptcha_key;
        echo json_encode($aResponse);
    } else {
        $aResponse['error'] = true;
        echo json_encode($aResponse);
    }
} else {
    $aResponse['error'] = true;
    echo json_encode($aResponse);
}
