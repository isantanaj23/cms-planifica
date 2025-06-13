<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    /**
     * Mostrar lista de servicios
     */
    public function index()
    {
        $services = Service::orderBy('order', 'asc')->get();
        return view('admin.services.index', compact('services'));
    }

    /**
     * Mostrar formulario para crear servicio
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Guardar nuevo servicio
     */
    public function store(Request $request)
    {
        // DEBUG: Ver qué datos llegan
        \Log::info('Datos del formulario:', $request->all());
        \Log::info('Checkbox is_active:', ['has' => $request->has('is_active'), 'boolean' => $request->boolean('is_active')]);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'icon' => 'required|string|max:100',
            'image' => 'nullable|string|max:500',
            'is_active' => 'boolean',
            'order' => 'nullable|integer|min:0'
        ]);

        // Generar slug
        $validated['slug'] = Str::slug($validated['title']);
        
        // Si no se especifica orden, usar el siguiente disponible
        if (!isset($validated['order']) || $validated['order'] === null) {
            $validated['order'] = Service::max('order') + 1;
        }

        // Asegurarse de que is_active tenga un valor
        $validated['is_active'] = $request->boolean('is_active');
        
        // DEBUG: Ver datos finales
        \Log::info('Datos validados:', $validated);

        try {
            $service = Service::create($validated);
            \Log::info('Servicio creado:', $service->toArray());
            
            return redirect()->route('admin.services.index')
                ->with('success', '¡Servicio creado exitosamente!');
        } catch (\Exception $e) {
            \Log::error('Error creando servicio:', ['error' => $e->getMessage()]);
            return redirect()->back()
                ->with('error', 'Error al crear servicio: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Mostrar servicio específico
     */
    public function show(Service $service)
    {
        return view('admin.services.show', compact('service'));
    }

    /**
     * Mostrar formulario para editar servicio
     */
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Actualizar servicio
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'icon' => 'required|string|max:100',
            'image' => 'nullable|string|max:500',
            'is_active' => 'boolean',
            'order' => 'nullable|integer|min:0'
        ]);

        // Actualizar slug si cambió el título
        if ($service->title !== $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Asegurarse de que is_active tenga un valor
        $validated['is_active'] = $request->boolean('is_active');

        $service->update($validated);

        return redirect()->route('admin.services.index')
            ->with('success', '¡Servicio actualizado exitosamente!');
    }

    /**
     * Eliminar servicio
     */
    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'Servicio eliminado exitosamente.');
    }

    /**
     * Cambiar estado activo/inactivo
     */
    public function toggleStatus(Service $service)
    {
        \Log::info('Toggle Status llamado:', [
            'service_id' => $service->id,
            'current_status' => $service->is_active
        ]);

        try {
            $service->update([
                'is_active' => !$service->is_active
            ]);
            
            $status = $service->is_active ? 'activado' : 'desactivado';
            
            \Log::info('Estado cambiado:', [
                'service_id' => $service->id,
                'new_status' => $service->is_active,
                'message' => "Servicio {$status} exitosamente."
            ]);

            return response()->json([
                'success' => true,
                'message' => "Servicio {$status} exitosamente.",
                'is_active' => $service->is_active
            ]);
        } catch (\Exception $e) {
            \Log::error('Error en toggleStatus:', [
                'service_id' => $service->id,
                'error' => $e->getMessage()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Error al cambiar estado: ' . $e->getMessage()
            ], 500);
        }
    }
}