<?php
/*
Plugin Name:	WP Meetups Germany
Plugin URI: 	https://github.com/wpFRA/wpmeetups-widget
Description: 	Alle deutschen WP Meetups - in einem Widget.

Author:         wpFRA
Author URI: 	https://wpfra.de

Version:        0.1
Tested up to: 	4.1

License: 		GPL2
*/



/*
Copyright 2015 WP Meetup Frankfurt (wpfra.de) (e-mail: kontakt@wpfra.de)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


class wpmg_list extends WP_Widget {

	function wpmg_list() {
		$widget_ops = array('description' => 'Liste deutscher WP Meetups' , 'wpmg-widget');

		parent::WP_Widget(false, __('WP Meetups Germany', 'wpmg-widget'),$widget_ops);
	}

	function widget($args, $instance) {  
		extract( $args );
		$title = $instance['title'];
		
		echo $before_widget; ?>
		 <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>

        <div class="wpmg_widget widget_nav_menu">
			<ul class="menu">
				<li class="menu-item"><a href="http://wpmeetup-potsdam.de/" title="WP Meetup Potsdam" target="_blank" rel="nofollow">Meetup Potsdam</a></li>
				<li class="menu-item"><a href="http://wpmeetup-berlin.de/" title="WP Meetup Berlin" target="_blank" rel="nofollow">Meetup Berlin</a></li>
				<li class="menu-item"><a href="http://wpmeetup-hamburg.de/" title="WP Meetup Hamburg" target="_blank" rel="nofollow">Meetup Hamburg</a></li>
				<li class="menu-item"><a href="http://www.wpmeetup-hannover.de/" title="WP Meetup Hannover" target="_blank" rel="nofollow">Meetup Hannover</a></li>
				<li class="menu-item"><a href="http://wpmeetup-frankfurt.de/" title="WP Meetup Frankfurt" target="_blank" rel="nofollow">Meetup Frankfurt</a></li>
				<li class="menu-item"><a href="http://wpmeetup-franken.de/" title="WP Meetup Franken" target="_blank" rel="nofollow">Meetup Franken</a></li>
				<li class="menu-item"><a href="http://wpmeetup-stuttgart.de/" title="WP Meetup Stuttgart" target="_blank" rel="nofollow">Meetup Stuttgart</a></li>
				<li class="menu-item"><a href="http://www.meetup.com/WordPress-Meetup-Koln/" title="WP Meetup Köln" target="_blank" rel="nofollow">Meetup Köln</a></li>
				<li class="menu-item"><a href="http://wpmeetup-muenchen.org/" title="WP Meetup München" target="_blank" rel="nofollow">Meetup München</a></li>
				<li class="menu-item"><a href="http://www.wpmeetup-osnabrueck.de/" title="WP Meetup Osnabrück/Emsland" target="_blank" rel="nofollow">Meetup Osnabrück/Emsland</a></li>
				<li class="menu-item"><a href="http://wpmeetup-dresden.de/" title="WP Meetup Dresden" target="_blank" rel="nofollow">Meetup Dresden</a></li>
				<li class="menu-item"><a href="http://www.wpmeetup-eifel.de/" title="WP Meetup Eifel" target="_blank" rel="nofollow">Meetup Eifel</a></li>
				<li class="menu-item"><a href="http://wpmeetup-karlsruhe.de/" title="WP Meetup Karlsruhe" target="_blank" rel="nofollow">Meetup Karlsruhe</a></li>
			</ul>

		</div><!-- end .wpmg_widget -->

	   <?php			
	   echo $after_widget;
   }

   function update($new_instance, $old_instance) {                
       return $new_instance;
   }

   function form($instance) {
		$title = esc_attr($instance['title']);
		?>

		 <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Titel:','wpmg-widget'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
        </p>

		<?php
	} 
 
} // end class wpmg_list
add_action('widgets_init', create_function('', 'return register_widget("wpmg_list");'));
?>