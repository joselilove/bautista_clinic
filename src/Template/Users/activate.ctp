<?= $this->element('navbar'); ?>
<?= $this->Html->css('/assets/node_modules/tablesaw-master/dist/tablesaw.css'); ?>
<?= $this->Html->script('/assets/node_modules/tablesaw-master/dist/tablesaw.jquery.js'); ?>
<?= $this->Html->script('/assets/node_modules/tablesaw-master/dist/tablesaw-init.js'); ?>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Activate Users account</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/medications/home">Home</a></li>
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
                                    <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Name</th>
                                    <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Username</th>
                                    <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Position</th>
                                    <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4">Email</th>
                                    <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="5">Created</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $person) { ?>
                                    <tr>
                                        <td><?= h($person->name) ?></td>
                                        <td><?= h($person->username) ?></td>
                                        <?php
                                            $position = 'Secretary';
                                            if ($person->emp_type) {
                                                $position = 'Doctor';
                                            }
                                            ?>
                                        <td><?= h($position) ?></td>
                                        <td><?= h($person->email) ?></td>
                                        <td><?= h($person->created) ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class=" icon-menu"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <?php if ($person->activated) { ?>
                                                        <a class="dropdown-item" href="/users/deactivate-account/<?= $person->id ?>">Deactivate</a>
                                                    <?php } else { ?>
                                                        <a class="dropdown-item" href="/users/activate-account/<?= $person->id ?>">Activated</a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <?php if ($person->activated) { ?>
                                                <span class="badge badge-success">Activated</span>
                                            <?php } else { ?>
                                                <span class="badge badge-primary">Not Activated</span>
                                            <?php } ?>
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