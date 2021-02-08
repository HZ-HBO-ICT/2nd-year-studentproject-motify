<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, viewport-fit=cover" name="viewport">
    <title>{{ env('APP_NAME') }}</title>

    <meta name="theme-color" content="#7baef7">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="{{ env('APP_NAME') }}">
    <meta name="application-name" content="{{ env('APP_NAME') }}">

    <meta name="msapplication-TileColor" content="#0addff">
    <meta name="msapplication-TileImage" content="{{ url('./img/icons/mstile-144x144.png')}}">
    <meta name="msapplication-config" content="{{ url('./img/icons/browserconfig.xml')}}">

    <link href="{{url('favicon.ico') }}" rel="icon" />
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('./img/icons/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url('./img/icons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="194x194" href="{{ url('./img/icons/favicon-194x194.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ url('./img/icons/android-chrome-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('./img/icons/favicon-16x16.png')}}">
    <link rel="manifest" href="{{ url('./img/icons/site.webmanifest')}}">
    <link rel="mask-icon" href="{{ url('./img/icons/safari-pinned-tab.svg')}}" color="#0addff">
    <link rel="shortcut icon" href="{{ url('./img/icons/favicon.ico')}}">

    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,d500,700,900" rel="stylesheet" />
</head>

<noscript>
    <strong>
        We're sorry but Motify doesn't work properly without JavaScript enabled.
        Please enable it to continue.
    </strong>
</noscript>

<body class="body-2">
    <div id="app"></div>
</body>

<script src="{{ mix('/js//app.js') }}" type="text/javascript" defer></script>

</html>
