<?php

class Direccion extends \Eloquent {
    protected $table = 'direccion';
    public $timestamps = false;
    public $primaryKey = 'id_direccion';
    protected $guarded = ['id_ano'];
    protected $fillable = ['descripcion', 'fecha_inicio', 'fecha_termino','estado','creacion'];


}