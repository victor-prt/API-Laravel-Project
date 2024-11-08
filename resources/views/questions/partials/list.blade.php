

@if(!$ws)
    <div class="p-4 m-4">
        {{$questions->links()}}
    </div>
@endif

<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class='px-6 py-3'>
                Title
            </th>
            <th scope="col" class="px-6 py-3">
                Tags
            </th>
            <th scope="col" class="px-6 py-3">
                Creation date
            </th>
            <th scope="col" class="px-6 py-3">
                Searched at
            </th>
        </tr>
    </thead>
    <tbody>
        @forelse($questions as $question)
            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <td class="px-6 py-4">
                    <a href="{{$ws ? $question->link : $question->url}}" class="hover:underline" target="_blank">{{$question->title}}</a>
                </td>
                <td class="px-6 py-4">
                    {{$question->tags}}
                </td>
                <td class="px-6 py-4">
                    {{$question->creation_date}}
                </td>
                <td class="px-6 py-4">
                    {{$question->created_at}}
                </td>
            </tr>
        @empty
            <tr>
                @if(!$ws)
                <td class="px-6 py-4 whitespace-nowrap">
                    No existen búsquedas recientes
                </td>
                @else
                <td class="px-6 py-4 whitespace-nowrap">
                    Realiza una búsqueda en stack overflow
                </td>
                @endif
            </tr>
        @endforelse
    </tbody>
</table>
@if(!$ws)
    <div class="p-4 m-4">
        {{$questions->links()}}
    </div>
@endif
