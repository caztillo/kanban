<?php

class Programa extends \Eloquent {
    protected $table = 'programa';
    public $timestamps = false;
    public $primaryKey = 'id_programa';
    protected $guarded = ['id_programa'];
    protected $fillable = ['nombre', 'clave', 'direccion','estado','creacion'];

    public function direcciones()
    {
        //return $this->hasMany('Class', 'foreign_key', 'local_key');
        return $this->hasMany('Direccion', 'id_dependencia', 'id_dependencia');
    }
}