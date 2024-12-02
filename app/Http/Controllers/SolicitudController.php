<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitud;
use Illuminate\Support\Facades\Auth;

class SolicitudController extends Controller
{

    public function index()
    {
        $solicitudes = Solicitud::where('status', 'pending')->with('user')->get();
        return view('admin.index', compact('solicitudes'));
    }   


    public function store(Request $request)
    {
        $validated = $request->validate([
            'archivo' => 'required|file|mimes:pdf,jpeg,png|max:2048', 
        ]);


        $filePath = $request->file('archivo')->store('solicitudes', 'public');

        Solicitud::create([
            'user_id' => Auth::id(), 
            'file' => $filePath, 
            'status' => 'pending',
        ]);

        return redirect()->back()->with('status', 'profile-updated');
    }


    public function update(Request $request, Solicitud $solicitud)
    {
        $accion = $request->input('accion');

        if ($accion === 'aceptar') {
            $solicitud->status = 'accepted';
            $solicitud->user->rol = 'critico';
            $solicitud->user->save();
        } elseif ($accion === 'rechazar') {
            $solicitud->status = 'rejected';
        }

        $solicitud->save();

        return redirect()->route('admin.index')->with('success', 'Solicitud actualizada correctamente.');
    }
}
