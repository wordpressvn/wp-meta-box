<?php

namespace WPVNTeam\WPMetaBox\Options;

use WPVNTeam\WPMetaBox\Enqueuer;
use WPVNTeam\WPMetaBox\Option;
use WPVNTeam\WPMetaBox\PostOption;
use WPVNTeam\WPMetaBox\TaxonomyMetaBox;
use WPVNTeam\WPMetaBox\TaxonomyOption;

use function WPVNTeam\WPMetaBox\resource_content as resource_content;

class Repeater extends OptionAbstract
{
    public $view = 'repeater';
    
    private static $scripts_loaded = false;

    public $options = [];

    public $groups_set = false;

    public function __construct($section, $args = [])
    {
        add_action('admin_enqueue_scripts', [$this, 'enqueue']);

        parent::__construct($section, $args);
    }

    public function enqueue()
    {
        Enqueuer::add('wmb-repeater', function () {
            if (!self::$scripts_loaded) {
                self::$scripts_loaded = true;
                wp_enqueue_script('jquery-ui-sortable');
                wp_register_script('wmb-repeater', false);
                wp_enqueue_script('wmb-repeater');
                wp_add_inline_script('wmb-repeater', resource_content('js/wmb-repeater.js'));
            }
        });
    }

    public function add_option($type, $args = [])
    {
        $option = new Option($this->meta_box, $type, array_merge($args, ['_parent' => $this]));

        $this->options[] = $option;

        return $this;
    }

    public function save($object_id = null)
    {
        $value = array_filter($this->get_value_from_request(), function ($group) {
            return array_filter($group);
        });

        if ($this->meta_box instanceof TaxonomyMetaBox) {
            if ($value) {
                update_term_meta($object_id, $this->get_name_attribute(), array_values($value));
            } else {
                delete_term_meta($object_id, $this->get_name_attribute());
            }
        } else {
            if ($value) {
                update_post_meta($this->get_object_id(), $this->get_name_attribute(), array_values($value));
            } else {
                delete_post_meta($this->get_object_id(), $this->get_name_attribute());
            }
        }
    }

    public function group_options()
    {
        $groups = [];

        if (! empty($this->groups_set)) {
            return $this->groups_set;
        }

        $value = $this->get_value_attribute();

        $iterate = ! empty($value) ? count($value) : 1;
        $count = 0;

        while ($count != $iterate) {
            foreach ($this->options as $option) {
                if ($this->meta_box instanceof TaxonomyMetaBox) {
                    $groups[$count][] = new TaxonomyOption($this->meta_box, $option->type, $option->args);
                } else {
                    $groups[$count][] = new PostOption($this->meta_box, $option->type, $option->args);
                }
            }
            $count++;
        }

        if (empty($groups)) {
            $groups[] = $this->options;

            $this->groups_set = $groups;

            return $groups;
        }

        $this->groups_set = $groups;

        return $groups;
    }

    public function get_option_by_name($name)
    {
        foreach ($this->options as $option) {
            if ($option->implementation->get_arg('name') === $name) {
                return $option;
            }
        }

        return false;
    }

    public function get_options()
    {
        $groups = $this->group_options();
        $repeater = $this;

        foreach ($groups as $index => $options) {
            foreach ($options as $option) {
                $option->implementation->set_custom_name($this->get_name_attribute().'['.$index.']'.'['.$option->implementation->get_arg('name').']');

                $option->implementation->set_custom_value(function ($object_id) use ($repeater, $index, $option) {
                    if ($option instanceof TaxonomyOption) {
                        $repeater_value = get_term_meta($object_id, $repeater->get_name_attribute(), true);
                    } else {
                        $repeater_value = get_post_meta($object_id, $repeater->get_name_attribute(), true);
                    }

                    return $repeater_value[$index][$option->implementation->get_arg('name')] ?? null;
                });
            }
        }

        return $groups;
    }
}
