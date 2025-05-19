@extends('layouts.app')

@section('title', 'Roman to Arabic Converter')

@section('content')
  <div
    class="flex flex-col items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white dark:bg-gray-800 p-10 rounded-xl shadow-2xl">
      <div>
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900 dark:text-gray-100">
          Roman to Arabic Numeral Converter
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600 dark:text-gray-400">
          Enter a Roman numeral (e.g., VI, XCIX, DCCCLXXXVIII). Max value: 3999.
        </p>
        <p class="mt-1 text-center text-xs text-gray-500 dark:text-gray-300">
          Input is case-insensitive.
        </p>
      </div>

      @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-md mb-6" role="alert">
          <p class="font-bold">Error:</p>
          <ul class="mt-2 list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form class="mt-8 space-y-6" action="{{ route('roman.converter.process') }}" method="POST">
        @csrf
        <div>
          <label for="roman_numeral" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            Roman Numeral:
          </label>
          <input id="roman_numeral" name="roman_numeral" type="text" autocomplete="off" required
            class="mt-1 appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 placeholder-gray-500 dark:placeholder-gray-400 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm uppercase"
            placeholder="e.g., XCIX" value="{{ old('roman_numeral', $inputRoman ?? '') }}">
        </div>

        <div>
          <button type="submit"
            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
            Convert to Arabic
          </button>
        </div>
      </form>

      @if (isset($arabicResult) && is_numeric($arabicResult))
        <div class="mt-8 p-6 bg-green-50 dark:bg-green-700 rounded-lg shadow">
          <h3 class="text-lg font-medium leading-6 text-green-900 dark:text-green-100">Conversion Result</h3>
          <div class="mt-3 space-y-2">
            <div>
              <p class="text-sm font-medium text-green-800 dark:text-green-200">Roman Input (Processed):</p>
              <p class="text-md p-2 bg-gray-100 dark:bg-gray-600 rounded break-all font-mono">{{ $processedRoman ?? '' }}
              </p>
            </div>
            <div>
              <p class="text-sm font-medium text-green-800 dark:text-green-200">Arabic Equivalent:</p>
              <p class="text-2xl font-bold p-2 bg-gray-200 dark:bg-gray-500 rounded break-all font-mono">
                {{ $arabicResult }}</p>
            </div>
          </div>
        </div>
      @endif

      <div class="mt-10">
        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Test Cases:</h3>
        <ul class="mt-2 text-sm text-gray-600 dark:text-gray-400 list-disc list-inside space-y-1">
          <li>Input: VI or vi &rarr; Output: 6</li>
          <li>Input: XCIX or xcix &rarr; Output: 99</li>
          <li>Input: DCCCLXXXVIII or dccclxxxviii &rarr; Output: 888</li>
          <li>Max convertable: 3999 (MMMCMXCIX)</li>
        </ul>
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
