<?php

class Dependencia extends \Eloquent {
    protected $table = 'dependencia';
    public $timestamps = false;
    public $primaryKey = 'id_dependencia';
    protected $guarded = ['id_dependencia'];
    protected $fillable = ['nombre', 'clave', 'direccion','estado','creacion'];

    public function direccion()
    {
        //return $this->hasMany('Class', 'foreign_key', 'local_key');
        return $this->hasMany('Direccion', 'id_dependencia', 'id_dependencia');
    }
}