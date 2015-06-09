<?php

class OrganizacionPrograma extends \Eloquent {
    protected $table = 'organizacion_programa';
    public $timestamps = false;
    public $primaryKey = 'id_organizacion_programa';
    protected $guarded = ['id_organizacion_programa'];
    protected $fillable = ['id_organizacion', 'id_programa', 'id_direccion','finalidad','comentarios','inscripcion'];

    public function organizacion()
    {
        //return $this->belongsTo('Class', 'local_key', 'parent_key');
        return $this->belongsTo('Organizacion', 'id_organizacion', 'id_organizacion');
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