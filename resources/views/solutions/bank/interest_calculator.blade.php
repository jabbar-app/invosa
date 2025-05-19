@extends('layouts.app') {{-- Assuming you have a layout file as set up previously --}}

@section('title', 'Bank Interest Calculator')

@section('content')
  <div
    class="flex flex-col items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white dark:bg-gray-800 p-10 rounded-xl shadow-2xl">
      <div>
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900 dark:text-gray-100">
          Bank Interest Calculator
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600 dark:text-gray-400">
          Calculates balance with 1% monthly interest (using a loop). Initial balance: Rp 1,000,000.00
        </p>
      </div>

      {{-- Display Validation Errors --}}
      @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
          <strong class="font-bold">Oops! Something went wrong.</strong>
          <ul class="mt-2 list-disc list-inside">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form class="mt-8 space-y-6" action="{{ route('bank.interest.calculate') }}" method="POST">
        @csrf {{-- CSRF protection token --}}
        <div class="rounded-md shadow-sm -space-y-px">
          <div>
            <label for="months" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Number of Months
              (b):</label>
            <input id="months" name="months" type="number" autocomplete="off" required
              class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 placeholder-gray-500 dark:placeholder-gray-400 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
              placeholder="Enter number of months" value="{{ old('months', isset($inputMonths) ? $inputMonths : '') }}">
            {{-- Retain old input or current input --}}
          </div>
        </div>

        <div>
          <button type="submit"
            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
            Calculate Balance
          </button>
        </div>
      </form>

      {{-- Display Result --}}
      @if (isset($balance))
        <div class="mt-8 p-6 bg-green-50 dark:bg-green-700 rounded-lg shadow">
          <h3 class="text-lg font-medium leading-6 text-green-900 dark:text-green-100">Calculation Result</h3>
          <div class="mt-2 text-lg text-green-800 dark:text-green-200">
            <p>After <span class="font-semibold">{{ $inputMonths }}</span> month(s), the balance will be:</p>
            <p class="text-2xl font-bold mt-1">Rp {{ $balance }}</p>
          </div>
        </div>
      @endif

      {{-- Test Cases --}}
      <div class="mt-10">
        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Test Cases:</h3>
        <ul class="mt-2 text-sm text-gray-600 dark:text-gray-400 list-disc list-inside space-y-1">
          <li>Input: 0 months &rarr; Output: 1.000.000,00</li>
          <li>Input: 1 month &rarr; Output: 1.010.000,00</li>
          <li>Input: 12 months &rarr; Output: 1.126.825,03</li>
          <li>Input: 60 months &rarr; Output: 1.816.696,70</li>
          <li>Input: 360 months &rarr; Output: 35.949.641,33</li>
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
