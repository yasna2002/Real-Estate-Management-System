<x-backoffice-layout>
    @php
        $headers = ['id','name','email','phone number','role'];
        $fields = ['id','name','email','phone_number','role'];
    @endphp
    @include('components.table', ['models' => $users, 'headers' => $headers, 'fields' => $fields, 'edit'=>false, 'deleteRoute' => 'backoffice.users.destroy'])
</x-backoffice-layout>
