<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js') ?>
<?= $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.css') ?>
<script>
    $(function() {
        successNotification('<?= $message ?>');
    });

    function successNotification(message) {
        "use strict";
        $.toast({
            heading: `<small><b>${message}</b></small>`,
            text: '<small>Thank you!</small>',
            position: 'top-left',
            loaderBg: '#ff6849',
            icon: 'success',
            hideAfter: 4500,
            stack: 6
        });
    }
</script>