
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Service Unavailable</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-image: url("{{ asset('img/wall.jpg') }}");
            background-repeat:no-repeat;
            background-position: center center;
            color: #dff0f9;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 36px;
            padding: 20px;
            font-weight: bold;
            text-shadow: 2px 2px 5px black;
        }

        img {
            box-shadow: 0 0 15px black;
            border-radius: 15px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title">
            <img src="{{ asset('img/logo.png') }}" style="max-height: 150px" alt=""><br>
            Be right back</div>
    </div>
</div>
</body>
</html>
