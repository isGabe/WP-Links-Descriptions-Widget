<?php
/*
Plugin Name: Links From Custom Menu Widget
Plugin URI: https://github.com/TheF-Stop/WP-Links-Descriptions-Widget
Description: Extends WP Custom menu Widget to include link descriptions
Author: Gabriel Luethje
Version: 0.1
Author URI: http://thefstopdesign.com
*/

/*
 * First we append the native Walker, using the description.
 *
 * @see http://wordpress.stackexchange.com/q/14037/
 * @author toscho, http://toscho.de
 */
class FStop_Description_Walker extends Walker_Nav_Menu
  {
      function start_el(&$output, $item, $depth, $args) {
      parent::start_el($output, $item, $depth, $args);
      $output .= sprintf('&nbsp;<span class="link-description">%s</span>', esc_html($item->description));
      }
  }

/*
 * Next we create the widget. 
 * This is basically a copy of the WP code, taken from /wp-includes/default_widgets.php.
 * The only change is the addition of the walker to the wp_nav_menu call on line 50.
 */

class FStopLinksWidget extends WP_Widget
{

  function __construct() {
    $widget_ops = array( 'description' => __('Use this widget to add one of your custom menus as a widget. You can also add descriptions in the menu editor.') );
    parent::__construct( 'nav_menu', __('Links Menu - Plugin'), $widget_ops );
  }
 
  function widget($args, $instance) {
    // Get menu

    $nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

    if ( !$nav_menu )
      return;

    $instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

    echo $args['before_widget'];

    if ( !empty($instance['title']) )
      echo $args['before_title'] . $instance['title'] . $args['after_title'];

    wp_nav_menu( array( 'fallback_cb' => '', 'menu' => $nav_menu, 'walker' => new FStop_Description_Walker) ); // calling the new walker so we have descriptions

    echo $args['after_widget'];
  }
 
  function update( $new_instance, $old_instance ) {
    $instance['title'] = strip_tags( stripslashes($new_instance['title']) );
    $instance['nav_menu'] = (int) $new_instance['nav_menu'];
    return $instance;
  }
 
  function form( $instance ) {
    $title = isset( $instance['title'] ) ? $instance['title'] : '';
    $nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';

    // Get menus
    $menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );

    // If no menus exists, direct the user to go and create some.
    if ( !$menus ) {
      echo '<p>'. sprintf( __('No menus have been created yet. <a href="%s">Create some</a>.'), admin_url('nav-menus.php') ) .'</p>';
      return;
    }
    ?>
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('nav_menu'); ?>"><?php _e('Select Menu:'); ?></label>
      <select id="<?php echo $this->get_field_id('nav_menu'); ?>" name="<?php echo $this->get_field_name('nav_menu'); ?>">
    <?php
      foreach ( $menus as $menu ) {
        $selected = $nav_menu == $menu->term_id ? ' selected="selected"' : '';
        echo '<option'. $selected .' value="'. $menu->term_id .'">'. $menu->name .'</option>';
      }
    ?>
      </select>
    </p>
    <?php
  }
}

add_action( 'widgets_init', create_function('', 'return register_widget("FStopLinksWidget");') );

?>
