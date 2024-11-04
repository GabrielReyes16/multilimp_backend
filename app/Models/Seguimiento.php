<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    use HasFactory;

    protected $table = 'seguimientos';

    protected $fillable = [
        'fecha_emision', 'oce', 'ocf', 'id_empresa', 'id_cliente', 'catalogo',
        'fecha_form', 'fecha_max_form', 'monto_venta', 'siaf', 'cprovincia',
        'cdistrito', 'cdepartamento', 'cdireccion', 'creferencia', 'productos',
        'etapa_siaf', 'fecha_siaf', 'factura', 'fecha_factura', 'grr', 'retencion',
        'detraccion', 'forma_envio', 're_factura', 're_fecha_factura', 're_grr',
        're_retencion', 're_detraccion', 're_forma_envio', 'nota_credito', 'id_venta',
        'contacto_cliente', 'op_proveedor', 'cargo_entrega', 'peru_compras',
        'fecha_peru_compras', 'fecha_entrega_oc', 'contacto_cobrador', 'monto_retencion',
        'monto_detraccion', 'penalidad', 'neto_cobrado', 'estado_moroza', 'fecha_cobro',
        'proxima_gestion', 'estado_activo', 'estado_facturacion', 'estado_tesoreria',
        'inicio_cobranza', 'fin_cobranza'
    ];

    //Relaciones para traer datos de cliente y de empresa
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'id_empresa');
    }

    //Relacion para ver las OP ligadas al seguimiento
    public function ordenPedido()
    {
        return $this->hasOne(OrdenPedido::class, 'id_seguimiento');
    }
    public function  contactoCobrador()
    {
        return $this -> hasOne(User::class,  'id', 'contacto_cobrador');
    }

    public function contactoCliente()
    {
        return $this-> hasOne(ContactoCliente::class, 'id', 'contacto_cliente');
    }

}
