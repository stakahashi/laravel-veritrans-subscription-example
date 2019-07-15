<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'user_id', 'plan_id'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->attributes['id'] = \Uuid::generate()->string;
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
