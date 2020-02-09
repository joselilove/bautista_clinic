<?= $this->element('navbar'); ?>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Review appointed patients</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/medications/home">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Review</a></li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <?php if ($current == null) { ?>
                            <h1>Patient schedule not found</h1>
                        <?php } else { ?>
                            <h5 class="font-weight-bold">Patients with the schedule</h5>
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6 border-dark border">
                                    <h4 class="text-center">Current Patient</h4>
                                    <div class="col-md-12">
                                        <div class="card shadow-sm">
                                            <div class="card-header clicked-status clicked-status-<?= $current->id ?>">
                                                <?= h($current->patient->full_name); ?>
                                                <div class="card-actions">
                                                    <a class="" data-action="collapse"><i class="ti-plus" title="Show more" data-toggle="tooltip"></i></a>
                                                    <a href="#" onclick="showToBeShare(<?= h($current); ?>)"><i class="ti-bookmark-alt" title="Review" data-toggle="tooltip"></i></a>
                                                </div>
                                            </div>
                                            <div class="card-body collapse">
                                                <h4 class="card-title"><?= h($current->patient->full_name); ?></h4>
                                                <p class="card-text"><?= h($current->patient->pat_address); ?></p>
                                                <p class="card-text"><?= h($current->patient->pat_age); ?></p>
                                                <p class="card-text"><?= h($current->patient->pat_address); ?></p>
                                                <?php
                                                    $gender = 'Female';
                                                    if ($current->patient->pat_gender) {
                                                        $gender = 'Male';
                                                    }
                                                    ?>
                                                <p class="card-text"><?= h($gender); ?></p>
                                                <p class="card-text"><?= h($current->patient->pat_contact) ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                        <?php } ?>
                        <ul class="nav nav-tabs profile-tab" role="tablist">
                            <li class="mr-auto"></li>
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
                                    <a href="/medications/review-current-patient"><button type="button" class="btn waves-effect waves-light btn-secondary">Show all</button></a>
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
                                            <small><?= h($person->patient->full_name); ?></small><br> 
                                            <small><?= h($person->rec_date); ?></small>
                                            <div class="card-actions">
                                                <a class="" data-action="collapse"><i class="ti-plus" title="Show more" data-toggle="tooltip"></i></a>
                                                <a href="#" onclick="showToBeShare(<?= h($person) ?>)"><i class="ti-bookmark-alt" title="Review" data-toggle="tooltip"></i></a>
                                            </div>
                                        </div>
                                        <div class="card-body collapse">
                                            <h4 class="card-title"><?= h($person->patient->full_name); ?></h4>
                                            <p class="card-text"><?= h($person->patient->pat_address); ?></p>
                                            <p class="card-text"><?= h($person->patient->pat_age); ?></p>
                                            <p class="card-text"><?= h($person->patient->pat_address); ?></p>
                                            <?php
                                                $gender = 'Female';
                                                if ($person->patient->pat_gender) {
                                                    $gender = 'Male';
                                                }
                                                ?>
                                            <p class="card-text"><?= h($gender); ?></p>
                                            <p class="card-text"><?= h($person->patient->pat_contact) ?></p>
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

                        <hr>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <?= $this->Form->create(
                            $medication,
                            [
                                'type' => 'post',
                                'onsubmit' => 'disableField()'
                            ]
                        ) ?>
                        <h4 class="card-title">Medication</h4>
                        <div class="form-body">
                            <div class="card-body">
                                <div class="row pt-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <?= $this->Form->control(
                                                'id',
                                                [
                                                    'type' => 'hidden',
                                                    'class' => 'form-control',
                                                    'id' => 'id',
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
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?= $this->Form->control(
                                                'rec_bp',
                                                [
                                                    'type' => 'text',
                                                    'class' => 'form-control',
                                                    'label' => 'Blood Pressure',
                                                    'id' => 'rec_bp'
                                                ]
                                            ); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?= $this->Form->control(
                                                'rec_cr',
                                                [
                                                    'type' => 'text',
                                                    'class' => 'form-control',
                                                    'label' => 'Cardiac Rate',
                                                    'id' => 'rec_cr'
                                                ]
                                            ); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?= $this->Form->control(
                                                'rec_rr',
                                                [
                                                    'type' => 'text',
                                                    'class' => 'form-control',
                                                    'label' => 'Respiratory Rate',
                                                    'id' => 'rec_rr'
                                                ]
                                            ); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?= $this->Form->control(
                                                'rec_wt',
                                                [
                                                    'type' => 'text',
                                                    'class' => 'form-control',
                                                    'label' => 'Weight',
                                                    'id' => 'rec_wt'
                                                ]
                                            ); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <?= $this->Form->control(
                                                'rec_medication',
                                                [
                                                    'type' => 'textarea',
                                                    'class' => 'form-control',
                                                    'label' => 'Medication',
                                                ]
                                            ); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <?= $this->Form->control(
                                                'rec_diagnosis',
                                                [
                                                    'type' => 'textarea',
                                                    'class' => 'form-control',
                                                    'label' => 'Diagnosis',
                                                ]
                                            ); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <?= $this->Form->control(
                                                'rec_complains',
                                                [
                                                    'type' => 'textarea',
                                                    'class' => 'form-control',
                                                    'label' => 'Complains',
                                                ]
                                            ); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="card-body">
                                        <button onclick="return confirm('Are you done with this patient?')" type="submit" class="btn btn-success"> <i class="ti-save"></i> Record</button>
                                        <a href="/schedule-sequence/review-current-patient"><button type="button" class="btn btn-secondary">Cancel</button></a>
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
    $('#vital').hide();
    $( ".review_nav" ).addClass( "active" );
    function showToBeShare(data) {
        $('#full_name').val(`${data.patient.pat_fname} ${data.patient.pat_middle_initial}. ${data.patient.pat_lname}`);
        $('#vital').show();
        $('#id').val(`${data.id}`);
        $('#rec_bp').val(`${data.rec_bp}`);
        $('#rec_cr').val(`${data.rec_cr}`);
        $('#rec_rr').val(`${data.rec_rr}`);
        $('#rec_wt').val(`${data.rec_wt}`);
        $('textarea[name="rec_diagnosis"]').text(`${data.rec_diagnosis}`);
        $('textarea[name="rec_medication"]').text(`${data.rec_medication}`);
        $('textarea[name="rec_complains"]').text(`${data.rec_complains}`);
        $(`.clicked-status`).removeClass("bg-success");
        $(`.clicked-status-${data.id}`).addClass("bg-success");
    }
</script>