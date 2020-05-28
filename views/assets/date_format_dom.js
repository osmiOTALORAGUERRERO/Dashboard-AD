$(document).ready( () => {
    generateOptionsYear()
    generateOptionsMonth()
    generateOptionsWeek()
    generateOptionsDay()
})

function generateOptionsYear() {
    const selectYear = document.getElementById('selectYear')
    let option
    let year = 2000;
    for (let i = 0; i <= (new Date().getFullYear()-year); i++) {
        option = document.createElement('option');
        option.value = year+i
        option.text = year+i
        selectYear.appendChild(option)
    } 
}

function generateOptionsMonth(params) {
    const selectMonth = document.getElementById('selectMonth')
    let option
    let month = 1
    for (let i = 0; i < 12; i++) {
        option = document.createElement('option');
        option.value = month+i
        option.text = month+i
        selectMonth.appendChild(option)
    }
}

function generateOptionsWeek(params) {
    const selectWeek = document.getElementById('selectWeek')
    let option
    let week = 1
    for (let i = 0; i < 4; i++) {
        option = document.createElement('option');
        option.value = week+i
        option.text = week+i
        selectWeek.appendChild(option)
    }
}

function generateOptionsDay(params) {
    const selectDay = document.getElementById('selectDay')
    let option
    let day = 1
    for (let i = 0; i < 30; i++) {
        option = document.createElement('option');
        option.value = day+i
        option.text = day+i
        selectDay.appendChild(option)
    }
}