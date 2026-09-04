<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function getWhatsAppUrl($productName, $price, $productUrl = null)
    {
        // Ambil nomor dari setting DB atau gunakan default dari .env/fallback
        $phone = self::where('key', 'whatsapp_number')->value('value') ?? env('WHATSAPP_NUMBER', '6281234567890');
        
        $message = "Halo Fania Flower Shop, saya ingin memesan produk berikut:\n\n";
        $message .= "Nama Produk: " . $productName . "\n";
        $message .= "Harga: Rp " . number_format($price, 0, ',', '.') . "\n";
        
        if ($productUrl) {
            $message .= "Link Produk: " . $productUrl . "\n";
        }
        
        $message .= "\nApakah produk ini masih tersedia?";

        return 'https://wa.me/' . $phone . '?text=' . urlencode($message);
    }
}
