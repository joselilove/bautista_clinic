<!DOCTYPE html>
<html lang="en">
<?= $this->Html->css('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css') ?>
<?= $this->Html->css('auth.css') ?>
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
        <img src="img/profile/profile.png" alt="Avatar">
    </div>
    <h2 class="text-center">Login</h2>
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
        <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
    </div>
    <div class="clearfix text-center">
        <p class="text-center">Don't have an account? <a href="users/register" class="text-success"><b>Sign up here!</b></a></p>
        <a href="users/recover">Forgot Password?</a>
    </div>
    <?= $this->Form->end() ?>
</div>
<script>
    $(document).ready(function() {
        $('footer').hide();
    });
</script>