<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1,minimum-scale=1">
<meta name="apple-mobile-web-app-capable" content="yes">
{{--
<link rel="icon" type="image/x-icon" href="{{ Theme::asset('pub_theme::icons/fav.png') }}" />
--}}
<meta name="author" content="{{ Theme::metatag('author') }}">
<link rel="author" href="https://plus.google.com/b/104035968244380319088/?hl=it" />
<link rel="icon" href="{{ Theme::asset('pub_theme::icons/favicon.ico') }}" />
{{--
<link rel="apple-touch-icon" sizes="57x57" href="{{ Theme::asset('pub_theme::icons/apple-touch-icon-57x57.png') }}">
<link rel="apple-touch-icon" sizes="60x60" href="{{ Theme::asset('pub_theme::icons/apple-touch-icon-60x60.png') }}">
<link rel="apple-touch-icon" sizes="72x72" href="{{ Theme::asset('pub_theme::icons/apple-touch-icon-72x72.png') }}">
<link rel="apple-touch-icon" sizes="76x76" href="{{ Theme::asset('pub_theme::icons/apple-touch-icon-76x76.png') }}">
<link rel="apple-touch-icon" sizes="114x114" href="{{ Theme::asset('pub_theme::icons/apple-touch-icon-114x114.png') }}">
<link rel="apple-touch-icon" sizes="120x120" href="{{ Theme::asset('pub_theme::icons/apple-touch-icon-120x120.png') }}">
<link rel="apple-touch-icon" sizes="144x144" href="{{ Theme::asset('pub_theme::icons/apple-touch-icon-144x144.png') }}">
<link rel="apple-touch-icon" sizes="152x152" href="{{ Theme::asset('pub_theme::icons/apple-touch-icon-152x152.png') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ Theme::asset('pub_theme::icons/apple-touch-icon-180x180.png') }}">
<link rel="icon" type="image/png" href="{{ Theme::asset('pub_theme::icons/favicon-32x32.png') }}" sizes="32x32">
--}}
{{--
<link rel="icon" type="image/png" href="{{ Theme::asset('pub_theme::icons/favicon-96x96.png') }}" sizes="96x96">
<link rel="icon" type="image/png" href="{{ Theme::asset('pub_theme::icons/favicon-194x194.png') }}" sizes="194x194">
<link rel="icon" type="image/png" href="{{ Theme::asset('pub_theme::icons/android-chrome-192x192.png') }}" sizes="192x192">
--}}
{{--
<link rel="icon" type="image/png" href="{{ Theme::asset('pub_theme::icons/favicon-16x16.png') }}" sizes="16x16">
--}}
{{--    DA RIABILITARE QUANDO AVRA' SENSO
<link rel="manifest" href="{{ asset('/manifest.json') }}">
--}}
<meta name="application-name" content="{{ Theme::metatag('sitename') }}">
<meta name="msapplication-TileColor" content="#2d89ef">
<meta name="msapplication-TileImage" content="/mstile-144x144.png">
<meta name="theme-color" content="#ffffff">

<title>{{ Theme::metatag('title') }}</title>
<meta property="og:title" 	content="{{ Theme::metatag('title') }}" />
<meta name="twitter:title" 	content="{{ Theme::metatag('title') }}" />
{{--
    <meta itemprop="og:headline" content="{{ Theme::metatag('subtitle') }}" />
--}}
<meta property="fb:pages" content="test sitenamecom"/>
{{-- canonical si usa se ci sono 2 pagine con indirizzo diverso che vanno allo stesso contenuto.
<link rel="canonical" 		href="{{ Theme::url(['locale'=>app()->getLocale()]) }}" />
<meta property="og:url"  content="{{ Theme::url(['locale'=>app()->getLocale()]) }}" />
<meta name="twitter:site"  content="{{ Theme::url(['locale'=>app()->getLocale()]) }}" />
--}}
<link rel="canonical" 		href="{{ Theme::metatag('url') }}" />
<meta name="twitter:site" content="{{ Theme::metatag('url') }}">
<meta property="og:url"  content="{{ Theme::metatag('url') }}" />
{{--
<meta property="fb:app_id" content="1415518648515278"/>
<meta property="og:image" 	content="{{ Theme::metatag('image') }}" />
--}}
<meta property="twitter:image" 	content="{{ Theme::metatag('image') }}" />
<meta property="og:image" 	content="{{ Theme::metatag('image') }}" />
<meta property="og:image:width" content="{{ Theme::metatag('image_width') }}" />
<meta property="og:image:height" content="{{ Theme::metatag('image_height') }}" />

<meta name="description" 			content="{{ Theme::metatag('meta_description') }}"/>
<meta property="og:description" 	content="{{ Theme::metatag('meta_description') }}" />
<meta name="twitter:description" 	content="{{ Theme::metatag('meta_description') }}" />

<meta name="keywords" 			content="{{ Theme::metatag('meta_keywords') }}"/>

<meta name="twitter:card" content="summary" />

{{--

<meta name="twitter:site" content="@nytimesbits" />
<meta name="twitter:creator" content="@nickbilton" />

<meta name=”geo.region” content=”IT-VI” />
<meta name=”geo.placename” content=”Vicenza” />
<meta name=”geo.position” content=”45.547761;11.545387″ />
<meta name=”ICBM” content=”45.547761, 11.545387″ />

 --}}
<meta property="og:locale" content="{{ Theme::metatag('locale') }}" />  {{--  en_US --}}
<meta property="og:type" content="{{ Theme::metatag('type') }}" />{{-- article --}}
<meta property="og:site_name" content="{{ Theme::metatag('sitename') }}" />
<meta property="article:section" content="{{ Theme::metatag('category') }}" />
<meta property="article:published_time" 	content="{{ Theme::metatag('published_at') }}" />{{-- 2016-03-18T19:14:32+02:00 --}}
<meta property="article:modified_time" 		content="{{ Theme::metatag('updated_at') }}" />{{-- 2016-03-18T19:14:32+02:00 --}}
<meta property="og:updated_time" 			content="{{ Theme::metatag('updated_at') }}" />{{-- 2016-03-18T19:14:32+02:00 --}}
<meta name="twitter:card" 		content="summary_large_image" />
@foreach(Theme::metatag('tags') as $tag)
<meta property="article:tag" content="{{ $tag }}" />
@endforeach

<meta name="msvalidate.01" content="AB2A8D77734F695DBC2CACB559A24130" />
{{--
@foreach(config('laravellocalization.supportedLocales') as $k=>$loc)
	<link rel="alternate" href="{{ Theme::url(['locale'=>$k]) }}" hreflang="{{ strtolower(str_replace('_','-',$loc['regional'])) }}" />
@endforeach
--}}

<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="dns-prefetch preconnect" href="https://www.googletagservices.com">
<link rel="dns-prefetch preconnect" href="https://securepubads.g.doubleclick.net">
<link rel="dns-prefetch preconnect" href="https://tpc.googlesyndication.com">
<link rel="dns-prefetch" href="https://partner.googleadservices.com">
