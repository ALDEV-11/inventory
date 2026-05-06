<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Barang;

class StokMinimumNotification extends Notification
{
    use Queueable;

    private $barang;

    public function __construct(Barang $barang)
    {
        $this->barang = $barang;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'type' => 'stok_minimum',
            'title' => 'Peringatan Stok Minimum',
            'message' => 'Stok ' . $this->barang->nama_barang . ' telah mencapai atau berada di bawah batas minimum.',
            'id_barang' => $this->barang->id_barang,
            'nama_barang' => $this->barang->nama_barang,
            'stok_saat_ini' => $this->barang->stok_saat_ini,
            'stok_min' => $this->barang->stok_min,
            'url' => route('barang.show', $this->barang->id_barang)
        ];
    }
}
