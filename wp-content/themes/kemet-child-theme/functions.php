<?php
// Incluir Estilos CSS
function styles_css()
{
    wp_enqueue_style('bootstrap_css', 'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css', array(), '4.5.3', false);
    wp_enqueue_style('chart_css', 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css', array(), '2.9.3', false);
    wp_enqueue_style('fullpage_css', 'https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/3.0.9/fullpage.min.css', array(), '3.0.9', false);
    wp_enqueue_style('parent-style', get_stylesheet_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'styles_css');

// Incluir Scripts JS
function script_js()
{
    wp_enqueue_script('bootstrap_js', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js', array('jquery'), '1.16.1', true);
    wp_enqueue_script('bootstrap_js', 'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js', array('jquery'), '4.5.3', true);
    wp_enqueue_script('chart_js', 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js', array('jquery'), '2.9.3', true);
    wp_enqueue_script('fullpage_js', 'https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/3.0.9/fullpage.min.js', array('jquery'), '3.0.9', true);
    wp_enqueue_script('chart_js', 'https://unpkg.com/sweet-scroll/sweet-scroll.min.js', array('jquery'), '4.0.0', true);
    wp_enqueue_script('custom_js', get_stylesheet_directory_uri().'/js/custom.js');
}
add_action('wp_enqueue_scripts', 'script_js');

//Añadir tag module
function add_type_attribute($tag, $handle, $src)
{
    if ('custom_js' === $handle) {
        $tag = '<script type="module" src="' . esc_url($src) . '"></script>';
    }
    return $tag;
}
add_filter('script_loader_tag', 'add_type_attribute', 10, 3);

//Registro de custom post tipo Work
function custom_post_type()
{
    $labels = array(

        'name'                => _x('Works', 'Post Type General Name', 'kemet'),

        'singular_name'       => _x('Work', 'Post Type Singular Name', 'kemet'),

        'menu_name'           => __('Works', 'kemet'),

        'parent_item_colon'   => __('Parent Work', 'kemet'),

        'all_items'           => __('All Works', 'kemet'),

        'view_item'           => __('View Work', 'kemet'),

        'add_new_item'        => __('Add New Work', 'kemet'),

        'add_new'             => __('Add New', 'kemet'),

        'edit_item'           => __('Edit Work', 'kemet'),

        'update_item'         => __('Update Work', 'kemet'),

        'search_items'        => __('Search Work', 'kemet'),

        'not_found'           => __('Not Found', 'kemet'),

        'not_found_in_trash'  => __('Not found in Trash', 'kemet'),

    );

    $args = array(

        'label'               => __('works', 'kemet'),

        'description'         => __('Work news and reviews', 'kemet'),

        'labels'              => $labels,

        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', ),

        // 'taxonomies'          => array( 'types' ),

        'hierarchical'        => false,

        'public'              => true,

        'show_ui'             => true,

        'show_in_menu'        => true,

        'show_in_nav_menus'   => true,

        'show_in_admin_bar'   => true,

        'menu_position'       => 5,

        'can_export'          => true,

        'has_archive'         => true,

        'exclude_from_search' => false,

        'publicly_queryable'  => true,

        'capability_type'     => 'post',

        'show_in_rest' => true,

    );

    register_post_type('works', $args);
}
add_action('init', 'custom_post_type', 0);

//Taxonomia para custom post type work

function create_work_taxonomies()
{
    /* Configuramos las etiquetas que mostraremos en el escritorio de WordPress */
    $labels = array(
    'name'             => _x('Tipos', 'taxonomy general name'),
    'singular_name'    => _x('Tipo', 'taxonomy singular name'),
    'search_items'     =>  __('Buscar por Tipo'),
    'all_items'        => __('Todos los Tipos'),
    'parent_item'      => __('Tipo padre'),
    'parent_item_colon'=> __('Tipo padre:'),
    'edit_item'        => __('Editar Tipo'),
    'update_item'      => __('Actualizar Tipo'),
    'add_new_item'     => __('Añadir nuevo Tipo'),
    'new_item_name'    => __('Nombre del nuevo Tipo'),
  );

    register_taxonomy('tipo', array( 'works' ), array(
    'hierarchical'       => true,
    'labels'             => $labels,
    'show_ui'            => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'tipo' ),
  ));
}
add_action('init', 'create_work_taxonomies', 0);

//Asigna una plantilla a Custom Post Type Work
function asign_block_template_works()
{
    $template= array(
        array( 'core-embed/youtube', array()),
        array( 'core/image', array()),
        array( 'core/columns', array(), array(
                array( 'core/column', array('width' =>33.33), array(
                    array( 'core/heading', array(
                        'level' => 2,
                        'content' => 'client name / brand name'
                    )),
                    array( 'core/heading', array(
                        'level' => 5,
                        'content' => 'by *team member name*'
                    )),
                    array( 'core/image', array())
                )),
                array( 'core/column', array('width' =>66.66), array(
                    array( 'core/paragraph', array(
                        'content' => 'Add a 1st inner paragraph'
                    )),
                    array( 'core-embed/youtube', array()),
                    array( 'core/image', array()),
                    array( 'core/paragraph', array(
                        'content' => 'Add a 2nd inner paragraph'
                    )),
                    array( 'core/heading', array(
                        'level' => 5,
                        'content' => 'type of work'
                    )),
                ))
            )
        )
    );
    $CPT_obj = get_post_type_object('works');
    $CPT_obj->template = $template;
    $CPT_obj->template_lock = 'all';
}
add_action('init', 'asign_block_template_works');

//Obtiene bloque de content y lo retorna de acuerdo al tipo y su orden respecto a los demas bloques
function display_post_block($type, $position)
{
    global $post;
    $blocks = parse_blocks($post->post_content);
    foreach ($blocks as $block) {
        // Chequeo por nombre de bloque
        if ($block['blockName'] === 'core/columns') {
            getInnerBlockFromColumns($block, $type, $position);
        } elseif ($type === $block['blockName']) {
            echo apply_filters('the_content', render_block($block));
            break;
        }
    }
}

//Obtiene bloques que se encuentren dentro de columnas
function getInnerBlockFromColumns($columnContainer, $type, $position)
{
    $step = 1;
    foreach ($columnContainer['innerBlocks'] as $column) {
        foreach ($column['innerBlocks'] as $el) {
            if ($el['blockName'] === $type && $step==$position) {
                echo apply_filters('the_content', render_block($el));
                break 2;
            }
            $step++;
        }
    }
}
