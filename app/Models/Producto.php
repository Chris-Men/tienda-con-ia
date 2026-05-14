<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Producto
 *
 * @property $id
 * @property $nombre
 * @property $descripcion
 * @property $stock
 * @property $precio
 * @property $imagen
 * @property $id_categoria
 * @property $created_at
 * @property $updated_at
 *
 * @property Categoria $categoria
 * @property Detallespedido[] $detallespedidos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Producto extends Model
{
    
    static $rules = [
		'nombre' => 'required',
		'descripcion' => 'required',
		'stock' => 'required',
		'precio' => 'required',
		// 'imagen' => 'required',
		'id_categoria' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','descripcion','stock','precio','imagen','id_categoria'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function categoria()
    {
        return $this->hasOne('App\Models\Categoria', 'id', 'id_categoria');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detallespedidos()
    {
        return $this->hasMany('App\Models\Detallespedido', 'producto_id', 'id');
    }
    

}
