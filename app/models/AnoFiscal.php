<?php

class AnoFiscal extends \Eloquent {
    protected $table = 'ano';
    public $timestamps = false;
    public $primaryKey = 'id_ano';
    protected $guarded = ['id_ano'];
    protected $fillable = ['descripcion', 'fecha_inicio', 'fecha_termino','estado','creacion'];


}