@props(['id', 'name', 'label', 'options' => [], 'required' => false])

<div>
    <x-input-label for="{{ $id }}" :value="__($label)" />
    <select id="{{ $id }}" name="{{ $name }}" {{ $required ? 'required' : '' }} 
        {{ $attributes->merge(['class' => 'block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm']) }}>
        <option value="">Select {{ strtolower($label) }}</option>
        @foreach ($options as $option)
            <option value="{{ $option->id }}">{{ $option->name }}</option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get($name)" class="mt-2" />
</div>
