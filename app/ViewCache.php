<?php
namespace App;

use Illuminate\Database\Eloquent\Model as Model;

class ViewCache extends Model
{
    protected $table = "view_cache";

    public function thread()
    {
        return $this->belongsTo('App\Thread', 'id', 'thread_id');
    }
}