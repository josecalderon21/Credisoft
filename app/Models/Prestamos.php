<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamos extends Model
{
    use HasFactory;


    protected $fillable = [
        'cliente_id',
        'monto',
        'tasa_interes',
        'fecha_prestamo',
        'cuotas',
        'estado',
    ];

    /**
     * Los atributos que deben ser mutados a tipos de datos nativos.
     *
     * @var array
     */
    protected $casts = [
        'fecha_prestamo' => 'datetime',
        'tasa_interes' => 'decimal:2',
    ];

    /**
     * Obtener el cliente asociado con el préstamo.
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
    

    public function pagosAbonos()
    {
        return $this->hasMany(PagoAbono::class);
    }
}
