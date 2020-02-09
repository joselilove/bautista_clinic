<?= $this->element('navbar'); ?>
<?= $this->Html->css('/dist/css/pages/floating-label.css'); ?>
<?= $this->Html->script('/assets/node_modules/sparkline/jquery.sparkline.min.js'); ?>
<?= $this->Html->script('/dist/js/waves.js'); ?>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Add Patient</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/medications/home">Home</a></li>
                        <li class="breadcrumb-item active">Add Patient</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <?= $this->element('patient_form'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>