<?= $this->element('navbar'); ?>
<?= $this->Html->css('/dist/css/pages/floating-label.css'); ?>
<?= $this->Html->css('/dist/css/pages/stylish-tooltip.css'); ?>
<?= $this->Html->script('/assets/node_modules/sparkline/jquery.sparkline.min.js'); ?>
<?= $this->Html->script('/dist/js/waves.js'); ?>
<?= $this->Html->css('/assets/node_modules/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css'); ?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Appointment</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/medications/home">Home</a></li>
                        <li class="breadcrumb-item active">Appointment</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <ul class="nav nav-tabs profile-tab" role="tablist">
                            <li class="mr-auto"><a href="/medications/schedule"><button type="button" class="btn waves-effect waves-light btn-secondary">Update Schedule</button>
                            <a href="#" data-container="body" title="Did you know?" data-toggle="popover" data-placement="right" data-content="This is used to redirect the user to the list of schedule of the patients"><i class="icon-question"></i></a>
                        </a></li>
                            <li class="nav-item">
                                <?= $this->Form->create(
                                    'Patient',
                                    [
                                        'type' => 'get',
                                        'class' => 'app-search d-none d-md-block d-lg-block search_form',
                                        'onsubmit' => 'disableField()',
                                    ]
                                ) ?>
                                <?php if ($search != '') { ?>
                                    <a href="/Medications/appointment"><button type="button" class="btn waves-effect waves-light btn-secondary">Show all</button></a>
                                <?php } ?>
                                <input type="text" class="form-control border-dark" placeholder="Search & enter" name="search_name" value="<?= h($search); ?>">
                                <?= $this->Form->end() ?>
                            </li>
                        </ul>
                        <div class="row">
                            <?php foreach ($patients as $person) { ?>
                                <div class="col-md-4">
                                    <div class="card shadow-sm">
                                        <div class="card-header clicked-status clicked-status-<?= $person->id ?>">
                                            <?= h($person->pat_fname); ?> <?= h($person->pat_lname); ?>
                                            <div class="card-actions">
                                                <a class="" data-action="collapse"><i class="ti-plus" title="Show more" data-toggle="tooltip"></i></a>
                                                <a onclick="showToBeShare(<?= h($this->requestAction('/patients/showToBeShare/' . $person->id, ['return'])); ?>)"><i class="ti-bookmark-alt" title="Appoint" data-toggle="tooltip"></i></a>
                                            </div>
                                        </div>
                                        <div class="card-body collapse">
                                            <h4 class="card-title"><?= h($person->full_name); ?></h4>
                                            <p class="card-text"><?= h($person->pat_address); ?></p>
                                            <p class="card-text"><?= h($person->pat_age); ?></p>
                                            <p class="card-text"><?= h($person->pat_address); ?></p>
                                            <?php
                                                $gender = 'Female';
                                                if ($person->pat_gender) {
                                                    $gender = 'Male';
                                                }
                                                ?>
                                            <p class="card-text"><?= h($gender); ?></p>
                                            <p class="card-text"><?= h($person->pat_contact) ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <center>
                            <div class="paginator">
                                <ul class="pagination_post">
                                    <?= $this->Paginator->first('<< ' . __('First ')) ?>
                                    <?php if ($this->Paginator->hasPrev()) {
                                        echo $this->Paginator->prev('< ' . __('Previous '));
                                    } ?>
                                    <?= $this->Paginator->numbers() ?>
                                    <?php
                                    if ($this->Paginator->hasNext()) {
                                        echo $this->Paginator->next(__('Next') . ' >');
                                    }
                                    ?>
                                    <?= $this->Paginator->last(__('Last') . ' >>') ?>
                                </ul>
                                <p><small><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></small></p>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <?= $this->Form->create(
                            $appoint,
                            [
                                'type' => 'post',
                                'onsubmit' => 'disableField()'
                            ]
                        ) ?>
                        <h4 class="card-title">Get Appointment
                            <a href="#" data-container="body" title="Did you know?" data-toggle="popover" data-placement="right" data-content="Click the bookmark icon of the patient to set up their appoinment
"><i class="icon-question"></i></a></h4>
                        <div class="form-body">
                            <div class="card-body">
                                <div class="row pt-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <?= $this->Form->control(
                                                'patient_id',
                                                [
                                                    'type' => 'hidden',
                                                    'class' => 'form-control',
                                                    'id' => 'patient_id',
                                                    'readonly'
                                                ]
                                            ); ?>
                                            <?= $this->Form->control(
                                                'full_name',
                                                [
                                                    'type' => 'text',
                                                    'class' => 'form-control',
                                                    'label' => 'Patient',
                                                    'id' => 'full_name',
                                                    'readonly',
                                                    'placeholder' => 'Choose patient in the left side'
                                                ]
                                            ); ?>
                                            <?= $this->Form->control(
                                                'rec_date',
                                                [
                                                    'type' => 'text',
                                                    'class' => 'form-control',
                                                    'label' => 'Set date',
                                                    'id' => 'date-format2',
                                                    'placeholder' => 'Set Schedule'
                                                ]
                                            ); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <?= $this->Form->control(
                                                'rec_bp',
                                                [
                                                    'type' => 'hidden',
                                                    'class' => 'form-control',
                                                    'label' => 'Blood Pressure'
                                                ]
                                            ); ?>
                                        </div>
                                    </div>
                                    <label>Blood Pressure</label>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <?= $this->Form->control(
                                                    'bp_first',
                                                    [
                                                        'type' => 'text',
                                                        'class' => 'form-control',
                                                        'label' => false,
                                                    ]
                                                ); ?>
                                            </div>
                                        </div>
                                        <span>/</span>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <?= $this->Form->control(
                                                    'bp_second',
                                                    [
                                                        'type' => 'text',
                                                        'class' => 'form-control',
                                                        'label' => false,
                                                    ]
                                                ); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <?= $this->Form->control(
                                                'rec_cr',
                                                [
                                                    'type' => 'number',
                                                    'class' => 'form-control',
                                                    'label' => 'Cardiac Rate (bpm)',
                                                    'id' => 'rec_cr'
                                                ]
                                            ); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <?= $this->Form->control(
                                                'rec_rr',
                                                [
                                                    'type' => 'number',
                                                    'class' => 'form-control',
                                                    'label' => 'Respiratory Rate',
                                                    'id' => 'rec_rr'
                                                ]
                                            ); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <?= $this->Form->control(
                                                'rec_wt',
                                                [
                                                    'type' => 'number',
                                                    'class' => 'form-control',
                                                    'label' => 'Weight (kg)',
                                                    'id' => 'rec_wt'
                                                ]
                                            ); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="card-body">
                                        <button onclick="return confirm('Are you done with this patient?')"  type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Reserve</button>
                                        <a href="/medications/appointment"><button type="button" class="btn btn-secondary">Cancel</button></a>
                                    </div>
                                </div>
                            </div>
                            <?= $this->Form->end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function showToBeShare(data) {
        $('#full_name').val(`${data.pat_fname} ${data.pat_middle_initial}. ${data.pat_lname}`);
        $('#patient_id').val(data.id);
        $(`.clicked-status`).removeClass("bg-success");
        $(`.clicked-status-${data.id}`).addClass("bg-success");
    }
</script>

<?= $this->Html->script('/assets/node_modules/moment/moment.js'); ?>
<?= $this->Html->script('/assets/node_modules/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js'); ?>
<?= $this->Html->script('/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js'); ?>

<script>
    $(".schedule_nav").addClass("active");
    $('#date-format2').bootstrapMaterialDatePicker({
        // format: 'dddd DD MMMM YYYY - HH:mm'
        format: 'YYYY-MM-DD HH:mm'
    });
</script>