<?php

namespace WPVNTeam\WPMetaBox\Options;

use WPVNTeam\WPMetaBox\Enqueuer;

use function WPVNTeam\WPMetaBox\resource_content as resource_content;

class Color extends OptionAbstract
{
    public $view = 'text';

    public function __construct($section, $args = [])
    {
        add_action('admin_enqueue_scripts', [$this, 'enqueue']);

        $this->default_args['css']['input_class'] = 'wmb-color-picker';
        $this->default_args['type'] = 'text';

        parent::__construct($section, $args);
    }

    public function enqueue()
    {
        Enqueuer::add('wmb-color-picker', function () {
            wp_enqueue_style('wp-color-picker');
            wp_enqueue_script('wp-color-picker');
            wp_register_script('wmb-color-picker', false);
            wp_enqueue_script('wmb-color-picker');
            wp_add_inline_script('wmb-color-picker', resource_content('js/wmb-color-picker.js'));
        });
    }
}
