<?php
/**
 * Custom comment walker for this theme.
 *
 * @package Mori
 */

if (!class_exists('Mori_Walker_Comment')) {
    /**
     * CUSTOM COMMENT WALKER
     * A custom walker for comments, based on the walker in Twenty Nineteen and Twenty Twenty.
     */
    class Mori_Walker_Comment extends Walker_Comment
    {

        /**
         * Outputs a comment in the HTML5 format.
         *
         * @param WP_Comment $comment Comment to display.
         * @param int $depth Depth of the current comment.
         * @param array $args An array of arguments.
         * @see https://developer.wordpress.org/reference/functions/get_avatar/
         * @see https://developer.wordpress.org/reference/functions/get_comment_reply_link/
         * @see https://developer.wordpress.org/reference/functions/get_edit_comment_link/
         *
         * @see wp_list_comments()
         * @see https://developer.wordpress.org/reference/functions/get_comment_author_url/
         * @see https://developer.wordpress.org/reference/functions/get_comment_author/
         */
        protected function html5_comment($comment, $depth, $args)
        {

            $tag = ('div' === $args['style']) ? 'div' : 'li';

            ?>
            <<?php echo $tag; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output
            ?> id="comment-<?php comment_ID(); ?>" <?php comment_class($this->has_children ? 'parent' : '', $comment); ?>>
            <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
                <footer class="comment-meta">
                    <div class="comment-metadata">
                        <?php
                        $comment_author_url = get_comment_author_url($comment);
                        $comment_author = get_comment_author($comment);
                        $avatar = get_avatar($comment, $args['avatar_size']);
                        if (0 !== $args['avatar_size']) {
                            if (empty($comment_author_url)) {
                                echo wp_kses_post($avatar);
                            } else {
                                printf('<a href="%s" rel="external nofollow" class="url">', $comment_author_url); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped --Escaped in https://developer.wordpress.org/reference/functions/get_comment_author_url/
                                echo wp_kses_post($avatar);
                                echo '</a>';
                            }
                        }
                        ?>
                        <div class="comment-meta-wrap">
                            <?php
                            $comment_timestamp = get_comment_date('', $comment);
                            ?>
                            <time datetime="<?php comment_time('c'); ?>"
                                  title="<?php echo esc_attr($comment_timestamp); ?>">
                                <?php echo esc_html($comment_timestamp); ?> |
                            </time>
                            <div class="comment-author vcard">
									<span class="fn">
									<?php
                                    esc_html_e('Posted by: ', 'mori');
                                    if (empty($comment_author_url)) {
                                        echo esc_html($comment_author);
                                    } else {
                                        printf('<a href="%s" rel="external nofollow" class="url">', $comment_author_url); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped --Escaped in https://developer.wordpress.org/reference/functions/get_comment_author_url/
                                        echo esc_html($comment_author);
                                        echo '</a>';
                                    }
                                    ?>
									</span>
                            </div><!-- .comment-author -->
                        </div>
                    </div><!-- .comment-metadata -->

                </footer><!-- .comment-meta -->

                <div class="comment-content">
                    <?php
                    comment_text();
                    if ('0' === $comment->comment_approved) {
                        ?>
                        <p class="comment-awaiting-moderation">
                            <b><?php esc_html_e('Your comment has been successfully submitted and is awaiting moderation.', 'mori'); ?></b>
                        </p>
                        <?php
                    }
                    ?>
                </div><!-- .comment-content -->

                <?php
                $comment_reply_link = get_comment_reply_link(
                    array_merge(
                        $args,
                        array(
                            'add_below' => 'div-comment',
                            'depth' => $depth,
                            'max_depth' => $args['max_depth'],
                            'before' => '<span class="comment-reply">',
                            'after' => '</span>',
                        )
                    )
                );

                if ($comment_reply_link) {
                    echo $comment_reply_link; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Link is escaped in https://developer.wordpress.org/reference/functions/get_comment_reply_link/
                }
                ?>
            </article><!-- .comment-body -->

            <?php
        }
    }
}
