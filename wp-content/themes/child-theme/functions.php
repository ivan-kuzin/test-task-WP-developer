<?php
// Create child theme
add_action( 'wp_enqueue_scripts', 'connect_custom_files' );
function connect_custom_files() {
	//Child theme creation
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_script('bootstrap-js', get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), false, true );
	wp_enqueue_style( 'bootstrap-css', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css' );
	wp_enqueue_script('Brazzers-js', get_stylesheet_directory_uri() . '/assets/js/jQuery.Brazzers-Carousel.min.js', array('jquery'), false, true );
	wp_enqueue_style( 'Brazzers-css', get_stylesheet_directory_uri() . '/assets/css/jQuery.Brazzers-Carousel.min.css' );
	wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/assets/js/script.js', array('jquery'), false, true );
}

//
add_action( 'init', 'register_post_types' );
function register_post_types(){
	//Register taxonomy
	register_taxonomy( 'type', [ 'realestate' ], [
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => [
			'name'              => 'Тип недвижимости',
			'singular_name'     => 'Тип',
			'search_items'      => 'Поиск',
			'all_items'         => 'Все типы',
			'view_item '        => 'Смотреть',
			'parent_item'       => 'Родительский тип',
			'parent_item_colon' => 'Родительский тип:',
			'edit_item'         => 'Редактирование типа',
			'update_item'       => 'Обновить',
			'add_new_item'      => 'Добавить новый тип',
			'new_item_name'     => 'Название нового типа',
			'menu_name'         => 'Тип недвижимости',
			'back_to_items'     => '← Назад',
		],
		'description'           => '', // описание таксономии
		'public'                => true,
		'hierarchical'          => true,

		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => null, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
		'show_admin_column'     => false, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
		'show_in_rest'          => null, // добавить в REST API
		'rest_base'             => null, // $taxonomy
		// '_builtin'              => false,
		//'update_count_callback' => '_update_post_term_count',
	] );

	//Register post type
	register_post_type( 'realestate', [
		'label'  => null,
		'labels' => [
			'name'               => 'Объекты недвижимости', // основное название для типа записи
			'singular_name'      => 'Объект недвижимости', // название для одной записи этого типа
			'add_new'            => 'Добавить объект', // для добавления новой записи
			'add_new_item'       => 'Добавление объекта', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование объекта', // для редактирования типа записи
			'new_item'           => 'Новый объект', // текст новой записи
			'view_item'          => 'Смотреть', // для просмотра записи этого типа.
			'search_items'       => 'Поиск', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'menu_name'          => 'Объекты недвижимости', // название меню
		],
		'description'         => '',
		'public'              => true,
		'show_in_menu'        => null, // показывать ли в меню адмнки
		'show_in_rest'        => null, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-admin-home',
		//'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'revisions'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [],
		'has_archive'         => false,
		'rewrite'             => true,
		'query_var'           => true,
	] );
}

//Show estate shortcode
add_shortcode('estate', 'estate_shortcode_logic');
function estate_shortcode_logic($atts){
	$atts = shortcode_atts( array(
		'count' => 5,
		'type' => 7,
		'title' => 'Заголовок секции'
	), $atts );

	$args = array(
			'post_type' => 'realestate',
			'posts_per_page' => $atts['count'],
			'post_status' => 'publish',
			'orderby' => 'title',
			'order' => 'ASC',
			'tax_query' => array(
				array(
					'taxonomy' => 'type',
					'field'    => 'id',
					'terms'    => $atts['type']
				)
			)
		);
		$query = new WP_Query( $args ); 
		ob_start();
		?>

	  <div class="estate-objects py-5 bg-light">
	    <div class="container">
	    	 <div class="row">
	      		<div class="col-12">
	        		<h2 class="fw-light"><?php echo $atts['title']; ?></h2>
	        	</div>
	        </div>
	       <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

	      	<?php if ( $query->have_posts() ) :
	      		  while ( $query->have_posts() ) : $query->the_post(); 
	      		  	if ( function_exists('get_field') ) {
	      		  		$area = get_field('area', get_the_ID());
	      		  		$cost = get_field('cost', get_the_ID());
	      		  		$floor = get_field('floor', get_the_ID());
	      		  		$gallery = get_field('gallery', get_the_ID());
	      		  		//print_r($gallery);
	      		  	}
	      		  	?>
			        <div class="col-12 col-sm-6 col-md-4">
			          <div class="card shadow-sm" id="object-<?php the_ID(); ?>">
			          	<?php
			          		$images = [];
							if ( has_post_thumbnail() ) {
								array_push($images, get_post_thumbnail_id(get_the_ID()));
							}
							if ( $gallery ) {
								foreach ($gallery as $id) {
									array_push($images, $id['id']);
								}
								//print_r($images);
								echo '<div class="thumbnail">';
								foreach ($images as $image) {
									echo wp_get_attachment_image( $image, 'medium');
								}
								echo '</div>';
							}
			          	?>
			            <div class="card-body">
			            	<a href="<?php the_permalink(); ?>" class="title-link">
			            		<h3><?php the_title(); ?></h3>
			            	</a>
			            	<?php if ( isset($area) || isset($cost) || isset($floor) ) {
			            		echo '<ul class="details">';
			            		if ( $area ) 
			            			echo '<li><span>Площадь:</span> '. $area .'м<sup>2</sup></li>';
			            		if ( $cost ) 
			            			echo '<li><span>Стоимость:</span> '. number_format( $cost, 0, ',', ' ' ) .'&#8381;</li>';
		            			if ( $floor ) 
			            			echo '<li><span>Этаж:</span> '. $floor .'</li>';
				            	echo '</ul>';
			            	} ?>
			            	<?php if( has_excerpt( get_the_ID() ) ){ 
			                	echo '<p class="card-text">'. the_excerpt() .'</p>';
			                	}
		                	?>
			              <div class="d-flex justify-content-between align-items-center">
			                <div class="btn-group">
			                	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" >
			                  		<button type="button" class="btn btn-sm btn-outline-secondary">Перейти</button>
			                  	</a>
			                  	<?php edit_post_link('Править', '<button type="button" class="btn btn-sm btn-outline-secondary">', '</button>'); ?>
			                </div>
			                <small class="text-muted"><?php the_time('d.m.y'); ?></small>
			              </div>
			            </div>
			          </div>
			        </div>
	        	<?php endwhile;
		        	  wp_reset_postdata();
					else : ?>
						<p>Ничего не найдено</p>
					<?php endif; ?>
	      </div>
	    </div>
	  </div>
<?php 
return ob_get_clean();
} 
?>
