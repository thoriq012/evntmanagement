<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;

/**
     * Menampilkan Halaman Utama Dari WEB
     * Terhubung Kedalam Events Model
     * 
     */

class WelcomeController extends Controller
{
    public function index()
    {
        $events = Events::latest()->get();
        return view('welcome', compact('events'));
    }
}