<?php
if (!defined('ABSPATH')) {
    exit();
}

global $thim_options_data;

$room = WPHB_Room::instance(get_the_ID());
ob_start();
the_content();
$content = ob_get_clean();


$tabsInfo = array();
if ( !isset($thim_options_data['thim_hb_single_hide_desc']) ||
    !$thim_options_data['thim_hb_single_hide_desc']) {
    $tabsInfo[] = array(
        'id' => 'hb_room_description',
        'title' => esc_html__('Description', 'sailing'),
        'content' => $content

    );
}

if ( !isset($thim_options_data['thim_hb_single_hide_info']) || !$thim_options_data['thim_hb_single_hide_info']) {
    $tabsInfo[] = array(
        'id' => 'hb_room_additinal',
        'title' => esc_html__('Additional Information', 'sailing'),
        'content' => $room->addition_information
    );
}

if (isset($thim_options_data['thim_hb_single_hide_reviews']) && $thim_options_data['thim_hb_single_hide_reviews']) {
    remove_filter('hotel_booking_single_room_infomation_tabs', array('HB_Comments', 'addTabReviews'));
}
$tabs = apply_filters('hotel_booking_single_room_infomation_tabs', $tabsInfo);

// prepend after li tabs single
do_action('hotel_booking_before_single_room_infomation');
?>



<?php if (isset($tabs) && count($tabs)) { ?>
    <div class="hb_single_room_details" style="margin-bottom:55px;">

        <ul class="hb_single_room_tabs">

            <?php

            foreach ($tabs as $key => $tab): ?>
                <li>
                    <a href="#<?php echo esc_attr($tab['id']) ?>">
                        <?php do_action('hotel_booking_single_room_before_tabs_' . $tab['id']); ?>
                        <?php printf('%s', $tab['title']) ?>
                        <?php do_action('hotel_booking_single_room_after_tabs_' . $tab['id']); ?>
                    </a>
                </li>

            <?php endforeach; ?>
        </ul>

        <?php
        // append after li tabs single
        do_action('hotel_booking_after_single_room_infomation'); ?>

        <div class="hb_single_room_tabs_content">

            <?php foreach ($tabs as $key => $tab): ?>

                <div id="<?php echo esc_attr($tab['id']) ?>" class="hb_single_room_tab_details">
                    <?php do_action('hotel_booking_single_room_before_tabs_content_' . $tab['id']); ?>

                    <?php printf('%s', $tab['content']); ?>

                    <?php do_action('hotel_booking_single_room_after_tabs_content_' . $tab['id']); ?>
                </div>



            <?php endforeach; ?>
        </div>


    </div>
    <div class="row room-details" style="margin:auto;">

    <?php
            /**
         * hotel_booking_loop_room_single_price
         */
        do_action( 'hotel_booking_loop_room_price' );
    ?>
        <a class="hb_button" href="http://www.booking.com/Share-KBkgEn#availability_target" target="_blank" title="This will redirect you to our booking site."><span style="color:#ffffff;">Book Now</span> </a> 
    </div>

<?php } ?>
