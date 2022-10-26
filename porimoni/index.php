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
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="single_blog wow fadeInLeft">
                                    <div class="blog-thumb">
                                        <div class="blog-image">
                                            <a href="<?php echo esc_url( get_the_permalink() ) ?>">
												<?php if ( has_post_thumbnail() ) {
													the_post_thumbnail( 'thumbnail', array( 'class' => 'img-responsive' ) );
												} ?>
                                            </a>
                                        </div>
                                        <div class="blog-info">
                                            <small><i class="fa fa-clock-o"></i><?php echo get_the_date() ?></small>
                                            <span><?php echo get_the_category_list( ', ' ) ?></span>
                                            <a href="<?php echo get_the_permalink() ?>"><h4><?php the_title() ?></h4></a>
                                            <p><?php echo wp_trim_words( get_the_content(), '15' ) ?></p>
                                            <a href="<?php echo get_the_permalink() ?>"
                                               class="btn blog_btn"><?php echo __( 'Read
                                                More', 'porimoni' ) ?></a>
                                        </div>
                                    </div>
                                </div>
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