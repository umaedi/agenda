@extends('layouts.template')
@push('lib-css')
@endpush
@push('css')
@endpush

@section('action-title')
    <div class="col-auto ms-auto d-print-none">
        <div class="btn-list">
            <a href="{{ url('surat/keluar') }}" class="btn btn-success d-none d-sm-inline-block">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1"></path>
                </svg>
                Kembali
            </a>
            <a href="{{ url('surat/keluar') }}"  class="btn btn-success d-sm-none btn-icon">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1"></path>
                </svg>
            </a>
        </div>
    </div>
@endsection

@section('content')

    <div class="container-xl">
        <div class="row">
            <div class="col-md-12">
                @if($feedback = session('feedback'))
                    @include('layouts._alert_feedback', ['feedback' => $feedback])
                @endif
                <form action="{{ url('surat/keluar') }}" method="post" enctype="multipart/form-data">
                    @csrf
                <div class="card">
                    <div class="card-status-start bg-green"></div>
                    <div class="card-header">
                        <h4 class="card-title">Form Isian Surat Keluar</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Nomor Surat</label>
                            <div class="col">
                                <input type="text" name="no_surat" id="no_surat" value="{{ old('no_surat') }}" class="form-control @error('no_surat') is-invalid @enderror" placeholder="Masukkan Nomor Surat..">
                                @error('no_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Tanggal Surat</label>
                            <div class="col">
                                <div class="input-icon">
                                      <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="4" y="5" width="16" height="16" rx="2"></rect><line x1="16" y1="3" x2="16" y2="7"></line><line x1="8" y1="3" x2="8" y2="7"></line><line x1="4" y1="11" x2="20" y2="11"></line><line x1="11" y1="15" x2="12" y2="15"></line><line x1="12" y1="15" x2="12" y2="18"></line></svg>
                                      </span>
                                    <input type="date" name="tgl_surat" id="tgl_surat" value="{{ old('tgl_surat', now()->format('Y-m-d')) }}" class="form-control @error('tgl_surat') is-invalid @enderror">
                                </div>
                                @error('tgl_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Tanggal Dikirim</label>
                            <div class="col">
                                <div class="input-icon">
                                      <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="4" y="5" width="16" height="16" rx="2"></rect><line x1="16" y1="3" x2="16" y2="7"></line><line x1="8" y1="3" x2="8" y2="7"></line><line x1="4" y1="11" x2="20" y2="11"></line><line x1="11" y1="15" x2="12" y2="15"></line><line x1="12" y1="15" x2="12" y2="18"></line></svg>
                                      </span>
                                    <input type="date" name="tgl_dikirim" id="tgl_surat" value="{{ old('tgl_dikirim', now()->format('Y-m-d')) }}" class="form-control @error('tgl_dikirim') is-invalid @enderror">
                                </div>
                                @error('tgl_dikirim')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Kepada</label>
                            <div class="col">
                                <input type="text" name="kepada" id="kepada" value="{{ old('kepada') }}" class="form-control @error('kepada') is-invalid @enderror" placeholder="Masukkan Kepada..">
                                @error('kepada')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-9 offset-3 mt-2">
                                <select name="tujuan[]" id="tujuan" class="form-control select2 @error('tujuan') is-invalid @enderror" multiple>
                                    <option></option>
                                    @foreach($opd as $o)
                                        <option {{ (collect(old('tujuan'))->contains($o->id_opd)) ? 'selected':'' }} value="{{ $o->id_opd }}">{{ $o->nama_opd }}</option>
                                    @endforeach
                                </select>
                                <div class="form-hint">Biarkan <b>kosong</b> apabila surat hanya ingin disimpan.</div>
                                @error('tujuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Perihal</label>
                            <div class="col">
                                <input type="text" name="perihal" id="perihal" value="{{ old('perihal') }}" class="form-control @error('perihal') is-invalid @enderror" placeholder="Masukkan Perihal Surat..">
                                @error('perihal')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Lampiran</label>
                            <div class="col">
                                <input type="number" name="lampiran" id="lampiran" value="{{ old('lampiran') }}" class="form-control @error('lampiran') is-invalid @enderror" placeholder="Masukkan Jumlah Lampiran..">
                                @error('lampiran')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Ditanda Tangani oleh</label>
                            <div class="col">
                                <select name="id_jenis_ttd_fk" id="id_jenis_ttd_fk" class="form-control select2 @error('id_jenis_ttd_fk') is-invalid @enderror">
                                    <option></option>
                                    @foreach($ttd as $t)
                                        <option value="{{ $t->id_jenis_ttd }}">{{ $t->jenis_ttd }}</option>
                                    @endforeach
                                </select>
                                @error('id_jenis_ttd_fk')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Berkas</label>
                            <div class="col">
                                <input type="file" name="berkas" id="berkas" value="{{ old('berkas') }}" class="form-control @error('berkas') is-invalid @enderror" placeholder="Masukkan Berkas Surat..">
                                @error('berkas')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                                <circle cx="12" cy="14" r="2"></circle>
                                <polyline points="14 4 14 8 8 8 8 4"></polyline>
                            </svg> Simpan</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('lib-js')
@endpush
@push('js')
@endpush
