<?= $this->element('navbar'); ?>
<?= $this->Html->css('/assets/node_modules/tablesaw-master/dist/tablesaw.css'); ?>
<?= $this->Html->script('/assets/node_modules/tablesaw-master/dist/tablesaw.jquery.js'); ?>
<?= $this->Html->script('/assets/node_modules/tablesaw-master/dist/tablesaw-init.js'); ?>
<?= $this->Html->script('/dist/js/sweetalert.js'); ?>
<?php
$user = $this->Session->read('Auth.User');
?>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Patients Record</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/medications/home">Home</a></li>
                        <li class="breadcrumb-item active">Patients</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <ul class="nav nav-tabs profile-tab" role="tablist">
                            <?php if (!($user['emp_type'])) { ?>
                                <li class="nav-item"> <a class="nav-link" href="/patients/create"><button type="button" class="btn btn-outline-dark"><i class="fa icon-plus"></i> Add patient</button></a> </li>
                                <a href="#" data-container="body" title="Did you know?" data-toggle="popover" data-placement="right" data-content="This is used to redirect the user into the adding page of patients"><i class="icon-question"></i></a>
                            <?php } ?>
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
                                    <a href="/patients"><button type="button" class="btn waves-effect waves-light btn-secondary">Show all</button></a>
                                <?php } ?>
                                <input type="text" class="form-control border-dark" placeholder="Search & enter" name="search" value="<?= h($search); ?>">
                                <?= $this->Form->end() ?>
                            </li>
                        </ul>
                        <table class="tablesaw table-striped table-hover table-bordered table" data-tablesaw-mode="columntoggle">
                            <span class="float-right">
                                <a href="#" data-container="body" title="Did you know?" data-toggle="popover" data-placement="right" data-content="The dropdown button below is used to hide fields in tables."><i class="icon-question"></i></a>
                            </span>
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
                                    <?php if (!($user['emp_type'])) { ?>
                                        <th scope="col">Action
                                            <a href="#" data-container="body" title="Did you know?" data-toggle="popover" data-placement="right" data-content="This row is for updating or delete the patient's information"><i class="icon-question"></i></a>
                                        </th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($patients as $person) { ?>
                                    <tr>
                                        <td><?= h($person->pat_fname) ?></td>
                                        <td><?= h($person->pat_middle_initial) ?></td>
                                        <td><?= h($person->pat_lname) ?></td>
                                        <td><?= h($person->pat_age) ?></td>
                                        <?php
                                            $gender = 'Female';
                                            if ($person->pat_gender) {
                                                $gender = 'Male';
                                            }
                                            ?>
                                        <td><?= h($gender) ?></td>
                                        <td><?= h($person->pat_address) ?></td>
                                        <td><?= h($person->pat_occupation) ?></td>
                                        <td><?= h($person->pat_contact) ?></td>
                                        <?php if (!($user['emp_type'])) { ?>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class=" icon-menu"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="/patients/edit/<?= $person->id ?>">Edit</a>
                                                        <a class="dropdown-item" href="javascript:patient().delete(<?= $person->id; ?>)">Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        <?php } ?>
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
    $(".patient_nav").addClass("active");

    function patient() {
        return {
            delete: function(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        data = {
                            'id': id
                        }
                        $.ajax({
                            data: data,
                            type: 'post',
                            url: '/patients/delete',
                            beforeSend: function(xhr) {
                                xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                            },
                            success: function(response) {
                                let redirect = false;
                                if (response.status) {
                                    message().delete_success();
                                    redirect = true;
                                } else {
                                    message().failed();
                                    redirect = false;
                                }
                                if (response.status == 'invalid') {
                                    message().bad();
                                    redirect = false;
                                }
                                if (redirect) {
                                    setTimeout(function() {
                                        $(location).attr('href', '/patients');
                                    }, 500);
                                }
                            }
                        });
                    }
                });
            },
        }
    }
</script>