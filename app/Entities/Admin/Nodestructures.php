<?php

namespace App\Entities\Admin;

use Illuminate\Database\Eloquent\Model;

class Nodestructures extends Model
{
    protected $fillable = ['child_node_id', 'parent_node_id', 'priority', 'active'];

    /**
     * Get the post that owns the comment.
     */
    public function node()
    {
        return $this->belongsTo('App\Entities\Admin\Node', 'child_node_id')->where('nodes.active', 1);
    }
}
