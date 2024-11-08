<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <title>{{ config('app.name','Laravel')}}</title>

    @vite('resources/css/app.css')

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body style="font-family: 'figtree',sans-serif;">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7-xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

    </div>
</body>

</html>
