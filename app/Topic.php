<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    //
    protected $fillable = [
        'topic', 'exam_id', 'opt1', 'opt2', 'opt3', 'opt4', 'ans',
    ];
    //12-8 測驗與題目的關聯，設定Topic可找所屬於的測驗
    public function exam()
    {
        return $this->belongsTo('App\Exam');
    }
}
