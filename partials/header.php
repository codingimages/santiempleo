<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="En santiempleo.com ayudamos a empleadores encontrar trabajadores y a los trabajadores encontrar empleo. Asi de simple! ">
    <meta name="keywords" content="agencia de empleo" "empleos para hispanos" "empleos disponibles para hispanos">
    <meta name="author" content="santiempleo.com">
    <link rel="shortcut icon" type="image/png" href=img/favicon.png>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">

    <!-- Custom Style -->
    <link rel="stylesheet" href="css/style.css?v=1">

    <script>
        function loadTimes() {
            var selectedDate = document.getElementById('date');

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("time").innerHTML = this.responseText;
                }
            };
            xhttp.open("POST", "partials/ajax.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("date=" + selectedDate.value);
        }

    </script>

    <title>SantiEmpleo Solicita información</title>
</head>

<body>
