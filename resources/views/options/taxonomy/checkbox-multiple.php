<?php if ($option->get_object_id()) { ?>
	<tr class="form-field term-<?php echo esc_attr($option->get_name_attribute()); ?>-wrap">
		<th scope="row">
			<label for="<?php echo $option->get_id_attribute(); ?>"><?php echo $option->get_label(); ?></label>
		</th>
		<td>
			<div>
				<ul>
                    <?php foreach ($option->args['options'] as $key => $label) { ?>
                        <li>
                        <input name="<?php echo esc_attr($option->get_name_attribute()); ?>" id="<?php echo $option->get_id_attribute(); ?>_<?php echo $key; ?>" type="checkbox" value="<?php echo $key; ?>" <?php echo in_array($key, $option->get_value_attribute()) ? 'checked' : null; ?>><label for="<?php echo $option->get_id_attribute(); ?>_<?php echo $key; ?>"><?php echo $label; ?></label>
                        </li>
                    <?php } ?>
                </ul>

				<?php if ($description = $option->get_description()) { ?>
					<p class="wmb-input-description"><?php echo $description; ?></p>
				<?php } ?>
			</div>
		</td>
	</tr>
<?php } else { ?>
	<div class="form-field term-<?php echo esc_attr($option->get_name_attribute()); ?>-wrap">
        <label for="<?php echo $option->get_id_attribute(); ?>"><?php echo $option->get_label(); ?></label>
        <div>
            <ul>
                <?php foreach ($option->args['options'] as $key => $label) { ?>
                    <li>
                    <input name="<?php echo esc_attr($option->get_name_attribute()); ?>" id="<?php echo $option->get_id_attribute(); ?>_<?php echo $key; ?>" type="checkbox" value="<?php echo $key; ?>" <?php echo in_array($key, $option->get_value_attribute()) ? 'checked' : null; ?>><label for="<?php echo $option->get_id_attribute(); ?>_<?php echo $key; ?>"><?php echo $label; ?></label>
                    </li>
                <?php } ?>
            </ul>

            <?php if ($description = $option->get_description()) { ?>
                <p class="wmb-input-description"><?php echo $description; ?></p>
            <?php } ?>
        </div>
    </div>
<?php } ?>



