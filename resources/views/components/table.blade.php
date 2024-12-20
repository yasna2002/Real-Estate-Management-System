@props([
    'models' => [],
    'headers' => [],
    'fields' => [],
])

<div class="overflow-x-auto">
    <table class="table-auto min-w-full bg-white border border-gray-200 rounded-lg">
        <thead class="bg-gray-100">
        <tr>
            @foreach ($headers as $header)
                <th class="px-4 py-2 text-left min-w-24 text-xs font-medium text-gray-500 uppercase tracking-wider">
                    {{ $header }}
                </th>
            @endforeach
        </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
        @foreach($models as $model)
            <tr class="hover:bg-gray-100">
                @foreach ($fields as $field)
                    <td class="px-6 py-4">
                        {{ $model->$field ?? '-' }}
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
