<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    protected $fillable = [
        'packageId',
        'orgIdPrefix',
        'name',
        'domain',
        'email',
        'favicon',
        'logo',
        'theme',
        'skin',
        'detailsinfo',
        'status',
    ];
}
