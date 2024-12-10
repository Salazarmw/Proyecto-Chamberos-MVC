<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'quotation_id',
        'status',
        'client_ok',
        'chambero_ok',
    ];

    /**
     * Relación con la tabla de cotizaciones.
     */
    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

    /**
     * Verifica si el trabajo está completado exitosamente.
     *
     * @return bool
     */
    public function isCompletedSuccessfully()
    {
        return $this->client_ok === 'success' && $this->chambero_ok === 'success';
    }

    /**
     * Verifica si el trabajo falló.
     *
     * @return bool
     */
    public function isFailed()
    {
        return $this->client_ok === 'failed' || $this->chambero_ok === 'failed';
    }
}
