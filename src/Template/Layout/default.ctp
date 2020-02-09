<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->script('/assets/node_modules/jquery/jquery-3.2.1.min.js') ?>
    <?= $this->Html->script('/assets/node_modules/popper/popper.min.js') ?>
    <?= $this->Html->script('/assets/node_modules/bootstrap/dist/js/bootstrap.min.js') ?>
    <?= $this->Html->script('/dist/js/sidebarmenu.js') ?>
    <?= $this->Html->script('/dist/js/custom.min.js') ?>

    <?= $this->Html->css('/css/my_style.css') ?>
    <?= $this->Html->css('/dist/css/style.min.css') ?>
    <?= $this->Html->css('/dist/css/google_font.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<div class="print-hide">
    <?= $this->element('modal_vital'); ?>
</div>

<body class="logo-center fixed-layout skin-green-dark mini-sidebar">
    <div id="main-wrapper">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
        <footer class="footer">
            © 2019 MIS
        </footer>
    </div>
</body>

</html>
<script>
    function disableField() {
        $("input").prop("readonly", true);
        $("button").prop("disabled", true);
        $(".submit").prop("disabled", true);
    }

    function message() {
        return {
            delete_success: function() {
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            },
            failed: function() {
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                    footer: 'Please Try again later!!'
                })
            },
            bad: function() {
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'You are trying to delete other user properties',
                    footer: 'Please try again. Thank you!'
                })
            }
        }
    }
</script>