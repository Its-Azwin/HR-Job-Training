<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $post;

if ( ! $course = LP_Global::course() ) {
	return;
}

extract( $args );
extract( $args );
extract( $instance );
$title = apply_filters('widget_title', $instance['title']);
echo trim($before_widget);
if ( $title ) {
    echo trim($before_title)  . trim( $title ) . $after_title;
}

$duration = $course->get_data( 'duration' );
// Retrieve new custom meta fields
$track = get_post_meta($post->ID, '_lp_track', true);
$mode = get_post_meta($post->ID, '_lp_mode', true);
$session = get_post_meta($post->ID, '_lp_session', true);
$payments = get_post_meta($post->ID, '_lp_payments', true);

?>
<div class="course-info-widget">
    
    <?php
    $layout_type = educrat_course_layout_type();

    if ( $layout_type == 'v1' || $layout_type == 'v2' || $layout_type == 'v3' || $layout_type == 'v4' ) {
        learn_press_get_template( 'single-course/video.php' );
    }
    ?>
    <div class="bottom-inner">
    	<?php if ( !learn_press_is_learning_course() ) { ?>
    		
    	<?php } ?>
        
        <?php learn_press_get_template( 'single-course/buttons.php' ); ?>

    	<div class="inner">
        	<ul class="lp-course-info-fields">
                <li class="lp-course-info duration">
                    <label><i class="fas fa-clock"></i><?php esc_html_e( 'Duration', 'educrat' ); ?></label>
                    <?php learn_press_label_html( $duration ); ?>
                </li>
                <!-- Add new fields with icons -->
                <li class="lp-course-info track">
                    <label><i class="fas fa-map-signs"></i><?php esc_html_e( 'Track', 'educrat' ); ?></label>
                    <?php learn_press_label_html( $track ); ?>
                </li>
                <li class="lp-course-info mode">
                    <label><i class="fas fa-chalkboard-teacher"></i><?php esc_html_e( 'Mode', 'educrat' ); ?></label>
                    <?php learn_press_label_html( $mode ); ?>
                </li>
                <li class="lp-course-info session">
                    <label><i class="fas fa-calendar-alt"></i><?php esc_html_e( 'Session', 'educrat' ); ?></label>
                    <?php learn_press_label_html( $session ); ?>
                </li>
                <li class="lp-course-info payments">
                    <label><i class="fas fa-credit-card"></i><?php esc_html_e( 'Payments', 'educrat' ); ?></label>
                    <?php learn_press_label_html( $payments ); ?>
                </li>
            </ul>
            <?php
            $more_info = get_post_meta($post->ID, '_lp_more_info', true);
            if ( !empty($more_info) ) {
            ?>
        	    <ul class="lp-course-info-fields style2">
        	        <?php foreach ($more_info as $value) {
        	        	if ( $value ) {
                	?>
        	        	<li>
        		            <?php echo trim($value); ?>
        		        </li>
        	        <?php } ?>
        	        <?php } ?>
        	    </ul>
        	<?php } ?>
        	
            <!-- socials -->

            <?php get_template_part('template-parts/sharebox-course'); ?>
        </div>
    </div>
</div>
<?php echo trim($after_widget); ?>
