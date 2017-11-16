<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!
 *
 * @author 		ThimPress
 * @package 	tp-hotel-booking/templates
 * @version     0.9
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
$settings = WPHB_Settings::instance();
?>
<li itemprop="review" itemscope itemtype="http://schema.org/Review" <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

    <div id="comment-<?php comment_ID(); ?>" class="comment_container">

        <?php echo get_avatar( $comment, apply_filters( 'hb_review_gravatar_size', '70' ), '' ); ?>

        <div class="comment-text">

            <?php if ( $comment->comment_approved == '0' ) : ?>

                <div class="meta"><em><?php esc_html_e( 'Your comment is awaiting approval', 'sailing' ); ?></em></div>

            <?php else : ?>

                <div class="meta">
                    <h4 class="author" itemprop="author"><?php comment_author(); ?></h4>
                    <div class="date" itemprop="datePublished" datetime="<?php echo get_comment_date( 'c' ); ?>"><?php echo get_comment_date( hb_date_format() ); ?></div>
                </div>

            <?php endif; ?>

            <?php if ( $rating && $settings->get( 'enable_review_rating' ) ) : ?>

                <div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="star-rating" title="<?php echo sprintf( esc_html__( 'Rated %d out of 5', 'sailing' ), $rating ) ?>">
                    <span style="width:<?php echo ( $rating / 5 ) * 100; ?>%"></span>
                </div>

            <?php endif; ?>

            <div itemprop="description" class="description"><?php comment_text(); ?></div>
        </div>
    </div>
</li>