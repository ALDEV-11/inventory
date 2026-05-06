<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Sistem - SmartStock</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist-dashboard/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-dashboard/assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-dashboard/assets/css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="shortcut icon" href="{{ asset('dist-dashboard/assets/images/logo/logo.png') }}" type="image/x-icon">

</head>

<body>
<div id="app">
    <div id="sidebar" class="active">
        <div class="sidebar-wrapper active">
            @include('partials.sidebar-header')
            @php
                $role = Auth::user()->role;
                $sidebarView = ($role == 'admin') ? 'admin.partials.sidebar' : (($role == 'petugas') ? 'petugas.partials.sidebar' : 'kepala.partials.sidebar');
            @endphp
            @include($sidebarView)
        </div>
    </div>

    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3>Notifikasi Sistem</h3>
                    <p class="text-subtitle text-muted">Pusat pemberitahuan dan peringatan stok minimum</p>
                </div>
                @if(Auth::user()->unreadNotifications->count() > 0)
                <form action="{{ route('notifikasi.markAllAsRead') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-primary px-4 shadow-sm fw-bold">
                        <i class="fas fa-check-double me-2"></i> Tandai Semua Dibaca
                    </button>
                </form>
                @endif
            </div>
        </div>

<div class="page-content">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible show fade shadow-sm mb-4" style="border-left: 5px solid #4fbe87;">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0" style="border-radius: 12px;">
        <div class="card-body p-0">
            <div class="list-group list-group-flush rounded" style="border-radius: 12px;">
                @forelse($notifications as $notif)
                    <div class="list-group-item list-group-item-action p-4 border-bottom {{ is_null($notif->read_at) ? 'bg-light' : '' }}">
                        <div class="d-flex w-100 justify-content-between align-items-center">
                            <div class="d-flex align-items-start gap-3">
                                
                                <div class="mt-1">
                                    @if(is_null($notif->read_at))
                                        <div class="icon-circle" style="width: 45px; height: 45px; background-color: rgba(220, 53, 69, 0.1); color: #dc3545; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-exclamation-triangle fs-5"></i>
                                        </div>
                                    @else
                                        <div class="icon-circle" style="width: 45px; height: 45px; background-color: rgba(108, 117, 125, 0.1); color: #6c757d; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-bell fs-5"></i>
                                        </div>
                                    @endif
                                </div>

                                <div>
                                    <h6 class="mb-1 fw-bold {{ is_null($notif->read_at) ? 'text-dark' : 'text-muted' }}">
                                        {{ $notif->data['title'] ?? 'Pemberitahuan Sistem' }}
                                        @if(is_null($notif->read_at))
                                            <span class="badge bg-danger ms-2 rounded-pill" style="font-size: 0.6rem;">Baru</span>
                                        @endif
                                    </h6>
                                    <p class="mb-1 text-muted">{{ $notif->data['message'] ?? 'Tidak ada pesan spesifik.' }}</p>
                                    
                                    @if(isset($notif->data['stok_saat_ini']) && isset($notif->data['stok_min']))
                                    <div class="mt-2 small text-muted">
                                        Pergerakan Stok: <span class="badge {{ $notif->data['stok_saat_ini'] == 0 ? 'bg-danger' : 'bg-warning' }}">{{ $notif->data['stok_saat_ini'] }}</span>
                                        <span class="ms-1">Garis Batas Minimal: <span class="badge bg-secondary">{{ $notif->data['stok_min'] }}</span></span>
                                    </div>
                                    @endif

                                    <small class="text-muted d-block mt-2"><i class="far fa-clock me-1"></i> {{ $notif->created_at->diffForHumans() }} ({{ $notif->created_at->format('d/m/Y H:i') }})</small>
                                </div>
                            </div>
                            
                            <div class="d-flex flex-column gap-2 text-end">
                                @if(isset($notif->data['url']))
                                    <a href="{{ $notif->data['url'] }}" class="btn btn-sm btn-outline-info rounded-pill px-3"><i class="fas fa-eye me-1"></i> Lihat Data</a>
                                @endif
                                
                                @if(is_null($notif->read_at))
                                    <form action="{{ route('notifikasi.markAsRead', $notif->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-light rounded-pill px-3 text-muted"><i class="fas fa-check me-1"></i> Tandai Dibaca</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <i class="far fa-bell-slash fa-4x text-muted opacity-50 mb-3"></i>
                        <h5 class="text-muted">Yeay, tidak ada notifikasi.</h5>
                        <p class="text-secondary small">Anda sudah membaca seluruh pemberitahuan peringatan sistem.</p>
                    </div>
                @endforelse
            </div>
            
            @if($notifications->hasPages())
                <div class="card-footer bg-white border-0 py-3 mt-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="small text-muted mb-0">Halaman {{ $notifications->currentPage() }} dari {{ $notifications->lastPage() }}</p>
                        {{ $notifications->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@include('admin.partials.footer')
 
</div>

<script src="{{ asset('dist-dashboard/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('dist-dashboard/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist-dashboard/assets/js/main.js') }}"></script>

</body>
</html>
