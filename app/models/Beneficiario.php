<?php

class Beneficiario extends \Eloquent {
    protected $table = 'beneficiario';
    public $timestamps = false;
    public $primaryKey = 'id_beneficiario';
    protected $guarded = ['id_beneficiario'];
    protected $fillable = ['nombre', 'direccion', 'codigo_postal', 'telefono', 'correo','fecha_nacimiento','pais_nacionalidad','RFC','CURP','estado','creacion'];

    public function beneficiario_organizaciones()
    {
        //return $this->hasMany('Class', 'foreign_key', 'local_key');
        return $this->hasMany('BeneficiarioOrganizacion', 'id_beneficiario', 'id_beneficiario');
    }

}