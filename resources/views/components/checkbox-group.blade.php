@props(['options' => [], 'selected' => []])

<div {{ $attributes->merge(['class' => 'border border-gray-300 dark:border-gray-700 rounded-md p-4 overflow-y-scroll h-72 relative max-w-sm mx-auto']) }}
    style="scrollbar-width: thin; scrollbar-color: #a0aec0 #edf2f7;">
    @foreach ($options as $option)
        <div
            class="flex items-center gap-4 p-4 border border-gray-300 dark:border-gray-700 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800 transition">
            <input type="checkbox" name="tags[]" value="{{ $option['id'] }}"
                {{ in_array($option['id'], $selected) ? 'checked' : '' }}
                class="h-5 w-5 text-blue-600 dark:text-blue-400 border-gray-300 dark:border-gray-700 rounded focus:ring-indigo-500 dark:focus:ring-indigo-600 mr-2" />
            <label for="tag-{{ $option['id'] }}" class="text-gray-700 dark:text-gray-300">
                {{ $option['description'] }}
            </label>
        </div>
    @endforeach
</div>
