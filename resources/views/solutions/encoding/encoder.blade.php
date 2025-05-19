@extends('layouts.app')

@section('title', 'ASCII Encoder')

@section('content')
  <div
    class="flex flex-col items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-xl w-full space-y-8 bg-white dark:bg-gray-800 p-10 rounded-xl shadow-2xl">
      <div>
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900 dark:text-gray-100">
          ASCII Character Encoder
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600 dark:text-gray-400">
          Encodes characters from ASCII 64 ('@') to 95 ('_'). Input is case-insensitive.
        </p>
        <p class="mt-1 text-center text-xs text-gray-500 dark:text-gray-300">
          Rule: 'A' &harr; 'Q', 'B' &harr; 'R', etc. (effectively swapping ASCII 64-79 with 80-95). No 'if' or 'switch'
          used in core logic.
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

      <form class="mt-8 space-y-6" action="{{ route('encoding.process') }}" method="POST">
        @csrf
        <div>
          <label for="input_string" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            Enter String to Encode:
          </label>
          <textarea id="input_string" name="input_string" rows="4"
            class="mt-1 appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 placeholder-gray-500 dark:placeholder-gray-400 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            placeholder="Enter text here, e.g., Saya_mau_makan">{{ old('input_string', $inputString ?? '') }}</textarea>
        </div>

        <div>
          <button type="submit"
            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
            Encode String
          </button>
        </div>
      </form>

      @if (isset($encodedString))
        <div class="mt-8 p-6 bg-green-50 dark:bg-green-700 rounded-lg shadow">
          <h3 class="text-lg font-medium leading-6 text-green-900 dark:text-green-100">Encoding Result</h3>
          <div class="mt-3 space-y-2">
            <div>
              <p class="text-sm font-medium text-green-800 dark:text-green-200">Original Input:</p>
              <p class="text-md p-2 bg-gray-100 dark:bg-gray-600 rounded break-all font-mono">{{ $inputString }}</p>
            </div>
            <div>
              <p class="text-sm font-medium text-green-800 dark:text-green-200">Processed Input (Uppercase):</p>
              <p class="text-md p-2 bg-gray-100 dark:bg-gray-600 rounded break-all font-mono">{{ $uppercasedInput }}</p>
            </div>
            <div>
              <p class="text-sm font-medium text-green-800 dark:text-green-200">Encoded Output:</p>
              <p class="text-xl font-bold p-2 bg-gray-200 dark:bg-gray-500 rounded break-all font-mono">
                {{ $encodedString }}</p>
            </div>
          </div>
        </div>
      @endif

      <div class="mt-10">
        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Test Cases:</h3>
        <div class="mt-2 text-sm text-gray-600 dark:text-gray-400 bg-gray-50 dark:bg-gray-700 p-3 rounded-md">
          <p><span class="font-semibold">Input:</span> <code class="font-mono">Saya_mau_makan</code></p>
          <p><span class="font-semibold">Expected Output:</span> <code class="font-mono">CQIQO]QEO]Q[Q^</code></p>
        </div>
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
