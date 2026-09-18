<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'student_name', 'class_major', 'whatsapp',
        'break_time', 'total_price', 'status',
        'queue_code', 'payment_method',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /** Label badge status untuk tampilan */
    public function statusLabel(): string
    {
        return match($this->status) {
            'pending'    => '🕒 Pending',
            'processing' => '⚙️ Diproses',
            'ready'      => '✅ Siap Ambil',
            'completed'  => '🏁 Selesai',
            default      => $this->status,
        };
    }

    /** Warna badge status */
    public function statusColor(): string
    {
        return match($this->status) {
            'pending'    => 'bg-amber-100 text-amber-600',
            'processing' => 'bg-blue-100 text-blue-600',
            'ready'      => 'bg-emerald-100 text-emerald-600',
            'completed'  => 'bg-slate-100 text-slate-500',
            default      => 'bg-slate-100 text-slate-500',
        };
    }
}
