<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $with = ['service', 'warehouse', 'author'];

    protected $guarded = ['id'];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function depo()
    {
        return $this->belongsTo(Depo::class);
    }

    public function CMS()
    {
        return $this->belongsTo(CMS::class);
    }

    public function logistic()
    {
        return $this->belongsTo(Logistic::class);
    }
}
