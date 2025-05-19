@extends('layouts.app')

@section('title', 'Sin Curve Area Calculator')

@section('content')
  <div
    class="flex flex-col items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-lg w-full space-y-8 bg-white dark:bg-gray-800 p-10 rounded-xl shadow-2xl">
      <div>
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900 dark:text-gray-100">
          Area Under Sin(x) Curve
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600 dark:text-gray-400">
          Calculates the area 'y' of sin(x) from angle 'a' to 'b' (0-360 degrees).
        </p>
        <p class="mt-1 text-center text-xs text-gray-500 dark:text-gray-300">
          Uses numerical integration (Trapezoidal Rule). Results are scaled by 180/&pi; to match PDF examples.
        </p>
      </div>

      @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-md mb-6" role="alert">
          <p class="font-bold">Please correct the errors below:</p>
          <ul class="mt-2 list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form class="mt-8 space-y-6" action="{{ route('sincurve.calculator.process') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label for="angle_a" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Start Angle 'a'
              (degrees):</label>
            <input id="angle_a" name="angle_a" type="number" step="any" min="0" max="360" required
              class="mt-1 appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 placeholder-gray-500 dark:placeholder-gray-400 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              placeholder="e.g., 0" value="{{ old('angle_a', $input_a ?? '0') }}">
          </div>
          <div>
            <label for="angle_b" class="block text-sm font-medium text-gray-700 dark:text-gray-300">End Angle 'b'
              (degrees):</label>
            <input id="angle_b" name="angle_b" type="number" step="any" min="0" max="360" required
              class="mt-1 appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 placeholder-gray-500 dark:placeholder-gray-400 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              placeholder="e.g., 90" value="{{ old('angle_b', $input_b ?? '90') }}">
          </div>
        </div>
        <div>
          <label for="segments" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Number of Segments (for
            precision):</label>
          <input id="segments" name="segments" type="number" min="1" max="100000" required
            class="mt-1 appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 placeholder-gray-500 dark:placeholder-gray-400 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            placeholder="e.g., 1000" value="{{ old('segments', $input_segments ?? '1000') }}">
          <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">More segments = higher precision, but slower
            calculation.</p>
        </div>

        <div>
          <button type="submit"
            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
            Calculate Area
          </button>
        </div>
      </form>

      @if (isset($calculatedArea))
        <div class="mt-8 p-6 bg-green-50 dark:bg-green-800 rounded-lg shadow">
          <h3 class="text-lg font-medium leading-6 text-green-900 dark:text-green-100">Calculation Result</h3>
          <div class="mt-3 space-y-1">
            <p class="text-sm text-green-800 dark:text-green-200">
              For a = <span class="font-semibold">{{ $input_a ?? 'N/A' }}&deg;</span>,
              b = <span class="font-semibold">{{ $input_b ?? 'N/A' }}&deg;</span>,
              Segments = <span class="font-semibold">{{ $input_segments ?? 'N/A' }}</span>
            </p>
            <p class="text-xl font-bold text-green-700 dark:text-green-50">
              Calculated Area (y): {{ $calculatedArea }}
            </p>
            <p class="text-xs text-gray-600 dark:text-gray-300">
              (Analytical scaled result for reference: {{ $analyticalArea }})
            </p>
          </div>
        </div>
      @endif

      <div class="mt-10">
        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Reference Table:</h3>
        <div class="overflow-x-auto mt-2">
          <table class="min-w-full text-sm text-left text-gray-500 dark:text-gray-400 rounded-lg shadow">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
              <tr>
                <th scope="col" class="px-6 py-3">a (&deg;)</th>
                <th scope="col" class="px-6 py-3">b (&deg;)</th>
                <th scope="col" class="px-6 py-3">y (Area)</th>
              </tr>
            </thead>
            <tbody>
              <tr class="bg-white dark:bg-gray-800 border-b dark:border-gray-700">
                <td class="px-6 py-2">0</td>
                <td class="px-6 py-2">90</td>
                <td class="px-6 py-2">57.3</td>
              </tr>
              <tr class="bg-gray-50 dark:bg-gray-750 border-b dark:border-gray-700">
                <td class="px-6 py-2">0</td>
                <td class="px-6 py-2">180</td>
                <td class="px-6 py-2">114.6</td>
              </tr>
              <tr class="bg-white dark:bg-gray-800 border-b dark:border-gray-700">
                <td class="px-6 py-2">0</td>
                <td class="px-6 py-2">360</td>
                <td class="px-6 py-2">0.0</td>
              </tr>
              <tr class="bg-gray-50 dark:bg-gray-750 border-b dark:border-gray-700">
                <td class="px-6 py-2">150</td>
                <td class="px-6 py-2">210</td>
                <td class="px-6 py-2">0.0</td>
              </tr>
              <tr class="bg-white dark:bg-gray-800 border-b dark:border-gray-700">
                <td class="px-6 py-2">45</td>
                <td class="px-6 py-2">90</td>
                <td class="px-6 py-2">40.5</td>
              </tr>
              <tr class="bg-gray-50 dark:bg-gray-750 border-b dark:border-gray-700">
                <td class="px-6 py-2">90</td>
                <td class="px-6 py-2">180</td>
                <td class="px-6 py-2">57.3</td>
              </tr>
              <tr class="bg-white dark:bg-gray-800">
                <td class="px-6 py-2">90</td>
                <td class="px-6 py-2">360</td>
                <td class="px-6 py-2">-57.3</td>
              </tr>
            </tbody>
          </table>
        </div>
        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Note: The PDF values seem to be $\text{Area} =
          (\cos(a_{rad}) - \cos(b_{rad})) \times \frac{180}{\pi}$. The numerical integration above aims to approximate
          this scaled value.</p>
      </div>

      <div class="mt-6 text-center">
        <a href="{{ route('problems.index') }}"
          class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300">
          &larr; Back to Problems Index
        </a>
      </div>
    </div>
  </div>
@endsection
