{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $appUrl = config('app.url');
    $currentLocale = App::getLocale();
    $fallbackLocale = config('app.fallback_locale');
@endphp
<link rel="apple-touch-icon" sizes="180x180" href="{{ $appUrl }}/images/favicon/apple-touch-icon.png">
<link rel="icon" sizes="32x32" href="{{ $appUrl }}/images/favicon/favicon-32x32.png">
<link rel="icon" sizes="16x16" href="{{ $appUrl }}/images/favicon/favicon-16x16.png">
<link rel="manifest" href="{{ $appUrl }}/site.webmanifest">
<link rel="mask-icon" href="{{ $appUrl }}/images/favicon/safari-pinned-tab.svg" color="#e2609a">
<meta name="msapplication-TileColor" content="#603cba">
<meta name="theme-color" content="hsl({{ $currentHue }}, 10%, 40%)"> {{-- @osu-colour-b1 --}}

<meta charset="utf-8">
<meta name="description" content="{{ $pageDescription ?? osu_trans('layout.defaults.page_description') }}">
<meta name="keywords" content="osu, peppy, ouendan, elite, beat, agents, ds, windows, game, taiko, tatsujin, simulator, sim, xna, ddr, beatmania, osu!, osume">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="search" type="application/opensearchdescription+xml" title="osu! search" href="{{ config('app.url') }}/opensearch.xml">

@if (isset($opengraph))
    <meta property="og:site_name" content="osu! » {{ page_title() }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:title" content="{{ $opengraph['title'] }}">
    <meta property="og:image" content="{{ $opengraph['image'] }}">

    @if (isset($pageDescription))
        <meta property="og:description" content="{{ $pageDescription }}">
    @endif
@endif

@if ($noindex ?? false)
    <meta name="robots" content="noindex">
@endif

<meta name="csrf-param" content="_token">
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="turbolinks-cache-control" content="no-preview">

@if(config("services.ga.tracking_id") !== '')
    <meta name="ga-tracking-id" content="{{ config("services.ga.tracking_id") }}">
@endif

@switch($currentLocale)
    @case('vi')
        <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,600,700&display=swap&subset=vietnamese" rel="stylesheet">
        <style>
            :root {
                --font-default-override: var(--font-default-vi);
            }
        </style>
        @break
    @case('zh')
        <style>
            :root {
                --font-default-override: var(--font-default-zh);
            }
        </style>
        @break
    @case('zh-tw')
        <style>
            :root {
                --font-default-override: var(--font-default-zh-tw);
            }
        </style>
        @break
    @case('th')
        <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600&display=swap&subset=thai" rel="stylesheet">
        <style>
            :root {
                --font-default-override: var(--font-default-th);
            }
        </style>
        @break
@endswitch

<link rel="stylesheet" media="all" href="{{ unmix('css/app.css') }}" data-turbolinks-track="reload">

<script>
    var currentLocale = {!! json_encode($currentLocale) !!};
    var fallbackLocale = {!! json_encode($fallbackLocale) !!};
    var experimentalHost = {!! json_encode(config('osu.urls.experimental_host')) !!}
</script>

<script src="{{ unmix('js/runtime.js') }}" data-turbolinks-track="reload"></script>
<script src="{{ unmix('js/vendor.js') }}" data-turbolinks-track="reload"></script>

@if(config('services.sentry.public_dsn') !== '')
    <script src="https://browser.sentry-cdn.com/5.1.0/bundle.min.js" crossorigin="anonymous"></script>
    <script>
        typeof Sentry !== 'undefined' && Sentry.init({
            debug: {!! json_encode(config('app.debug')) !!},
            dsn: {!! json_encode(config('services.sentry.public_dsn')) !!},
            ignoreErrors: [
                // Random plugins/extensions
                'top.GLOBALS',
                /class is a reserved identifier$/
            ],
            ignoreUrls: [
                // Chrome/Firefox extensions
                /extensions\//i,
                /^chrome:\/\//i,
                /^resource:\/\//i,
                // Errors caused by spyware/adware junk
                /^\/loaders\//i
            ],
            release: {!! json_encode(config('osu.git-sha')) !!},
            whitelistUrls: [/^{!! preg_quote($appUrl, '/') !!}\/.*\.js(?:\?.*)?$/],
        });
    </script>
@endif

<script src="{{ unmix("js/locales/{$currentLocale}.js") }}" data-turbolinks-track="reload"></script>
@if ($fallbackLocale !== $currentLocale)
    <script src="{{ unmix("js/locales/{$fallbackLocale}.js") }}" data-turbolinks-track="reload"></script>
@endif

<script src="{{ unmix('js/commons.js') }}" data-turbolinks-track="reload"></script>
<script src="{{ unmix('js/app.js') }}" data-turbolinks-track="reload"></script>

<script
    src="{{ unmix("js/moment-locales/{$currentLocaleMeta->moment()}.js") }}"
    data-turbolinks-track="reload"
></script>

@if (isset($atom))
    <link rel="alternate" type="application/atom+xml" title="{{ $atom['title'] }}" href="{{ $atom['url'] }}">
@endif

@if (isset($canonicalUrl))
    <link rel="canonical" href="{{ $canonicalUrl }}">
@endif

@if (isset($translatedPages))
    @foreach ($translatedPages as $l => $url)
        <link rel="alternate" hreflang="{{ $l }}" href="{{ $url }}" />
    @endforeach
@endif
