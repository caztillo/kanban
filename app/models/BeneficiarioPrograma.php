<?php

class BeneficiarioPrograma extends \Eloquent {
    protected $table = 'beneficiario_programa';
    public $timestamps = false;
    public $primaryKey = 'id_beneficiario_programa';
    protected $guarded = ['id_beneficiario_programa'];
    protected $fillable = ['id_beneficiario', 'id_programa', 'id_direccion','finalidad','comentarios','inscripcion'];

    public function beneficiario()
    {
        //return $this->belongsTo('Class', 'local_key', 'parent_key');
        return $this->belongsTo('Beneficiario', 'id_beneficiario', 'id_beneficiario');
    }


    public function programa()
    {
        //return $this->belongsTo('Class', 'local_key', 'parent_key');
        return $this->belongsTo('Programa', 'id_programa', 'id_programa');
    }
    
    public function direccion()
    {
        //return $this->belongsTo('Class', 'local_key', 'parent_key');
        return $this->belongsTo('Direccion', 'id_direccion', 'id_direccion');
    }
}