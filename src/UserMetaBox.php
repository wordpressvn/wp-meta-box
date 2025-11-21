<?php

namespace WPVNTeam\WPMetaBox;

class UserMetaBox extends MetaBox
{
    public $options = [];
    public $user_roles = [];

    public function set_role($role)
    {
        $roles = $this->user_roles;
        $roles[] = $role;
        return $this->set_roles($roles);
    }

    public function set_roles($roles)
    {
        $this->user_roles = (array) $roles;
        return $this;
    }

    public function get_roles()
    {
        return $this->user_roles;
    }

    public function register()
    {
        add_action('show_user_profile', [$this, 'render']);
        add_action('edit_user_profile', [$this, 'render']);
        add_action('personal_options_update', [$this, 'save']);
        add_action('edit_user_profile_update', [$this, 'save']);
    }

    public function render($user)
    {
        $this->current_user_id = $user->ID;

        Enqueuer::enqueue();

        if (!empty($this->user_roles)) {
            $roles = $user->roles ?? [];
            if (!array_intersect($roles, $this->user_roles)) return;
        }

        echo '<h2>' . esc_html($this->title) . '</h2>';
        echo '<table class="form-table">';

        foreach ($this->options as $option) {
            do_action('wmb_before_option_render', $option);
            echo $option->render();
            do_action('wmb_after_option_render', $option);
        }

        echo '</table>';
    }


    public function save($user_id = null)
    {
        if (!$user_id) return;

        if (!current_user_can('edit_user', $user_id)) return $user_id;

        foreach ($this->options as $option) {
            $option->save($user_id);
        }

        do_action('wmb_after_user_meta_box_save', $user_id, $this);
    }

    public function make()
    {
        $instance = WPMetaBox::instance();
        add_action('admin_enqueue_scripts', [$instance, 'enqueue_scripts']);
        $this->register();
    }

    public function add_option($type, $args = [])
    {
        $option = new UserOption($this, $type, $args);
        $this->options[] = $option;
        return $option;
    }
}
