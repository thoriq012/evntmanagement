{{-- Untuk Menampilkan Halamn Dashboard pada web --}}
@extends('layouts.app')

@section('title', 'Dashboard')

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
@stop

@section('script_link')
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
@stop

@section('content')
    <div class="p-4">
        <!-- Info boxes -->
        <div
            class="grid @if (Auth::user()->role == 'admin') xl:grid-cols-4 @else xl:grid-cols-3 @endif md:grid-cols-2 grid-cols-1 -mx-2 mb-4 ">
            <div class="w-full px-2 mb-4">
                <div class="flex items-center bg-blue-500 text-white rounded-lg p-4 shadow-md">
                    <svg class="w-[48px] h-[48px] text-gray-800 text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M5 5a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1 2 2 0 0 1 2 2v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a2 2 0 0 1 2-2ZM3 19v-7a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm6.01-6a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm-10 4a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z"
                            clip-rule="evenodd" />
                    </svg>
                    <div class="ml-4">
                        <p class="text-sm font-semibold">Total Event</p>
                        <p class="text-lg font-bold">{{ $totalEvent }}</p>
                    </div>
                </div>
            </div>
            @if (Auth::user()->role == 'admin')
                <div class="w-full px-2 mb-4">
                    <div class="flex items-center bg-green-500 text-white rounded-lg p-4 shadow-md">
                        <svg class="w-[48px] h-[48px] text-gray-800 text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H6Zm7.25-2.095c.478-.86.75-1.85.75-2.905a5.973 5.973 0 0 0-.75-2.906 4 4 0 1 1 0 5.811ZM15.466 20c.34-.588.535-1.271.535-2v-1a5.978 5.978 0 0 0-1.528-4H18a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2h-4.535Z"
                                clip-rule="evenodd" />
                        </svg>
                        <div class="ml-4">
                            <p class="text-sm font-semibold">Total Users</p>
                            <p class="text-lg font-bold">{{ $totalUser }}</p>
                        </div>
                    </div>
                </div>
            @endif
            <div class="w-full px-2 mb-4">
                <div class="flex items-center bg-yellow-500 text-white rounded-lg p-4 shadow-md">
                    <svg class="w-[48px] h-[48px] text-gray-800 text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                            clip-rule="evenodd" />
                    </svg>
                    <div class="ml-4">
                        <p class="text-sm font-semibold">Active Event</p>
                        <p class="text-lg font-bold">{{ $eventAktif }}</p>
                    </div>
                </div>
            </div>
            <div class="w-full px-2 mb-4">
                <div class="flex items-center bg-red-500 text-white rounded-lg p-4 shadow-md">
                    <svg class="w-[48px] h-[48px] text-gray-800 text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M13.5 2c-.178 0-.356.013-.492.022l-.074.005a1 1 0 0 0-.934.998V11a1 1 0 0 0 1 1h7.975a1 1 0 0 0 .998-.934l.005-.074A7.04 7.04 0 0 0 22 10.5 8.5 8.5 0 0 0 13.5 2Z" />
                        <path d="M11 6.025a1 1 0 0 0-1.065-.998 8.5 8.5 0 1 0 9.038 9.039A1 1 0 0 0 17.975 13H11V6.025Z" />
                    </svg>
                    <div class="ml-4">
                        <p class="text-sm font-semibold">Finished Event</p>
                        <p class="text-lg font-bold">{{ $eventSelesai }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Events & Participants -->
        <div class="flex flex-wrap -mx-2">
            <!-- Recent Events -->
            <div class="w-full px-2">
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                    <div class="bg-gray-100 dark:bg-gray-700 p-4">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Current Event</h3>
                    </div>
                    <div class="p-4">
                        <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700"
                            id="sorting-table">
                            <thead>
                                <tr
                                    class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 uppercase text-sm text-left">
                                    <th class="py-3 px-4 border-b dark:border-gray-700">Event Name</th>
                                    <th class="py-3 px-4 border-b dark:border-gray-700">Date</th>
                                    <th class="py-3 px-4 border-b dark:border-gray-700">Status</th>
                                    <th class="py-3 px-4 border-b dark:border-gray-700">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700 dark:text-gray-300">
                                @foreach ($event as $item)
                                    @php
                                        $now = now();
                                        $eventDate = \Carbon\Carbon::parse($item->event_date);
                                        $eventStart = \Carbon\Carbon::parse(
                                            $item->event_date . ' ' . $item->event_start,
                                        );
                                        $eventEnd = \Carbon\Carbon::parse($item->event_date . ' ' . $item->event_end);
                                    @endphp
                                    <tr class="border-b dark:border-gray-700">
                                        <td class="py-3 px-4">{{ $item->name }}</td>
                                        <td class="py-3 px-4">{{ $item->event_date }}</td>
                                        <td class="py-3 px-4">
                                            @if ($eventDate->isToday() && $now->between($eventStart, $eventEnd))
                                                <span
                                                    class="px-2 py-1 bg-green-100 dark:bg-green-700 text-green-800 dark:text-green-200 rounded-full text-xs font-semibold">Active</span>
                                            @elseif ($eventDate->isFuture() || ($eventDate->isToday() && $now->lt($eventStart)))
                                                <span
                                                    class="px-2 py-1 bg-yellow-100 dark:bg-yellow-700 text-yellow-800 dark:text-yellow-200 rounded-full text-xs font-semibold">Registration</span>
                                            @else
                                                <span
                                                    class="px-2 py-1 bg-red-100 dark:bg-red-700 text-red-800 dark:text-red-200 rounded-full text-xs font-semibold">Finished</span>
                                            @endif
                                            @php
                                                $joined = false;
                                                if (!$item->eventParticipants->isEmpty()):
                                                    foreach ($item->eventParticipants as $participant):
                                                        if ($participant->id_user == Auth::id()) {
                                                            $joined = true;
                                                        }
                                                    endforeach;
                                                endif;
                                            @endphp

                                        </td>
                                        <td class="py-3 px-4">
                                            @if ($joined)
                                                You Already Joined
                                            @else
                                                <form action="{{ route('join') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id_user" value="{{ Auth::id() }}">
                                                    <input type="hidden" name="id_event" value="{{ $item->id }}">
                                                    <input type="hidden" name="name" @auth value="{{ Auth::user()->name }}" @endauth>
                                                    <input type="hidden" name="email" @auth value="{{ Auth::user()->email }}" @endauth>
                                                    <input type="hidden" name="no_telp" @auth value="{{ Auth::user()->no_telp }}" @endauth>
                                                    <input type="hidden" name="alamat" @auth value="{{ Auth::user()->alamat }}" @endauth>
                                                    <input type="hidden" name="for_me" value="">
                                                    <button type="submit"
                                                        class="flex items-center px-4 py-1 bg-green-500 dark:bg-green-600 text-white rounded hover:bg-green-600 dark:hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 dark:focus:ring-green-700 focus:ring-opacity-50">
                                                        <svg class="w-6 h-6 mr-2 text-white" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path d="M14 19V5h4a1 1 0 0 1 1 1v11h1a1 1 0 0 1 0 2h-6Z" />
                                                            <path fill-rule="evenodd"
                                                                d="M12 4.571a1 1 0 0 0-1.275-.961l-5 1.428A1 1 0 0 0 5 6v11H4a1 1 0 0 0 0 2h1.86l4.865 1.39A1 1 0 0 0 12 19.43V4.57ZM10 11a1 1 0 0 1 1 1v.5a1 1 0 0 1-2 0V12a1 1 0 0 1 1-1Z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        Join
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Your Events -->
        <div class="flex flex-wrap mt-4 -mx-2">
            <div class="w-full px-2">
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                    <div class="bg-gray-100 dark:bg-gray-700 p-4">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Your Event</h3>
                    </div>
                    <div class="p-4">
                        <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                            <thead>
                                <tr
                                    class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 uppercase text-sm text-left">
                                    <th class="py-3 px-4 border-b dark:border-gray-700">Event Name</th>
                                    <th class="py-3 px-4 border-b dark:border-gray-700">Date</th>
                                    <th class="py-3 px-4 border-b dark:border-gray-700">Status</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700 dark:text-gray-300">
                                @foreach ($yourEvent as $item)
                                    @php
                                        $now = now();
                                        $eventDate = \Carbon\Carbon::parse($item->event_date);
                                        $eventStart = \Carbon\Carbon::parse(
                                            $item->event_date . ' ' . $item->event_start,
                                        );
                                        $eventEnd = \Carbon\Carbon::parse($item->event_date . ' ' . $item->event_end);
                                    @endphp
                                    <tr class="border-b dark:border-gray-700">
                                        <td class="py-3 px-4">{{ $item->name }}</td>
                                        <td class="py-3 px-4">{{ $item->event_date }}</td>
                                        <td class="py-3 px-4">
                                            @if ($eventDate->isToday() && $now->between($eventStart, $eventEnd))
                                                <span
                                                    class="px-2 py-1 bg-green-100 dark:bg-green-700 text-green-800 dark:text-green-200 rounded-full text-xs font-semibold">Active</span>
                                            @elseif ($eventDate->isFuture() || ($eventDate->isToday() && $now->lt($eventStart)))
                                                <span
                                                    class="px-2 py-1 bg-yellow-100 dark:bg-yellow-700 text-yellow-800 dark:text-yellow-200 rounded-full text-xs font-semibold">Registration</span>
                                            @else
                                                <span
                                                    class="px-2 py-1 bg-red-100 dark:bg-red-700 text-red-800 dark:text-red-200 rounded-full text-xs font-semibold">Finished</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script>
        $(document).ready(function() {

            if (document.getElementById("sorting-table") && typeof simpleDatatables.DataTable !== 'undefined') {
                const dataTable = new simpleDatatables.DataTable("#sorting-table", {
                    searchable: false,
                    perPageSelect: false,
                    sortable: true
                });
            }

        });
    </script>
@stop