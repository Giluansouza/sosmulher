<?php $v->layout("_theme"); ?>
<div class="row">
    <div class="col-xl-12">
        <div class="breadcrumb-holder">
            <h1 class="main-title float-left">Gráficos</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item active"><a href="<?= url('/app') ?>"></a>Início</li>
                <li class="breadcrumb-item active">Gráficos</li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- Content Wrapper. Contains page content -->
<div class="ajax_response"><?= flash(); ?></div>
<?php $v->insert('views/widgets/header-filter-o.php', ["url" => "/dev/graficos"]); ?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-line-chart"></i> Dia da Semana
            </div>
            <div class="card-body">
                <!--Div that will hold the pie chart-->
                <div id="columnchart_weekday" class="bar-chart"></div>
            </div>
            <div class="card-footer small text-muted">Atualizado em <?= date('d/m/Y H:i'); ?></div>
        </div><!-- end card-->
    </div>
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-line-chart"></i> Intervalo de Tempo
            </div>
            <div class="card-body">
                <!--Div that will hold the pie chart-->
                <div id="linechart_interval" class="bar-chart"></div>
            </div>
            <div class="card-footer small text-muted">Atualizado em <?= date('d/m/Y H:i'); ?></div>
        </div><!-- end card-->
    </div>
</div>
  <!-- <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-line-chart"></i> Motivação
            </div>
            <div class="card-body">
                <!-Div that will hold the pie chart
                <div id="chart_motivation" class="bar-chart"></div>
            </div>
            <div class="card-footer small text-muted">Atualizado em <= date('d/m/Y H:i'); ?></div>
        </div><!- end card
    </div>
</div> -->
<!-- endrow -->
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-line-chart"></i> Veículo Utilizado
            </div>
            <div class="card-body">
                <!--Div that will hold the pie chart-->
                <div id="chart_vehicle" class="bar-chart"></div>
            </div>
            <div class="card-footer small text-muted">Atualizado em <?= date('d/m/Y H:i'); ?></div>
        </div><!-- end card-->
    </div>
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-line-chart"></i> Arma Utilizada
            </div>
            <div class="card-body">
                <!--Div that will hold the pie chart-->
                <div id="chart_weapon" class="bar-chart"></div>
            </div>
            <div class="card-footer small text-muted">Atualizado em <?= date('d/m/Y H:i'); ?></div>
        </div><!-- end card-->
    </div>
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-line-chart"></i> Motivação
            </div>
            <div class="card-body">
                <!--Div that will hold the pie chart-->
                <div id="chart_motivation" class="bar-chart"></div>
            </div>
            <div class="card-footer small text-muted">Atualizado em <?= date('d/m/Y H:i'); ?></div>
        </div><!-- end card-->
    </div>
    <!-- <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-line-chart"></i> Calibre
            </div>
            <div class="card-body">
                Div that will hold the pie chart
                <div id="chart_caliber" class="bar-chart"></div>
            </div>
            <div class="card-footer small text-muted">Atualizado em <= date('d/m/Y H:i'); ?></div>
        </div>--><!-- end card-->
    <!--</div> -->
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-line-chart"></i> Cidade
            </div>
            <div class="card-body">
                <!--Div that will hold the pie chart-->
                <div id="columnchart_cityCount" class="bar-chart"></div>
            </div>
            <div class="card-footer small text-muted">Atualizado em <?= date('d/m/Y H:i'); ?></div>
        </div><!-- end card-->
    </div>
</div>
<?php if ($districtCount != NULL): ?>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-line-chart"></i> Bairro/Distrito
                </div>
                <div class="card-body">
                    <!--Div that will hold the pie chart-->
                    <div id="columnchart_districtCount" class="bar-chart"></div>
                </div>
                <div class="card-footer small text-muted">Atualizado em <?= date('d/m/Y H:i'); ?></div>
            </div><!-- end card-->
        </div>
    </div>
