<!DOCTYPE html>
<html lang="en">
<?= $this->Html->css('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css') ?>
<?= $this->Html->script('https://code.jquery.com/jquery-3.3.1.slim.min.js') ?>
<?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js') ?>
<?= $this->Html->script('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js') ?>
<?= $this->Html->css('/css/auth.css') ?>
<style type="text/css">

</style>
<nav class="navbar navbar-light shadow-sm fixed-top" style="background-color:#20c997; opacity:0.8">
    <span class="navbar-brand mb-0 h3" style="margin-left:auto; margin-right:auto">Bautista Clinic Record Management System</span>
</nav>
<div class="login-form" style="margin-top:1%">
    <?= $this->Form->create(
        $user,
        [
            'type' => 'post',
            'enctype' => 'multipart/form-data',
            'onsubmit' => 'disableField()'
        ]
    ) ?>
    <div class="avatar">
        <img src="/img/profile/profile.png" alt="Avatar">
    </div>
    <h2 class="text-center">Register</h2>
    <div class="form-group">
        <?= $this->Form->control('username', [
            'class' => 'form-control',
            'type' => 'text',
            'label' => false,
            'placeholder' => 'Username'
        ]) ?>
    </div>
    <div class="form-group">
        <?= $this->Form->control('password', [
            'class' => 'form-control',
            'type' => 'password',
            'label' => false,
            'placeholder' => 'Password'
        ]) ?>
    </div>
    <div class="form-group">
        <?= $this->Form->control('confirm_password', [
            'class' => 'form-control',
            'type' => 'password',
            'label' => false,
            'placeholder' => 'Confirm_password'
        ]) ?>
    </div>
    <div class="form-group">
        <?= $this->Form->control('name', [
            'class' => 'form-control',
            'type' => 'text',
            'label' => false,
            'placeholder' => 'Name'
        ]) ?>
    </div>
    <div class="form-group">
        <?= $this->Form->control('email', [
            'class' => 'form-control',
            'type' => 'email',
            'label' => false,
            'placeholder' => 'Email'
        ]) ?>
    </div>
    <div class="form-group">
        <?= $this->Form->select(
            'emp_type',
            ['Secretary', 'Doctor'],
            ['class' => 'form-control']
        ); ?>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-lg btn-block">Sign up</button>
    </div>
    <div class="clearfix text-center">
        <p class="text-center">Already have an account? <a href="/users/login" class="text-success"><b>Sign in here!</b></a></p>
        <a href="/users/recover">Forgot Password?</a>
    </div>
    <?= $this->Form->end() ?>
</div>
<script>
    $(document).ready(function() {
        $('footer').hide();
    });
</script>