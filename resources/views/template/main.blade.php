<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    @include('template.partials.loader')

    <link href="/css/app.css?v=0.1" rel="stylesheet">
    <link href="/css/style.min.css?v=0.1" rel="stylesheet">
    <script type="text/javascript">
        window.__ORGANIZATION__ = {!! $organization !!};
    </script>
</head>

<body class="app">
    <div id="loader">
        <div class="spinner"></div>
    </div>
    <script>
        window.addEventListener('load', function load() {
            const loader = document.getElementById('loader');
            setTimeout(function() {
                loader.classList.add('fadeOut');
            }, 300);
        });
    </script>
    <div id="app">
        <v-app>
            @include('template.partials.sidebar')

            <div class="page-container">
                @include('template.partials.navbar')
                <main class="main-content bgc-grey-100">
                    <div id="mainContent">
                        @yield('content')
                    </div>
                </main>
                @include('template.partials.footer')
            </div>
        </v-app>
    </div>

    <script type="text/javascript" src="/js/app.js"></script>
    <script type="text/javascript" src="/js/vendor.min.js"></script>
    <script type="text/javascript" src="/js/bundle.min.js"></script>
</body>

</html>