<div class="wmb-code-editor">
    <textarea wmb-code-editor="<?php echo esc_attr(json_encode($option->get_editor_config())); ?>" <?php echo $option->get_input_attributes_string(); ?>><?php echo wp_unslash($option->get_value_attribute()); ?></textarea>
</div>