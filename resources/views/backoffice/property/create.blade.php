<x-backoffice-layout>
    <form action="{{ route('backoffice.properties.store') }}" method="POST"
          class="space-y-6 bg-white p-6 rounded-lg shadow-md">
        @csrf

        <div class="sm:flex items-center justify-between sm:space-x-6 space-y-3 sm:space-y-0">
            <x-input name="title" label="Title" required />
            <x-input name="price" label="Price" type="number" required />
            <x-select name="type" label="Type" :options="\App\Models\Property::getPropetyTypes()" />
        </div>

        <div class="sm:flex items-center justify-between sm:space-x-6 space-y-3 sm:space-y-0">
            <x-select name="status" label="Status" :options="\App\Models\Property::getPropertyStatus()" required />
            <x-input name="size" label="Size (sqm)" type="number" />
            <x-input name="rooms" label="Rooms" type="number" />
        </div>

        <div class="sm:flex items-center justify-between sm:space-x-6 space-y-3 sm:space-y-0">
            <x-input name="location" label="Location" />
            <x-input name="city" label="City" required />
        </div>

        <x-textarea name="description" label="Description" />

        <div>
            <button type="submit"
                    class="inline-flex justify-center rounded-md border border-transparent bg-blue-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Submit
            </button>
        </div>
    </form>
</x-backoffice-layout>