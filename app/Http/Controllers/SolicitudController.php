<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitud;
use Illuminate\Support\Facades\Auth;

class SolicitudController extends Controller
{

    public function index()
    {
        $solicitudes = Solicitud::where('status', 'pending')->with('usuario')->get();
        return view('admin.solicitudes', compact('solicitudes'));
    }   


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


    public function update(Request $request, Solicitud $solicitud)
    {
        $accion = $request->input('accion');

        if ($accion === 'aceptar') {
            $solicitud->status = 'accepted';
            $solicitud->usuario->rol = 'critico';
            $solicitud->usuario->save();
        } elseif ($accion === 'rechazar') {
            $solicitud->status = 'rejected';
        }

        $solicitud->save();

        return redirect()->route('solicitudes.index')->with('success', 'Solicitud actualizada correctamente.');
    }
}
