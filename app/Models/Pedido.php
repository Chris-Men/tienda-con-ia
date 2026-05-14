<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Pedido
 *
 * @property $id
 * @property $cliente_id
 * @property $fecha_pedido
 * @property $total
 * @property $estado
 * @property $created_at
 * @property $updated_at
 *
 * @property Cliente $cliente
 * @property DetallesPedido[] $detallesPedidos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Pedido extends Model
{
    
    static $rules = [
		'cliente_id' => 'required',
		'fecha_pedido' => 'required',
		'total' => 'required',
		'estado' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['cliente_id','fecha_pedido','total','estado'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cliente()
    {
        return $this->hasOne('App\Models\Cliente', 'id', 'cliente_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detallesPedidos()
    {
        return $this->hasMany('App\Models\DetallesPedido', 'pedido_id', 'id');
    }
    

}
