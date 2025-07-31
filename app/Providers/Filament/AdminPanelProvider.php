<?php

namespace App\Providers\Filament;

use App\Filament\Resources\AnggotaResource;
use App\Filament\Resources\KegiatanResource;
use App\Filament\Resources\PengaturanResource;
use App\Filament\Resources\TransaksiKeuanganResource;
use App\Filament\Resources\UsulanKegiatanResource;
use App\Filament\Widgets\KalenderKegiatan;
use App\Filament\Widgets\RekapAnggota;
use App\Filament\Widgets\RekapKeuangan;
use App\Filament\Widgets\WelcomeWidget;
use App\Models\Pengaturan;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        $pengaturan = Pengaturan::first();

        return $panel
            ->id('admin')
            ->path('admin')

            // 🎨 Warna bawaan modern Filament v3
            ->colors([
                'primary' => Color::Emerald,
                'secondary' => Color::Cyan,
                'success' => Color::Green,
                'warning' => Color::Amber,
                'danger' => Color::Rose,
                'info' => Color::Blue,
            ])

            // ⚡ SPA untuk transisi smooth
            ->spa()

            // 🖼 Branding organisasi
            ->brandName(fn () => $pengaturan?->nama_organisasi ?? 'KORMA Al Manshuriyah')
            ->brandLogo(fn () => $pengaturan?->logo ? Storage::url($pengaturan->logo) : null)
            ->brandLogoHeight('3rem')
            ->favicon(fn () => $pengaturan?->logo ? Storage::url($pengaturan->logo) : null)

            // 📂 Tata letak sidebar & konten
            ->sidebarCollapsibleOnDesktop()
            ->sidebarWidth('20rem')
            ->maxContentWidth('7xl')

            // 🔑 Login bawaan Filament
            ->login()

            // 📌 Auto discovery Resource, Page, Widget
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')

            // 📚 Resource terdaftar
            ->resources([
                KegiatanResource::class,
                UsulanKegiatanResource::class,
                AnggotaResource::class,
                TransaksiKeuanganResource::class,
                PengaturanResource::class,
            ])

            // 📄 Pages
            ->pages([
                Dashboard::class,
            ])

            // 📊 Widget
            ->widgets([
                WelcomeWidget::class,
                RekapKeuangan::class,
                RekapAnggota::class,
                KalenderKegiatan::class,
            ])

            // 📂 Grup Navigasi bawaan Filament v3
            ->navigationGroups([
                '📅 Manajemen Kegiatan',
                '👥 Manajemen Anggota',
                '💰 Keuangan',
                '⚙️ Pengaturan Sistem',
            ])

            // 🛡 Middleware bawaan
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])

            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
