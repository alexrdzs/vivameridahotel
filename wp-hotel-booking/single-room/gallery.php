<?php
/**
 * Gallery Images Room Template
 *
 * Closing li is left out on purpose!
 *
 * @author        ThimPress
 * @package    tp-hotel-booking/templates
 * @version     0.9
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

global $hb_room;
$galeries = $hb_room->get_galleries(false);
?>

<?php if ($galeries): ?>
    <div class="hb_room_gallery flexslider" id="slider">
        <ul class="slides">
            <?php foreach ($galeries as $key => $gallery): ?>
                <li><img src="<?php echo esc_url($gallery['src']) ?>"></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="hb_room_gallery flexslider" id="carousel">
        <ul class="slides">
            <?php foreach ($galeries as $key => $gallery): ?>
                <li><img src="<?php echo esc_url($gallery['src']) ?>"></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>