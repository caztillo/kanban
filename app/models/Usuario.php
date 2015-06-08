<?php

class Usuario extends \Eloquent {
    protected $table = 'dependencia';
    public $timestamps = false;
    public $primaryKey = 'id_dependencia';
    protected $guarded = ['id_dependencia'];
    protected $fillable = ['id_rol', 'id_dependencia', 'nombre', 'num_empleado', 'correo', 'correo', 'contrasena', 'estado','creacion'];
}