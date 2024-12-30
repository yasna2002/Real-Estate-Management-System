<x-backoffice-layout>

    <div class="mb-2">
        <a href="{{ route('backoffice.properties.create') }}">
            <x-primary-button>Create</x-primary-button>
        </a>
    </div>

    @php
        $headers = ['title','user id','description','price','type','status','location','city','size','rooms'];
        $fields = ['title','user_id','description','price','type','status','location','city','size','rooms'];
    @endphp
    @include('components.table',
['models' => $properties, 'headers' => $headers, 'fields' => $fields, 'edit' => true,
'editRoute' => 'backoffice.properties.edit', 'delete' => true, 'deleteRoute' => 'backoffice.properties.destroy'])
</x-backoffice-layout>
