<?php

class Organizaciones extends \Eloquent {
    protected $table = 'organizacion';
    public $timestamps = false;
    public $primaryKey = 'id_organizacion';
    protected $guarded = ['id_organizacion'];
    protected $fillable = ['nombre','razon_social','direccion','codigo_postal', 'contacto', 'telefono','correo','estado','creacion'];
}