<?php endif ?>
<?php $v->start('scripts'); ?>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="<?= theme("../superadmin/assets/plugins/googlechart/loader.js"); ?>"></script>
    <script type="text/javascript">
        // Load the Visualization API and the corechart package.
        google.charts.load('current', {'packages':['corechart']});
        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChartMotivation);
        google.charts.setOnLoadCallback(drawChartWeapon);
        // google.charts.setOnLoadCallback(drawChartCaliber);
        google.charts.setOnLoadCallback(drawChartVehicle);
        google.charts.setOnLoadCallback(drawChartWeekday);
        google.charts.setOnLoadCallback(drawChartInterval);
        google.charts.setOnLoadCallback(drawChartCityCount);

        // Callback that creates and populates a data table,
        // instantiates the pie chart, passes in the data and
        // draws it.
        function drawChartMotivation() {
            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Topping');
            data.addColumn('number', 'Slices');
            data.addRows([
                <?php foreach ($motivation as $key => $value):
                    echo "['".$value->name."', ".$value->total."],";
                endforeach ?>
            ]);

            // Set chart options
            var options = {
                    'legend':'bottom'
                };

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.PieChart(document.getElementById('chart_motivation'));
            chart.draw(data, options);
        }
        // Weapon
        function drawChartWeapon() {
            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Topping');
            data.addColumn('number', 'Slices');
            data.addRows([
                <?php foreach ($weapon as $key => $value):
                    echo "['".$value->name."', ".$value->total."],";
                endforeach ?>
            ]);

            // Set chart options
            var options = {
                    'legend':'bottom'
                };

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.PieChart(document.getElementById('chart_weapon'));
            chart.draw(data, options);
        }
        // Caliber
        function drawChartCaliber() {
            // Create the data table.
            // var data = new google.visualization.DataTable();
            // data.addColumn('string', 'Topping');
            // data.addColumn('number', 'Slices');
            // data.addRows([
            //     <php foreach ($caliber as $key => $value):
            //         echo "['".$value->name."', ".$value->total."],";
            //     endforeach ?>
            // ]);

            // // Set chart options
            // var options = {
            //         'legend':'bottom'
            //     };

            // // Instantiate and draw our chart, passing in some options.
            // var chart = new google.visualization.PieChart(document.getElementById('chart_caliber'));
            // chart.draw(data, options);
        }
        // Vehicle
        function drawChartVehicle() {
            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Topping');
            data.addColumn('number', 'Slices');
            data.addRows([
                <?php foreach ($vehicle as $key => $value):
                    echo "['".$value->name."', ".$value->total."],";
                endforeach ?>
            ]);

            // Set chart options
            var options = {
                    'legend':'bottom'
                };

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.PieChart(document.getElementById('chart_vehicle'));
            chart.draw(data, options);
        }
        //Weekday
        function drawChartWeekday() {
            var data = google.visualization.arrayToDataTable([
                ["Element", "Density", { role: "value" } ],
                <?php foreach ($weekday as $key => $value):
                    echo "['".strftime('%A', strtotime($value->name))."', ".$value->total.", 1],";
                endforeach ?>
            ]);

          var view = new google.visualization.DataView(data);
          view.setColumns([0, 1,
                           { calc: "stringify",
                             sourceColumn: 1,
                             type: "string",
                             role: "annotation" },
                           2]);

            var options = {
                bar: {groupWidth: "95%"},
                legend: { position: "none" },
            };
          var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_weekday"));
          chart.draw(view, options);
        }
        //Interval
        function drawChartInterval() {
            var data = google.visualization.arrayToDataTable([
                ['Year', 'Intervalo', {type: 'number', role:'annotation'}],
                <?php foreach ($interval as $key => $value):
                    echo "['".$value->name."', ".$value->total.", ".$value->total."],";
                endforeach ?>
            ]);
            var options = {
                curveType: 'function',
                legend: { position: 'bottom' }
            };
            var chart = new google.visualization.LineChart(document.getElementById('linechart_interval'));
            chart.draw(data, options);
        }
        //City Count
        function drawChartCityCount() {
            var data = google.visualization.arrayToDataTable([
                ["Element", "Quantidade", { role: "value" } ],
                <?php foreach ($cityCount as $key => $value):
                    if(!empty($value->name)) {
                        echo "['".$value->name."', ".$value->total.", 1],";
                    }
                endforeach ?>
            ]);

          var view = new google.visualization.DataView(data);
          view.setColumns([0, 1,
                           { calc: "stringify",
                             sourceColumn: 1,
                             type: "string",
                             role: "annotation" },
                           2]);

            var options = {
                bar: {groupWidth: "95%"},
                legend: { position: "none" },
            };
          var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_cityCount"));
          chart.draw(view, options);
        }

        //District Count
        if ($('#columnchart_districtCount').length != 0) {
            google.charts.setOnLoadCallback(drawChartDistrictCount);
            function drawChartDistrictCount() {
                var data = google.visualization.arrayToDataTable([
                    ["Element", "Quantidade", { role: "value" } ],
                    <?php
                        if ($districtCount):
                            foreach ($districtCount as $key => $value):
                                if(!empty($value->name)) {
                                    echo "['".($value->dname?:"NI")."', ".$value->total.", 1],";
                                }
                            endforeach;
                        endif;
                    ?>
                ]);

              var view = new google.visualization.DataView(data);
              view.setColumns([0, 1,
                               { calc: "stringify",
                                 sourceColumn: 1,
                                 type: "string",
                                 role: "annotation" },
                               2]);

                var options = {
                    bar: {groupWidth: "95%"},
                    legend: { position: "none" },
                };
              var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_districtCount"));
              chart.draw(view, options);
            }
        } else {
            console.log("Não existe "+$('#columnchart_districtCount').length);
        }
    </script>
<?php $v->end(); ?>
