<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoAbono extends Model
{
    use HasFactory;
    protected $table = 'pagos_abonos';


    protected $fillable = [
        'cliente_id',
        'prestamo_id',
        'fecha_pago_abono',
        'monto',
        'saldo_restante',
        'estado',
        'notas',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function prestamos()
    {
        return $this->belongsTo(Prestamos::class);
    }
}
