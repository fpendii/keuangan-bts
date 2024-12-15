@extends('components.template-admin.template')

@php
    $page = 'laporan-keuangan';
@endphp

@section('title')
    {{ $page }}
@endsection

@section('content')


    <div class="card">
        <div class="card">

            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link {{ Request::is('admin/laporan-keuangan/printing') ? 'active' : ''}}" id="home-tab" href="{{ url('admin/laporan-keuangan/printing') }}" role="tab"
                            aria-controls="home" aria-selected="true">Printing</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link {{ Request::is('admin/laporan-keuangan/jilid') ? 'active' : ''}}" id="home-tab" href="{{ url('admin/laporan-keuangan/jilid') }}" role="tab"
                            aria-controls="home" aria-selected="true">Jilid</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link {{ Request::is('admin/laporan-keuangan/bimbel') ? 'active' : ''}}" id="home-tab" href="{{ url('admin/laporan-keuangan/bimbel') }}" role="tab"
                            aria-controls="home" aria-selected="true">Bimbel</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link {{ Request::is('admin/laporan-keuangan/jas') ? 'active' : ''}}" id="home-tab" href="{{ url('admin/laporan-keuangan/jas') }}" role="tab"
                            aria-controls="home" aria-selected="true">Jas</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <p class='my-2'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ut nulla
                            neque. Ut hendrerit nulla a euismod pretium.
                            Fusce venenatis sagittis ex efficitur suscipit. In tempor mattis fringilla. Sed id
                            tincidunt orci, et volutpat ligula.
                            Aliquam sollicitudin sagittis ex, a rhoncus nisl feugiat quis. Lorem ipsum dolor sit
                            amet, consectetur adipiscing elit.
                            Nunc ultricies ligula a tempor vulputate. Suspendisse pretium mollis ultrices.</p>
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection
