<?php
require_once("/wp-load.php");
//wp_head();

$member = strip_tags(trim($_POST['member']));
$post_id = strip_tags(trim($_POST['post_id']));
$vote_amount = (int)strip_tags(trim($_POST['vote_amount']));

$new_vote_amount = $vote_amount + 1;

//    update_sub_field( array('members', 1, 'vote'), $new_vote_amount, $post_id );
//update_vote(array('members', 1, 'vote'), $new_vote_amount, $post_id);
//$ttt = get_permalink($post_id);

if (true) {
    $result = $vote;
    echo json_encode($result);
} else {
    $result = 0;
    echo json_encode($result);
}