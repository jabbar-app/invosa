@extends('layouts.app')

@section('title', 'Multi-level Discount Calculator')

@section('content')
  <div
    class="flex flex-col items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-lg w-full space-y-8 bg-white dark:bg-gray-800 p-10 rounded-xl shadow-2xl">
      <div>
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900 dark:text-gray-100">
          Multi-level Discount Calculator
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600 dark:text-gray-400">
          Initial item price: <span class="font-semibold">{{ $initialPriceFormatted ?? 'Rp 100,000' }}</span>.
        </p>
        <p class="mt-1 text-center text-xs text-gray-500 dark:text-gray-300">
          E.g., 50% + 20% means apply 50% discount, then 20% on the discounted price.
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

      <form class="mt-8 space-y-6" action="{{ route('discount.calculator.calculate') }}" method="POST">
        @csrf
        <div>
          <label for="num_discounts" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            Number of Discount Levels:
          </label>
          <input id="num_discounts" name="num_discounts" type="number" min="1" required
            class="mt-1 appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 placeholder-gray-500 dark:placeholder-gray-400 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            placeholder="e.g., 2 for 50% + 20%" value="{{ old('num_discounts', $inputNumDiscounts ?? 1) }}">
        </div>

        <div id="discount_levels_container" class="space-y-4">
          {{-- Discount input fields will be generated here by JavaScript --}}
        </div>

        <div>
          <button type="submit"
            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
            Calculate Final Price
          </button>
        </div>
      </form>

      @if (isset($finalPrice))
        <div class="mt-8 p-6 bg-green-50 dark:bg-green-700 rounded-lg shadow">
          <h3 class="text-lg font-medium leading-6 text-green-900 dark:text-green-100">Calculation Result</h3>
          <div class="mt-2">
            <p class="text-sm text-green-800 dark:text-green-200">Initial Price: {{ $initialPriceFormatted }}</p>
            @if (isset($appliedDiscounts) && count($appliedDiscounts) > 0)
              <p class="text-sm text-green-800 dark:text-green-200">
                Discounts Applied:
                @foreach ($appliedDiscounts as $index => $disc)
                  {{ $disc }}%{{ $index < count($appliedDiscounts) - 1 ? ' + ' : '' }}
                @endforeach
              </p>
            @endif
            <p class="text-2xl font-bold mt-1 text-green-800 dark:text-green-100">Final Price: {{ $finalPrice }}</p>
          </div>
        </div>
      @endif

      <div class="mt-10">
        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Test Cases:</h3>
        <ul class="mt-2 text-sm text-gray-600 dark:text-gray-400 list-disc list-inside space-y-2">
          <li>
            1 Level, Discount: 30% &rarr; Output: Rp 70,000
          </li>
          <li>
            2 Levels, Discounts: 50%, 20% &rarr; Output: Rp 40,000
          </li>
          <li>
            3 Levels, Discounts: 40%, 20%, 50% &rarr; Output: Rp 24,000
          </li>
        </ul>
      </div>
      <div class="mt-6 text-center">
        <a href="{{ route('landing') }}"
          class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300">
          &larr; Back to Problems Index
        </a>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const numDiscountsInput = document.getElementById('num_discounts');
      const container = document.getElementById('discount_levels_container');

      // Pre-fill discount values if they exist (e.g., from old input or server response)
      const oldDiscounts = @json(old('discounts', $inputDiscounts ?? []));

      function generateDiscountFields(count) {
        container.innerHTML = ''; // Clear existing fields
        if (count > 0 && count <= 10) { // Limit to a reasonable number, e.g., 10
          for (let i = 0; i < count; i++) {
            const div = document.createElement('div');
            div.classList.add('flex', 'items-center', 'space-x-2');

            const label = document.createElement('label');
            label.htmlFor = `discount_${i}`;
            label.classList.add('block', 'text-sm', 'font-medium', 'text-gray-700', 'dark:text-gray-300', 'w-1/3');
            label.textContent = `Discount Level ${i + 1} (%):`;

            const input = document.createElement('input');
            input.type = 'number';
            input.id = `discount_${i}`;
            input.name = `discounts[${i}]`; // Use array notation for name
            input.min = 0;
            input.max = 100;
            input.required = true;
            input.classList.add('appearance-none', 'rounded-md', 'relative', 'block', 'w-2/3', 'px-3', 'py-2',
              'border', 'border-gray-300', 'dark:border-gray-600', 'placeholder-gray-500',
              'dark:placeholder-gray-400', 'text-gray-900', 'dark:text-gray-100', 'bg-white', 'dark:bg-gray-700',
              'focus:outline-none', 'focus:ring-indigo-500', 'focus:border-indigo-500', 'sm:text-sm');
            input.placeholder = `e.g., 50 for 50%`;

            // Set value from old input or passed $inputDiscounts
            if (oldDiscounts && oldDiscounts[i] !== undefined) {
              input.value = oldDiscounts[i];
            } else if (typeof $inputDiscounts !== 'undefined' && $inputDiscounts[i] !== undefined) {
              input.value = $inputDiscounts[i];
            }


            div.appendChild(label);
            div.appendChild(input);
            container.appendChild(div);
          }
        } else if (count > 10) {
          container.innerHTML = '<p class="text-red-500 text-sm">Maximum 10 discount levels allowed.</p>';
        }
      }

      // Initial generation of fields based on current value (e.g. from old input)
      generateDiscountFields(parseInt(numDiscountsInput.value) || 1);

      numDiscountsInput.addEventListener('input', function() {
        const count = parseInt(this.value);
        generateDiscountFields(count);
      });
    });
  </script>
@endsection
