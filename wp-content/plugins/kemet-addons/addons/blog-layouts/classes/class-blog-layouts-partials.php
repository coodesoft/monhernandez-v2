<?php
/**
 * Blog Layouts
 * 
 * @package Kemet Addons
 */
if (! class_exists('Kemet_Blog_Layouts_Partials')) {

    class Kemet_Blog_Layouts_Partials {
        private static $instance;
        
        public static function get_instance()
        {
            if (! isset(self::$instance)) {
                self::$instance = new self();
            }
            return self::$instance;
        }
        /**
		 *  Constructor
		 */
		public function __construct() {
            add_action( 'kemet_get_css_files', array( $this, 'add_styles' ) , 5);
            remove_action( 'kemet_pagination', 'kemet_number_pagination' );
            add_action( 'kemet_pagination', array( $this,'kemet_addons_number_pagination') );
            add_filter( 'post_class', array( $this, 'kemet_post_class_blog_grid' ) );
            add_filter( 'excerpt_length', array( $this, 'kemet_custom_excerpt_length' ));
            add_filter( 'kemet_blog_post_container', array( $this, 'kemet_blog_post_container' ));
            add_action( 'kemet_get_js_files', array( $this, 'add_scripts' ) );
            add_action( 'wp_enqueue_scripts', array( $this,'site_scripts') , 1);
            add_filter( 'kemet_theme_js_localize', array( $this, 'blog_js_localize' ) );
            add_action( 'wp_ajax_kemet_pagination_infinite', array( $this, 'kemet_pagination_infinite' ) );
			add_action( 'wp_ajax_nopriv_kemet_pagination_infinite', array( $this, 'kemet_pagination_infinite' ) );
        }

        function kemet_post_class_blog_grid( $classes ) {

            $is_ajax_pagination = $this->is_ajax_pagination();

            if ( is_archive() || is_home() || is_search() || $is_ajax_pagination) {

                $blog_layout = kemet_get_option('blog-layouts');
                $blog_grids = kemet_get_option('blog-grids');
    
                if ( $is_ajax_pagination ) {
                    $classes[] = 'kmt-col-sm-12';
                    $classes[] = 'kmt-article-post';
                }
                
                if($blog_layout == 'blog-layout-2'){

                    if(in_array('kmt-col-sm-12' , $classes)){
                        $overlay_enabled = array_search('kmt-col-sm-12', $classes);
                        unset($classes[$overlay_enabled]);
                    }
                    $desktop_columns = !empty($blog_grids['desktop']) ? ' kmt-col-md-' . strval(12 / $blog_grids['desktop']) : '';
                    $tablet_columns = !empty($blog_grids['tablet']) ? ' kmt-col-sm-' . strval(12 / $blog_grids['tablet']) : ' kmt-col-sm-12';
                    $mobile_columns = !empty($blog_grids['mobile']) ? ' kmt-col-xs-' . strval(12 / $blog_grids['mobile']) : ' kmt-col-xs-12';
                    $classes[] = $desktop_columns . $tablet_columns . $mobile_columns;
                }
            }

            return $classes;

        }
        
        function kemet_blog_post_container($classes){
            $classes[] = kemet_get_option( 'blog-layouts' );
            $blog_layout = kemet_get_option('blog-layouts');

            if($blog_layout == 'blog-layout-2'){
                $classes [] = !empty(kemet_get_option( 'blog-layout-mode' )) ? kemet_get_option( 'blog-layout-mode' ) : 'fitRows';
            }
            $classes[] = kemet_get_option( 'overlay-image-style' ) != 'none' ? kemet_get_option( 'overlay-image-style' ) : '';
            $classes[]  = kemet_get_option( 'hover-image-effect' )!= 'none' ? kemet_get_option( 'hover-image-effect' ) : '';
            $classes[]  = kemet_get_option('post-image-position') == 'left' ? 'kmt-img-left' : 'kmt-img-right';
            return $classes;
        }
        function kemet_custom_excerpt_length(){
            $excerpt_length = !empty(kemet_get_option('blog-excerpt-length')) ? kemet_get_option('blog-excerpt-length') : 50;

            return $excerpt_length;
        }

        /**
         * Kemet addons Pagination
         *
         */
        function kemet_addons_number_pagination() {
            global $numpages;

            $enabled = apply_filters( 'kemet_pagination_enabled', true );
            $pagination_style = kemet_get_option('blog-pagination-style');
            $prev_text = $pagination_style == 'next-prev' ? kemet_theme_strings( 'string-blog-navigation-previous', false ) : '<span class="dashicons dashicons-arrow-left-alt2"></span>';
            $next_text = $pagination_style == 'next-prev' ? kemet_theme_strings( 'string-blog-navigation-next', false ) : '<span class="dashicons dashicons-arrow-right-alt2"></span>';

            if ( isset( $numpages ) && $enabled && $pagination_style != 'infinite-scroll' ) {
                ob_start();
                echo "<div class='kmt-pagination ". $pagination_style ."'>";
                the_posts_pagination(
                    array(
                        'prev_text'    => $prev_text,
                        'next_text'    => $next_text,
                        'taxonomy'     => 'category',
                        'in_same_term' => true,
                    )
                );
                echo '</div>';
                $output = ob_get_clean();
                echo apply_filters( 'kemet_pagination_markup', $output ); // WPCS: XSS OK.

            }else if($pagination_style == 'infinite-scroll'){ 
                $end_text = kemet_get_option('blog-infinite-scroll-last-text');
                $msg = esc_html__( $end_text , 'kemet-addons' );
                ?>

                <div class="kmt-infinite-scroll-loader">
				<div class="kmt-infinite-scroll-dots">
					<span class="kmt-loader"></span>
					<span class="kmt-loader"></span>
					<span class="kmt-loader"></span>
					<span class="kmt-loader"></span>
				</div>
				<p class="infinite-scroll-end-msg"><?php echo esc_attr( $msg ); ?></p>
			</div>

           <?php }
        }
        
        /**
		 * Infinite Posts Show on scroll
		 *
		 * @since 1.0
		 * @param array $localize   JS localize variables.
		 * @return array
		 */
		function blog_js_localize( $localize ) {

			global $wp_query;
            $blog_pagination = kemet_get_option('blog-pagination-style');

			$localize['ajax_url'] 						 = admin_url( 'admin-ajax.php' );
			$localize['blog_infinite_count']        	 = 2;
			$localize['blog_infinite_total']        	 = $wp_query->max_num_pages;
			$localize['pagination_style']        	     = $blog_pagination;
			$localize['blog_infinite_nonce']        	 = wp_create_nonce( 'kmt-load-more-nonce' );
			$localize['query_vars']                 	 = json_encode( $wp_query->query_vars );

			return $localize;
		}


        /**
		 * Infinite Posts Show on scroll
		 */
		function kemet_pagination_infinite() {

			check_ajax_referer( 'kmt-load-more-nonce', 'nonce' );

			do_action( 'kemet_pagination_infinite' );

			$query_vars                = json_decode( stripslashes( $_POST['query_vars'] ), true );
			$query_vars['paged']       = ( isset( $_POST['page_no'] ) ) ? stripslashes( $_POST['page_no'] ) : 1;
			$query_vars['post_status'] = 'publish';
			$posts                     = new WP_Query( $query_vars );

			if ( $posts->have_posts() ) {
				while ( $posts->have_posts() ) {
                    $posts->the_post();
					get_template_part( 'templates/content', 'blog' );
				}
			}
			wp_reset_query();

			wp_die();
        }
        
        /**
		 * Check if ajax pagination is calling.
		 *
		 * @return boolean classes
		 */
		function is_ajax_pagination() {

			$pagination = false;

			if ( isset( $_POST['kemet_infinite'] ) && wp_doing_ajax() && check_ajax_referer( 'kmt-load-more-nonce', 'nonce', false ) ) {
				$pagination = true;
			}

			return $pagination;
        }

        /**
		 * Enqueue Scripts
		 */
        function site_scripts() {
            wp_enqueue_script('masonry');
        }
        function add_styles() {
            Kemet_Style_Generator::kmt_add_css( KEMET_BLOG_LAYOUTS_DIR.'assets/css/minified/blog-layouts.min.css');

        }
        public function add_scripts() {
            Kemet_Style_Generator::kmt_add_js(KEMET_BLOG_LAYOUTS_DIR.'assets/js/minified/blog-layouts.min.js');
       }
    }
}
Kemet_Blog_Layouts_Partials::get_instance();
