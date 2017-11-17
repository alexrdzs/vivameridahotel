<?php

if ( !defined( 'ABSPATH' ) ) {
	exit();
}

do_action( 'hb_before_search_result' );
?>
<?php
global $hb_search_rooms;
?>
<div id="hotel-booking-results">
	<?php if ( $results && !empty( $hb_search_rooms['data'] ) ): ?>
        <h3><?php _e( 'Search Results', 'wp-hotel-booking' ); ?></h3>

    <p style="font-size:15px; margin-bottom:20px;">Here are some rooms perfect for you:</p>
    <hr>
		<?php hb_get_template( 'search/list.php', array( 'results' => $hb_search_rooms['data'], 'atts' => $atts ) ); ?>
        <nav class="rooms-pagination">
			<?php
			echo paginate_links( apply_filters( 'hb_pagination_args', array(
				'base'      => add_query_arg( 'hb_page', '%#%' ),
				'format'    => '',
				'prev_text' => __( 'Previous', 'wp-hotel-booking' ),
				'next_text' => __( 'Next', 'wp-hotel-booking' ),
				'total'     => $hb_search_rooms['max_num_pages'],
				'current'   => $hb_search_rooms['page'],
				'type'      => 'list',
				'end_size'  => 3,
				'mid_size'  => 3
			) ) );
			?>
        </nav>
	<?php else: ?>
    <h3>Oh, no. </h3>
        <em><p style="font-size:18px;"><?php _e( 'We are unable to find a room matching your search. ', 'wp-hotel-booking' ); ?></p></em>
    <hr>
    <strong><a href="contact-us" style="font-size:18px;"> Please <span style="text-decoration:underline;">contact us directly</span> so we can help you find an available date.</a></strong>

	<?php endif; ?>
</div>
