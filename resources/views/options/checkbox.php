<?php if($option->is_multiple()) : ?>
    <ul class="categorychecklist form-no-clear">
        <?php foreach ($option->get_options() as $key => $label) { ?>
            <li class="selectit"><label><input type="checkbox" <?php echo $option->get_input_attributes_string(); ?> value="<?php echo $key; ?>" <?php echo in_array($key, $option->get_value_attribute()) ? 'checked' : ''; ?>><?php echo $label; ?></label></li>
        <?php } ?>
    </ul>
<?php else: ?>
    <input type="checkbox" <?php echo $option->get_input_attributes_string(['value' => $option->get_value_attribute()]); ?>
    <?php echo $option->is_checked() ? 'checked' : ''; ?>>
<?php endif; ?>
