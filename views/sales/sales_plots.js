const selectYear = document.getElementById('selectYear')
const selectMonth = document.getElementById('selectMonth')
const selectWeek = document.getElementById('selectWeek')
const selectDay = document.getElementById('selectDay')

const canvas = {
    ctxPerCustomer : document.getElementById('salesPerCustomer').getContext('2d'),
    ctxPerDate : document.getElementById('salesPerDate').getContext('2d'),
    ctxUnits : document.getElementById('salesProducts').getContext('2d')
}

let plots = {}

selectYear.onchange = restartPlots
selectMonth.onchange = restartPlots
selectWeek.onchange = restartPlots
selectDay.onchange = restartPlots

function restartPlots() {
    plots.perCustomer.destroy()
    plots.perDate.destroy()
    plots.units.destroy()
    plots = {}
    loadPlots()
}

function loadPlots() {
    const date = {
        year : selectYear.value,
        month : selectMonth.value,
        week : selectWeek.value,
        day : selectDay.value
    }
    // console.log(date)
    totalsSales(date)
    salesPerCustomer(date)  
    salesPerDate(date)
    salesProducts(date)
}

function salesPerCustomer (date) {
    getData('http://localhost/Dashboard-AD/', { c:'SalesReport', a:'plotSalesPerCustomer', date:JSON.stringify(date)})
    .done(data => {
        // console.log(data)
        let customers_name = data.map(customer => customer.customer_name)
        // console.log(customers_name);
        let units_buyed = data.map(units => units.units_buyed)
        // console.log(units_buyed);
        var color = Chart.helpers.color;
        let dataPlot = {
            labels : customers_name,
            datasets : [{
                label : '# units buyed',
                data : units_buyed,
                backgroundColor : color(window.chartColors.blue).alpha(0.5).rgbString(),
                borderColor: window.chartColors.blue,
				borderWidth: 1
            }]
        }
        let myChart = new Chart(canvas.ctxPerCustomer, {
            type: 'bar',
            data: dataPlot,
            options: {
                responsive: true,
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Compras por clientes'
                }
            }
        })
        plots.perCustomer = myChart;
    })    
}

function salesPerDate(date) {
    getData('http://localhost/Dashboard-AD/', { c:'SalesReport', a:'plotSalesPerDate', date:JSON.stringify(date)})
        .done(data => {
            // console.log(data);
            const dataSet1 = data.salesRevenue
            const dataSet2 = data.sellingExpenses
            const revenueDate = dataSet1.map(revenue => revenue['0'])
            const revenueValue = dataSet1.map(revenue => revenue.sales_revenue)
            // console.log(revenueDate, revenueValue);
            const expensesDate = dataSet2.map(expenses => expenses['0'])
            const expensesValue = dataSet2.map(expenses => expenses.selling_expenses)
            // console.log(expensesDate, expensesValue);
            dataPlot = {
                labels : revenueDate,
                datasets : [{
                    label : 'Ingresos',
                    borderColor : window.chartColors.red,
                    backgroundColor : window.chartColors.red,
                    fill : false,
                    pointRadius: 10,
                    data : revenueValue
                },{
                    label : 'Invertido',
                    borderColor : window.chartColors.blue,
                    backgroundColor : window.chartColors.blue,
                    fill : false,
                    pointRadius: 10,
                    data : expensesValue
                }]
            }
            let myChart = new Chart(canvas.ctxPerDate, {
                type: 'line',
                data: dataPlot,
				options: {
                    responsive: true,
                    hoverMode: 'index',
					stacked: false,
					legend: {
						position: 'top',
					},
					title: {
						display: true,
						text: 'Ingresos e invertido en productos vendidos'
                    }
				}
            })
            plots.perDate = myChart;
        })   
}

function salesProducts(date) {
    getData('http://localhost/Dashboard-AD/', { c:'SalesReport', a:'plotSalesProducts', date:JSON.stringify(date)})
        .done(data => {
            // console.log(data);
            const nameProduct = data.map(product => product.name)
            const unitsProduct = data.map(product => product.units)
            const colors = []
            for (let i = 0; i < data.length; i++) {
                colors.push(colorRGB());
            }
            const dataPlot = {
                labels : nameProduct,
                datasets : [
                    {
                        label : 'Products',
                        data : unitsProduct,
                        backgroundColor : colors
                    }
                ]
            }
            let myChart = new Chart(canvas.ctxUnits, {
                type : 'pie',
                data : dataPlot,
                options : {
                    responsive: true,
                    hoverMode: 'index',
					stacked: false,
					legend: {
						position: 'top',
					},
					title: {
						display: true,
						text: '# productos vendidos'
                    }
                }
            })
            plots.units = myChart;
        })   
}

function totalsSales(date) {
    getData('http://localhost/Dashboard-AD/',  { c:'SalesReport', a:'totalsSales', date:JSON.stringify(date)})
        .done(data => {
            // console.log(data);
            const h1Sales = document.getElementById('#Sales')
            const h1Products = document.getElementById('#Products')
            h1Sales.innerText = `# Ventas: ${data[0][0].sales_number}`
            h1Products.innerText = `# Productos: ${data[1][0].units_number}`
        })
}
function getData(url, data){
    const response = $.ajax({
        url : url,
        type : 'POST',
        dataType : 'json',
        data : data
    })
    return response
}