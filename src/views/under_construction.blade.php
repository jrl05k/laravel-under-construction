<!DOCTYPE html>
<html>
<head>
    <title>{{ config('app.name') }}</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Lato|Roboto:100,300,400" rel="stylesheet">
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            min-height: 100%;
            padding-top: 50%;
            text-align: center;
            font-family: sans-serif;
            font-size: 40px;
        }
        .title {
            font-family: 'Roboto', sans-serif;
            font-weight: 100;
            font-size: 40px;            
        }
        
        .message {
            font-family: 'Open+Sans', sans-serif;
            font-size: 25px;
        }

        @media only screen and (min-width : 500px) {
            body {
                padding-top: 30%;
            }
            .title {
                font-size: 60px;
            }
            .message {
                font-size: 20px;
            }
        }

        /* Small Devices, Tablets */
        @media only screen and (min-width : 768px) {
            body {
                padding-top: 25%;
            }
        }

        /* Medium Devices, Desktops */
        @media only screen and (min-width : 992px) {
            body {
                padding-top: 15%;
            }
        }

        /* Large Devices, Wide Screens */
        @media only screen and (min-width : 1200px) {
            body {
                padding-top: 15%;                
            }
        }

    </style>
</head>
<body>

    <span class="title"> {{ config('app.name') }} </span>
    <br>
    <br>
    <span class="message"> UNDER CONSTRUCTION </span>


</body>
</html>