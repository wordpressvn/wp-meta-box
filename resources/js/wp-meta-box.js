jQuery(function($) {
    new ClipboardJS('.clipboard').on('success', function(event) {
        var $trigger = $(event.trigger),
            originalTooltip = $trigger.attr('tooltip'),
            copiedText = event.text;
            
        $trigger.attr('tooltip', wp.i18n.__('Copied: ') + copiedText);
        setTimeout(function() {
            $trigger.attr('tooltip', originalTooltip);
        }, 3000);
    });
});