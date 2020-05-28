<div class="row justify-content-center mt-2">
    <div class="col align-self-center">
        <h1 class="text-center">Reporte de ventas</h1>
    </div>
</div>

<?php require_once 'views/assets/date_form.php'?>

<canvas id="salesPerCustomer" width="400" height="400"></canvas>
<canvas id="salesPerDate" width="400" height="400"></canvas>
<canvas id="SalesProducts" width="400" height="400"></canvas>

<script src="views/sales/sales_plots.js"></script>
<script>
    $(document).ready(() => {
        loadPlots()
    })
</script>