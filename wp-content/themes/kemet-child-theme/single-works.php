<?php
/**
 * The template for displaying Work single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
                    <div class="work-video">
                        <?php
                            if (has_block('core-embed/youtube', $post)) {
                                //Parametro 1 = tipo de bloque, Parametro 2 orden del bloque
                                display_post_block('core-embed/youtube', 1);
                            }
                        ?>
                    </div>                    
                </div>
            </div>
            <div class="row unselectable">
                <div class="col-1"></div>
                <div class="col-4">
                    <div class="work-client font-size-28 font-color-purple">
                        <?php
                            if (has_block('core/heading', $post)) {
                                display_post_block('core/heading', 1);
                            }
                        ?>
                    </div>
                    <div class="work-title">
                        <h1 class="font-size-48 font-weight-bold font-color-purple" >
                            <?php
                                echo single_post_title('', false);
                            ?>
                        </h1>
                    </div>                    
                    <div class="container">
                        <div class="row">
                            <div class="col-6 nopadding">
                                <div class="author-name font-size-20 font-color-purple">
                                    <h4 class="font-weight-bold nomargin">by</h4>
                                    <?php
                                        if (has_block('core/heading', $post)) {
                                            display_post_block('core/heading', 2);
                                        }
                                    ?>	
                                </div>
                                <div class="author-picture">
                                    <?php
                                        if (has_block('core/image', $post)) {
                                            display_post_block('core/image', 3);
                                        }
                                    ?>	
                                </div>
                                
                            </div>
                            <div class="col-6"></div>
                        </div>
                    </div>	        
                </div>
                <div class="col-1"></div>
                <div class="col-6">
                    <div class="work-paragraph font-size-24 font-color-purple">
                        <?php
                            if (has_block('core/paragraph', $post)) {
                                display_post_block('core/paragraph', 4);
                            }
                        ?>
                    </div>
                    <div class="work-image">
                        <?php
                            if (has_block('core/image', $post)) {
                                display_post_block('core/image', 5);
                            }
                        ?>
                    </div>
                    <div class="work-paragraph font-size-24 font-color-purple">
                        <?php
                            if (has_block('core/paragraph', $post)) {
                                display_post_block('core/paragraph', 6);
                            }
                        ?>
                    </div>
                    <div class="font-size-24">
                        <h4 class="font-color-cyan nomargin">type of work</h4>
                        <div class="work-type font-color-purple">
                            <?php
                                if (has_block('core/heading', $post)) {
                                    display_post_block('core/heading', 7);
                                }
                            ?>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>


	</div><!-- #primary -->

<?php get_footer(); ?>
