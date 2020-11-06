<?php
/**
 * The template for displaying Work liss page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Kemet
 *
 */

get_header(); ?>

<div id="primary" class="nopadding">
        <div class="m-width container nomargin nopadding">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-11">
                    <div class="top-divider"></div>   
                    </div>               
                </div>
            </div>
            <div class="row unselectable">
                <div class="col-1"></div>
                <div class="col-2">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <h3 class="font-size-28 font-weight-bold font-color-purple">type of work</h3>
                            </div>
                            <div class="col-12">
                                <h3 class="font-size-18 font-color-grey">remove filters</h3>
                            </div>
                            <div class="col-12 filter-divider"></div>
                            <div class="col-12">
                                
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="col-9">
                    <div class="container">
                        <div class="row">
                            <div class="col-9">
                                <h2 class="font-size-34 font-weight-bold font-color-purple nomargin">work</h2>
                                <h3 class="font-size-34 font-color-purple">nuestros clientes han elevado el impacto en su entorno, la sociedad y el planeta, y nosotros 
                                les ayudamos a transformarse y detonar su potencial.</h3>
                            </div>
                        </div>
                    </div>                    
                    <div class="container">
                        <div class="row">
                            <?php
                                // Start the Loop.
                                while (have_posts()) :
                                // You can list your posts here
                                the_post();
                            ?>
                            <div class="col-4">
                                <div class="archive-item">
                                    <div class="post-title">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </div>
                                    <div class="post-thumbnail">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail(); ?>
                                        </a>
                                    </div>
                                    <div class="post-content">
                                        <?php the_content(); ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                                endwhile;
                            ?>    
                        </div>
                    </div>
                </div>
            </div>
            <?php kemet_pagination(); ?>
        </div>


	</div><!-- #primary -->

	<div id="primary" <?php kemet_content_class(); ?>>


		

	</div><!-- #primary -->

<?php get_footer(); ?>
