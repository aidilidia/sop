@extends('layout-sop.layout')
@section('title', 'SOP')
@section('konten')

    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
            <h1 class="m-0">Cari SOP Pengadilan Tinggi Agama Padang? </h1>

            <form action="/cari" method="GET">
              <div class="pendar input-group input-group-md">
                <input name="search" class="form-control form-control-navbar" type="search" placeholder="Ketik kata kunci pencarian" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </form>

          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="content">
      <div class="container">

        <div class="row">
          <div class="col-lg-4">
            <h4>SOP Terbaru</h4>
              @foreach($sops as $sop)
                @if($cekNoRevKada->where('input_id', $forkada->where('revisi', $sop->id)->max('id'))->first())
                  <a href="/detail-{{$sop->slug}}" target="_parent">
                    <div class="penor card position-relative bg-warning" style="height: 130px">
                      <div class="ribbon-wrapper ribbon-lg">
                        <div class="ribbon bg-danger">
                          Tidak berlaku
                        </div>
                      </div>

                      <div class="card-body">
                        <h5 class="card-title">
                          @if($lastNama->where('input_id', $sop->id)->max('nama'))
                            {{$lastNama->where('input_id', $sop->id)->max('nama')}}
                          @else
                            {{$sop->nama}}
                          @endif
                        </h5>
                        <p class="card-text text-muted">
                          {{$sop->nomor}}
                        </p>
                        <span>
                          <i class="far fa-calendar-alt"></i> {{date('d F Y', strtotime($sop->tglnomor))}}
                        </span>
                        &emsp;
                        <span class="text-grey">
                          <!-- <i class="fas fa-mouse-pointer"></i> 2 -->
                        </span>
                      </div>
                    </div>
                  </a>
                @else
                    <a class="pendar card card-primary card-outline text-dark" href="/detail-{{$sop->slug}}" target="_parent">
                      <div class="card-body">
                        <h5 class="card-title">
                          @if($lastNama->where('input_id', $sop->id)->max('nama'))
                            {{$lastNama->where('input_id', $sop->id)->max('nama')}}
                          @else
                            {{$sop->nama}}
                          @endif
                          
                        </h5>
                        <p class="card-text text-muted">
                          {{$sop->nomor}}
                        </p>
                        <span class="text-grey">
                          <i class="far fa-calendar-alt"></i> {{date('d F Y', strtotime($sop->tglnomor))}}
                        </span>
                        &emsp;
                        <span class="text-grey">
                          <!-- <i class="fas fa-mouse-pointer"></i> 20 -->
                        </span>
                      </div>
                    </a>
                @endif
              @endforeach
          </div>

          <div class="col-lg-4">
            <h4 style="color:#f4f6f9;">.</h4>
              @foreach($sopos as $sop)
                @if($cekNoRevKada->where('input_id', $forkada->where('revisi', $sop->id)->max('id'))->first())
                    <a href="/detail-{{$sop->slug}}" target="_parent">
                      <div class="penor card position-relative bg-warning" style="height: 130px">
                        <div class="ribbon-wrapper ribbon-lg">
                          <div class="ribbon bg-danger">
                            Tidak berlaku
                          </div>
                        </div>

                        <div class="card-body">
                          <h5 class="card-title">
                            @if($lastNama->where('input_id', $sop->id)->max('nama'))
                              {{$lastNama->where('input_id', $sop->id)->max('nama')}}
                            @else
                              {{$sop->nama}}
                            @endif
                          </h5>
                          <p class="card-text">
                            {{$sop->nomor}}
                          </p>
                          <span>
                            <i class="far fa-calendar-alt"></i> {{date('d F Y', strtotime($sop->tglnomor))}}
                          </span>
                          &emsp;
                          <span class="text-grey">
                            <!-- <i class="fas fa-mouse-pointer"></i> 2 -->
                          </span>
                        </div>
                      </div>
                    </a>
                  
                @else
                    <a class="pendar card card-primary card-outline text-dark" href="/detail-{{$sop->slug}}" target="_parent">
                      <div class="card-body">
                        <h5 class="card-title">
                          @if($lastNama->where('input_id', $sop->id)->max('nama'))
                            {{$lastNama->where('input_id', $sop->id)->max('nama')}}
                          @else
                            {{$sop->nama}}
                          @endif
                          
                        </h5>
                        <p class="card-text text-muted">
                          {{$sop->nomor}}
                        </p>
                        <span class="text-grey">
                          <i class="far fa-calendar-alt"></i> {{date('d F Y', strtotime($sop->tglnomor))}}
                        </span>
                        &emsp;
                        <span class="text-grey">
                          <!-- <i class="fas fa-mouse-pointer"></i> 20 -->
                        </span>
                      </div>
                    </a>
                @endif
              @endforeach
          </div>

          <div class="col-lg-4">
            <h4>Kategori</h4>
            
            @foreach($kategoris as $kategori)
            @csrf
            <a href="/kategori-{{$kategori->kategori}}">
              <div class="pendar callout 
                @if($kategori->id % 4 == 1)
                callout-danger 
                @elseif($kategori->id % 4 == 2)
                callout-success
                @elseif($kategori->id % 4 == 3)
                callout-warning
                @elseif($kategori->id % 4 == 0)
                callout-info
                @endif                
                text-dark info-box">
                <div class="info-box-content">
                  <h5>{{$kategori->kategori}}</h5>
                  <!-- <p>terkait laporan perkara</p> -->
                </div>
                <span style="font-size:9px" class="info-box-icon 
                
                  @if($kategori->id % 4 == 1)
                  bg-danger 
                  @elseif($kategori->id % 4 == 2)
                  bg-success
                  @elseif($kategori->id % 4 == 3)
                  bg-warning
                  @elseif($kategori->id % 4 == 0)
                  bg-info
                  @endif
                  elevation-1 "> 
                  
                  @foreach($jmlkat as $jml)
                    @if($jml->id == $kategori->id)
                    |
                    
                    @endif
                  @endforeach
                </span>
              </div>
            </a>
            @endforeach
            <form action="/semua">
              <button class="tomcoret"><span>Lihat Semua</span></button>
            </form>

          </div>
        </div>
      </div>
    </div>
@endsection