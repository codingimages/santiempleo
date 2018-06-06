function show() {

    var selectedDate = document.getElementById('date');
    var d = new Date();
    var days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    var inputDay = days[d.getDay()];

    console.log(inputDay);
    console.log(selectedDate.value);

}


