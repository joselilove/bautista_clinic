<?= $this->element('navbar'); ?>
<?php $user = $this->Session->read('Auth.User'); ?>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Password</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/medications/home">Home</a></li>
                        <li class="breadcrumb-item active">Change password</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- Row -->
        <div class="row">
            <div class="col-lg-12 shadow-sm p-3 mb-5 bg-white rounded">
                <div class="card">
                    <div class="card-body">
                        <?= $this->Form->create(
                            $password,
                            [
                                'type' => 'post',
                                'class' => 'form-horizontal form-material',
                                'onsubmit' => 'disableField()'
                            ]
                        ) ?>
                        <div class="form-body">
                            <h3 class="card-title">Change password</h3>
                            <hr>
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= $this->Form->control('current_password', [
                                            'class' => 'form-control',
                                            'type' => 'password',
                                        ]) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= $this->Form->control('password', [
                                            'class' => 'form-control',
                                            'type' => 'password',
                                        ]) ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= $this->Form->control('confirm_password', [
                                            'class' => 'form-control',
                                            'type' => 'password',
                                        ]) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                            <a href="/patients"><button type="button" class="btn btn-secondary">Cancel</button></a>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row -->
    </div>
</div>