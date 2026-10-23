<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pizza;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PizzaController extends Controller
{
    /**
     * Mostrar todas las pizzas.
     */
    public function index(): View
    {
        $pizzas = Pizza::query()
            ->orderBy('name')
            ->get();

        return view('admin.pizzas.index', compact('pizzas'));
    }

    /**
     * Mostrar el formulario para crear una pizza.
     */
    public function create(): View
    {
        return view('admin.pizzas.create');
    }

    /**
     * Guardar una nueva pizza.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'required',
                'string',
                'max:2000',
            ],
            'price' => [
                'required',
                'numeric',
                'decimal:0,2',
                'min:0.01',
                'max:999999.99',
            ],
            'image_url' => [
                'nullable',
                'url:http,https',
                'max:255',
            ],
        ], [
            'name.required' => 'El nombre de la pizza es obligatorio.',
            'name.max' => 'El nombre no puede superar los 255 caracteres.',
            'description.required' => 'La descripción es obligatoria.',
            'description.max' => 'La descripción no puede superar los 2000 caracteres.',
            'price.required' => 'El precio es obligatorio.',
            'price.numeric' => 'El precio debe ser un número.',
            'price.decimal' => 'El precio puede tener como máximo dos decimales.',
            'price.min' => 'El precio debe ser superior a cero.',
            'price.max' => 'El precio supera el límite permitido.',
            'image_url.url' => 'Introduce una URL válida que empiece por http o https.',
            'image_url.max' => 'La URL de la imagen es demasiado larga.',
        ]);

        // Las pizzas nuevas estarán disponibles por defecto.
        $validated['is_available'] = true;

        Pizza::create($validated);

        return redirect()
            ->route('admin.pizzas.index')
            ->with('success', '¡Pizza creada correctamente!');
    }

    /**
     * Mostrar el formulario para editar una pizza.
     */
    public function edit(Pizza $pizza): View
    {
        return view('admin.pizzas.edit', compact('pizza'));
    }

    /**
     * Actualizar una pizza existente.
     */
    public function update(
        Request $request,
        Pizza $pizza
    ): RedirectResponse {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'required',
                'string',
                'max:2000',
            ],
            'price' => [
                'required',
                'numeric',
                'decimal:0,2',
                'min:0.01',
                'max:999999.99',
            ],
            'image_url' => [
                'nullable',
                'url:http,https',
                'max:255',
            ],
        ], [
            'name.required' => 'El nombre de la pizza es obligatorio.',
            'name.max' => 'El nombre no puede superar los 255 caracteres.',
            'description.required' => 'La descripción es obligatoria.',
            'description.max' => 'La descripción no puede superar los 2000 caracteres.',
            'price.required' => 'El precio es obligatorio.',
            'price.numeric' => 'El precio debe ser un número.',
            'price.decimal' => 'El precio puede tener como máximo dos decimales.',
            'price.min' => 'El precio debe ser superior a cero.',
            'price.max' => 'El precio supera el límite permitido.',
            'image_url.url' => 'Introduce una URL válida que empiece por http o https.',
            'image_url.max' => 'La URL de la imagen es demasiado larga.',
        ]);

        // Solo actualizamos los campos permitidos.
        $pizza->update($validated);

        return redirect()
            ->route('admin.pizzas.index')
            ->with('success', '¡Pizza actualizada correctamente!');
    }

    /**
     * Activar o desactivar una pizza.
     */
    public function toggleAvailability(Pizza $pizza): RedirectResponse
    {
        $pizza->update([
            'is_available' => !$pizza->is_available,
        ]);

        $message = $pizza->is_available
            ? '¡Pizza activada correctamente!'
            : '¡Pizza desactivada correctamente!';

        return redirect()
            ->route('admin.pizzas.index')
            ->with('success', $message);
    }

    /**
     * Eliminar una pizza.
     */
    public function destroy(Pizza $pizza): RedirectResponse
    {
        $pizza->delete();

        return redirect()
            ->route('admin.pizzas.index')
            ->with('success', 'Pizza eliminada correctamente.');
    }
}
