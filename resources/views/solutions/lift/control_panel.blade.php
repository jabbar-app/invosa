@extends('layouts.app')

@section('title', 'Lift Control Optimizer')

@section('content')
  <div
    class="flex flex-col items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl w-full space-y-8 bg-white dark:bg-gray-800 p-6 md:p-10 rounded-xl shadow-2xl">
      <div>
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900 dark:text-gray-100">
          Lift Control Optimizer
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600 dark:text-gray-400">
          Input lift starting positions and people's requests to find the minimum accumulated wait time.
        </p>
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

      <form class="mt-8 space-y-8" action="{{ route('lift.control.process') }}" method="POST">
        @csrf
        {{-- Lift Inputs --}}
        <fieldset class="space-y-4 p-4 border border-gray-300 dark:border-gray-600 rounded-md">
          <legend class="text-lg font-medium text-gray-900 dark:text-gray-100 px-2">Lift Starting Positions (Floor 1-8)
          </legend>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @for ($i = 0; $i < 3; $i++)
              <div>
                <label for="lift_{{ $i }}_floor"
                  class="block text-sm font-medium text-gray-700 dark:text-gray-300">Lift {{ $i + 1 }}:</label>
                <input id="lift_{{ $i }}_floor" name="lifts[{{ $i }}][floor]" type="number"
                  min="1" max="8" required
                  class="mt-1 appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 placeholder-gray-500 dark:placeholder-gray-400 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                  value="{{ $lifts[$i]['floor'] ?? '' }}">
              </div>
            @endfor
          </div>
        </fieldset>

        {{-- People Inputs --}}
        <fieldset class="space-y-4 p-4 border border-gray-300 dark:border-gray-600 rounded-md">
          <legend class="text-lg font-medium text-gray-900 dark:text-gray-100 px-2">People Requests (4 People)</legend>
          @php $personLabels = ['A', 'B', 'C', 'D']; @endphp
          @for ($i = 0; $i < 4; $i++)
            <div
              class="grid grid-cols-1 md:grid-cols-2 gap-4 items-end border-t border-gray-200 dark:border-gray-700 pt-3 first:border-t-0 first:pt-0">
              <div>
                <label for="person_{{ $i }}_floor"
                  class="block text-sm font-medium text-gray-700 dark:text-gray-300">Person {{ $personLabels[$i] }} Floor
                  (1-8):</label>
                <input id="person_{{ $i }}_floor" name="people[{{ $i }}][floor]" type="number"
                  min="1" max="8" required
                  class="mt-1 appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 placeholder-gray-500 dark:placeholder-gray-400 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                  value="{{ $people[$i]['floor'] ?? '' }}">
              </div>
              <div>
                <label for="person_{{ $i }}_direction"
                  class="block text-sm font-medium text-gray-700 dark:text-gray-300">Person {{ $personLabels[$i] }}
                  Direction:</label>
                <select id="person_{{ $i }}_direction" name="people[{{ $i }}][direction]" required
                  class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                  <option value="n"
                    {{ isset($people[$i]['direction']) && $people[$i]['direction'] == 'n' ? 'selected' : '' }}>Naik (Up
                    to F8)</option>
                  <option value="t"
                    {{ isset($people[$i]['direction']) && $people[$i]['direction'] == 't' ? 'selected' : '' }}>Turun
                    (Down to F1)</option>
                </select>
              </div>
            </div>
          @endfor
        </fieldset>

        <div>
          <button type="submit"
            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 dark:focus:ring-offset-gray-800">
            Find Minimum Wait Time
          </button>
        </div>
      </form>

      @if (isset($calculationDone) && isset($result))
        <div class="mt-10 p-6 bg-blue-50 dark:bg-blue-900 rounded-lg shadow">
          <h3 class="text-xl font-semibold leading-6 text-blue-900 dark:text-blue-100">Optimization Result</h3>
          @if (is_numeric($result['total_wait_time']))
            <p class="mt-3 text-2xl font-bold text-blue-700 dark:text-blue-50">
              Minimum Accumulated Wait Time: {{ $result['total_wait_time'] }} seconds
            </p>
            <div class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
              @foreach ($result['individual_waits'] as $personId => $waitTime)
                <div class="p-3 bg-blue-100 dark:bg-blue-800 rounded">
                  <span class="font-medium text-blue-800 dark:text-blue-200">Wait Time (Person
                    {{ $personId }}):</span>
                  <span class="block text-lg font-semibold text-blue-700 dark:text-blue-100">{{ $waitTime }}s</span>
                </div>
              @endforeach
            </div>
            {{-- Optional: Display assignment_details if needed for clarity --}}
            {{-- <pre class="mt-4 text-xs bg-gray-100 dark:bg-gray-700 p-2 rounded overflow-x-auto">Best Assignment Structure: {{ print_r($result['assignment_details'], true) }}</pre> --}}
          @else
            <p class="mt-3 text-lg font-medium text-red-700 dark:text-red-300">
              {{ $result['total_wait_time'] }}
            </p>
          @endif
        </div>
      @endif

      <div class="mt-10">
        <h4 class="text-md font-medium text-gray-700 dark:text-gray-300">PDF Example Input:</h4>
        <ul class="text-xs list-disc list-inside text-gray-500 dark:text-gray-400 mt-1">
          <li>Lifts: L1@7, L2@5, L3@3</li>
          <li>People: A(2,n), B(2,t), C(6,t), D(5,n)</li>
          <li>Expected Output: A:5s, B:1s, C:1s, D:0s. Total: 7s</li>
        </ul>
      </div>

      <div class="mt-8 text-center">
        <a href="{{ route('problems.index') }}"
          class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300">
          &larr; Back to Problems Index
        </a>
      </div>
    </div>
  </div>
@endsection
