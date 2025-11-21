<div class="wmb-input <?php echo $option->get_group_class_attribute(); ?>">
    <?php if ($label = $option->get_label()) { ?>
        <label for="<?php echo $option->get_id_attribute(); ?>" class="<?php echo $option->get_label_class_attribute(); ?>"><?php echo $label; ?></label>
    <?php } ?>
    <div>
        <?php echo $slot; ?>
        <?php if ($description = $option->get_description()) { ?>
            <?php echo $description; ?>
        <?php } ?>
    </div>
</div>