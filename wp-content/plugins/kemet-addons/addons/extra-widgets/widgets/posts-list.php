<?php
$posts_list_widget = array(
  'title'       => __('Kemet Posts List', 'kemet-addons' ),
  'classname'   => 'kfw-widget-posts-list',
  'id'          => 'kemet-widget-posts-list',
  'description' => __('Posts List', 'kemet-addons' ),
  'fields'      => array(
    array(
      'id'      => 'title',
      'type'    => 'text',
      'title'   => __('Title:', 'kemet-addons' ),
      'default'   => __('Posts List', 'kemet-addons' ),
    ),
    array(
      'id'    => 'posts-number',
      'type'  => 'number',
      'title' => __('Number of posts to show', 'kemet-addons' ),
      'default'     => 5
    ),
    array(
      'id'          => 'posts-order',
      'type'        => 'select',
      'title'       => __('Posts Order', 'kemet-addons' ),
      'options'     => array(
            'most-recent' => __('Most Recent', 'kemet-addons' ),
            'popular' => __('Popular', 'kemet-addons' ),
            'random' => __('Random', 'kemet-addons' ),
      ),
      'default'     => 'most-recent'
    ),
    array(
        'id'      => 'display-thumbinals',
        'type'    => 'checkbox',
        'title'   => __('Display Thumbinals', 'kemet-addons' ),
        'default' => true
      ),
  )
);

if( ! function_exists( 'kemet_widget_posts_list' ) ) {
  function kemet_widget_posts_list( $args, $instance ,$id) {
    echo $args['before_widget'];
    if ( ! empty( $instance['title'] ) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', esc_attr($instance['title'], 'kemet-addons' ) ) . $args['after_title'];
    }
    global $post;
    $orig_post = $post;

    $order = isset($instance['posts-order']) ? $instance['posts-order'] : 'random';
    $posts_number = isset($instance['posts-number']) ? $instance['posts-number'] : 5;
    $display_thumbnail = isset($instance['display-thumbinals']) ? $instance['display-thumbinals'] : true;
    switch($order){
      case 'random':
          $all_posts	 = get_posts( array( 'numberposts' => $posts_number, 'orderby' => 'rand' ) );

          break;
      case 'most-recent':
          $all_posts	 = get_posts( array( 'numberposts' => $posts_number ) );
      
          break; 
      case 'popular':
          $all_posts	 = get_posts( array( 'numberposts' => $posts_number, 'orderby' => 'comment_count' ) );
  
          break;        
    }?>
    <ul class="kmt-wdg-posts-list">
    <?php foreach ( $all_posts as $post ){
          setup_postdata( $post );
      echo '<li>';
      if ( function_exists( "has_post_thumbnail" ) && has_post_thumbnail() && $display_thumbnail) { ?>
          <div class="wgt-img">
					      <a class="ttip" title="<?php esc_attr(the_title(), 'kemet-addons' ); ?>" href="<?php the_permalink(); ?>" ><?php the_post_thumbnail( array('50', '50') ) ?></a>
				  </div><!-- wgt-img /-->
      <?php } ?>
        <div class="wdg-posttitle"><a href="<?php the_permalink(); ?>"><?php esc_attr(the_title(), 'kemet-addons' ); ?></a></div>
        <small class="small"><?php echo esc_attr(get_the_date(), 'kemet-addons' ); ?></small>
      </li>
        <?php } 
      ?>
    </ul>
    <?php
    $post = $orig_post;
    echo $args['after_widget']; 
  } 
}

register_widget( Kemet_Create_Widget::instance( "kemet_widget_posts_list" , $posts_list_widget) );