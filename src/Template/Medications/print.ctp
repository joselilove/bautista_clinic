<?= $this->Html->css('/css/print_style.css') ?>
<?= $this->Html->script('/dist/js/jquery-printme.js') ?>
<?= $this->Html->script('/dist/js/jquery-printme.min.js') ?>

<br>
<div class="print">
    <center>
        <h1>Medical Certificate</h1>
    </center>
    <p style="margin-left:80%"><?= date_format($user->modified, "M-d-Y"); ?></p>
    <p>To whom it may concern:</p>
    <?php
    $gender = 'female';
    if ($user->patient->pat_gender) {
        $gender = 'male';
    }
    ?>
    <p>This is to certify that <b><?= strtoupper(h($user->patient->full_name)); ?> <?= h($user->patient->pat_age); ?> years old <?= $gender; ?> </b> and a resdident of a <b><?= h($user->patient->pat_address); ?></b> was seen and examined by the undersigned and found that he is physically and mentally fit to work</p>
    <br><br><br>
    <p>Issue this <b><?= date_format($user->modified, "M-d-Y g:i A"); ?> </b> at 68 Eugenio St. Canuto Ramos, SanJose City, Nueva Ecija for whatever purpose it may serve.</p>
    <br><br><br><br><br><br>
    <h3 style="margin-left:75%">Rainville B. Bautista, M.D.</h3>
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