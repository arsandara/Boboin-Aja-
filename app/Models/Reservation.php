<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'reservations';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'reservation_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'guest_name',
        'guest_email',
        'guest_phone',
        'guest_dob',
        'room_id',
        'room_name',
        'room_number',
        'person',
        'check_in',
        'check_out',
        'duration',
        'early_checkin',
        'late_checkout',
        'extra_bed',
        'base_price',
        'request_price',
        'subtotal',
        'tax',
        'total_price',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
        'guest_dob' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'early_checkin' => 'boolean',
        'late_checkout' => 'boolean',
        'extra_bed' => 'boolean',
        'base_price' => 'float',
        'request_price' => 'float',
        'subtotal' => 'float',
        'tax' => 'float',
        'total_price' => 'float',
    ];

    protected $dates = [
        'check_in',
        'check_out',
        'created_at',
        'updated_at'
    ];

    /**
     * Get the room that the reservation belongs to.
     */
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'room_id');
    }

    /**
     * Format the price to rupiah format.
     *
     * @param float $price
     * @return string
     */
    public static function formatRupiah($price)
    {
        return 'Rp. ' . number_format($price, 0, ',', '.');
    }
}