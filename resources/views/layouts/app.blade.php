<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', config('app.name', 'Invosa')) - Solutions by Jabbar Ali Panggabean</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    xintegrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
    rel="stylesheet">

  <style>
    html {
      font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
    }

    body {
      @apply bg-white text-gray-800 dark:bg-gray-900 dark:text-gray-100;
    }

    ::-webkit-scrollbar {
      width: 8px;
    }

    ::-webkit-scrollbar-thumb {
      background-color: rgba(100, 116, 139, 0.5);
      border-radius: 4px;
    }

    .dark ::-webkit-scrollbar-thumb {
      background-color: rgba(148, 163, 184, 0.5);
    }
  </style>

  @stack('styles')

  <script>
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)')
        .matches)) {
      document.documentElement.classList.add('dark');
    } else {
      document.documentElement.classList.remove('dark');
    }
  </script>

</head>

<body
  class="font-figtree antialiased bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 leading-normal tracking-tight">

  <div id="app-layout-content" class="min-h-screen flex flex-col">
    <main class="flex-grow">
      @yield('content')
    </main>
  </div>

  @stack('scripts')
</body>

</html>
