<?php

class Dependencia extends \Eloquent {
    protected $table = 'dependencia';
    public $timestamps = false;
    public $primaryKey = 'id_dependencia';
    protected $guarded = ['id_dependencia'];
    protected $fillable = ['nombre', 'clave', 'direccion','estado','creacion'];
}