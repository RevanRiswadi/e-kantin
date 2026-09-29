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

    /** Format nomor WhatsApp standar internasional (62...) */
    public function getFormattedWhatsappAttribute(): string
    {
        $phone = preg_replace('/[^0-9]/', '', (string) $this->whatsapp);
        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }
        return $phone;
    }

    /** Link pesan WhatsApp otomatis untuk notifikasi kasir */
    public function getWaNotificationUrlAttribute(): string
    {
        $phone = $this->formatted_whatsapp;
        $code  = $this->queue_code ?? ('#' . $this->id);

        $itemsList = $this->items->map(function ($item) {
            $name = $item->menu->name ?? 'Item';
            return "- {$name} (x{$item->quantity})";
        })->implode("\n");

        $statusMessage = match($this->status) {
            'ready'      => "✅ *PESANAN SUDAH SIAP DIAMBIL!*\nSilakan langsung ke stand kantin untuk mengambil pesananmu ya.",
            'processing' => "⚙️ *PESANAN SEDANG DIPROSES!*\nPenjual sedang menyiapkan makanan/minumanmu.",
            'completed'  => "🏁 *PESANAN SELESAI!*\nTerima kasih sudah memesan di E-Kantin SMKN 1 Ciomas. Selamat menikmati!",
            default      => "🕒 *PESANAN DITERIMA!*\nPesananmu sedang dalam antrean kantin.",
        };

        $message = "Halo *{$this->student_name}* ({$this->class_major})! 👋\n\n"
                 . "Update pesanan kamu dari *E-Kantin SMKN 1 Ciomas*:\n"
                 . "🎫 No. Antrean: *{$code}*\n"
                 . "⏰ Pengambilan: *{$this->break_time}*\n"
                 . "📌 Status: {$statusMessage}\n\n"
                 . "📋 *Rincian Menu:*\n{$itemsList}\n\n"
                 . "💰 *Total:* Rp " . number_format($this->total_price, 0, ',', '.') . " (" . strtoupper($this->payment_method) . ")\n\n"
                 . "_Pesan otomatis dari Kasir E-Kantin SMKN 1 Ciomas_";

        return 'https://wa.me/' . $phone . '?text=' . rawurlencode($message);
    }
}
