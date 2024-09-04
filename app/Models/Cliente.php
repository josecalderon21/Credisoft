<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'nombre',
        'apellido',
        'tipo_documento',
        'documento_identidad',
        'telefono',
        'direccion',
        'email',
    ];
    
    
    use HasFactory;
    public function pagosAbonos()
    {
        return $this->hasMany(PagoAbono::class);
    }

    // Concatenar nombre y apellido
    public function getFullNameAttribute()
    {
        return $this->nombre . ' ' . $this->apellido;
    }

}
