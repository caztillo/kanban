<?php

class Direccion extends \Eloquent {
    protected $table = 'direccion';
    public $timestamps = false;
    public $primaryKey = 'id_direccion';
    protected $guarded = ['id_direccion'];
    protected $fillable = ['id_dependencia', 'nombre', 'clave','estado','creacion'];

    public function dependencia()
    {
        //return $this->belongsTo('Class', 'local_key', 'parent_key');
        return $this->belongsTo('Dependencia', 'id_dependencia', 'id_dependencia');
    }
}