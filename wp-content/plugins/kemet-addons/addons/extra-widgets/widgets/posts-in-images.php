<?php

$categories_obj	 = get_categories();
$categories= array();
foreach($categories_obj as $category){
    $categories[$category->term_id] = __($category->name, 'kemet-addons' );
}
$posts_in_images_widget = array(
  'title'       => __('Kemet Posts In Images', 'kemet-addons' ),
  'classname'   => 'kfw-widget-posts-images',
  'id'          => 'kemet-widget-posts-in-images',
  'description' => __('Posts In Images', 'kemet-addons' ),
  'fields'      => array(
    array(
      'id'      => 'title',
      'type'    => 'text',
      'title'   => __('Title:', 'kemet-addons' ),
      'default'   => __('Posts In Images', 'kemet-addons' ),
    ),
    array(
      'id'    => 'posts-number',
      'type'  => 'number',
      'title' => __('Number of posts to show', 'kemet-addons' ),
      'default'     => 12
    ),
    array(
      'id'          => 'select-category',
      'type'        => 'select',
      'title'       => __('Category', 'kemet-addons' ),
      'options'     => $categories,
      'multiple'    => true,
      'default'     => 1
    ),
    array(
      'id'          => 'posts-order',
      'type'        => 'select',
      'title'       => __('Posts Order', 'kemet-addons' ),
      'options'     => array(
            'most-recent' => __('Most Recent', 'kemet-addons' ),
            'random' => __('Random', 'kemet-addons' ),
      ),
      'default'     => 'most-recent'
    ),
  )
);

if( ! function_exists( 'kemet_widget_posts_in_images' ) ) {
  function kemet_widget_posts_in_images( $args, $instance ,$id) {
    echo $args['before_widget'];
    if ( ! empty( $instance['title'] ) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', esc_attr($instance['title'], 'kemet-addons' ) ) . $args['after_title'];
    }
    global $post;
    $orig_post = $post;

    $order = isset($instance['posts-order']) ? $instance['posts-order'] : 'random';
    $category = isset($instance['select-category']) ? $instance['select-category'] : 1;
    $posts_number = isset($instance['posts-number']) ? $instance['posts-number'] : 12;
    
    switch($order){
      case 'random':
          $cat_posts	 = get_posts( array( 'numberposts' => $posts_number, 'orderby' => 'rand', 'category' => $category ) );

          break;
      case 'most-recent':
          $cat_posts	 = get_posts( array( 'numberposts' => $posts_number, 'category' => $category ) );
      
          break;   
    }
    ?>
    <?php foreach ( $cat_posts as $post ){
			setup_postdata( $post );
			if ( function_exists( "has_post_thumbnail" ) && has_post_thumbnail() ) { 
        ?>
					<div class="wgt-img">
					      <a class="ttip" title="<?php esc_attr(the_title(), 'kemet-addons' ); ?>" href="<?php the_permalink(); ?>" ><?php the_post_thumbnail( array('50', '50') ) ?></a>
				  </div><!-- wgt-img /-->
			<?php }
        } 
      ?>
    <?php
    $post = $orig_post;
    echo $args['after_widget']; 
  } 
}

register_widget( Kemet_Create_Widget::instance( "kemet_widget_posts_in_images" , $posts_in_images_widget) );