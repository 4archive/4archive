<?php
namespace App;

use Illuminate\Database\Eloquent\Model as Model;

class UpdateRecord extends Model
{
    protected $table = "update_records";

    public function thread()
    {
        return $this->belongsTo('App\Thread', 'id', 'thread_id');
    }
}