<?= $this->element('navbar'); ?>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Update Account</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/medications/home">Home</a></li>
                        <li class="breadcrumb-item active">Update Account</li>
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
                            $userUsed,
                            [
                                'type' => 'post',
                                'class' => 'form-horizontal form-material',
                                'enctype' => 'multipart/form-data',
                                'onsubmit' => 'disableField()'
                            ]
                        ) ?>
                        <div class="form-body">
                            <h3 class="card-title">Personal Info</h3>
                            <hr>
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= $this->Form->control('username', [
                                            'class' => 'form-control',
                                            'type' => 'text',
                                        ]) ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= $this->Form->control('email', [
                                            'class' => 'form-control',
                                            'type' => 'text',
                                        ]) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= $this->Form->select(
                                            'emp_type',
                                            ['Secretary', 'Doctor'],
                                            ['class' => 'form-control']
                                        ); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= $this->Form->control('name', [
                                            'class' => 'form-control',
                                            'type' => 'text',
                                        ]) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Update</button>
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