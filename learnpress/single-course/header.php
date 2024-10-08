<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $post;
$course = learn_press_get_course();
$layout_type = educrat_course_layout_type();
?>
<div class="course-header default <?php echo esc_attr($layout_type); ?>">
    <div class="container">
        <?php educrat_render_breadcrumbs_simple(); ?>
        <div class="inner-default">
            <div class="col-xl-8">
                <div class="course-header-left">
                    <div class="course-category">
                        <?php
                        $categories = get_the_terms( $post->ID, 'course_category' );
                        if ( $categories ) {
                            foreach ($categories as $term) {
                                ?>
                                <a class="course-category-item" href="<?php echo get_term_link($term); ?>"><?php echo esc_html($term->name); ?></a>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <h2 class="title"><?php the_title(); ?></h2>

                    <?php if(has_excerpt()){ ?>
                        <div class="excerpt">
                            <?php echo get_the_excerpt(); ?>
                        </div>
                    <?php } ?>

                    <div class="course-header-meta">
                        <!-- rating -->
                        <div class="rating">
                            <div class="wrapper_rating_avg d-flex align-items-center">
                                <?php
                                    $rating_avg = Educrat_Course_Review::get_ratings_average($post->ID);
                                    $total = Educrat_Course_Review::get_total_reviews( $post->ID );
                                    if($total > 0) {
                                ?>
                                    <span class="rating_avg"><?php echo number_format($rating_avg, 1,".","."); ?></span>
                                    <?php Educrat_Course_Review::print_review($rating_avg, 'detail', $total); ?>

                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    
                </div>

            </div>

        </div>
    </div>
</div>