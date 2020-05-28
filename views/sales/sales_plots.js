const selectYear = document.getElementById('selectYear')
const selectMonth = document.getElementById('selectMonth')
const selectWeek = document.getElementById('selectWeek')
const selectDay = document.getElementById('selectDay')

selectYear.onchange = loadPlots
selectMonth.onchange = loadPlots
selectWeek.onchange = loadPlots
selectDay.onchange = loadPlots

function loadPlots() {
    const date = {
        year : selectYear.value,
        month : selectMonth.value,
        week : selectWeek.value,
        day : selectDay.value
    }
    console.log(date);
    
    salesPerCustomer(date)  
    salesPerDate(date)
    salesProducts(date)
}

function salesPerCustomer (date) {
    getData('http://localhost/Dashboard-AD/', { c:'SalesReport', a:'plotSalesPerCustomer', date:JSON.stringify(date)})
        .done(data => {
            console.log(data);
        })    
}

function salesPerDate(date) {
    getData('http://localhost/Dashboard-AD/', { c:'SalesReport', a:'plotSalesPerDate', date:JSON.stringify(date)})
        .done(data => {
            console.log(data);
        })   
}

function salesProducts(date) {
    getData('http://localhost/Dashboard-AD/', { c:'SalesReport', a:'plotSalesProducts', date:JSON.stringify(date)})
        .done(data => {
            console.log(data);
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