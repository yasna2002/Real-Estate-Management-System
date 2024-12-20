@props([
    'name',
    'label',
    'options' => [],
    'value' => null,
    'required' => false,
])

<div class="w-full">
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    <select
        name="{{ $name }}"
        id="{{ $name }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm']) }}>
        <option value="">Select {{ $label }}</option>
        @foreach ($options as $option)
            <option value="{{ $option }}" {{ old($name, $value) == $option ? 'selected' : '' }}>
                {{ $option }}
            </option>
        @endforeach
    </select>
</div>
