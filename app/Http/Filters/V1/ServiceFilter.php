<?php

namespace App\Http\Filters\V1;

class ServiceFilter extends QueryFilter {
    protected $sortable = [
        'title',
        'price',
        'duration' ,
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

    public function price($value) {
        $likeStr = '*'.$value.'*';
        return $this->builder->where('price', $likeStr);
    }

    public function duration($value) {
        $interval = intval($value)*60;
        return $this->builder->where('duration', $interval);
    }

    public function title($value) {
        $likeStr = str_replace('*', '%', $value);
        return $this->builder->where('title', 'like', $likeStr);
    }

    public function updatedAt($value) {
        $dates = explode(',', $value);

        if (count($dates) > 1) {
            return $this->builder->whereBetween('updated_at', $dates);
        }

        return $this->builder->whereDate('updated_at', $value);
    }

    
}