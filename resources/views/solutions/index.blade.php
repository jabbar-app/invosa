@extends('layouts.app') {{-- Assuming you have a layout file named app.blade.php in resources/views/layouts/ --}}

@section('title', 'Problem Solutions Index') {{-- Sets the title for the page --}}

@section('content')
  <div
    class="flex flex-col items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white dark:bg-gray-800 p-10 rounded-xl shadow-2xl">
      {{-- Page Header --}}
      <div>
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900 dark:text-gray-100">
          Invosa Test Problems
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600 dark:text-gray-400">
          Select a problem to view the solution.
        </p>
      </div>

      {{-- Navigation Links for Problems --}}
      <nav class="mt-8 space-y-6">
        {{-- Basic Level Problems --}}
        <div>
          <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Basic Level</h3>
          <ul class="mt-2 space-y-2">
            <li>
              <a href="{{ route('bank.interest.show') }}"
                class="block w-full text-left px-4 py-3 rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 dark:text-indigo-300 dark:bg-indigo-700 dark:hover:bg-indigo-600 transition duration-150 ease-in-out">
                1.1 Bank Interest (Loop)
              </a>
            </li>
            <li>
              <a href="{{ route('bank.interest-no-loop.show') }}"
                class="block w-full text-left px-4 py-3 rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 dark:text-indigo-300 dark:bg-indigo-700 dark:hover:bg-indigo-600 transition duration-150 ease-in-out">
                1.2 Bank Interest (No Loop)
              </a>
            </li>
            <li>
              <a href="{{ route('discount.calculator.show') }}"
                class="block w-full text-left px-4 py-3 rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 dark:text-indigo-300 dark:bg-indigo-700 dark:hover:bg-indigo-600 transition duration-150 ease-in-out">
                2. Multi-level Discount
              </a>
            </li>
            <li>
              <a href="{{ route('encoding.show') }}"
                class="block w-full text-left px-4 py-3 rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 dark:text-indigo-300 dark:bg-indigo-700 dark:hover:bg-indigo-600 transition duration-150 ease-in-out">
                3. ASCII Encoder
              </a>
            </li>
          </ul>
        </div>

        {{-- Intermediate Level Problems --}}
        <div class="mt-6">
          <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Intermediate Level</h3>
          <ul class="mt-2 space-y-2">
            <li>
              <a href="{{ route('roman.converter.show') }}"
                class="block w-full text-left px-4 py-3 rounded-md text-teal-700 bg-teal-100 hover:bg-teal-200 dark:text-teal-300 dark:bg-teal-700 dark:hover:bg-teal-600 transition duration-150 ease-in-out">
                4. Roman to Arabic Converter
              </a>
            </li>
            <li>
              <a href="{{ route('shortestpath.form.show') }}"
                class="block w-full text-left px-4 py-3 rounded-md text-teal-700 bg-teal-100 hover:bg-teal-200 dark:text-teal-300 dark:bg-teal-700 dark:hover:bg-teal-600 transition duration-150 ease-in-out">
                5. Shortest Path Problem
              </a>
            </li>
            <li>
              <a href="{{ route('sincurve.calculator.show') }}"
                class="block w-full text-left px-4 py-3 rounded-md text-teal-700 bg-teal-100 hover:bg-teal-200 dark:text-teal-300 dark:bg-teal-700 dark:hover:bg-teal-600 transition duration-150 ease-in-out">
                6. Sin Curve Area
              </a>
            </li>
          </ul>
        </div>

        {{-- Advanced Level Problems --}}
        <div class="mt-6">
          <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Advanced Level</h3>
          <ul class="mt-2 space-y-2">
            <li>
              <a href="{{ route('marble.prediction.show') }}"
                class="block w-full text-left px-4 py-3 rounded-md text-purple-700 bg-purple-100 hover:bg-purple-200 dark:text-purple-300 dark:bg-purple-700 dark:hover:bg-purple-600 transition duration-150 ease-in-out">
                7. Marble Prediction
              </a>
            </li>
            <li>
              <a href="{{ route('lift.control.show') }}"
                class="block w-full text-left px-4 py-3 rounded-md text-purple-700 bg-purple-100 hover:bg-purple-200 dark:text-purple-300 dark:bg-purple-700 dark:hover:bg-purple-600 transition duration-150 ease-in-out">
                8. Lift Control
              </a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </div>
@endsection
