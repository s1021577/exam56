<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
        'title', 'user_id', 'enable',
    ];
    protected $casts = [
        'enable' => 'boolean',
    ]; //處理boolean換成tinyint
    //12-8 測驗與題目的關聯，設定Exam可找出所有的題目(Topic)
    public function topics()
    {
        return $this->hasMany('App\Topic');
    }
    public function tests()
    {
        return $this->hasMany('App\Test');
    }
}
