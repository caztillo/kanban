<?php

class BeneficiarioOrganizacion extends \Eloquent {
    protected $table = 'beneficiario_organizacion';
    public $timestamps = false;
    public $primaryKey = 'id_beneficiario_organizacion';
    protected $guarded = ['id_beneficiario_organizacion'];
    protected $fillable = ['id_beneficiario', 'id_organizacion', 'comentario','estado','inscripcion'];

    public function beneficiario()
    {
        //return $this->belongsTo('Class', 'local_key', 'parent_key');
        return $this->belongsTo('Beneficiario', 'id_beneficiario', 'id_beneficiario');
    }

    public function organizacion()
    {
        //return $this->belongsTo('Class', 'local_key', 'parent_key');
        return $this->belongsTo('Organizacion', 'id_organizacion', 'id_organizacion');
    }


}