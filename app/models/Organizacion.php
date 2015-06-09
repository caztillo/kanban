<?php

class Organizacion extends \Eloquent {
    protected $table = 'organizacion';
    public $timestamps = false;
    public $primaryKey = 'id_organizacion';
    protected $guarded = ['id_organizacion'];
    protected $fillable = ['nombre','razon_social','direccion','codigo_postal', 'contacto', 'telefono','correo','estado','creacion'];

	public function beneficiario_organizaciones()
    {
        //return $this->hasMany('Class', 'foreign_key', 'local_key');
        return $this->hasMany('BeneficiarioOrganizacion', 'id_organizacion', 'id_organizacion');
    }

}