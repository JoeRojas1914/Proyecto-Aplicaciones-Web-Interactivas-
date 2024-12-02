<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Administración') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-2xl font-bold mb-4">Solicitudes para Perfil Verificado</h3>
                
                @if($solicitudes->isEmpty())
                    <p class="text-gray-500">No hay solicitudes pendientes.</p>
                @else
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th class="px-6 py-3 text-left">Usuario</th>
                                <th class="px-6 py-3 text-left">Archivo</th>
                                <th class="px-6 py-3 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($solicitudes as $solicitud)
                                <tr>
                                    <td class="px-6 py-4">{{ $solicitud->user->name }}</td>
                                    <td class="px-6 py-4">
                                        <a href="{{ asset('storage/' . $solicitud->archivo) }}" target="_blank" class="text-primary">Ver archivo</a>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <form method="POST" action="{{ route('admin.update', $solicitud) }}" class="d-inline-block">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="accion" value="aceptar">
                                            <button type="submit" class="btn btn-success">
                                                Autorizar
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.update', $solicitud) }}" class="d-inline-block">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="accion" value="rechazar">
                                            <button type="submit" class="btn btn-danger">
                                                Rechazar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
