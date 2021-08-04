<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

use \Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Collective\Html\HtmlFacade;
use Carbon\Carbon;

class Poll extends Model
{
    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    // public static $statusList = [
    //     'draft' => 'Rascunho', 
    //     'private' => 'Privado', 
    //     'publish' => 'Público', 
    //     'trash' => 'Excluído', 
    // ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function alternatives()
    {
        return $this->hasMany(Alternative::class);
    }

   
}
