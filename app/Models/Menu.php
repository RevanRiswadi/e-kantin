<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['name', 'category', 'stand', 'price', 'image', 'stock', 'is_available'];

    /** Apakah menu masih bisa dipesan (tersedia + stok > 0 atau stok tidak dibatasi) */
    public function isOrderable(): bool
    {
        if (! $this->is_available) return false;
        if (! is_null($this->stock) && $this->stock <= 0) return false;
        return true;
    }

    /** Label badge stok */
    public function stockLabel(): string
    {
        if (is_null($this->stock)) return '';
        if ($this->stock <= 0) return 'Habis';
        if ($this->stock <= 5) return "Sisa {$this->stock} porsi";
        return "Stok {$this->stock}";
    }

    /** Warna badge stok */
    public function stockColor(): string
    {
        if (is_null($this->stock)) return '';
        if ($this->stock <= 0) return 'bg-red-500/20 text-red-400 border-red-500/30';
        if ($this->stock <= 5) return 'bg-orange-500/20 text-orange-400 border-orange-500/30';
        return 'bg-emerald-500/20 text-emerald-400 border-emerald-500/30';
    }
}
