<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Dyrynda\Database\Support\GeneratesUuid;
use Dyrynda\Database\Support\BindsOnUuid;

class Attendee extends Model
{
    use HasFactory, GeneratesUuid, BindsOnUuid;
    
    /**
     * 
     * @fillable Array
     */
    protected $fillable = ['dispenser_id', 'uuid', 'opened_at', 'closed_at', 'total_spent'];
}
