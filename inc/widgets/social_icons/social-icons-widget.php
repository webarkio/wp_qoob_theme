<?php
/*
  Plugin Name: Social Icons Widget
  Plugin URI:
  Description: 
  Author: 
  Author 
 */

/**
 * Adds Social_Icons widget.
 */
class Social_Icons extends WP_Widget {

    public $iconsClass = array(
        'twitter' => "fa fa-twitter",
        'facebook' => "fa fa-facebook-official", 
        'google' => "fa fa-google-plus",
        'instagram' => "fa fa-instagram",
        'youtube' => "fa fa-youtube" 
    );


    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
                'Social_Icons',
                __('Social Networks Profiles', 'qoob-theme'), // Name
                array('description' => __('Links to Author social media profile', 'qoob-theme'))
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        $links = '';
        echo $args['before_widget'];
        ?>
        <div class="social-icon-block  black-bg">
            <div class="block-icons">
                <?php
                foreach($instance as $key => $value) {
                    if (!empty($value)) {
                        echo '<a class="social-icons '.$this->iconsClass[$key].' '.$key.'" href="' . $value . '"></a>';
                    }
                }
                ?>  
            </div>
        </div>
        <?php
        echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance) {
        if(empty($instance) === true) {
            $instance['twitter'] = '#';
            $instance['facebook'] = '#';
            $instance['google'] = '#';
            $instance['instagram'] = '#';
            $instance['youtube'] = '#';
        }
        foreach($instance as $key => $value) {
            $id = $this->get_field_id($key);
            $name = $this->get_field_name($key);
            ?>
            <p>
                <label for="<?php echo $id; ?>"><?php echo ucfirst($key); ?></label> 
                <input class="widefat" id="<?php echo $id; ?>" name="<?php echo $name; ?>" type="text" value="<?php echo esc_attr($value); ?>">
            </p>
            <?php
        }
         
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $array = array();
        $array['twitter'] = (!empty($new_instance['twitter']) ) ? strip_tags($new_instance['twitter']) : '';
        $array['facebook'] = (!empty($new_instance['facebook']) ) ? strip_tags($new_instance['facebook']) : '';
        $array['google'] = (!empty($new_instance['google']) ) ? strip_tags($new_instance['google']) : '';
        $array['instagram'] = (!empty($new_instance['instagram']) ) ? strip_tags($new_instance['instagram']) : '';
        $array['youtube'] = (!empty($new_instance['youtube']) ) ? strip_tags($new_instance['youtube']) : '';
        
        return $array;
    }

}

// register Social_Icons widget
function register_social_profile() {
    register_widget('Social_Icons');
}

add_action('widgets_init', 'register_social_profile');

// enqueue css stylesheet
function social_icons_widget_css() {
    wp_enqueue_style('social-icons-widget', get_template_directory_uri() . '/inc/widgets/social_icons/social-icons-widget.css');
}

add_action('wp_enqueue_scripts', 'social_icons_widget_css');