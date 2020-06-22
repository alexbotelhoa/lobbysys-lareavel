<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            html, body {
                padding: 20px;
            }
            .navbar {
                margin-bottom: 20px;
            }

            .full-height {
                height: 80vh;
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

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>

        <title>{{ config('app.name', 'LobbySis') }}</title>
    </head>
    <body>
        <div class="container">
            @component('components.navbar', ["current" => $current])
            @endcomponent
            <main role="main">
                @hasSection('body')
                    @yield('body')
                @endif
            </main>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>

        @hasSection('javascript')
            @yield('javascript')
        @endif

    </body>
</html>