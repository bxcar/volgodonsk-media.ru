<?php
$member  = strip_tags(trim($_POST['member']));
if (true) {
    $result = $member;
    echo json_encode($result);
} else {
    $result = 0;
    echo json_encode($result);
}