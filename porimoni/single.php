<?php get_header() ?>

    <!-- START BLOG -->
    <section id="blog" class="gray_bg section_padding">
        <div class="container">
            <div class="row">
                <div class="blog_slide_area">
					<?php
					if ( have_posts() ) {
						while ( have_posts() ) {
							the_post();
							?>
							<?php if ( has_post_thumbnail() ) {
								the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) );
							} ?>
                            <div class="blog-info">
                                <small><i class="fa fa-clock-o"></i><?php echo get_the_date() ?></small>
                                <span><?php echo get_the_category_list( ', ' ) ?></span>
                                <a href="<?php echo get_the_permalink() ?>"><h4><?php the_title() ?></h4>
                                </a>
                                <p><?php the_content(); ?></p>

                            </div>
							<?php
						}
					}
					?>

                </div>
            </div>
        </div>
    </section>
    <!-- END BLOG -->
<?php get_footer() ?>