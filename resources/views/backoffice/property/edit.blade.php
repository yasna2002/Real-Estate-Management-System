@php
    /** @var \App\Models\Property $property */
@endphp
<x-backoffice-layout>
    <form action="{{ route('backoffice.properties.update', $property->id) }}" method="POST"
          class="space-y-6 bg-white p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT')

        <!-- Title, Price, Type -->
        <div class="sm:flex items-center justify-between sm:space-x-6 space-y-3 sm:space-y-0">
            <x-input name="title" label="Title" :value="$property->title" required />
            <x-input name="price" step="0.01" label="Price" type="number" :value="$property->price" required />
            <x-select name="type" label="Type" :options="\App\Models\Property::getPropetyTypes()" :value="$property->type" />
        </div>

        <!-- Status, Size, Rooms -->
        <div class="sm:flex items-center justify-between sm:space-x-6 space-y-3 sm:space-y-0">
            <x-select name="status" label="Status" :options="\App\Models\Property::getPropertyStatus()" :value="$property->status" required />
            <x-input name="size" step="0.1" label="Size (sqm)" type="number" :value="$property->size" />
            <x-input name="rooms" label="Rooms" type="number" :value="$property->rooms" />
        </div>

        <!-- Location, City -->
        <div class="sm:flex items-center justify-between sm:space-x-6 space-y-3 sm:space-y-0">
            <x-input name="location" label="Location" :value="$property->location" />
            <x-input name="city" label="City" :value="$property->city" required />
        </div>

        <!-- Description -->
        <x-textarea name="description" label="Description" :value="$property->description" />

        <!-- Submit Button -->
        <div>
            <button type="submit"
                    class="inline-flex justify-center rounded-md border border-transparent bg-blue-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Update
            </button>
        </div>
    </form>
</x-backoffice-layout>
