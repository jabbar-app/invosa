<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth"> {{-- scroll-smooth for navbar links, dark class removed for toggling --}}

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}"> {{-- CSRF Token for AJAX requests if needed --}}

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
    /* Apply font to html for better inheritance, or body if preferred */
    html {
      font-family: 'Plus Jakarta Sans', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
    }

    /* Custom Scrollbar Styles */
    ::-webkit-scrollbar {
      width: 8px;
      height: 8px;
      /* For horizontal scrollbars */
    }

    ::-webkit-scrollbar-track {
      background: transparent;
      /* Or a very light grey for light mode */
    }

    ::-webkit-scrollbar-thumb {
      background-color: rgba(156, 163, 175, 0.4);
      /* gray-400 with opacity */
      border-radius: 4px;
      border: 2px solid transparent;
      /* Creates padding around thumb */
      background-clip: padding-box;
    }

    ::-webkit-scrollbar-thumb:hover {
      background-color: rgba(107, 114, 128, 0.5);
      /* gray-500 with opacity */
    }

    .dark ::-webkit-scrollbar-thumb {
      background-color: rgba(75, 85, 99, 0.5);
      /* gray-600 with opacity */
    }

    .dark ::-webkit-scrollbar-thumb:hover {
      background-color: rgba(55, 65, 81, 0.6);
      /* gray-700 with opacity */
    }
  </style>

  {{-- Page-specific styles --}}
  @stack('styles')

  <script>
    // Auto-apply dark mode on page load based on system or saved preference
    // This script runs early to prevent FOUC (Flash Of Unstyled Content)
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)')
        .matches)) {
      document.documentElement.classList.add('dark');
    } else {
      document.documentElement.classList.remove('dark');
      // Explicitly set light theme in localStorage if it's the first visit and system is light
      // This helps the toggle button to correctly show the moon icon initially if system is light
      if (!('theme' in localStorage) && !window.matchMedia('(prefers-color-scheme: dark)').matches) {
        localStorage.setItem('theme', 'light');
      }
    }
  </script>
</head>

<body
  class="font-plus-jakarta-sans antialiased bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200 leading-normal tracking-tight">
  {{--
        - `font-plus-jakarta-sans` class applied to use the new font.
        - Tailwind's dark mode utility classes (e.g., dark:bg-gray-900) will now work based on the `dark` class on the <html> tag.
    --}}

  <div id="app-layout-content" class="min-h-screen flex flex-col">
    {{--
            Your navigation bar (containing the theme toggle buttons)
            would typically be included here or within the @yield('content')
            of a specific page like landing.blade.php.
            Example: @include('partials.navbar')
        --}}
    <main class="flex-grow">
      @yield('content')
    </main>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const desktopToggle = document.getElementById('theme-toggle');
      const desktopIcon = document.getElementById('theme-icon');
      const mobileToggle = document.getElementById('theme-toggle-mobile');
      const mobileIcon = document.getElementById('theme-icon-mobile');

      // Function to update icon states for both desktop and mobile
      function updateIcons(isDark) {
        if (desktopIcon) {
          desktopIcon.classList.remove(isDark ? 'fa-sun' : 'fa-moon');
          desktopIcon.classList.add(isDark ? 'fa-moon' : 'fa-sun');
        }
        if (mobileIcon) {
          mobileIcon.classList.remove(isDark ? 'fa-sun' : 'fa-moon');
          mobileIcon.classList.add(isDark ? 'fa-moon' : 'fa-sun');
        }
      }

      // Function to apply the theme and update icons
      function applyCurrentTheme() {
        if (localStorage.theme === 'dark') {
          document.documentElement.classList.add('dark');
          updateIcons(true);
        } else {
          // Default to light if no specific theme or if theme is 'light'
          document.documentElement.classList.remove('dark');
          updateIcons(false);
        }
      }

      // Function to handle the toggle action
      function handleThemeToggle() {
        const isCurrentlyDark = document.documentElement.classList.contains('dark');
        if (isCurrentlyDark) {
          localStorage.setItem('theme', 'light');
        } else {
          localStorage.setItem('theme', 'dark');
        }
        applyCurrentTheme();
      }

      // Set initial theme and icons on page load
      applyCurrentTheme();

      // Add event listeners to toggle buttons
      if (desktopToggle) {
        desktopToggle.addEventListener('click', handleThemeToggle);
      } else {
        // console.warn("Desktop theme toggle button (ID: theme-toggle) not found.");
      }

      if (mobileToggle) {
        mobileToggle.addEventListener('click', handleThemeToggle);
      } else {
        // console.warn("Mobile theme toggle button (ID: theme-toggle-mobile) not found.");
      }
    });
  </script>

  {{-- Page-specific scripts --}}
  @stack('scripts')
</body>

</html>
