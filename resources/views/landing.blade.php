@extends('layouts.app')

@section('title', 'Jabbar Ali Panggabean - Invosa Test Solutions')

@push('styles')
  <style>
    .hero-gradient-bg {
      background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #ec4899 100%);
    }

    .dark .hero-gradient-bg {
      background: linear-gradient(135deg, #3730a3 0%, #5b21b6 50%, #be185d 100%);
    }

    /* Animations */
    .fade-in-up {
      opacity: 0;
      transform: translateY(20px);
      animation: fadeInUp 0.7s ease-out forwards;
    }

    .fade-in {
      opacity: 0;
      animation: fadeIn 0.9s ease-out forwards;
    }

    @keyframes fadeInUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes fadeIn {
      to {
        opacity: 1;
      }
    }

    .feature-card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .feature-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
    }

    .dark .feature-card:hover {
      box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
    }

    .project-card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .project-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.07);
    }

    .dark .project-card:hover {
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.25);
    }

    .relative-z-10 {
      position: relative;
      z-index: 10;
    }
  </style>
@endpush

@section('content')
  {{-- Simple Navbar --}}
  @include('layouts.navbar')

  {{-- Hero Section --}}
  <header class="bg-gray-900 text-white pt-32 pb-20 md:pt-48 md:pb-32 flex items-center justify-center min-h-screen">
    <div class="text-center max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 relative-z-10">
      <div class="mb-8 fade-in" style="animation-delay: 0.1s;">
        <img src="{{ asset('assets/images/jab-profpic.png') }}" alt="Jabbar"
          class="w-28 h-28 mx-auto rounded-full flex items-center justify-center">
      </div>
      <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold mb-6 leading-tight fade-in-up"
        style="animation-delay: 0.3s;">
        Welcome!
      </h1>
      <p class="text-lg sm:text-xl text-indigo-100 dark:text-indigo-200 mb-2 fade-in-up" style="animation-delay: 0.4s;">
        Invosa Systems Online Test's solutions by
      </p>
      <p class="text-lg sm:text-xl font-semibold mb-10 text-indigo-100 fade-in-up" style="animation-delay: 0.5s;">
        Jabbar Ali Panggabean
      </p>
      <div class="fade-in-up" style="animation-delay: 0.7s;">
        <a href="{{ route('problems.index') }}"
          class="inline-block bg-white dark:bg-gray-100 text-indigo-700 dark:text-indigo-800 font-bold text-lg px-12 py-4 rounded-lg shadow-xl hover:bg-opacity-90 dark:hover:bg-opacity-90 transform hover:scale-105 transition-transform duration-300 ease-in-out">
          Explore Solutions
        </a>
      </div>
    </div>
  </header>

  {{-- Meet the Developer Section --}}
  <section id="developer" class="py-16 sm:py-24 bg-white dark:bg-gray-800">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-12 fade-in">
        <h2 class="text-3xl font-bold text-gray-800 dark:text-white">Meet the Developer</h2>
      </div>
      <div class="grid md:grid-cols-2 gap-10 items-center">
        <div class="fade-in-up" style="animation-delay: 0.2s;">
          {{-- Using a more relevant placeholder --}}
          <img src="https://placehold.co/600x400/7c3aed/white?text=Jabbar+A.+Panggabean&font=lora"
            alt="Jabbar Ali Panggabean" class="rounded-lg shadow-xl">
        </div>
        <div class="fade-in-up" style="animation-delay: 0.4s;">
          <h3 class="text-2xl font-semibold text-gray-800 dark:text-white mb-3">Jabbar Ali Panggabean</h3>
          <p class="text-indigo-600 dark:text-indigo-400 font-medium mb-4">Senior Software Engineer | Full-Stack
            Specialist</p>
          <p class="text-gray-600 dark:text-gray-300 mb-4">
            With over <strong>7 years of experience</strong> in full-stack product development, I specialize in building
            scalable, production-grade applications. My expertise spans modern web architectures, including
            <strong>TypeScript, React.js, Node.js, and Laravel</strong>.
          </p>
          <p class="text-gray-600 dark:text-gray-300 mb-4">
            I am passionate about clean code principles, performance optimization, CI/CD best practices, and leveraging
            technologies like Docker, GCP, and AWS to deliver impactful products.
          </p>
          <p class="text-gray-600 dark:text-gray-300">
            These solutions for the Invosa Systems Online Test reflect my commitment to quality, thorough problem-solving,
            and practical application of technology.
          </p>
          {{-- Optional: Link to portfolio from resume --}}
          <div class="mt-6">
            <a href="http://link.jabbar.id/" target="_blank" rel="noopener noreferrer"
              class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-200 font-semibold group">
              View My Portfolio
              <span
                class="inline-block transition-transform group-hover:translate-x-1 motion-reduce:transform-none">&rarr;</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- Demonstrated Skills Section --}}
  <section id="skills-showcase" class="py-16 sm:py-24 bg-gray-50 dark:bg-gray-800/50">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16 fade-in">
        <h2 class="text-3xl font-bold text-gray-800 dark:text-white">Demonstrated Skills Through Solutions</h2>
        <p class="mt-3 text-lg text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
          The problems solved in this test are categorized to showcase a range of technical abilities, from foundational
          logic to advanced algorithmic thinking using PHP and Laravel.
        </p>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @php
          $categories = [
              [
                  'name' => 'Basic Level',
                  'description' =>
                      'Mastery of fundamental programming constructs, data handling, and algorithmic thinking through clear and efficient PHP/Laravel solutions.',
                  'icon' =>
                      '<svg class="h-12 w-12 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>',
                  'delay' => '0.1s',
              ],
              [
                  'name' => 'Intermediate Level',
                  'description' =>
                      'Tackling challenges involving algorithms (e.g., Roman numerals, shortest path), data manipulation, and numerical methods, showcasing analytical skills.',
                  'icon' =>
                      '<svg class="h-12 w-12 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/></svg>',
                  'delay' => '0.3s',
              ],
              [
                  'name' => 'Advanced Level',
                  'description' =>
                      'Addressing sophisticated problems requiring optimization, simulation, and strategic assignment logic, reflecting an ability to design and implement complex systems.',
                  'icon' =>
                      '<svg class="h-12 w-12 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>',
                  'delay' => '0.5s',
              ],
          ];
        @endphp
        @foreach ($categories as $category)
          <div class="feature-card bg-white dark:bg-gray-700 p-8 rounded-xl shadow-lg text-center fade-in-up"
            style="animation-delay: {{ $category['delay'] }};">
            <div
              class="flex items-center justify-center h-20 w-20 rounded-full bg-gray-100 dark:bg-gray-600 mx-auto mb-6">
              {!! $category['icon'] !!}
            </div>
            <h3 class="text-2xl font-semibold text-gray-800 dark:text-white mb-3">{{ $category['name'] }}</h3>
            <p class="text-gray-600 dark:text-gray-300 text-sm">{{ $category['description'] }}</p>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  {{-- Project Highlights Section --}}
  <section id="projects" class="py-16 sm:py-24 bg-white dark:bg-gray-800">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16 fade-in">
        <h2 class="text-3xl font-bold text-gray-800 dark:text-white">Highlighted Professional Experience</h2>
        <p class="mt-3 text-lg text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
          Beyond these test solutions, I bring a proven track record of developing impactful, real-world applications.
          Here are a couple of examples:
        </p>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @php
          $projects = [
              [
                  'name' => 'Japan Smart Trip Planner',
                  'description' =>
                      'A full-featured trip planner for travelers visiting Japan, featuring a personalized itinerary builder with drag-and-drop UX, smart destination filtering, and city-based grouping.',
                  'stack' => 'TypeScript, Next.js, Tailwind, Fastify, Prisma, GCP',
                  'link' => 'http://japan-trip.jabbar.id/',
                  'icon' =>
                      '<svg class="h-10 w-10 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L21 12l-5.447 2.724A1 1 0 0115 13.618v-3.236a1 1 0 00-1.447-.894L9 12v8z" /></svg>',
                  'delay' => '0.2s',
              ],
              [
                  'name' => 'Japanese NLP Parser & Learning Platform',
                  'description' =>
                      'An AI-powered web application for Japanese learners to parse sentences, review vocabulary with flashcards, and take JLPT-style quizzes. Re-architected into a scalable microservices platform.',
                  'stack' => 'Laravel, Vue.js, Python, Lumen, GCP, Terraform, Docker, Kubernetes',
                  'link' => 'http://japanese-nlp.jabbar.id/',
                  'icon' =>
                      '<svg class="h-10 w-10 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v11.494m0 0a8.485 8.485 0 0011.925 0M12 17.747a8.485 8.485 0 01-11.925 0M12 17.747l-.001-.001M12 6.253l-.001-.001M6.253 12l11.494 0" /></svg>',
                  'delay' => '0.4s',
              ],
          ];
        @endphp
        @foreach ($projects as $project)
          <div class="project-card bg-gray-50 dark:bg-gray-700/50 p-6 rounded-lg shadow-lg flex flex-col fade-in-up"
            style="animation-delay: {{ $project['delay'] }};">
            <div class="flex items-center mb-4">
              <div class="flex-shrink-0 mr-4">
                {!! $project['icon'] !!}
              </div>
              <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white">{{ $project['name'] }}</h3>
              </div>
            </div>
            <p class="text-gray-600 dark:text-gray-300 text-sm mb-3 flex-grow">{{ $project['description'] }}</p>
            <p class="text-xs text-gray-500 dark:text-gray-400 mb-3"><strong>Stack:</strong> {{ $project['stack'] }}</p>
            @if ($project['link'])
              <a href="{{ $project['link'] }}" target="_blank" rel="noopener noreferrer"
                class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-200 font-semibold self-start group">
                View Project
                <span
                  class="inline-block transition-transform group-hover:translate-x-1 motion-reduce:transform-none">&rarr;</span>
              </a>
            @endif
          </div>
        @endforeach
      </div>
    </div>
  </section>

  {{-- Technologies Used Section --}}
  <section class="py-16 sm:py-24 bg-white dark:bg-gray-800">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-12 fade-in">
        <h2 class="text-3xl font-bold text-gray-800 dark:text-white">Core Technologies Leveraged</h2>
        <p class="mt-3 text-lg text-gray-600 dark:text-gray-300">
          These solutions are built using a modern and robust technology stack.
        </p>
      </div>
      <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-8 text-center">
        @php

          $techs = [
              ['name' => 'PHP', 'icon' => 'fab fa-php', 'color' => 'text-indigo-500'],
              ['name' => 'Laravel', 'icon' => 'fab fa-laravel', 'color' => 'text-red-500'],
              ['name' => 'JavaScript', 'icon' => 'fab fa-js-square', 'color' => 'text-yellow-400'],
              ['name' => 'TypeScript', 'icon' => 'fas fa-code', 'color' => 'text-blue-500'],
              ['name' => 'React.js', 'icon' => 'fab fa-react', 'color' => 'text-sky-500'],
              ['name' => 'Tailwind CSS', 'icon' => 'fab fa-css3-alt', 'color' => 'text-cyan-500'],
              ['name' => 'Vite', 'icon' => 'fas fa-bolt', 'color' => 'text-yellow-500'],
              ['name' => 'Git', 'icon' => 'fab fa-git-alt', 'color' => 'text-orange-500'],
          ];
        @endphp
        @foreach ($techs as $index => $tech)
          <div class="fade-in-up p-4" style="animation-delay: {{ $index * 0.05 + 0.1 }}s;">
            <i class="{{ $tech['icon'] }} text-5xl {{ $tech['color'] }} mb-3"></i>
            <h3 class="text-md font-semibold text-gray-800 dark:text-white">{{ $tech['name'] }}</h3>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  {{-- Final Call to Action Section --}}
  <section class="py-16 sm:py-24 bg-gray-900 text-white">
    <div class="max-w-3xl mx-auto text-center px-4 sm:px-6 lg:px-8 relative-z-10">
      <h2 class="text-3xl sm:text-4xl font-bold mb-6 fade-in">Explore the Solutions</h2>
      <p class="text-lg sm:text-xl text-indigo-100 dark:text-indigo-200 mb-10 fade-in" style="animation-delay: 0.2s;">
        Dive into the detailed implementations for each problem from the Invosa Systems Online Test.
      </p>
      <div class="fade-in" style="animation-delay: 0.4s;">
        <a href="{{ route('problems.index') }}"
          class="inline-block bg-white dark:bg-gray-100 text-white dark:text-gray-900 font-bold text-lg px-12 py-4 rounded-lg shadow-xl hover:bg-opacity-90 dark:hover:bg-opacity-90 transform hover:scale-105 transition-transform duration-300 ease-in-out">
          View All Problem Solutions
        </a>
      </div>
    </div>
  </section>

  {{-- Footer --}}
  <footer class="bg-black text-gray-400 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <div class="flex justify-center items-center mb-4">
        <img src="{{ asset('assets/images/jab-logo.svg') }}" alt="Jabbar" class="h-10">
      </div>
      <p class="text-sm">Solutions Showcase for Invosa Systems Online Test.</p>
      <p class="mt-1 text-xs">Contact: box@jabbar.id | Portfolio: <a href="http://link.jabbar.id/" target="_blank"
          rel="noopener noreferrer" class="hover:text-indigo-400">link.jabbar.id</a></p>
      <p class="mt-6 text-xs">&copy; {{ date('Y') }} Jabbar Ali Panggabean. All Rights Reserved.</p>
    </div>
  </footer>

