<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_cotizacion',
        'id_empresa',
        'id_cliente',
        'id_contacto_cliente',
        'monto',
        'tipo_pago',
        'nota_pago',
        'nota_pedido',
        'c_direccion',
        'c_distrito',
        'c_provincia',
        'c_departamento',
        'c_referencia',
        'estado',
        'fecha_cotizacion',
        'fecha_entrega',
    ];
        // Indicar el nombre de la tabla
        protected $table = 'cotizaciones';

        public $timestamps = true;

        public function productos()
        {
            return $this->hasMany(CotizacionProducto::class, 'id_cotizacion');
        }

        //Relaciones con empresas, clientes y contacto_clientes
        public function empresa()
        {
            return $this->belongsTo(Empresa::class, 'id_empresa');
        }

        public function cliente()
        {
            return $this->belongsTo(Cliente::class, 'id_cliente');
        }

        public function contactoCliente()
        {
            return $this->belongsTo(ContactoCliente::class, 'id_contacto_cliente');
        }
}
