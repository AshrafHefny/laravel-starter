<!-- Required meta tags -->
<meta charset="utf-8">

<base href="{{app()->make("url")->to('/')}}/" />
<title>{{ appName() }} :: {{@$page_title}}</title>
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta http-equiv="Content-Language" content="en" />
<meta name="msapplication-TileColor" content="#2d89ef">
<meta name="theme-color" content="#4188c9">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="mobile-web-app-capable" content="yes">
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<link rel="icon" href="{{app()->make("url")->to('/')}}/favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" type="image/x-icon" href="{{app()->make("url")->to('/')}}/favicon.ico" />
<meta name="csrf-token" content="{{ csrf_token() }}">
