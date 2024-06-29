<?php

/* namespace WPVNTeam\WPMetaBox\Options;

class Checkbox extends OptionAbstract
{
    public $view = 'checkbox';

    public function get_value_attribute()
    {
        return '1';
    }

    public function is_checked()
    {
        return parent::get_value_attribute();
    }
}
 */
 
namespace WPVNTeam\WPMetaBox\Options;

class Checkbox extends OptionAbstract
{
    public $view = 'checkbox';

    public function __construct($section, $args = [])
    {
        parent::__construct($section, $args);
    }

    public function is_multiple()
    {
        return $this->get_arg('multiple', false);
    }

    public function get_options()
    {
        $options = $this->get_arg('options', []);
        if (is_callable($options)) {
            return $options();
        }
        return $options;
    }

    public function get_name_attribute()
    {
        $name = parent::get_name_attribute();
        if ($this->is_multiple()) {
            return "{$name}[]";
        }
        return $name;
    }

    public function get_value_from_request()
    {
        $name = parent::get_name_attribute();
        return $_REQUEST[$name] ?? [];
    }

    public function get_value_attribute()
    {
        if ($this->is_multiple()) {
            $value = parent::get_value_attribute();
            if (empty($value)) {
                return [];
            }
            return (array) $value;
        }
        return '1';
    }

    public function is_checked($value = null)
    {
        if ($this->is_multiple()) {
            $selected_values = $this->get_value_attribute();
            return in_array($value, $selected_values);
        }
        return parent::get_value_attribute();
    }
}
