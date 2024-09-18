<?php

namespace WPVNTeam\WPMetaBox\Options;

use WPVNTeam\WPMetaBox\Options\OptionAbstract;

class CheckboxMultiple extends OptionAbstract
{
    public $view = 'checkbox-multiple';
    
	public function __construct($section, $args = [])
	{
		add_action('admin_enqueue_scripts', [$this, 'enqueue']);

		parent::__construct($section, $args);
	}

	public function enqueue()
	{
		wp_enqueue_script('wp-meta-box');
        wp_add_inline_script('wp-meta-box', "
            jQuery(function($) {
                $('.select-all').on('click', function() {
                    $(this).closest('td').find('input[type=\"checkbox\"]').prop('checked', true);
                });
                $('.deselect').on('click', function() {
                    $(this).closest('td').find('input[type=\"checkbox\"]').prop('checked', false);
                });
            });
        ");
	}

    public function get_name_attribute()
    {
        $name = parent::get_name_attribute();

        return "{$name}[]";
    }

    public function get_value_from_request()
    {
        return $_REQUEST[parent::get_name_attribute()] ?? [];
    }

    public function get_value_attribute()
    {
        $value = parent::get_value_attribute();

        if (empty($value)) {
            return [];
        }

        return (array) $value;
    }
}
