<?= $this->element('navbar'); ?>
<?= $this->Html->css('/assets/node_modules/tablesaw-master/dist/tablesaw.css'); ?>
<?= $this->Html->script('/assets/node_modules/tablesaw-master/dist/tablesaw.jquery.js'); ?>
<?= $this->Html->script('/assets/node_modules/tablesaw-master/dist/tablesaw-init.js'); ?>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Medications Record</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/medications/home">Home</a></li>
                        <li class="breadcrumb-item active">Medications Record</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
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
                                    <a href="/medications/medical-record"><button type="button" class="btn waves-effect waves-light btn-secondary">Show all</button></a>
                                <?php } ?>
                                <input type="text" class="form-control border-dark" placeholder="Search & enter" name="search" value="<?= h($search); ?>">
                                <?= $this->Form->end() ?>
                            </li>
                        </ul>
                        <table class="tablesaw table-striped table-hover table-bordered table" data-tablesaw-mode="columntoggle">
                            <thead>
                                <tr>
                                    <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">FirstName</th>
                                    <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Middle Initial</th>
                                    <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">LastName</th>
                                    <th scope="col" data-tablesaw-sortable-col data-tablesaw-sortable-default-col data-tablesaw-priority="3">Age</th>
                                    <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Gender</th>
                                    <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4">Address</th>
                                    <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="5">Occupation</th>
                                    <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="7">Contact</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($patients as $person) { ?>
                                    <tr>
                                        <td><?= h($person->patient->pat_fname) ?></td>
                                        <td><?= h($person->patient->pat_middle_initial) ?></td>
                                        <td><?= h($person->patient->pat_lname) ?></td>
                                        <td><?= h($person->patient->pat_age) ?></td>
                                        <?php
                                            $gender = 'Female';
                                            if ($person->patient->pat_gender) {
                                                $gender = 'Male';
                                            }
                                            ?>
                                        <td><?= h($gender) ?></td>
                                        <td><?= h($person->patient->pat_address) ?></td>
                                        <td><?= h($person->patient->pat_occupation) ?></td>
                                        <td><?= h($person->patient->pat_contact) ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class=" icon-menu"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="/medications/patient-record/<?= $person->patient_id ?>">View</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
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
        </div>
    </div>
</div>
<script>
$( ".record_nav" ).addClass( "active" );
</script>