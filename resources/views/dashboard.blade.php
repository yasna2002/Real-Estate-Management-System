<x-app-layout>
    <div class="mx-auto sm:px-10 py-16">
        <!-- Grid Container -->
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach($properties as $property)
                <!-- Property Box -->
                <div class="bg-white border border-gray-200 rounded-lg shadow-md flex flex-col h-full">
                    <!-- Image Section -->
                    <img
                    src="{{ $property?->image?->image_url ? asset('images/' . $property->image->image_url) : 'https://via.placeholder.com/300x200' }}"
                    alt="{{ $property->title }}"
                        class="w-full h-72 object-cover">

                    <!-- Content Section -->
                    <div class="p-4 flex-grow">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $property->title }}</h3>
                        <p class="mt-2 text-sm text-gray-600">{{ $property->description }}</p>
                        <p class="mt-4 text-sm font-medium text-gray-700">
                            Price: <span class="text-blue-600">{{ $property->price }} USD</span>
                        </p>
                        <p class="mt-1 text-sm text-gray-500">
                            Location: {{ $property->city }}
                        </p>
                    </div>

                    <!-- Like/Dislike Section -->
                    <div class="flex justify-between items-center bg-gray-100 p-3 border-t border-gray-200">
                        <button
                            class="flex items-center space-x-2 text-green-600 hover:text-green-800 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 6.42 3.42 5 5.5 5c1.74 0 3.41 1.01 4.5 2.57C11.09 6.01 12.76 5 14.5 5 16.58 5 18 6.42 18 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                            <span>Like</span>
                        </button>
                        <button
                            class="flex items-center space-x-2 text-red-600 hover:text-red-800 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.35l1.45 1.32C18.6 6.64 22 9.72 22 13.5c0 2.08-1.42 3.5-3.5 3.5-1.74 0-3.41-1.01-4.5-2.57C12.91 17.99 11.24 19 9.5 19 7.42 19 6 17.58 6 15.5c0-3.78 3.4-6.86 8.55-11.54L12 2.35z"/>
                            </svg>
                            <span>Dislike</span>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-10 font-semibold">
            {{ $properties->links() }}
        </div>
    </div>
</x-app-layout>
