<?= $this->Html->css('/css/print_style.css') ?>
<?= $this->Html->script('/dist/js/jquery-printme.js') ?>
<?= $this->Html->script('/dist/js/jquery-printme.min.js') ?>

<br>
<div class="print">
    <center>
        <h1><b>RAINVILLE B. BAUTISTA, M.D.</b></h1>
        <h5><b>68 Eugenio St. Canuto Ramos, SanJose City, Nueva Ecija</b></h5>
    </center>
    <br><br><br>
    <p style="margin-left:80%"><?= date_format($user->modified, "M-d-Y"); ?></p>
    <p><b>Name:</b> <?= strtoupper(h($user->patient->full_name)); ?></p>
    <p><b>Age:</b> <?= strtoupper(h($user->patient->pat_age)); ?></p>
    <?php
    $gender = 'female';
    if ($user->patient->pat_gender) {
        $gender = 'male';
    }
    ?>
    <p><b>Gender:</b> <?= strtoupper(h($gender)); ?></p>
    <p><b>Address:</b> <?= h($user->patient->pat_address); ?></p>
    <p><b>Case No:</b> <?= h($user->id); ?></p>
    <center>
        <h3>Result</h3>
        <hr style="border: 1px solid black">
    </center>
    <h4><b>Finding (s):</b></h4>
    <div style="margin-left: 7%">
        <p><b>Blood Pressure:</b> <?= h($user->rec_bp); ?></p>
        <p><b>Cardiac Rate:</b> <?= h($user->rec_cr); ?></p>
        <p><b>Respiratory Rate:</b> <?= h($user->rec_rr); ?></p>
        <p><b>Weight:</b> <?= h($user->rec_wt); ?> kg</p>
    </div>
    <h4><b>Medication (s):</b></h4>
    <p style="margin-left: 7%"><?= h($user->rec_medication); ?></p>
    <h4><b>Diagnosis (s):</b></h4>
    <p style="margin-left: 7%"><?= h($user->rec_diagnosis); ?></p>
    <br><br><br><br><br><br>
    <h3 style="margin-left:75%;">Rainville B. Bautista, M.D.</h3>
    <div class="hide-button">
        <button id="buttonPrint">Print</button>
        <a href="/medications/patient-record/<?= $user->patient->id ?>"><button>Cancel</button></a>
    </div>
</div>
</br>
<script>
    $(document).ready(function() {
        $('.footer').hide();
        $("body").printMe({
            "path": ["/css/print-hide.css"]
        });
        $("#buttonPrint").click(function() {
            $("body").printMe({
                "path": ["/css/print-hide.css"]
            });
        });
    });
</script>