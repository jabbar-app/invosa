@extends('layouts.app')

@section('title', 'Marble Count Prediction')

@section('content')
  <div
    class="flex flex-col items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl w-full space-y-8 bg-white dark:bg-gray-800 p-6 md:p-10 rounded-xl shadow-2xl">
      <div>
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900 dark:text-gray-100">
          Marble Count Prediction
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600 dark:text-gray-400">
          Predict the final count of yellow and blue marbles as they are drawn.
        </p>
      </div>

      @if (session('status'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md mb-6" role="alert">
          {{ session('status') }}
        </div>
      @endif
      @if (session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-md mb-6" role="alert">
          {{ session('error') }}
        </div>
      @endif
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

      @if (!$totalMarbles)
        {{-- Step 1: Input Total Marbles --}}
        <form class="mt-8 space-y-6" action="{{ route('marble.prediction.show') }}" method="POST">
          @csrf
          <div>
            <label for="total_marbles_input" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
              Total Number of Marbles (Z):
            </label>
            <input id="total_marbles_input" name="total_marbles_input" type="number" min="1" max="1000"
              required
              class="mt-1 appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 placeholder-gray-500 dark:placeholder-gray-400 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              placeholder="e.g., 100" value="{{ old('total_marbles_input') }}">
          </div>
          <div>
            <button type="submit"
              class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
              Start Prediction
            </button>
          </div>
        </form>
      @else
        {{-- Step 2: Draw Marbles and Predict --}}
        <div class="mt-8 space-y-6">
          <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg shadow">
            <p class="text-sm text-gray-700 dark:text-gray-200">
              Total Marbles (Z): <span class="font-semibold">{{ $totalMarbles }}</span>
            </p>
            <p class="text-sm text-gray-700 dark:text-gray-200">
              Marbles Drawn So Far: <span class="font-semibold">{{ $marblesDrawnCount }} / {{ $totalMarbles }}</span>
            </p>
            <p class="text-sm text-gray-700 dark:text-gray-200">
              Yellow Drawn: <span class="font-semibold">{{ $yellowDrawn }}</span> |
              Blue Drawn: <span class="font-semibold">{{ $blueDrawn }}</span>
            </p>
          </div>

          @if ($marblesDrawnCount < $totalMarbles)
            <form action="{{ route('marble.prediction.show') }}" method="POST" class="space-y-4">
              @csrf
              <div>
                <label for="drawn_color" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                  Color of Marble #{{ $marblesDrawnCount + 1 }}:
                </label>
                <select id="drawn_color" name="drawn_color" required
                  class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                  <option value="k" {{ old('drawn_color') == 'k' ? 'selected' : '' }}>Kuning (Yellow)</option>
                  <option value="b" {{ old('drawn_color') == 'b' ? 'selected' : '' }}>Biru (Blue)</option>
                </select>
              </div>
              <div>
                <button type="submit"
                  class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 dark:focus:ring-offset-gray-800">
                  Draw Marble & Predict
                </button>
              </div>
            </form>
          @else
            <div class="p-4 bg-blue-50 dark:bg-blue-700 rounded-lg text-center">
              <p class="font-semibold text-blue-800 dark:text-blue-100">All {{ $totalMarbles }} marbles have been drawn!
              </p>
              <p class="text-blue-700 dark:text-blue-200">Final Yellow: {{ $yellowDrawn }}, Final Blue:
                {{ $blueDrawn }}</p>
            </div>
          @endif

          @if ($prediction)
            <div class="mt-6 p-4 bg-indigo-50 dark:bg-indigo-700 rounded-lg shadow">
              <h4 class="text-md font-semibold text-indigo-800 dark:text-indigo-100">Current Prediction for Final Counts:
              </h4>
              <p class="text-indigo-700 dark:text-indigo-200">
                Predicted Yellow: <span class="font-bold">{{ $prediction['predicted_yellow_final'] }}</span>
              </p>
              <p class="text-indigo-700 dark:text-indigo-200">
                Predicted Blue: <span class="font-bold">{{ $prediction['predicted_blue_final'] }}</span>
              </p>
            </div>
          @endif

          <form action="{{ route('marble.prediction.show') }}" method="POST" class="mt-4">
            @csrf
            <input type="hidden" name="reset" value="true">
            <button type="submit"
              class="text-sm text-red-600 dark:text-red-400 hover:text-red-500 dark:hover:text-red-300 underline">
              Reset Prediction
            </button>
          </form>
        </div>
      @endif

      @if (!empty($predictionHistory))
        <div class="mt-10">
          <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">Prediction History:</h3>
          <div class="overflow-x-auto max-h-96 border border-gray-200 dark:border-gray-700 rounded-lg">
            <table class="min-w-full text-sm text-left text-gray-500 dark:text-gray-400">
              <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300 sticky top-0">
                <tr>
                  <th scope="col" class="px-4 py-2">Draw #</th>
                  <th scope="col" class="px-4 py-2">Color Drawn</th>
                  <th scope="col" class="px-4 py-2">Total Yellow Drawn</th>
                  <th scope="col" class="px-4 py-2">Total Blue Drawn</th>
                  <th scope="col" class="px-4 py-2">Pred. Yellow (Final)</th>
                  <th scope="col" class="px-4 py-2">Pred. Blue (Final)</th>
                </tr>
              </thead>
              <tbody class="bg-white dark:bg-gray-800">
                @foreach ($predictionHistory as $entry)
                  <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-4 py-2 font-medium text-gray-900 dark:text-white">{{ $entry['draw_number'] }}</td>
                    <td class="px-4 py-2">{{ $entry['drawn_color_input'] == 'k' ? 'Yellow' : 'Blue' }}</td>
                    <td class="px-4 py-2">{{ $entry['current_yellow'] }}</td>
                    <td class="px-4 py-2">{{ $entry['current_blue'] }}</td>
                    <td class="px-4 py-2 font-semibold">{{ $entry['predicted_yellow'] }}</td>
                    <td class="px-4 py-2 font-semibold">{{ $entry['predicted_blue'] }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      @endif

      <div class="mt-10">
        <h4 class="text-md font-medium text-gray-700 dark:text-gray-300">Examples (Z=100):</h4>
        <ul class="text-xs list-disc list-inside text-gray-500 dark:text-gray-400 mt-1">
          <li>Draw 1: k &rarr; Pred k:100, Pred b:0</li>
          <li>Draw 3: b (after 2 k's) &rarr; Pred k:70, Pred b:30 (example)</li>
          <li>Draw 100: k (final counts) &rarr; Actual k:67, Actual b:33 (example)</li>
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
