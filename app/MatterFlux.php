<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatterFlux extends Model
{
    protected $table = 'matter_flux';

	protected $fillable = ['matter_id','id_m_predecessors'];

    //
    //public function getRouteKeyName()
    //{
    //    return redirect()->route('UsersViews.administrador.carreras.index');
    //}
    //public function Career()
    //{
    //    return $this->hasMany('App\Career');
    //}

    public function matters()
    {
        return $this->belongsToMany(Matter::class);
    }


 /**
     * Set the categories
     *
     */
    public function setMatFlux($value)
    {
        $this->attributes['id_m_predecessors'] = json_encode($value);
    }
  
    /**
     * Get the categories
     *
     */
    public function getMatFlux($value)
    {
        return $this->attributes['id_m_predecessors'] = json_decode($value);
    }




}