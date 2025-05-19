<nav class="bg-white dark:bg-gray-800 shadow-md fixed w-full z-20 top-0">
  <div class="max-w-7xl mx-auto py-1 px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">
      <div class="flex items-center">
        <a href="{{ route('landing') }}" class="flex-shrink-0 flex items-center">
          <img src="{{ asset('assets/images/jab-logo.svg') }}" alt="Jabbar" style="height: 36px;">
        </a>
      </div>
      <div class="hidden md:block">
        <div class="ml-10 flex items-baseline space-x-4">
          <a href="#developer"
            class="text-gray-600 dark:text-gray-300 hover:text-indigo-500 dark:hover:text-indigo-400 px-3 py-2 rounded-md text-sm font-medium">Developer</a>
          <a href="#skills-showcase"
            class="text-gray-600 dark:text-gray-300 hover:text-indigo-500 dark:hover:text-indigo-400 px-3 py-2 rounded-md text-sm font-medium">Tests</a>
          <a href="#projects"
            class="text-gray-600 dark:text-gray-300 hover:text-indigo-500 dark:hover:text-indigo-400 px-3 py-2 rounded-md text-sm font-medium">Projects</a>
          <a href="{{ route('problems.index') }}"
            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium shadow-md transition-colors duration-150">
            View Test Solutions
          </a>
        </div>
      </div>
      <div class="ml-4">
        <button id="theme-toggle"
          class="p-2 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-100 hover:bg-gray-200 dark:hover:bg-gray-600 transition"
          title="Toggle Dark Mode">
          <i id="theme-icon" class="fas fa-moon"></i>
        </button>
      </div>
      <div class="-mr-2 flex md:hidden">
        <button type="button" id="mobile-menu-button"
          class="bg-white dark:bg-gray-800 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-indigo-500 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
          aria-controls="mobile-menu" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="block h-6 w-6" id="icon-open" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          <svg class="hidden h-6 w-6" id="icon-close" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </div>
  {{-- Mobile Menu --}}
  <div class="md:hidden hidden" id="mobile-menu">
    <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
      <a href="#developer"
        class="text-gray-600 dark:text-gray-300 hover:text-indigo-500 dark:hover:text-indigo-400 block px-3 py-2 rounded-md text-base font-medium">Developer</a>
      <a href="#skills-showcase"
        class="text-gray-600 dark:text-gray-300 hover:text-indigo-500 dark:hover:text-indigo-400 block px-3 py-2 rounded-md text-base font-medium">Tests</a>
      <a href="#projects"
        class="text-gray-600 dark:text-gray-300 hover:text-indigo-500 dark:hover:text-indigo-400 block px-3 py-2 rounded-md text-base font-medium">Projects</a>
    </div>
    <div class="px-3 py-2 text-center">
      <button id="theme-toggle-mobile"
        class="p-2 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-100 hover:bg-gray-200 dark:hover:bg-gray-600 transition"
        title="Toggle Dark Mode">
        <i id="theme-icon-mobile" class="fas fa-moon"></i>
      </button>
    </div>
    <div class="pt-2 pb-3 border-t border-gray-200 dark:border-gray-700">
      <div class="px-2">
        <a href="{{ route('problems.index') }}"
          class="block w-full text-center bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-base font-medium shadow-md transition-colors duration-150">
          View Test Solutions
        </a>
      </div>
    </div>
  </div>
</nav>
