<?php

namespace App\Filament\Widgets;

use Guava\Calendar\Widgets\CalendarWidget;
use App\Models\Kegiatan;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;

class KalenderKegiatan extends CalendarWidget
{
    protected string $calendarView = 'dayGridMonth';

    protected static bool $isLazy = false;

    public function getEvents(array $fetchInfo = []): Collection|array
{
    $today = now()->toDateString(); // tanggal hari ini, tanpa jam

    return Kegiatan::all()->map(function ($kegiatan) use ($today) {
        $tanggal = Carbon::parse($kegiatan->tanggal)->toDateString(); 

        // Default warna: kuning (belum terjadi)
        $color = '#facc15';

        if ($tanggal < $today) {
            // Sudah lewat
            $color = $kegiatan->terlaksana
                ? '#16a34a' // hijau jika terlaksana
                : '#f43f5e'; // merah jika tidak terlaksana
        }

        return [
            'title' => $kegiatan->nama_kegiatan,
            'start' => $tanggal,
            'end'   => Carbon::parse($tanggal)->addDay()->toDateString(),
            'color' => $color,
            'allDay' => true,
        ];
    });
}
}
