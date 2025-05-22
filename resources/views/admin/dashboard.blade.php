@extends('partials.main')

@section('judul', 'Dashboard Admin')

@section('konten')

        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Utama Kunjungan Pasien Klinik Sederhana</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
              <li class="breadcrumb-item">Data Utama Kunjungan</li>
              {{-- <li class="breadcrumb-item active" aria-current="page">Simple Tables</li> --}}
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h5 class="m-0 mt-2 font-weight-bold text-primary">Daftar Utama Kunjungan</h5>
                </div>

                  <div class="row mb-4">
                    <div class="col-12 d-flex justify-content-end px-4">
                      <form action="{{ route('dashboard') }}" method="GET" enctype="multipart/form-data">
                        <select name="poli_id" id="poli_filter" class="form-control" onchange="this.form.submit()">
                          <option value="">Semua Poli</option>
                          @foreach ($poli as $p)
                            <option value="{{ $p->id }}" {{ request('poli_id') == $p->id ? 'selected' : '' }}>
                                {{ $p->poli }}
                            </option>
                            
                          @endforeach
                        </select>
                        {{-- <input type="text" class="form-control form-control-md" name="cari" id="cari" placeholder="Cari Nama dan NIK..." value="{{ request('cari') }}"> --}}
                      </form>  
                    </div>
                
                </div>

                  @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Sukses!</strong> {{ session('success') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  @endif

                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead class="thead-light">
                      <tr class="text-center">
                        <th>No</th>
                        <th>Nik</th>
                        <th>Nama Pasien</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Tanggal Kunjungan</th>
                        <th>Poli Tujuan</th>
                        <th>Nama Dokter</th>
                        <th>Diagnosa</th>
                        <th>Obat Diberikan</th>
                        <th>Tindakan Medis</th>
                        <th>Biaya Total</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    @forelse ($utama as $item)
                      <tr class="text-center align-items-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->pasien->nik ?? '-' }}</td>
                        <td>{{ $item->pasien->nama ?? '-' }}</td>
                        <td>{{ $item->pasien->jenis_kelamin ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->pasien->tanggal_lahir)->format('d/m/Y') }}</td>
                        <td>{{ $item->pasien->alamat ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                        <td>{{ $item->datapoli->poli ?? '-' }}</td>
                        <td>{{ $item->datadokter->nama_dokter ?? '-' }}</td>
                        <td>{{ $item->diagnosa }}</td>
                        <td>{{ $item->obat }}</td>
                        <td>{{ $item->tindakan }}</td>
                        <td>Rp{{ number_format($item->biaya, 0, ',', '.') }}</td>
                        <td>
                          <a href="{{ route('cetakdata', $item->id) }}" class="btn btn-icon btn-danger mb-1"><i class="fas fa-print"></i></a>
                        </td>
                        
                      </tr>
                    </tbody>
                    @empty
                      <tr>
                          <td colspan="7" class="text-center">Tidak ada data dari database</td>
                      </tr>
                    @endforelse
                  </table>
                  <div class="d-flex justify-content-center mt-3">
                      {{ $utama->appends(request()->query())->links() }}
                  </div>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
          </div>
          <!--Row-->
        </div>

@endsection