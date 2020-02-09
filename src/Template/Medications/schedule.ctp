<?= $this->element('navbar'); ?>
<?= $this->Html->script('/dist/js/sweetalert.js'); ?>
<?= $this->Html->script('/assets/node_modules/sparkline/jquery.sparkline.min.js'); ?>
<?= $this->Html->script('/dist/js/waves.js'); ?>
<?= $this->Html->css('/assets/node_modules/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css'); ?>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Schedule</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/medications/home">Home</a></li>
                        <li class="breadcrumb-item"><a href="/medications/appointment">Appointment</a></li>
                        <li class="breadcrumb-item active"><a href="#">Schedule</a></li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-xlg-3 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h3>Current Patient
                            <small>
                            <a href="#" data-container="body" title="Did you know?" data-toggle="popover" data-placement="right" data-content="The patient's schedule info in this system only refresh every 15 seconds to avoid data transfer traffic"><i class="icon-question"></i></a>
                            </small>
                        </h3>
                        <center class="m-t-30 current-patient"> <img src="/img/profile/profile2.png" class="img-circle" width="150" />
                        </center>
                    </div>
                </div>
            </div>
        </div>
        <a href="#" data-container="body" title="Did you know?" data-toggle="popover" data-placement="right" data-content="Click the skip button to swap its schedule to the next patient"><i class="icon-question"></i></a>
        <div class="row">
            <div class="col-lg-4 col-xlg-9 col-md-7">
                <div class="card">
                    <div class="tab-content">
                        <div class="tab-pane active" id="home" role="tabpanel">
                            <div class="card-body">
                                <div class="profiletimeline patient-inline">
                                    <hr>
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
    $(function() {
        currentPatient().fetch();
        currentPatient().refresh();
    });

    function currentPatient() {
        return {
            fetch: function() {
                let data = {
                    'limit': 10
                }
                $.ajax({
                    data: data,
                    type: 'post',
                    url: '/medications/currentPatient',
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                    },
                    success: function(response) {
                        currentPatient().show(response);
                    }
                });
            },
            show: function(data) {
                let html = '';
                let currentUser = '';
                for (i = 0; i < data.length; i++) {
                    fullname = `${data[i].patient.pat_fname} ${data[i].patient.pat_middle_initial}. ${data[i].patient.pat_lname}`;
                    if (i == 0) {
                        currentUser = `<img src="/img/profile/profile2.png" class="img-circle" width="150" />
                                    <h4 class="card-title m-t-10">${data[i].patient.pat_fname} ${data[0].patient.pat_middle_initial}. ${data[0].patient.pat_lname}</h4>
                                    <h6 class="card-subtitle">${data[i].patient.pat_occupation}</h6>
                                    <div class="row text-center justify-content-md-center">`;
                        foundError = false;
                        try {
                            if (data[i + 1].id === 'undefined') {}
                        } catch (error) {
                            foundError = true;
                        }
                        if (!(foundError)) {
                            currentUser += `<div class="col-4" id="1${data[i].id}">
                                            <a href="#${data[i].id}" onclick="currentPatient().skip(${data[i].id},${data[i+1].id})" class="link"><i class="ti-arrow-down"></i>
                                                <small>Skip</small>
                                            </a>
                                        </div>`;
                        }
                        currentUser += `<div class="col-4">
                                            <a href="#" class="link" onclick="currentPatient().viewVital('${data[i].rec_bp}', '${data[i].rec_cr}', '${data[i].rec_rr}', '${data[i].rec_wt}', '${fullname}')" data-toggle="modal" data-target="#exampleModalCenter"><i class="icon-eyeglass"></i>
                                                <font class="font-medium">Vitals</font>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="javascript:currentPatient().remove(${data[i].id});" class="link"><i class="icon-trash"></i>
                                                <small>Remove</small>
                                            </a>
                                        </div>
                                    </div>
                                    <span class="sl-date"><b class="font-weight-bold">Schedule:</b> ${setDate(data[i].rec_date)}
                                    <a href="#" onclick="currentPatient().updateSched('${setDate(data[i].rec_date)}', '${data[i].id}', '${fullname}');" data-toggle="modal" data-target="#exampleModalCenter" class="link"><i class="ti-pencil"></i>
                                        Edit
                                    </a>
                                    </span>
                                    `;
                    } else {
                        html += `<div class="sl-item">
                                        <div class="sl-left"> <img src="/img/profile/profile2.png" alt="user" class="img-circle" /> </div>
                                        <div class="sl-right">
                                            <div><a href="javascript:void(0)" class="link">${fullname}</a> 
                                                <div class="row text-center justify-content-md-center">`;
                        foundError = false;
                        try {
                            if (data[i + 1].id === 'undefined') {

                            }
                        } catch (error) {
                            foundError = true;
                        }
                        if (!(foundError)) {
                            html += `<div class="col-4" id="${data[i].id}">
                                                    <a href="#${data[i].id}" onclick="currentPatient().skip(${data[i].id},${data[i+1].id})" class="link"><i class="ti-arrow-down"></i>
                                                        <small>Skip</small>
                                                    </a>
                                                </div>`;
                        }
                        html += `<div class="col-4">
                                                        <a href="#" onclick="currentPatient().viewVital('${data[i].rec_bp}', '${data[i].rec_cr}', '${data[i].rec_rr}', '${data[i].rec_wt}', '${fullname}')" data-toggle="modal" data-target="#exampleModalCenter" class="link"><i class="icon-eyeglass"></i>
                                                            <small>Vitals</small>
                                                        </a>
                                                    </div>
                                                    <div class="col-4">
                                                        <a href="javascript:currentPatient().remove(${data[i].id});" class="link"><i class="icon-trash"></i>
                                                            <small>Remove</small>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="sl-date"><b class="font-weight-bold">Schedule:</b> ${setDate(data[i].rec_date)} 
                                    <a href="#" onclick="currentPatient().updateSched('${setDate(data[i].rec_date)}', '${data[i].id}', '${fullname}');" data-toggle="modal" data-target="#exampleModalCenter" class="link"><i class="ti-pencil"></i>
                                        Edit
                                    </a>
                                    </span>
                                    <hr>`;
                    }
                }
                $('.patient-inline').html(html);
                $('.current-patient').html(currentUser);
            },
            refresh: function() {
                setInterval(function() {
                    currentPatient().fetch();
                }, 15000);
            },
            viewVital: function(bp, cr, rr, wt, name) {
                $('.updateSchedule').hide();
                $('.modal-body').show();
                $('#bp').text(bp);
                $('#cr').text(cr);
                $('#rr').text(rr);
                $('#w').text(wt);
                $('#name-modal').text(name);
            },
            updateSched: function(rec_date, id, name) {
                $('.updateSchedule').show();
                $('.modal-body').hide();
                $('#name-modal').text(name);
                $('#currentDate').text(rec_date)
                $('#s_id').val(id)
            },
            remove: function(id) {
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
                        let data = {
                            'id': id
                        }
                        $.ajax({
                            data: data,
                            type: 'post',
                            url: '/medications/delete',
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
                                        currentPatient().fetch();
                                    }, 500);
                                }
                            }
                        });
                    }
                });
            },
            skip: function(backward, forward) {
                let data = {
                    'forward': forward,
                    'backward': backward,
                }
                $.ajax({
                    data: data,
                    type: 'post',
                    url: '/Medications/skip',
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                    },
                    success: function(response) {
                        currentPatient().fetch();
                    }
                });
            }
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

<?= $this->Html->script('/assets/node_modules/moment/moment.js'); ?>
<?= $this->Html->script('/assets/node_modules/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js'); ?>
<?= $this->Html->script('/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js'); ?>
<script>
    $('#date-format').bootstrapMaterialDatePicker({
        // format: 'dddd DD MMMM YYYY - HH:mm'
        format: 'YYYY-MM-DD HH:mm'
    });
</script>