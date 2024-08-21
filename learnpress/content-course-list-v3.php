<?php
/**
 * Template for displaying course content within the loop.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/content-course.php
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 4.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

if (!empty($args)) {
    extract($args);
}
$course = learn_press_get_course( $post->ID );
if ( empty($course) ) {
    return;
}
?>

<div <?php post_class('course-layout-item'); ?>>
    <div class="course-list course-list-v3 m-0">
        <div class="course-entry d-sm-flex align-items-center">

            <!-- course thumbnail -->
            <?php if ( $image = educrat_display_post_thumb('educrat-course-list') ) { ?>
                <div class="course-cover flex-shrink-0">
                    <div class="course-cover-thumb"> 
                        <?php echo wp_kses_post($image); ?>
                        <?php
                        if ( $course->has_sale_price() ) {
                            echo '<span class="sale-label">' . esc_html__('Sale', 'educrat') . '</span>';
                        }
                        ?>
                    </div>                
                </div>
            <?php } ?>

            <div class="course-layout-content flex-grow-1">
                <div class="d-sm-flex align-items-center">
                    <div class="flex-grow-1 main-info">
                        <div class="course-info-top">
                            <!-- rating -->
                            <div class="wrapper_rating_avg d-flex align-items-center">
                                <?php
                                    $rating_avg = Educrat_Course_Review::get_ratings_average($post->ID);
                                    $total = Educrat_Course_Review::get_total_reviews( $post->ID );
                                    if($total > 0) {
                                ?>
                                    <span class="rating_avg"><?php echo number_format($rating_avg, 1,".","."); ?></span>
                                    <?php Educrat_Course_Review::print_review($rating_avg, 'list', $total); ?>

                                <?php } ?>
                            </div>
                        </div>          
                        <!-- course title -->
                        <h3 class="course-title"><a href="<?php echo get_the_permalink( $course->get_id() ) ?>"><?php echo wp_kses_post($course->get_title()); ?></a></h3>
                        <div class="course-excerpt d-none d-md-block"><?php echo wp_trim_words( $post->post_content, 20, '.' ); ?></div>
                    </div>
                    <!-- Read more button -->
                    <div class="course-meta-bottom">
                        <a href="<?php the_permalink(); ?>" class="btn btn-more btn-theme-rgb7">
                            <?php echo esc_html__('Read More','educrat') ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
