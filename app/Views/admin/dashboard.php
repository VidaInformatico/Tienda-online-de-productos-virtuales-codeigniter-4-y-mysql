<?php if ($_SESSION['rol'] == 'admin') {
    $this->extend('admin_layout');
} else {
    $this->extend('cliente_layout');
} ?>

<?= $this->section('content') ?>
<!-- Contenido específico de la página del dashboard se insertará aquí -->
<h2>Bienvenido al dashboard</h2>

<hr>

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-body">
                <canvas id="myChart" width="400" height="250"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Enlace oculto por defecto -->

<?= $this->endSection() ?>

<?= $this->section('js') ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Script para obtener datos de pedidos por mes y generar el gráfico -->
<script>
    document.addEventListener('DOMContentLoaded', function() {       

        //REPORTE GRAFICO
        var data = <?php echo json_encode($reportData); ?>;

        var labels = [];
        var values = [];

        data.forEach(function(item) {
            labels.push(item.mes);
            values.push(item.total);
        });

        var chartData = {
            labels: labels,
            datasets: [{
                label: 'Pedidos por Mes',
                data: values,
                backgroundColor: 'rgb(75, 192, 192)',
                borderColor: 'rgb(75, 192, 192)',
                borderWidth: 1
            }]
        };

        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: chartData,
            options: {
                scales: {
                    x: [{
                        grid: {
                            display: false
                        }
                    }],
                    y: [{
                        grid: {
                            display: false
                        }
                    }]
                }
            }
        });
    });
</script>
<?= $this->endSection() ?>