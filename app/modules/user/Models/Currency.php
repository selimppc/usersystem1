<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 2/15/16
 * Time: 11:41 AM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;


class Currency extends Model
{

    protected $table = 'currency';
    protected $fillable=['title','value','description'];

}