<?= $this->Form->create(
    $patient,
    [
        'type' => 'post',
        'onsubmit' => 'disableField()'
    ]
) ?>
<div class="card-body">
    <h4 class="card-title">Patient Information</h4>
</div>
<hr>
<div class="form-body">
    <div class="card-body">
        <?= $this->Form->control(
            'user_id',
            [
                'type' => 'hidden',
                'value' => 1
            ]
        ); ?>
        <div class="row pt-3">
            <div class="col-md-4">
                <div class="form-group">
                    <?= $this->Form->control(
                        'pat_fname',
                        [
                            'type' => 'text',
                            'class' => 'form-control',
                            'label' => 'First name'
                        ]
                    ); ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= $this->Form->control(
                        'pat_middle_initial',
                        [
                            'type' => 'text',
                            'class' => 'form-control',
                            'label' => 'Middle initial'
                        ]
                    ); ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= $this->Form->control(
                        'pat_lname',
                        [
                            'type' => 'text',
                            'class' => 'form-control',
                            'label' => 'Last name'
                        ]
                    ); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?= $this->Form->control(
                        'pat_address',
                        [
                            'type' => 'text',
                            'class' => 'form-control',
                            'label' => 'Address'
                        ]
                    ); ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Gender</label>
                    <?= $this->Form->select(
                        'pat_gender',
                        ['Female', 'Male'],
                        ['class' => 'form-control custom-select']
                    ); ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?= $this->Form->control(
                        'pat_occupation',
                        [
                            'type' => 'text',
                            'class' => 'form-control',
                            'label' => 'Occupation'
                        ]
                    ); ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?= $this->Form->control(
                        'pat_contact',
                        [
                            'type' => 'number',
                            'class' => 'form-control',
                            'label' => 'Contact',
                        ]
                    ); ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?= $this->Form->control(
                        'pat_age',
                        [
                            'type' => 'number',
                            'class' => 'form-control',
                            'label' => 'Age'
                        ]
                    ); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <div class="card-body">
            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
            <a href="/patients"><button type="button" class="btn btn-secondary">Cancel</button></a>
        </div>
    </div>
</div>
<?= $this->Form->end() ?>