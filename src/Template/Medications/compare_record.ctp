<?= $this->element('navbar'); ?>
<?= $this->Html->css('/dist/css/pages/ribbon-page.css'); ?>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Medical records</b> </h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/medications/home">Home</a></li>
                        <li class="breadcrumb-item"><a href="/medications/compare-record">Compare records</a></li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs profile-tab" role="tablist">
                            <li class="mr-auto"></li>
                            <li class="nav-item">
                                <?= $this->Form->create(
                                    'Patient',
                                    [
                                        'type' => 'get',
                                        'class' => 'app-search d-none d-md-block d-lg-block search_form'
                                    ]
                                ) ?>
                                <?php if ($search != '') { ?>
                                    <a href="/medications/compare-record"><button type="button" class="btn waves-effect waves-light btn-secondary">Show all</button></a>
                                <?php } ?>
                                <input type="text" class="form-control border-dark" placeholder="Search & enter" name="search_name" value="<?= h($search); ?>">
                                <?= $this->Form->end() ?>
                            </li>
                        </ul>
                        <!-- <a href="#" data-container="body" title="" data-toggle="popover" data-placement="right" data-content="The number between the name and date indicates how many consultants have occurred as of the date indicated" data-original-title="Did you know?"><i class="icon-question"></i></a> -->
                        <div class="row">
                            <?php foreach ($record as $medication) { ?>
                                <div class="col-md-6">
                                    <div class="card shadow-sm">
                                        <div class="card-header clicked-status clicked-status-<?= $medication->id ?>">
                                            <div class="row" style=" font-size: 12px;">
                                                <div class="col-md-5"><small class="float-lg-left"><?= h($medication->patient->pat_fname); ?> <?= h($medication->patient->pat_lname); ?></small></div>
                                                <div class="col-md-2"><small>
                                                        <?= $this->requestAction('medications/identify_checkup/' . $medication->patient->id . '/' . $medication->id); ?>
                                                    </small></div>
                                                <div class="col-md-5"><small class="float-lg-right"><?= h($medication->modified); ?></small></div>
                                            </div>
                                        </div>
                                        <div class="card-action text-center">
                                            <a style="margin-right:2%" href="#" class="" data-action="collapse"><i class="ti-plus" title="Show more" data-toggle="tooltip"></i></a>
                                            <a style="margin-right:2%" href="/medications/print-finding/<?= $medication->id ?>"><i class="icon-printer text-dark" title="Print Medical Findings" data-toggle="tooltip"></i></a>
                                            <a style="margin-right:2%" href="#" onclick="showToBeShare_record_1(<?= h($medication) ?>)"><i class="text-success ti-bookmark-alt" title="Review" data-toggle="tooltip"></i></a>
                                            <a style="margin-right:2%" href="#" onclick="showToBeShare_record_2(<?= h($medication) ?>)"><i class="text-info ti-bookmark-alt" title="Review" data-toggle="tooltip"></i></a>
                                        </div>
                                        <div class="card-body collapse" style="font-size: 11px">
                                            <p class="card-text"><b>Blood Pressure:</b> <?= h($medication->rec_bp); ?></p>
                                            <p class="card-text"><b>Cardiac Rate:</b> <?= h($medication->rec_cr); ?></p>
                                            <p class="card-text"><b>Respiratory Rate:</b> <?= h($medication->rec_rr); ?></p>
                                            <p class="card-text"><b>Weight:</b> <?= h($medication->rec_wt); ?></p>
                                            <p class="card-text"><b>Medication:</b> <?= h($medication->rec_medication); ?></p>
                                            <p class="card-text"><b>Diagnosis:</b> <?= h($medication->rec_diagnosis); ?></p>
                                            <p class="card-text"><b>Complains:</b> <?= h($medication->rec_complains); ?></p>
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
            <div class="col-md-6">
                <div class="card">
                    <h4 class="card-title text-center">Compare Records</h4>
                    <div class="card-body">
                        <div class="row">
                            <div class="ribbon ribbon-bookmark ribbon-success"><span class="record1"></span></div>
                            <div class="col-md-6">
                                <div class="form-body">
                                    <div class="card-body">
                                        <div class="row pt-3">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?= $this->Form->control(
                                                        'rec_bp',
                                                        [
                                                            'type' => 'text',
                                                            'class' => 'form-control',
                                                            'label' => 'Blood Pressure',
                                                            'id' => 'rec_bp',
                                                            'readonly'
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
                                                            'id' => 'rec_cr',
                                                            'readonly'
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
                                                            'id' => 'rec_rr',
                                                            'readonly'
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
                                                            'id' => 'rec_wt',
                                                            'readonly'
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
                                                            'readonly'
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
                                                            'readonly'
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
                                                            'readonly'
                                                        ]
                                                    ); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ribbon ribbon-bookmark ribbon-right ribbon-info"><span class="record2"></span></div>
                            <div class="col-md-6">
                                <div class="form-body">
                                    <div class="card-body">
                                        <div class="row pt-3">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?= $this->Form->control(
                                                        'rec_bp',
                                                        [
                                                            'type' => 'text',
                                                            'class' => 'form-control',
                                                            'label' => 'Blood Pressure',
                                                            'id' => 'rec_bp2',
                                                            'readonly'
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
                                                            'id' => 'rec_cr2',
                                                            'readonly'
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
                                                            'id' => 'rec_rr2',
                                                            'readonly'
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
                                                            'id' => 'rec_wt2',
                                                            'readonly'
                                                        ]
                                                    ); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <?= $this->Form->control(
                                                        'rec_medication2',
                                                        [
                                                            'type' => 'textarea',
                                                            'class' => 'form-control',
                                                            'label' => 'Medication',
                                                            'readonly'
                                                        ]
                                                    ); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <?= $this->Form->control(
                                                        'rec_diagnosis2',
                                                        [
                                                            'type' => 'textarea',
                                                            'class' => 'form-control',
                                                            'label' => 'Diagnosis',
                                                            'readonly'
                                                        ]
                                                    ); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <?= $this->Form->control(
                                                        'rec_complains2',
                                                        [
                                                            'type' => 'textarea',
                                                            'class' => 'form-control',
                                                            'label' => 'Complains',
                                                            'readonly'
                                                        ]
                                                    ); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.compare_record').addClass("active");
    });

    $('#vital').hide();

    function showToBeShare_record_1(data) {
        $('.record1').text(setDate(data.modified));
        $('#rec_bp').val(`${data.rec_bp}`);
        $('#rec_cr').val(`${data.rec_cr}`);
        $('#rec_rr').val(`${data.rec_rr}`);
        $('#rec_wt').val(`${data.rec_wt}`);
        $('textarea[name="rec_diagnosis"]').text(`${data.rec_diagnosis}`);
        $('textarea[name="rec_medication"]').text(`${data.rec_medication}`);
        $('textarea[name="rec_complains"]').text(`${data.rec_complains}`);
        $(`.clicked-status`).removeClass("bg-success");
        $(`.clicked-status-${data.id}`).addClass("bg-success");
        var className = $(`.clicked-status-${data.id}`).attr('class');
        var n = className.indexOf("bg-info");
        if (n > 0) {
            $(`.clicked-status`).removeClass("bg-info");
            $('.record2').text(``);
            $('#rec_bp2').val(``);
            $('#rec_cr2').val(``);
            $('#rec_rr2').val(``);
            $('#rec_wt2').val(``);
            $('textarea[name="rec_diagnosis2"]').text(``);
            $('textarea[name="rec_medication2"]').text(``);
            $('textarea[name="rec_complains2"]').text(``);
            $(`.clicked-status`).removeClass("bg-info");
            $(`.clicked-status-${data.id}`).addClass("bg-success");
        }

    }

    function showToBeShare_record_2(data) {
        $('.record2').text(setDate(data.modified));
        $('#rec_bp2').val(`${data.rec_bp}`);
        $('#rec_cr2').val(`${data.rec_cr}`);
        $('#rec_rr2').val(`${data.rec_rr}`);
        $('#rec_wt2').val(`${data.rec_wt}`);
        $('textarea[name="rec_diagnosis2"]').text(`${data.rec_diagnosis}`);
        $('textarea[name="rec_medication2"]').text(`${data.rec_medication}`);
        $('textarea[name="rec_complains2"]').text(`${data.rec_complains}`);
        $(`.clicked-status`).removeClass("bg-info");
        $(`.clicked-status-${data.id}`).addClass("bg-info");
        var className = $(`.clicked-status-${data.id}`).attr('class');
        var n = className.indexOf("bg-success");
        if (n > 0) {
            $(`.clicked-status`).removeClass("bg-success");
            $(`.clicked-status-${data.id}`).addClass("bg-success");
            $('.record1').text(``);
            $('#rec_bp').val(``);
            $('#rec_cr').val(``);
            $('#rec_rr').val(``);
            $('#rec_wt').val(``);
            $('textarea[name="rec_diagnosis"]').text(``);
            $('textarea[name="rec_medication"]').text(``);
            $('textarea[name="rec_complains"]').text(``);
        }
    }

    function setDate(timeStamp) {
        var asiaTime = new Date().toLocaleString("en-US", {
            timeZone: "Asia/Shanghai"
        });
        asiaTime = new Date(timeStamp);
        return asiaTime.toLocaleString();
    }
</script>

<script>
    $(document).ready(function() {
        $('.footer').show();
    });
</script>