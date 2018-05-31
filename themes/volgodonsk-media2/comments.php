<?php
  if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die ('Please do not load this page directly. Thanks!');
  if ( post_password_required() ) {
?>
    <p class="nocomments">Введите пароль, чтобы увидеть комментарии.</p>
    <?php return;
  } ?>
  <div id="comments">
    <?php if ( have_comments() ) : ?>
    <h3><?php theme_comments(); ?></h3>
    <ol class="commentlist">
      <?php wp_list_comments('avatar_size=48&callback=custom_comment&type=comment'); ?>
    </ol>
    <div class="clear"></div>
    <div class="navigation">
      <div class="alignleft"><?php previous_comments_link() ?></div>
      <div class="alignright"><?php next_comments_link() ?></div>
      <div class="fix"></div>
    </div>
    <br/>
    <?php else :
    if ('open' == $post->comment_status) :
    else : ?>
    <?php
      endif;
      endif;
    ?>
  </div>
  <?php
      if ('open' == $post->comment_status) :
  ?>
  <div id="respond">
    <h3><?php comment_form_title( 'Оставьте свой комментарий'); ?></h3>
    <div class="cancel-comment-reply">
      <small><?php cancel_comment_reply_link(); ?></small>
    </div>
    <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
    <p>Чтобы оставить комментарий вы должны
      <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">войти</a>
    </p>
    <?php else : ?>
    <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
      <?php if ( $user_ID ) : ?>
      <p>Вы вошли как 
        <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php">
          <?php echo $user_identity; ?>
        </a>. <a href="<?php echo wp_logout_url(); ?>" title="Выйти">Выйти#</a>
      </p>
      <?php else : ?>
      <p>
        <input class="txt" type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
        <label for="author">Имя<span><?php if ($req) echo " обязательно"; ?></span></label>
      </p>
      <?php endif; ?>
      <p><textarea name="comment" id="comment" rows="5" cols="200" tabindex="4"></textarea></p>
      <p>
        <input name="submit" type="submit" id="submit" tabindex="5" value="Отправить" />
        <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
      </p>
      <?php
        comment_id_fields();
        do_action('comment_form', $post->ID);
      ?>
    </form>
    <?php endif; ?>
    <div class="fix"></div>
  </div>
  <?php endif; ?>
