<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $table = "tickets";
    protected $fillable =
    [
        'buses_id',
        'customer_name',
        'email',
        'phone_number',
        'quantity',
        'identity_card',
        'status',
        'totalPrice',
        'description',

    ];
    public function buses(){
        return $this->belongsTo(Buses::class,'buses_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    // public function Buses(){
    //     return $this->belongsToMany(Buses::class, 'buses_tickes','ticket_id', 'buses_id');
    // }

}
