<?php
$user = $this->Session->read('Auth.User');
?>
<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"> <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                <li class="nav-item"> <a class="nav-link sidebartoggler d-lg-block d-none d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
            </ul>
            <span class="navbar-brand mb-0 h3 font-weight-bold text-white" style="margin-left:auto; margin-right:auto">Bautista Clinic Record Management System</span>
            <ul class="navbar-nav my-lg-0">
                <li class="nav-item dropdown u-pro">
                    <?php
                    $position = 'Secretary';
                    if ($user['emp_type']) {
                        $position = 'Doctor';
                    } ?>
                    <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="/img/profile/profile.png" alt="user" class=""> <span class="hidden-md-down"><span class="font-weight-bold"><?= h($position) ?></span>&nbsp;&nbsp; <?= h($user['name']) ?>&nbsp;<i class="icon-arrow-down"></i></span> </a>
                    <div class="dropdown-menu dropdown-menu-right animated">
                        <a href="/users/update-user-info" class="dropdown-item"><i class=""></i>Update info</a>
                        <a href="/users/change-password" class="dropdown-item"><i class=""></i>Change password</a>
                        <a href="/users/logout" class="dropdown-item"><i class=""></i> Logout</a>
                    </div>
                </li>
                <?php if (!(isset($schedulePage))) { ?>
                    <li class="nav-item dropdown mega-dropdown"> <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti-timer"></i></a>
                        <div class="dropdown-menu">
                            <ul class="mega-dropdown-menu row">
                                <li class="col-lg-3  m-b-30">

                                </li>
                                <li class="col-lg-3 col-xlg-2 m-b-30 border-right border-dark">
                                    <h3>Current Patient</h3>
                                    <center class="m-t-30 current-patient">
                                    </center>
                                </li>
                                <li class="col-lg-3 m-b-30">
                                    <div class="profiletimeline patient-inline">
                                    </div>
                                    <?php if (!($user['emp_type'])) { ?>
                                        <a href="/medications/schedule">See more details</a>
                                    <?php } ?>
                                </li>
                                <li class="col-lg-3 col-xlg-4 m-b-30">

                                </li>
                            </ul>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </nav>
</header>
<aside class="left-sidebar">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="dashboard_nav">
                    <a class="waves-effect waves-dark" href="/medications/home">
                        <i class="icon-home"></i>
                        <span class="hide-menu"><small>Dashboard</small></span>
                    </a>
                </li>
                <li class="patient_nav">
                    <a class="waves-effect waves-dark" href="/patients">
                        <i class="icon-people"></i>
                        <span class="hide-menu"><small>Patient</small></span>
                    </a>
                </li>
                <?php if (!($user['emp_type'])) { ?>
                    <li class="schedule_nav">
                        <a class="waves-effect waves-dark" href="/medications/appointment">
                            <i class="ti-clipboard"></i>
                            <span class="hide-menu"><small>Manage schedule</small></span>
                        </a>
                    </li>
                <?php } ?>
                <?php if ($user['emp_type']) { ?>
                    <li class="review_nav">
                        <a class="waves-effect waves-dark" href="/medications/review-current-patient">
                            <i class="ti-book"></i>
                            <span class="hide-menu"><small>Review Patient</small></span>
                        </a>
                    </li>
                <?php } ?>
                <li class="record_nav">
                    <a class="waves-effect waves-dark" href="/medications/medical-record">
                        <i class="icon-folder-alt"></i>
                        <span class="hide-menu"><small>Medical Records</small></span>
                    </a>
                </li>
                <li class="compare_record">
                    <a class="waves-effect waves-dark" href="/medications/compare-record">
                        <i class="icon-grid"></i>
                        <span class="hide-menu"><small>Compare Patients</small></span>
                    </a>
                </li>
                <li class="activate_nav">
                    <a class="waves-effect waves-dark" href="/users/activate">
                        <i class="icon-check"></i>
                        <span class="hide-menu"><small>Activate account</small></span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<?php if (!(isset($schedulePage))) { ?>
    <script>
        $(function() {
            currentPatient().fetch();
            currentPatient().refresh();
        });

        function currentPatient() {
            return {
                fetch: function() {
                    let data = {
                        'limit': 4
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
                                    <div class="row text-center justify-content-md-center">
                                        <div class="col-4">
                                            <a href="#" class="link" onclick="currentPatient().viewVital('${data[i].rec_bp}', '${data[i].rec_cr}', '${data[i].rec_rr}', '${data[i].rec_wt}', '${fullname}')" data-toggle="modal" data-target="#exampleModalCenter"><i class="icon-eyeglass"></i>
                                                <font class="font-medium">Vitals</font>
                                            </a>
                                        </div>
                                    </div>`;
                        } else {
                            html += `<div class="sl-item">
                                        <div class="sl-left"> <img src="/img/profile/profile2.png" alt="user" class="img-circle" /> </div>
                                        <div class="sl-right">
                                            <div><a href="javascript:void(0)" class="link">${fullname}</a>
                                                <div class="row text-center justify-content-md-center">
                                                    <div class="col-4">
                                                        <a href="#" onclick="currentPatient().viewVital('${data[i].rec_bp}', '${data[i].rec_cr}', '${data[i].rec_rr}', '${data[i].rec_wt}', '${fullname}')" data-toggle="modal" data-target="#exampleModalCenter" class="link"><i class="icon-eyeglass"></i>
                                                            <small>Vitals</small>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>`;
                        }
                    }
                    $('.patient-inline').html(html);
                    $('.current-patient').html(currentUser);
                },
                refresh: function() {
                    setInterval(function() {
                        currentPatient().fetch();
                    }, 50000);
                },
                viewVital: function(bp, cr, rr, wt, name) {
                    $('.updateSchedule').hide();
                    $('#bp').text(bp);
                    $('#cr').text(cr);
                    $('#rr').text(rr);
                    $('#w').text(wt);
                    $('#name-modal').text(name);
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
<?php } ?>