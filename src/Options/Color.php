<?php

namespace WPVNTeam\WPMetaBox\Options;

use WPVNTeam\WPMetaBox\WPMetaBox;
use WPVNTeam\WPMetaBox\Options\OptionAbstract;
use function WPVNTeam\WPMetaBox\resource_content as resource_content;

class Color extends OptionAbstract
{
	public $view = 'color';

	public function __construct($section, $args = [])
	{
		add_action('admin_enqueue_scripts', [$this, 'enqueue']);

		parent::__construct($section, $args);
	}

	public function enqueue()
	{
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker');

		if (WPMetaBox::instance()->is_script_loaded('wmb-color-picker')) {
            return;
        }

        wp_register_script('wmb-color-picker', false);
        wp_enqueue_script('wmb-color-picker');
        wp_add_inline_script('wmb-color-picker', resource_content('js/wmb-color-picker.js'));

	    WPMetaBox::instance()->script_is_loaded('wmb-color-picker');
	}
}
