<div class="row" style="height: 10px">

</div>

<div class="row">
    <div class="card" style="margin: 10px; height: 100%">
        <h6 class="card-header">Ultima leitura</h6>
        <div class="card-body text-center">

            <div class="row" style="width:100%; height:100%">
                <div class="col align-self-center">
                    <?php
                    include 'db.php';
                    $sql = "SELECT * FROM `dados_usina` ORDER BY registro DESC LIMIT 1";
                    $busca = mysqli_query($db, $sql);

                    while ($array = mysqli_fetch_array($busca)) {
                        $luminosidade = $array['luminosidade'];
                        $temperatura = $array['temperatura'];
                        $tensao = $array['tensao'];
                        $corrente = $array['corrente'];
                        $potencia = $array['potencia'];
                        $registro = $array['registro'];

                    ?>
                        <span style="font-size:15px">Potência Acumulada</span> <b class="text-primary" style="font-size:25px">
                            <?php echo "-"; ?> kWh
                        </b>
                        <br><span style="font-size:15px">Potência Instantânea</span> <b class="text-success" style="font-size:25px">
                            <?php echo $potencia; ?> W
                        </b>
                        <br><span style="font-size:15px">Corrente</span> <b class="text-warning" style="font-size:25px">
                            <?php echo $corrente; ?> A
                        </b>
                        <br><span style="font-size:15px">Tensão</span> <b class="text-danger" style="font-size:25px">
                            <?php echo $tensao; ?> V
                        </b>
                        <br><span style="font-size:15px">Temperatura</span> <b class="text-info" style="font-size:25px">
                            <?php echo $temperatura; ?> ºC
                        </b>
                </div>
            </div>
        </div>
        <div class="card-footer text-center text-muted">
            <?php echo date('d/m/Y G:i:s', strtotime($registro)) ?>
        <?php } ?>

        </div>
    </div>
</div>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['line']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = new google.visualization.DataTable();
        data.addColumn({
            type: 'date',
            label: 'Day'
        });
        data.addColumn('number', 'W');

        data.addRows([
            <?php
            include 'db.php';
            $sql = "SELECT * FROM `dados_usina` ORDER BY registro DESC LIMIT 20";
            $busca = mysqli_query($db, $sql);

            while ($array = mysqli_fetch_array($busca)) {
                $potencia = $array['potencia'];
                $registro = $array['registro'];
            ?>[new Date(<?php echo date('Y', strtotime($registro)); ?>, <?php echo date('m', strtotime($registro)); ?>, <?php echo date('d', strtotime($registro)); ?>, <?php echo date('h', strtotime($registro)); ?>, <?php echo date('i', strtotime($registro)); ?>, <?php echo date('s', strtotime($registro)); ?>), <?php echo $potencia; ?>],
            <?php } ?>
        ]);

        var options = {
            chart: {
                title: 'Potência',
                subtitle: 'Leituras da ultima hora'
            },

        };

        var chart = new google.charts.Line(document.getElementById('chart_potencia'));

        chart.draw(data, google.charts.Line.convertOptions(options));
    }
</script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['line']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = new google.visualization.DataTable();
        data.addColumn({
            type: 'date',
            label: 'Day'
        });
        data.addColumn('number', 'Lumens');

        data.addRows([
            <?php
            include 'db.php';
            $sql = "SELECT * FROM `dados_usina` ORDER BY registro DESC LIMIT 20";
            $busca = mysqli_query($db, $sql);

            while ($array = mysqli_fetch_array($busca)) {
                $luminosidade = $array['luminosidade'];
                $registro = $array['registro'];
            ?>[new Date(<?php echo date('Y', strtotime($registro)); ?>, <?php echo date('m', strtotime($registro)); ?>, <?php echo date('d', strtotime($registro)); ?>, <?php echo date('h', strtotime($registro)); ?>, <?php echo date('i', strtotime($registro)); ?>, <?php echo date('s', strtotime($registro)); ?>), <?php echo $luminosidade; ?>],
            <?php } ?>
        ]);

        var options = {
            chart: {
                title: 'Luminosidade',
                subtitle: 'Leituras da ultima hora'
            },

        };

        var chart = new google.charts.Line(document.getElementById('chart_luminosidade'));

        chart.draw(data, google.charts.Line.convertOptions(options));
    }
</script>
<div class="row" style="height: 10px">
    <div class="col-md"></div>
</div>
<div class="row">
    <div class="card" style="margin: 10px; height: 100%">
        <h6 class="card-header">Registros recentes</h6>
        <div class="card-body text-center">
            <div class="row">
                <div class="col-sm">
                    <?php
                    include 'db.php';
                    $sql = "SELECT * FROM `dados_usina` ORDER BY registro DESC LIMIT 20";
                    $busca = mysqli_query($db, $sql);

                    while ($array = mysqli_fetch_array($busca)) {
                        $luminosidade = $array['luminosidade'];
                        $temperatura = $array['temperatura'];
                        $tensao = $array['tensao'];
                        $corrente = $array['corrente'];
                        $potencia = $array['potencia'];
                        $registro = $array['registro'];
                    ?>
                        Potência Inst.: <b class="text-success">
                            <?php echo $potencia; ?>W
                        </b> / Temp.: <b class="text-info">
                            <?php echo $temperatura; ?> ºC
                        </b> / Tensão.: <b class="text-danger">
                            <?php echo $tensao; ?> V
                        </b> / Corrente.: <b class="text-warning">
                            <?php echo $corrente; ?> A
                        </b><br>
                        <p class="text-muted" style="font-size:12px">Registro:
                            <?php echo date('d/m/Y G:i:s', strtotime($registro)) ?>
                        </p>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="card-footer text-center text-muted">

        </div>
    </div>
    <div class="card" style="margin: 10px;">
        <h6 class="card-header">Gráfico - Potência Instantânea</h6>
        <div class="card-body">
            <div id="chart_potencia" style="width: 100%; height: 500px; margin-top: 10px;"></div>
        </div>
    </div>
    <div class="card" style="margin: 10px;">
        <h6 class="card-header">Gráfico - Luminosidade</h6>
        <div class="card-body">
            <div id="chart_luminosidade" style="width: 100%; height: 500px; margin-top: 10px;"></div>
        </div>
    </div>
</div>