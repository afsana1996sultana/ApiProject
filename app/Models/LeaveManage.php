<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class LeaveManage extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = ['id'];

    public function employee(){
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
    public function leave(){
        return $this->belongsTo(Leave::class, 'leave_id', 'id');
    }
}
