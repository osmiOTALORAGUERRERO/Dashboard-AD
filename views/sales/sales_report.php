<div class="row justify-content-center mt-2">
    <div class="col align-self-center">
        <h1 class="text-center">Reporte de ventas</h1>
    </div>
</div>

<?php require_once 'views/assets/date_form.php'?>
<div class="row justify-content-around">
    <div class="col-5">
        <div div="row">
            <h1 id="#Sales" class='display-3'></h1>
            <h1 id="#Products" class='display-4'></h1>
        </div>
        <div class="row">
            <canvas id="salesPerCustomer" width="400" height="400"></canvas>
        </div>
    </div>
    <div class="col-5">
        <div class="row">
            <canvas id="salesPerDate" width="400" height="400"></canvas>
        </div>
        <div class="row">
            <canvas id="salesProducts" width="400" height="400"></canvas>
        </div>
    </div>
</div>

<script src="views/sales/sales_plots.js"></script>
<script>
    $(document).ready(() => {
        loadPlots()
    })
</script>