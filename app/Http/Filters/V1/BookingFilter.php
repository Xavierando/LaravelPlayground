<?php

namespace App\Http\Filters\V1;

class BookingFilter extends QueryFilter {
    protected $sortable = [
        'date' => 's_date',
        'time' => 's_time',
        'payed' ,
        'service' => 'service_id' ,
        'user' => 'user_id',
        'createdAt' => 'created_at',
        'updatedAt' => 'updated_at'
    ];

    public function createdAt($value) {
        $dates = explode(',', $value);

        if (count($dates) > 1) {
            return $this->builder->whereBetween('created_at', $dates);
        }

        return $this->builder->whereDate('created_at', $value);
    }

    public function updatedAt($value) {
        $dates = explode(',', $value);

        if (count($dates) > 1) {
            return $this->builder->whereBetween('updated_at', $dates);
        }

        return $this->builder->whereDate('updated_at', $value);
    }

    public function date($value) {
        $dates = explode(',', $value);

        if (count($dates) > 1) {
            return $this->builder->whereBetween('s_date', $dates);
        }

        return $this->builder->whereDate('s_date', $value);
    }

    public function time($value) {
        $dates = explode(',', $value);

        if (count($dates) > 1) {
            return $this->builder->whereBetween('s_time', $dates);
        }

        return $this->builder->whereDate('s_time', $value);
    }
    public function payed($value) {
        return $this->builder->where('payed', $value);
    }

    public function user($value) {
        return $this->builder->where('user_id', $value);
    }

    public function service($value) {
        return $this->builder->where('service_id', $value);
    }
    
}
