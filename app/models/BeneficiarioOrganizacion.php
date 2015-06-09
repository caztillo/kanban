<?php

class BeneficiarioOrganizacion extends \Eloquent {
    protected $table = 'beneficiario_organizacion';
    public $timestamps = false;
    public $primaryKey = 'id_beneficiario_organizacion';
    protected $guarded = ['id_beneficiario_organizacion'];
    protected $fillable = ['id_beneficiario', 'id_organizacion', 'comentarios','estado','inscripcion'];

    public function beneficiario()
    {
        //return $this->belongsTo('Class', 'local_key', 'parent_key');
        return $this->belongsTo('Beneficiario', 'id_beneficiario', 'id_beneficiario');
    }



}