<?php 
/*
Plugin Name: ST Teachers List 
Plugin URI: http://softtech-it.com 
Version: 1.0 
Description: Teachers List and Details for School and College Websites 
Author: SoftTech-IT 
Author URI: http://softtech-it.com 
Licence: GPL2 
Textdomain: teachers
*/

add_action('init','st_teachers_plugins_neccessary');

function st_teachers_plugins_neccessary(){
	register_post_type('teachers', array(
		'labels' => array(
			'name' => __('Teachers', 'teachers'),
			'add_new_item' => __('Add New Teacher', 'teachers'),
			'add_new' => __('Add Teacher', 'teachers')
		),
		'public' => true,
		'supports' => array('title', 'editor', 'thumbnail'),
		'menu_icon' => 'dashicons-groups'
	));
}


add_shortcode('teachers', function(){ 

$teachers = new WP_Query(array(
	'post_type' => 'teachers',
	'posts_per_page' => -1
));
if($teachers->have_posts()) :
?>
	<div class="st-teachers"> 
<?php 

while($teachers->have_posts()) : $teachers->the_post(); 

ob_start(); 

?>

		<div class="teachers"> 
			<div class="image">
				<?php the_post_thumbnail(); ?>
			</div>
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php echo wp_trim_words(get_the_content(), 20, 'readmore'); ?>
		</div>

	
	
	
<?php endwhile; wp_reset_postdata(); ?>
	</div>
<?php endif;

$teacherssss = ob_get_clean();

return $teacherssss;
});



function css_add_korbo(){
	wp_register_style('style', plugins_url('/css/style.css', __FILE__));
	
	wp_enqueue_style('style');
}
add_action('wp_enqueue_scripts', 'css_add_korbo');



