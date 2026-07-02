<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParticipationMark extends Model
{
    protected $primaryKey = 'mark_id';
    protected $fillable = ['user_id', 'group_id', 'criteria', 'score', 'period'];

    public function user() { return $this->belongsTo(User::class, 'user_id'); }
    public function group() { return $this->belongsTo(Group::class, 'group_id'); }
}