@endsection

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function() {

      const mobileMenuButton = document.getElementById('mobile-menu-button');
      const mobileMenu = document.getElementById('mobile-menu');
      const iconOpen = document.getElementById('icon-open');
      const iconClose = document.getElementById('icon-close');

      if (mobileMenuButton && mobileMenu && iconOpen && iconClose) {
        mobileMenuButton.addEventListener('click', () => {
          const isExpanded = mobileMenuButton.getAttribute('aria-expanded') === 'true' || false;
          mobileMenuButton.setAttribute('aria-expanded', !isExpanded);
          mobileMenu.classList.toggle('hidden');
          iconOpen.classList.toggle('hidden');
          iconClose.classList.toggle('hidden');
        });
      }


      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
          e.preventDefault();
          const targetId = this.getAttribute('href');
          const targetElement = document.querySelector(targetId);
          if (targetElement) {
            const offsetTop = targetElement.offsetTop - 70;
            window.scrollTo({
              top: offsetTop,
              behavior: 'smooth'
            });

            if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
              mobileMenuButton.click();
            }
          }
        });
      });


      const animatedElements = document.querySelectorAll('.fade-in-up, .fade-in');
      if ("IntersectionObserver" in window) {
        let observer = new IntersectionObserver((entries, observerInstance) => {
          entries.forEach(entry => {
            if (entry.isIntersecting) {
              entry.target.style.animationPlayState = 'running';
              observerInstance.unobserve(entry.target);
            }
          });
        }, {
          threshold: 0.1
        });

        animatedElements.forEach(el => {

          el.style.animationPlayState = 'paused';
          observer.observe(el);
        });
      } else {
        animatedElements.forEach(el => {
          el.style.opacity = '1';
          el.style.transform = 'translateY(0)';
        });
      }
    });
  </script>
@endpush
