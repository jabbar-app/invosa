@extends('layouts.app')

@section('title', isset($calculationDone) ? 'Shortest Path - Result' : 'Shortest Path - Enter Numbers')

@section('content')
  <div
    class="flex flex-col items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl w-full space-y-8 bg-white dark:bg-gray-800 p-6 md:p-10 rounded-xl shadow-2xl">
      <div>
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900 dark:text-gray-100">
          Shortest Path Problem
        </h2>
        @if (!isset($calculationDone))
          <p class="mt-2 text-center text-sm text-gray-600 dark:text-gray-400">
            Step 2: Enter the numbers for the triangle ({{ $numRows }} {{ $numRows > 1 ? 'rows' : 'row' }}).
          </p>
        @else
          <p class="mt-2 text-center text-sm text-gray-600 dark:text-gray-400">
            Calculation Result:
          </p>
        @endif
      </div>

      @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-md my-6" role="alert">
          <p class="font-bold">Please correct the errors below:</p>
          <ul class="mt-2 list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form class="mt-8 space-y-6" action="{{ route('shortestpath.calculate') }}" method="POST">
        @csrf
        <input type="hidden" name="num_rows" value="{{ $numRows }}">

        <div class="space-y-3">
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Triangle Numbers:
          </label>
          @for ($i = 0; $i < $numRows; $i++)
            <div class="flex flex-wrap justify-center items-center space-x-2 mb-2" role="group"
              aria-label="Row {{ $i + 1 }}">
              <span class="text-xs text-gray-500 dark:text-gray-400 w-12 text-right">Row {{ $i + 1 }}:</span>
              @for ($j = 0; $j <= $i; $j++)
                <input type="number" name="triangle_data[{{ $i }}][{{ $j }}]" required
                  class="appearance-none rounded-md relative block w-16 px-2 py-1 border border-gray-300 dark:border-gray-600 placeholder-gray-500 dark:placeholder-gray-400 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-center"
                  placeholder="n{{ $i + 1 }}{{ $j + 1 }}"
                  value="{{ old("triangle_data.{$i}.{$j}", isset($inputTriangle[$i][$j]) ? $inputTriangle[$i][$j] : '') }}"
                  aria-label="Number for row {{ $i + 1 }}, column {{ $j + 1 }}">
              @endfor
            </div>
          @endfor
        </div>

        @if (!isset($calculationDone))
          <div>
            <button type="submit"
              class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 dark:focus:ring-offset-gray-800">
              Calculate Shortest Path
            </button>
          </div>
        @endif
      </form>

      @if (isset($calculationDone) && isset($minimumSum))
        <div class="mt-8 p-6 bg-blue-50 dark:bg-blue-900 rounded-lg shadow">
          <h3 class="text-lg font-medium leading-6 text-blue-900 dark:text-blue-100">Results</h3>
          <div class="mt-4">
            <p class="text-sm text-blue-800 dark:text-blue-200">
              Minimum Path Sum: <span class="font-bold text-xl">{{ $minimumSum }}</span>
            </p>
            <p class="text-sm text-blue-800 dark:text-blue-200 mt-2">
              Path Taken: <span class="font-semibold font-mono">{{ $pathString }}</span>
            </p>
          </div>

          <h4 class="text-md font-medium text-blue-800 dark:text-blue-200 mt-6 mb-2">Input Triangle with Path Highlighted:
          </h4>
          <div class="text-center space-y-1">
            @php
              $isNodeInPath = function ($r, $c) use ($pathNodes) {
                  foreach ($pathNodes as $node) {
                      if ($node['row'] === $r && $node['col'] === $c) {
                          return true;
                      }
                  }
                  return false;
              };
            @endphp
            @foreach ($inputTriangle as $r_idx => $row)
              <div class="flex justify-center space-x-2">
                @foreach ($row as $c_idx => $value)
                  <span
                    class="inline-block px-2 py-1 rounded w-10 text-center font-mono
                                    {{ $isNodeInPath($r_idx, $c_idx) ? 'bg-yellow-300 dark:bg-yellow-500 text-black font-bold ring-2 ring-yellow-500 dark:ring-yellow-300' : 'bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200' }}">
                    {{ $value }}
                  </span>
                @endforeach
              </div>
            @endforeach
          </div>
          <div class="mt-8 text-center">
            <a href="{{ route('shortestpath.form.show') }}"
              class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300">
              &larr; Start Over with New Triangle
            </a>
          </div>
        </div>
      @endif

      @if (!isset($calculationDone))
        <div class="mt-6 text-center">
          <a href="{{ route('shortestpath.form.show') }}"
            class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300">
            &larr; Change Number of Rows
          </a>
        </div>
      @endif

      @if (!isset($calculationDone))
        <div class="mt-10">
          <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Examples:</h3>
          <p class="text-sm text-gray-600 dark:text-gray-400">Input 1: 5 (rows)</p>
          <p class="text-sm text-gray-600 dark:text-gray-400">Input 2 (Triangle):</p>
          <pre class="text-xs bg-gray-50 dark:bg-gray-700 p-2 rounded overflow-x-auto">
    5
   2 3
  4 6 1
 7 5 3 5
1 2 4 2 7
            </pre>
          <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Output: 14 (Path: n11+n22+n33+n43+n54)</p>
        </div>
      @endif

      <div class="mt-6 text-center">
        <a href="{{ route('problems.index') }}"
          class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300">
          &larr; Back to Problems Index
        </a>
      </div>
    </div>
  </div>
@endsection
