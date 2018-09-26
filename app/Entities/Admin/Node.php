<?php

namespace App\Entities\Admin;

use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    //
    protected $fillable = [
    						'title', 'alias', 'keyword', 'description', 
    						'active', 'from_date', 'to_date', 'content1', 
    						'content2', 'content3', 'content4',
    						'media1', 'media2', 'media3', 'media4', 'template', 'lang_id', 
                            'insert_by', 'update_by',
						];

	/**
     * Get the images that owns the node.
     */
    public function getImages()
    {
        return $this->hasOne('App\Entities\Admin\Mediastorages', 'id', 'media1')->where(['tablename' => 'nodes', 'active' => 1]);
    }

    public function getImages2()
    {
        return $this->hasOne('App\Entities\Admin\Mediastorages', 'id', 'media2')->where(['tablename' => 'nodes', 'active' => 1]);
    }

    public function getImages3()
    {
        return $this->hasOne('App\Entities\Admin\Mediastorages', 'id', 'media3')->where(['tablename' => 'nodes', 'active' => 1]);
    }

    public function getImages4()
    {
        return $this->hasOne('App\Entities\Admin\Mediastorages', 'id', 'media4')->where(['tablename' => 'nodes', 'active' => 1]);
    }
    
}
