@props([
    'options' => [],
    'selected' => [],
    'name' => 'tags',
    'max' => null,
    'showSelectAll' => true,
])

<div {{ $attributes->merge(['class' => 'border border-gray-300 dark:border-gray-700 rounded-md p-4 overflow-y-auto max-h-72 relative max-w-sm mx-auto']) }}
    style="scrollbar-width: thin; scrollbar-color: #a0aec0 #edf2f7;">

    @foreach ($options as $option)
        <div
            class="flex items-center gap-4 p-4 border-b border-gray-300 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800 transition last:border-b-0">
            <input type="checkbox" id="tag-{{ $option['id'] }}" name="{{ $name }}[]" value="{{ $option['id'] }}"
                {{ in_array($option['id'], $selected) ? 'checked' : '' }}
                class="h-5 w-5 text-blue-600 dark:text-blue-400 border-gray-300 dark:border-gray-700 rounded focus:ring-indigo-500 dark:focus:ring-indigo-600 mr-2 tag-checkbox"
                @if ($max) onchange="
                        const checkedBoxes = document.querySelectorAll('input.tag-checkbox:checked');
                        if (checkedBoxes.length > {{ $max }}) {
                            this.checked = false;
                            alert('{{ __('You can select a maximum of :max tags', ['max' => $max]) }}');
                        }
                    " @endif />
            <label for="tag-{{ $option['id'] }}" class="text-gray-700 dark:text-gray-300 flex-1">
                {{ $option['description'] }}
            </label>
        </div>
    @endforeach
</div>
