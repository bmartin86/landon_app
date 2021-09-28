<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Room extends Model
{
    use HasFactory;
    public function getAvailableRooms($start_date, $end_date)
    {
        $available_rooms = DB::table('rooms as r')
                                    ->select('r.id', 'r.name')
                                    ->whereRaw("
                                    r.id NOT IN(
                                        SELECT b.room_id FROM reservations b
                                        WHERE NOT(
                                            b.date_out < '{$start_date}' OR
                                            b.date_in > '{$end_date}'
                                        )
                                    )
                                    ")
                                    ->orderBy('r.id')
                                    ->get()
        ;
        return $available_rooms;
    }
}
