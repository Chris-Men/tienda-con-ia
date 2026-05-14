<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Detallespedido
 *
 * @property $id
 * @property $pedido_id
 * @property $producto_id
 * @property $cantidad
 * @property $subtotal
 * @property $created_at
 * @property $updated_at
 *
 * @property Pedido $pedido
 * @property Producto $producto
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Detallespedido extends Model
{
    
    static $rules = [
		'pedido_id' => 'required',
		'producto_id' => 'required',
		'cantidad' => 'required',
		'subtotal' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['pedido_id','producto_id','cantidad','subtotal'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pedido()
    {
        return $this->hasOne('App\Models\Pedido', 'id', 'pedido_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function producto()
    {
        return $this->hasOne('App\Models\Producto', 'id', 'producto_id');
    }
    

}
