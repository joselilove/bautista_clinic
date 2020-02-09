<?= $this->element('navbar'); ?>
<?= $this->Html->script('/dist/js/chart_loader.js'); ?>
<?= $this->Html->script('/dist/js/yearpicker.js'); ?>
<?= $this->Html->script('/assets/node_modules/morrisjs/morris.js'); ?>

<link rel="stylesheet" href="/assets/node_modules/morrisjs/morris.css">
<link rel="stylesheet" href="/css/year_style.css">
<link rel="stylesheet" href="/css/yearpicker.css">
<link rel="stylesheet" href="/dist/css/pages/tab-page.css">

<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['bar']
    });
    google.charts.setOnLoadCallback(drawChart);
    d = new Date().getFullYear();
    function drawChart(year = d) {
        chartData = getData(year);
        var data = google.visualization.arrayToDataTable(chartData);

        var options = {
            chart: {
                title: 'Bautista Clinic Summary of Record',
                subtitle: 'Year:' + year,
            }
        };
        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
        $('.spinner-border').hide();
    }

    function getData(year) {
        let data;
        $.ajax({
            type: 'get',
            url: '/medications/getChartData/' + year,
            async: false,
            success: function(response) {
                data = response;
            }
        });
        return data;
    }
</script>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Home</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div>
                            <label>Select Date</label>
                            <input type="text" class="yearpicker form-control form-control-sm mb-4" />
                            <button type="button" class="btn btn-xs btn-success" id="submit-date">Submit</button>
                            <a href="#" data-container="body" title="Did you know?" data-toggle="popover" data-placement="right" data-content="This is a summary of patients for whom consulting is done"><i class="icon-question"></i></a>
                        </div>
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div id="columnchart_material" style="width: 100%; height: 500px;"></div>
                        <a href="#columnchart_material" data-container="body" 
                            title="Did you know?" data-toggle="popover" data-placement="right" 
                            data-content="The color orange rectangle shape is defined as a combination of a total value of male and female">
                            <i class="icon-question"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(".dashboard_nav").addClass("active");
    $(document).ready(function() {
        $(".yearpicker").yearpicker({
            year: 2019,
            startYear: 2012,
            endYear: 2030
        });
        $('#submit-date').click(function() {
            $('.spinner-border').show();
            yearData = $('.yearpicker').val();
            drawChart(yearData);
        });
    });
</script>