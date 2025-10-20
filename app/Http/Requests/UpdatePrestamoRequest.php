<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePrestamoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'equipo_id'    => 'required|exists:equipos,id',
            'encargado_id' => 'required|exists:encargados,id',
            'persona_id' => 'required|exists:personas,id',
            'estado_id'    => 'required|exists:estados,id',
            'fecha_prestamo'   => 'required|date',
            'fecha_devolucion' => 'nullable|date|after_or_equal:fecha_prestamo',
            'observaciones'    => 'nullable|string|max:500',
        ];
    }
}
