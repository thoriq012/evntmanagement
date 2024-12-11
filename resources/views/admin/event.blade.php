@extends('layouts.app')

@section('title', 'Event Management')

@section('content_header')
    <h1 class="text-2xl dark:text-gray-200 font-semibold mb-6">Event Management</h1>
@stop

@section('content')
    
<div class="relative overflow-x-auto sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Event Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Date
                </th>
                <th scope="col" class="px-6 py-3">
                    Start
                </th>
                <th scope="col" class="px-6 py-3">
                    End
                </th>
                <th scope="col" class="px-6 py-3">
                    Location
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($event as $item)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $item->name }}
                </th>
                <td class="px-6 py-4">
                    {{ $item->event_date }}
                </td>
                <td class="px-6 py-4">
                    {{ $item->event_start }}
                </td>
                <td class="px-6 py-4">
                    {{ $item->event_end }}
                </td>
                <td class="px-6 py-4">
                    {{ $item->location }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@stop

@section('css')
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
    <script> 
    @if (Session::has('succes'))
    toastr.success("{{ Session::get('success') }}");
    @endif
    </script> --}}
@stop
