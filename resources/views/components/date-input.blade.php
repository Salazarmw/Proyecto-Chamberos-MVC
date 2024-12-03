@props(['id', 'name', 'value' => '', 'required' => false])

<div>
    <label for="{{ $id }}" class="{{ $required ? 'required' : '' }}">{{ $slot }}</label>
    <input id="{{ $id }}" type="date" name="{{ $name }}" value="{{ $value }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm']) }}>
    @error($name)
        <span class='text-red-600 text-sm'>{{ $message }}</span>
    @enderror
</div>
