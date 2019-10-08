<?php
$DIR = '../system/config.php';
include_once $DIR;
$key = array('title', 'address', 'youtube_channel', 'location', 'service', 'keyword', 'desc', 'ga');
$p   = CheckAll($_POST, $key);
if (isset($_POST['update_profile'])) {
    $str     = htmlspecialchars($p['ga'], ENT_QUOTES);
    $profile = UpdateById($cn, 'inf', [
        'title'   => $p['title'],
        'keyword' => $p['keyword'],
        'desc'    => $p['desc'],
        'ga'      => $str,
    ], 0);
    $loc = split(',', $p['location']);
    $new = UpdateById($cn, 'inf', [
        'youtube_channel' => $p['youtube_channel'],
        'address'         => $p['address'],
        'service'         => $p['service'],
        'lat'             => $loc[0],
        'lng'             => $loc[1],
    ], 0);
    if ($profile && $new) {
        echo json_encode(['status' => true]);
        exit();
    } else {
        echo 'ERROR:資料未更新';
        exit();
    }
}
