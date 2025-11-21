<?php if($option->is_multiple()) : ?>
    <input type="hidden" name="<?php echo esc_attr($option->get_name_attribute()); ?>">
    <select <?php echo $option->get_input_attributes_string(); ?>>
        <?php foreach ($option->get_options() as $key => $label) { ?>
            <option value="<?php echo $key; ?>" <?php echo in_array($key, $option->get_value_attribute()) ? 'selected' : ''; ?>><?php echo $label; ?></option>
        <?php } ?>
    </select>
<?php else: ?>
    <select <?php echo $option->get_input_attributes_string(); ?>>
        <?php foreach ($option->get_options() as $key => $label) { ?>
            <option value="<?php echo $key; ?>" <?php selected($option->get_value_attribute(), $key); ?>><?php echo $label; ?></option>
        <?php } ?>
    </select>
<?php endif; ?>
