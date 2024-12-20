<x-backoffice-layout>

@php
    $headers = ['title','user id','description','price','type','status','location','city','size','rooms'];
    $fields = ['title','user_id','description','price','type','status','location','city','size','rooms'];
@endphp
    <x-table :models="$properties" :headers="$headers" :fields="$fields" />
</x-backoffice-layout>
