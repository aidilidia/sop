@extends('layout-sop.layout')
@section('title', 'Pencarian SOP')
@section('konten')
  
    <div class="content-header">
      <div class="container">
        <h1 class="m-0">Pencarian</h1>
        <span class="text-muted">
            
            @if($sops->count() > 0)
              pencarian dengan kata kunci 
              <b>{{$cari}} </b>
              ditemukan pada {{$sops->count()}} SOP
            @else
              tidak ditemukan SOP dengan kata kunci 
              <b>{{$cari}} </b>
            @endif
          </span>
        
      </div>
    </div>

    <div class="content">
      <div class="container">

        <div class="row">
        @foreach($sops as $sop)
          <div class="col-lg-4">
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
            </div>
          @endforeach
          
        </div>

        <div class="col-sm-12">
          @if($sops->count() > 0)
            {{$pang}} &mdash; {{$gil}}
          @endif
        </div>
        <br>
        <form action="/sop">
          <button class="tomcoret"><span>&nbsp;&nbsp; Kembali &nbsp;&nbsp; </span></button>
        </form>
        <br>
      </div>
    </div>
@endsection