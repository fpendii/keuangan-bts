<div class="card mb-2">
    <div class="card-body">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ Request::is('admin/laporan-keuangan/printing') ? 'active' : '' }}" id="home-tab"
                    href="{{ url('admin/laporan-keuangan/printing') }}" role="tab" aria-controls="home"
                    aria-selected="true"><i class="fa-solid fa-print"></i> Printing</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ Request::is('admin/laporan-keuangan/jilid') ? 'active' : '' }}" id="home-tab"
                    href="{{ url('admin/laporan-keuangan/jilid') }}" role="tab" aria-controls="home"
                    aria-selected="true"><i class="fa-solid fa-book"></i> Jilid</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ Request::is('admin/laporan-keuangan/bimbel') ? 'active' : '' }}" id="home-tab"
                    href="{{ url('admin/laporan-keuangan/bimbel') }}" role="tab" aria-controls="home"
                    aria-selected="true"><i class="fa-solid fa-school"></i> Bimbel</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ Request::is('admin/laporan-keuangan/jas') ? 'active' : '' }}" id="home-tab"
                    href="{{ url('admin/laporan-keuangan/jas') }}" role="tab" aria-controls="home"
                    aria-selected="true"><i class="fa-solid fa-user-tie"></i> Jas</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ Request::is('admin/laporan-keuangan/servis') ? 'active' : '' }}" id="home-tab"
                    href="{{ url('admin/laporan-keuangan/servis') }}" role="tab" aria-controls="home"
                    aria-selected="true"><i class="fa-solid fa-gear"></i> Servis</a>
            </li>
        </ul>
    </div>
</div>
