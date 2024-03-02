<div class="wmb-input">
    <label for="<?php echo $option->get_id_attribute(); ?>"><?php echo $option->get_label(); ?></label>

    <div wmb-media-library="<?php echo esc_attr(wp_json_encode($option->media_library_options())); ?>">
        <input name="<?php echo esc_attr($option->get_name_attribute()); ?>" id="<?php echo $option->get_id_attribute(); ?>" type="<?php echo $option->get_arg('type', 'hidden'); ?>" value="<?php echo $option->get_value_attribute(); ?>" class="">

        <div wmb-media-library:preview>
            <?php if ($option->get_value_attribute()) { ?>
                <p>
                    <?php if ($option->get_arg('mime_type') == "video") { ?>
                        <?php echo wp_oembed_get($option->get_preview_url(), array('width' => 254) ); ?>
                    <?php } else { ?>
                        <img style="max-width:254px;" src="<?php echo $option->get_preview_url(); ?>" />
                    <?php } ?>
                    <?php if($option instanceof WPVNTeam\WPMetaBox\Options\Image === false) { ?>
                        <?php echo $option->get_file_name(); ?>
                    <?php } ?>
                </p>
            <?php } ?>

            <button type="button" class="components-button is-secondary is-small" style="margin: 5px 0;" wmb-media-library:unset>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 15px; height: 15px;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>

                <?php _e('Remove'); ?>
            </button>
        </div>
        <?php if ($option->get_arg('mime_type') == "video") { ?>
            <button type="button" style="display: none;" class="components-button is-secondary is-small" wmb-media-library:open><?php _e('Select'); ?></button>
        <?php } else { ?>
            <button type="button" class="components-button is-secondary is-small" wmb-media-library:open><?php _e('Select'); ?></button>
        <?php } ?>

        <?php if ($description = $option->get_description()) { ?>
            <p class="wmb-input-description"><?php echo $description; ?></p>
        <?php } ?>
    </div>
</div>
