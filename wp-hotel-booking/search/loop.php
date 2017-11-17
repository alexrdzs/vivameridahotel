<?php

if ( !defined( 'ABSPATH' ) ) {
	exit();
}

global $hb_settings;
$gallery  = $room->gallery;
$featured = $gallery ? array_shift( $gallery ) : false;
?>
<li class="hb-room clearfix">

    <form name="hb-search-results" class="hb-search-room-results">
		<?php do_action( 'hotel_booking_loop_before_item', $room->post->ID ); ?>
        <div class="hb-room-content">
            <div class="hb-room-thumbnail">
				<?php if ( $featured ): ?>
                    <a class="hb-room-gallery" data-fancybox-group="hb-room-gallery-<?php echo esc_attr( $room->post->ID ); ?>" data-lightbox="hb-room-gallery[<?php echo esc_attr( $room->post->ID ); ?>]" data-title="<?php echo esc_attr( $featured['alt'] ); ?>" href="<?php echo esc_attr( $featured['src'] ); ?>">
						<?php $room->getImage( 'catalog' ); ?>
                    </a>
				<?php endif; ?>
            </div>

            <div class="hb-room-info">
                <h3 class="hb-room-name">
                    <a href="<?php echo get_the_permalink( $room->ID ) ?>">
						<?php echo esc_html( $room->name ); ?> <span class="thim-color" style = "display: block; font-size:80%;"> <?php $room->capacity_title ? printf( ' %s', $room->capacity_title ) : ''; ?></span>
                    </a>

                </h3>
                



                <ul class="hb-room-meta">

                    <li class="hb_search_capacity">

                        <label>Max. Adults</label>
                        <div class=""><span class="thim-color"><?php echo esc_html( $room->capacity ); ?></span></div>
                    </li>
                    <li class="hb_search_max_child">
                       <label>Optional Children:</label>
                        <div class=""><span class="thim-color"><?php echo esc_html( $room->max_child ); ?></span></div>
                    </li>

                    <li class="hb_search_price">

                        <h6>From <span class="hb_search_item_price"><?php echo hb_format_price( $room->amount_singular ); ?></span></h6>
<a href="" class="hb-view-booking-room-details">Price for one person per night.</a>
                        <?php hb_get_template( 'search/booking-room-details.php', array( 'room' => $room ) ); ?>

                    </li>
                    

                    
                    <li>
                      <a class="hb_button" href="<?php echo get_the_permalink( $room->ID ) ?>"><span style="color:#ffffff; font-weight:600;" title="Click to view more details.">View this Room</span> </a>

                        <a class="hb_button" href="http://www.booking.com/Share-KBkgEn#availability_target" target="_blank" title="This will redirect you to our booking site."><span style="color:#ffffff; ">Book Now</span> </a>
                        
                    </li>

<!--                                                <button class="hb_add_to_cart" sonclick="location.href = '<?php echo hb_get_cart_url() ?>';"><?php _e( 'Book now', 'sailing' ) ?> </button>-->


                    <li>


                </ul>

                <ul></ul>
            </div>
        </div>

		<?php wp_nonce_field( 'hb_booking_nonce_action', 'nonce' ); ?>
        <input type="hidden" name="check_in_date" value="<?php echo date( 'm/d/Y', hb_get_request( 'hb_check_in_date' ) ); ?>" />
        <input type="hidden" name="check_out_date" value="<?php echo date( 'm/d/Y', hb_get_request( 'hb_check_out_date' ) ); ?>">
        <input type="hidden" name="room-id" value="<?php echo esc_attr( $room->post->ID ); ?>">
        <input type="hidden" name="hotel-booking" value="cart">
        <input type="hidden" name="action" value="hotel_booking_ajax_add_to_cart" />

		<?php do_action( 'hotel_booking_loop_after_item', $room->post->ID ); ?>
    </form>
	<?php if ( ( isset( $atts['gallery'] ) && $atts['gallery'] === 'true' ) || $hb_settings->get( 'enable_gallery_lightbox' ) ): ?>
		<?php hb_get_template( 'loop/gallery-lightbox.php', array( 'room' => $room ) ) ?>
	<?php endif; ?>
</li>
