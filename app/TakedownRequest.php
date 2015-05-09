<?php
namespace App;

use Illuminate\Database\Eloquent\Model as Model;

class TakedownRequest extends Model
{
    protected $table = "takedown_requests";

    public function thread()
    {
        return $this->belongsTo('App\Thread', 'id', 'thread_id');
    }
}