<?php
/**
 * Widget to display 'Facebook Page Plugin'.
 *
 * Author: GalussoThemes
 * Author URI: https://galussothemes.com
 */

add_action ('widgets_init', 'jgcfpp_facebook_page_widget');
function jgcfpp_facebook_page_widget () {
	register_widget ('jgcfpp_widget_facebook_page');
}

class jgcfpp_widget_facebook_page extends WP_Widget {

	function __construct(){

		$widget_ops = array (
			'classname' => 'jgcfpp_widget_facebook_page',
			'description' => __('Creates a widget to display Facebook Page Plugin.', 'jgc-facebook-page-widget'),
		);

		parent::__construct('jgcfpp_widget_facebook_page', '(JGC) ' . __('Facebook Page Widget', 'jgc-facebook-page-widget'), $widget_ops);
	}

	function form ($instance) {

		$defaults = array (
			'title'         => '',
			'href'          => '',
			'hide_cover'    => '',
			'show_facepile' => '',
			'show_posts'    => '',
		);

		$instance = wp_parse_args ( (array) $instance, $defaults);

		$title         = $instance ['title'];
		$href          = $instance ['href'];
		$hide_cover    = $instance ['hide_cover'];
		$show_facepile = $instance ['show_facepile'];
		$show_posts    = $instance ['show_posts'];

		?>

        <p><?php _e('Widget Title', 'jgc-facebook-page-widget'); ?><br />
        	<input class="widefat"
            name="<?php echo $this->get_field_name('title'); ?>"
            type="text" value="<?php echo esc_attr($title); ?>" /></p>

        <p><?php _e('Facebook Page URL', 'jgc-facebook-page-widget'); ?>: &nbsp;
        	<input class="widefat"
            name="<?php echo $this->get_field_name('href'); ?>"
            type="text" value="<?php echo esc_attr($href); ?>"  /></p>

		<p><strong><?php _e( 'Options', 'jgc-facebook-page-widget' ); ?></strong></p>

		<p>
		<input name="<?php echo $this->get_field_name('hide_cover'); ?>" type="checkbox"
		<?php echo checked($hide_cover, 'on', false); ?> /> <?php _e('Hide cover', 'jgc-facebook-page-widget'); ?>
		</p>

		<p>
		<input name="<?php echo $this->get_field_name('show_facepile'); ?>" type="checkbox"
		<?php echo checked($show_facepile, 'on', false); ?> /> <?php _e('Show faces', 'jgc-facebook-page-widget'); ?>
		</p>

		<p>
		<input name="<?php echo $this->get_field_name('show_posts'); ?>" type="checkbox"
		<?php echo checked($show_posts, 'on', false); ?> /> <?php _e('Show posts', 'jgc-facebook-page-widget'); ?>
		</p>

        <p><a style="font-style: italic; color:#919191; text-decoration: none;" href="https://galussothemes.com/wordpress-themes" target="_blank"><?php _e('Take a look to our Themes', 'jgc-facebook-page-widget'); ?> &raquo;</a></p><hr>
       <?php
	}

	function update ($new_instance, $old_instance) {

		$instance = $old_instance;
		$instance['title']         = sanitize_text_field ( $new_instance['title'] );
		$instance['href']          = esc_url( $new_instance['href']);
		$instance['hide_cover']    = (!empty( $new_instance['hide_cover']))    ? strip_tags( $new_instance['hide_cover'])    : '';
		$instance['show_facepile'] = (!empty( $new_instance['show_facepile'])) ? strip_tags( $new_instance['show_facepile']) : '';
		$instance['show_posts']    = (!empty( $new_instance['show_posts']))    ? strip_tags( $new_instance['show_posts'])    : '';

		return $instance;
	}

	function widget ($args, $instance) {

		extract ($args);

		echo $before_widget;

		$title         = (!empty($instance['title'])) ? apply_filters ('widget_title', $instance['title']) : '';
		$href          = (!empty($instance['href'])) ?  $instance['href'] : '';
		$hide_cover    = (!empty($instance['hide_cover'])) ?  $instance['hide_cover'] : '';
		$show_facepile = (!empty($instance['show_facepile'])) ?  $instance['show_facepile'] : '';
		$show_posts    = (!empty($instance['show_posts'])) ?  $instance['show_posts'] : '';

		$hide_cover    = ($hide_cover    == 'on') ? 'true' : 'false';
		$show_facepile = ($show_facepile == 'on') ? 'true' : 'false';
		$show_posts    = ($show_posts    == 'on') ? 'true' : 'false';

		$idioma = str_replace('-', '_', get_bloginfo('language'));

		if (!empty($title)) {
			echo $before_title . esc_html ($title) . $after_title;
		}

		 ?>

		<div id="fb-root"></div>

		<script>(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/<?php echo $idioma;?>/sdk.js#xfbml=1&version=v2.3";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>

        	<div class="fb-page" data-href="<?php echo $href; ?>" data-small-header="false" data-adapt-container-width="true" data-hide-cover="<?php echo $hide_cover; ?>" data-show-facepile="<?php echo $show_facepile; ?>" data-show-posts="<?php echo $show_posts; ?>"></div>

		<?php

		echo $after_widget;

	} // widget()

} // class
