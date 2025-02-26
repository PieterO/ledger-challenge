<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Money Money Money</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
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

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .nineties {
                background-color: rgb(255, 246, 240);
                background: url("img/hell-background.gif");
                color: rgb(0, 0, 0);

            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height nineties">
            @if (Route::has('login'))
                <div class="top-right links" style="background-color:white">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md" style="background-color:cornsilk">
                    Balance
                </div>


                <div class="subtitle" style="background-color:lightcyan">>
                    For all your money needs, when you join us you get {{ numfmt_format_currency(config('global.fmt')
, config('global.startingBalance'), 'GBP')}} free!
                </div>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"><h2 align="CENTER"><blink><marquee behavior="alternative">JOIN TODAY</marquee></blink></h2></a>
                @endif
            </div>
        </div>
    </body>
</html>
