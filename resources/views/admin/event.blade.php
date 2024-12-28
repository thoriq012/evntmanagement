@extends('layouts.app')
 <!-- Mengindikasikan bahwa file ini adalah sebuah template blade yang mewarisi layout utama bernama app dari folder layouts.
Tujuan: Memungkinkan penggunaan layout standar untuk semua halaman aplikasi dengan konten yang berbeda-beda. -->

@section('title', 'Event Management')
<!-- Menentukan konten untuk bagian title di layout utama. Nilai 'Event Management' akan digunakan sebagai judul halaman.
Tujuan: Memberikan judul yang relevan pada tab browser atau metadata HTML.
 -->


@section('content_header')
    <h1 class="text-2xl dark:text-gray-200 font-semibold mb-6">Event Management</h1>
@stop
<!-- Mendefinisikan header konten dengan elemen <h1> berisi teks "Event Management".
Tujuan: Menampilkan judul atau deskripsi singkat di bagian atas konten halaman.-->

@section('content')
<!-- Fungsi: Menentukan konten utama halaman. Dalam hal ini, kode HTML digunakan untuk menampilkan daftar event dalam format tabel.-->

<div class="relative overflow-x-auto sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"> <!--<table>: Elemen HTML untuk membuat tabel.-->
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"><!-- <thead>: Mendefinisikan bagian header tabel, seperti kolom Event Name, Date, Start, End, dan Location. -->
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
        <tbody>  <!-- <tbody>: Menggunakan loop @foreach untuk menampilkan data event. -->

            @foreach ($event as $item)
             <!-- Fungsi: Iterasi setiap item dalam koleksi $event untuk menampilkan baris data. -->

            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $item->name }} <!-- {{ $item->name }}: Menampilkan nama event.-->
                </th>
                <td class="px-6 py-4">
                    {{ $item->event_date }}  <!-- {{ $item->event_date }}: Menampilkan tanggal event. -->
                </td>
                <td class="px-6 py-4">
                    {{ $item->event_start }}  <!-- {{ $item->event_start }}: Menampilkan waktu mulai event. -->
                </td>
                <td class="px-6 py-4">
                    {{ $item->event_end }}      <!-- {{ $item->event_end }}: Menampilkan waktu selesai event. -->
                </td>
                <td class="px-6 py-4">
                    {{ $item->location }}   <!-- {{ $item->location }}: Menampilkan lokasi event. -->   
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@stop

@section('css') <!-- Fungsi: Digunakan untuk menambahkan stylesheet kustom jika diperlukan. 
    Tujuan: Memberikan fleksibilitas untuk menambahkan CSS khusus pada halaman ini tanpa memengaruhi layout utama.-->

{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
@stop

@section('js') <!-- Fungsi: Menambahkan script JavaScript kustom untuk halaman ini
    Memungkinkan eksekusi logika JavaScript khusus pada halaman ini.-->

    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
    <script> 
    @if (Session::has('succes'))
    toastr.success("{{ Session::get('success') }}");
    @endif
    </script> --}}
@stop
<!-- Fungsi: Menandakan akhir dari masing-masing @section.
Tujuan: Memberitahu Blade bahwa bagian tersebut telah selesai didefinisikan -->