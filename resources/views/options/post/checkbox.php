<div class="wmb-input">
    <label for="<?php echo $option->get_id_attribute(); ?>">
    <div>
        <input name="<?php echo esc_attr($option->get_name_attribute()); ?>" id="<?php echo $option->get_id_attribute(); ?>" type="checkbox" value="<?php echo $option->get_value_attribute(); ?>" <?php echo $option->is_checked() ? 'checked' : null; ?>>

        <?php if ($description = $option->get_description()) { ?>
            <p class="wmb-input-description"><?php echo $description; ?></p>
        <?php } ?>
    </div><?php echo $option->get_label(); ?></label>
</div>
