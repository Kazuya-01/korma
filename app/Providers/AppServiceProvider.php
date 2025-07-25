<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
{
    Filament::registerRenderHook(
        'scripts.end',
        fn (): string => <<<'HTML'
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                window.addEventListener('swal:success', event => {
                    Swal.fire({
                        icon: 'success',
                        title: event.detail.title || 'Berhasil',
                        text: event.detail.text || 'Data berhasil disimpan!',
                        confirmButtonColor: '#3085d6',
                    });
                });
            </script>
        HTML
    );

        Paginator::useBootstrapFive();
    }
}
