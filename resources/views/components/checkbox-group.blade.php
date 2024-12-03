@props(['options' => [], 'selected' => []])

<div class="relative rounded-xl overflow-auto p-8">
    <div
        class="overflow-y-scroll h-72 relative max-w-sm mx-auto bg-white dark:bg-slate-800 shadow-lg ring-1 ring-black/5 rounded-xl flex flex-col divide-y dark:divide-slate-200/5">
        @foreach ($options as $option)
            <div class="flex items-center gap-4 p-4">
                <input type="checkbox" name="tags[]" value="{{ $option['id'] }}"
                    {{ in_array($option['id'], $selected) ? 'checked' : '' }}
                    class="h-5 w-5 text-blue-600 dark:text-blue-400 border-gray-300 dark:border-gray-700 rounded focus:ring-indigo-500 dark:focus:ring-indigo-600 mr-2">
                <div class="flex flex-col">
                    <strong
                        class="text-slate-900 text-sm font-medium dark:text-slate-200">{{ $option['description'] }}</strong>
                    <span class="text-slate-500 text-sm font-medium dark:text-slate-400">Tag ID:
                        {{ $option['id'] }}</span>
                </div>
            </div>
        @endforeach
    </div>
</div>
