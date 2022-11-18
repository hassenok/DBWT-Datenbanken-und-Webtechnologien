<?php
class gerichtar extends \Illuminate\Database\Eloquent\Model{
public $timestamps=false;
    protected $table='gericht';
    protected $primaryKey='id';
    function getPreisinternAttribute()
    {
        return number_format($this->attributes['preis_intern'],2,',', '.') . '€';
    }
    function getPreisexternAttribute()
    {
        return number_format($this->attributes['preis_extern'],2,',', '.') . '€';
    }
    function setVegetarischAttribute($value)
    {
        if(strtoupper(str_replace(' ','',$value)) === "YES" || strtoupper(str_replace(' ','',$value)) === "JA")
        {
            $this->attributes['vegetarisch'] = true;
        }
        elseif (strtoupper(str_replace(' ','',$value)) === "NO" || strtoupper(str_replace(' ','',$value)) === "NEIN")
        {
            $this->attributes['vegetarisch'] = false;
        }
        elseif ($value == 1 || $value == 0)
        {
            $this->attributes['vegetarisch'] = $value;
        }

        $this->save();
    }
    function setVeganAttribute($value)
    {
        if(strtoupper(str_replace(' ','',$value)) === "YES" || strtoupper(str_replace(' ','',$value)) === "JA")
        {
            $this->attributes['vegan'] = true;
        }
        elseif (strtoupper(str_replace(' ','',$value)) === "NO" || strtoupper(str_replace(' ','',$value)) === "NEIN")
        {
            $this->attributes['vegan'] = false;
        }
        elseif ($value == 1 || $value == 0)
        {
            $this->attributes['vegan'] = $value;
        }

        $this->save();
    }
}
