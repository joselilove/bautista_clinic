<!DOCTYPE html>
<html lang="en">
<?= $this->Html->css('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css') ?>
<?= $this->Html->css('/css/auth.css') ?>
<style type="text/css">

</style>
<nav class="navbar navbar-light fixed-top" style="background-color:#20c997; opacity:0.8">
    <span class="navbar-brand mb-0 h3" style="margin-left:auto; margin-right:auto">Bautista Clinic Record Management System</span>
</nav>
<div class="login-form" style="margin-top:1%">
    <?= $this->Form->create(
        'User',
        [
            'type' => 'post',
            'enctype' => 'multipart/form-data',
            'onsubmit' => 'disableField()',
        ]
    ) ?>
    <div class="avatar">
        <img src="/img/profile/profile.png" alt="Avatar">
    </div>
    <h2 class="text-center">Recover password</h2>
    <div class="form-group">
        <?= $this->Form->control('email', [
            'class' => 'form-control',
            'type' => 'text',
            'label' => false,
            'placeholder' => 'Email'
        ]) ?>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-lg btn-block">Reset</button>
    </div>
    <div class="clearfix text-center">
        <a href="/users/register" class="text-success float-left"><b>Sign up here!</b></a>
        <a href="/users/login" class="text-success float-right"><b>Sign in here!</b></a>
    </div>
    <?= $this->Form->end() ?>
</div>
<script>
$(document).ready(function () {
    $('footer').hide();
});
</script>