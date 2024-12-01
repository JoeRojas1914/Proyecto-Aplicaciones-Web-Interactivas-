<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitud;
use Illuminate\Support\Facades\Auth;

class SolicitudController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'archivo' => 'required|file|mimes:pdf,jpeg,png|max:2048', 
        ]);


        $fileContent = file_get_contents($request->file('archivo')->getRealPath());

        Solicitud::create([
            'user_id' => Auth::id(), 
            'file' => $fileContent, 
            'status' => 'pending',
        ]);

        return redirect()->back()->with('status', 'profile-updated');
    }
}
