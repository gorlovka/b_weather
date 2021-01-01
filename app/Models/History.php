<?php

/*
 *   Created on: Dec 30, 2020   11:24:01 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{

    public $timestamps = false;
    protected $table = 'history';

    public function getId()
    {
        return $this->id;
    }

    public function setId($value)
    {
        $this->id = $value;
        return $this;
    }

    public function getTemp()
    {
        return $this->temp;
    }

    public function setTemp($value)
    {
        $this->temp = $value;
        return $this;
    }

    public function getDateAt()
    {
        return $this->date_at;
    }

    public function setDateAt($value)
    {
        $this->date_at = $value;
        return $this;
    }

}
