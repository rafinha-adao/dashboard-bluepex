<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('action_button') ?>

<button onclick="getData()" class="btn btn-dark">Atualizar</button>

<?= $this->endSection('action_button') ?>

<?= $this->section('dashboard_content') ?>

<div class="row mb-3 gx-3">
    <div class="col-md-6 mb-3 mb-md-0">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title h6">CPU <span id="cpuPercent"></span></h2>
                <canvas id="chartCPU"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title h6">Memória <span id="memoryPercent"></span></h2>
                <canvas id="chartMemory"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="row mb-3 gx-3">
    <div class="col-md-6 mb-3 mb-md-0">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title h6">Disco <span id="diskPercent"></span></h2>
                <canvas id="chartDisk"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title h6">SO</h2>
                <div class="d-flex align-items-center justify-content-center h-75">
                    <p id="textOS" class="card-text text-center"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    canvas {
        max-width: 250px;
        max-height: 250px;
        margin-inline: auto;
    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const chartCPU = document.getElementById('chartCPU');
    const chartMemory = document.getElementById('chartMemory');
    const chartDisk = document.getElementById('chartDisk');
    const textOS = document.getElementById('textOS');

    const cpuPercent = document.getElementById('cpuPercent');
    const memoryPercent = document.getElementById('memoryPercent');
    const diskPercent = document.getElementById('diskPercent');

    // Armazene as instâncias de gráficos
    var chartCPUInstance, chartMemoryInstance, chartDiskInstance;

    function getData() {
        $.ajax({
            url: "/data",
            success: function(res) {
                textOS.textContent = res.os;

                if (chartCPUInstance) {
                    chartCPUInstance.destroy();
                }
                if (chartMemoryInstance) {
                    chartMemoryInstance.destroy();
                }
                if (chartDiskInstance) {
                    chartDiskInstance.destroy();
                }

                cpuPercent.textContent = "(" + Math.round(res.cpu.usage) + "%)";
                memoryPercent.textContent = "(" + Math.round(res.memory.used_percent) + "%)";
                diskPercent.textContent = "(" + Math.round(res.disk.used_percent) + "%)";

                chartCPUInstance = new Chart(chartCPU, {
                    type: 'doughnut',
                    data: {
                        labels: ['Usado', 'Disponível'],
                        datasets: [{
                            label: '',
                            data: [res.cpu.usage, res.cpu.available],
                            backgroundColor: ['#fece56', '#36a2eb'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                display: true,
                                position: 'bottom',
                            }
                        }
                    }
                });

                chartMemoryInstance = new Chart(chartMemory, {
                    type: 'doughnut',
                    data: {
                        labels: ['Usado', 'Disponível'],
                        datasets: [{
                            label: '',
                            data: [res.memory.used, res.memory.total - res.memory.used],
                            backgroundColor: ['#fece56', '#ff6283'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                display: true,
                                position: 'bottom',
                            }
                        }
                    }
                });

                chartDiskInstance = new Chart(chartDisk, {
                    type: 'doughnut',
                    data: {
                        labels: ['Usado', 'Disponível'],
                        datasets: [{
                            label: '',
                            data: [res.disk.used, res.disk.free],
                            backgroundColor: ['#fece56', '#4bc0c0'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                display: true,
                                position: 'bottom',
                            }
                        }
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error("Erro ao carregar dados do servidor: ", status, error);
            }
        });
    }

    getData();
    setInterval(getData, 10000);
</script>

<?= $this->endSection('dashboard_content') ?>