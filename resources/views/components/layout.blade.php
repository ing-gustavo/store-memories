<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-W1G6ES3JQ7"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-W1G6ES3JQ7');
        </script>
        <script type="text/javascript">
            (function(c,l,a,r,i,t,y){
                c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
                t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
                y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
            })(window, document, "clarity", "script", "jxvggf2z3t");
        </script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <meta name="robots" content="index,follow" />
        {!! SEO::generate(true) !!}
    </head>

    <body class="font-sans antialiased">

        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">

            <header class="bg-white border-b shadow-md sticky top-0 z-50" x-data="{open:false}">

                <nav class="mx-auto flex w-full items-center justify-between " aria-label="Global">
                    <a href="/" class="text-3xl font-bold px-6 text-blue-600">Enviamelos</a>
                    <a href="/uploader" class="inline-flex  bg-blue-600 px-4 sm:px-10 py-6 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">Empezar ahora</a>
                </nav>

            </header>

            <!-- Page Content -->
            <main class="relative">
                {{ $slot }}
            </main>

        </div>

    </body>
</html>
