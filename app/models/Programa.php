<?php

class Programa extends \Eloquent {
    protected $table = 'programa';
    public $timestamps = false;
    public $primaryKey = 'id_programa';
    protected $guarded = ['id_programa'];
    protected $fillable = ['id_ano','id_dependencia','clave', 'descripcion','convocatoria','estado','creacion'];



    public function ano_fiscal()
    {
        return $this->belongsTo('AnoFiscal', 'id_ano', 'id_ano');
    }

    public function dependencia()
    {
        return $this->belongsTo('Dependencia', 'id_dependencia', 'id_dependencia');
    }



}