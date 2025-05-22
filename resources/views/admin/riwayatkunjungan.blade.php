@extends('partials.main')

@section('judul', 'Riwayat Kunjungan')

@section('konten')

 <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Kunjungan Pasien</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Data Kunjungan</li>
            </ol>
          </div>
          
          <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Daftar Kunjungan</h6>
                </div>
                {{--  --}}
                <div class="col-12 d-flex justify-content-end mb-3">
                    <button class="btn btn-primary btn-md mr-3" data-toggle="modal" data-target="#tambahdata">
                        Tambah Data (+)
                    </button>
                    <a href="{{ route('cetakexcel') }}" class="btn btn-success btn-md">
                        <i class="fas fa-file-excel"></i> Download data
                    </a>
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
                        <th>Nama Pasien</th>
                        <th>Nama Dokter</th>
                        <th>Poli Tujuan</th>
                        <th>Tanggal Kunjungan</th>
                        <th>Diagnosa</th>
                        <th>Tindakan</th>
                        <th>Obat Diberikan</th>
                        <th>Biaya</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($kunjungan as $item)
                      <tr class="text-center align-items-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->pasien->nama ?? '-' }}</td>
                        <td>{{ $item->datadokter->nama_dokter ?? '-' }}</td>
                        <td>{{ $item->datapoli->poli ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                        <td>{{ $item->diagnosa }}</td>
                        <td>{{ $item->tindakan }}</td>
                        <td>{{ $item->obat }}</td>
                        <td>Rp{{ number_format($item->biaya, 0, ',', '.') }}</td>
                        <td>
                          <a href="#" class="btn btn-icon btn-primary mb-1" data-toggle="modal" data-target="#editdata-{{ $item->id }}"><i class="far fa-edit"></i></a>
                          <form id="delete-form-{{ $item->id }}" action="{{ route('hapuskunjungan', $item->id) }}" method="POST">
                              @csrf
                              @method('DELETE')
                              <button
                                  type="submit" 
                                  class="btn btn-link btn-danger delete-button"
                                  data-bs-toggle="tooltip" 
                                  title="Hapus Data" 
                                  data-id="{{ $item->id }}">
                                  <i class="fa fa-trash"></i>
                              </button>
                          </form>
                        </td>
                        
                      </tr>
                      {{-- <pre>{{ dd($item) }}</pre> --}}
                    </tbody>
                    @empty
                      <tr>
                          <td colspan="7" class="text-center">Tidak ada data dari database</td>
                      </tr>
                    @endforelse
                  </table>
                  <div class="d-flex justify-content-center mt-3">
                      {{-- {{ $pasien->appends(request()->query())->links() }} --}}
                  </div>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
          </div>
          <!--Row--> 
      </div>

          {{-- Modal Tambah Data --}}
        <div class="modal fade" id="tambahdata" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <div class="alert alert-warning ml-2 mr-2" role="alert">
                  Pengingat!!
                  Sebelum menambahkan data kunjungan pasien pastikan data pasien sudah ditambahkan terlebih dahulu
                </div>
              <div class="modal-body">
                <form action="{{ route('tambahkunjungan') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('POST')
                  <div class="mb-3">
                    <label for="pasien_id">Nama Pasien</label>
                    <select class="form-control" id="pasien_id" name="pasien_id">
                      <option value="" disabled selected>Pilih Pasien</option>
                      @foreach($pasien as $p)
                          <option value="{{ $p->id }}">{{ $p->nama }}</option>
                      @endforeach
                    </select>
                  </div>

                    <div class="mb-3">
                      <label for="dokter_id">Nama Dokter</label>
                      <select class="form-control" id="dokter_id" name="dokter_id">
                        <option value="" disabled selected>Pilih Dokter</option>
                        @foreach($dokter as $p)
                            <option value="{{ $p->id }}">{{ $p->nama_dokter }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="mb-3">
                      <label for="dokter_id">Poli</label>
                      <select class="form-control" id="poli_id" name="poli_id">
                        <option value="" disabled selected>Pilih Poli</option>
                        @foreach($poli as $p)
                            <option value="{{ $p->id }}">{{ $p->poli }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="tanggal_lahir">Tanggal Kunjungan</label>
                      <input type="date" class="form-control" name="tanggal" id="tanggal" placeholder="Masukkan Tanggal Kunjungan..">
                    </div>
                    <div class="form-group">
                      <label for="diagnosa">Diagnosa</label>
                      <input type="text" class="form-control" name="diagnosa" id="diagnosa" placeholder="Masukkan Diagnosa..">
                    </div>
                    <div class="form-group">
                      <label for="tindakan">Tindakan</label>
                      <input type="text" class="form-control" name="tindakan" id="tindakan" placeholder="Masukkan Tindakan..">
                    </div>
                    <div class="form-group">
                      <label for="obat">Obat</label>
                      <input type="text" class="form-control" name="obat" id="obat" placeholder="Masukkan Obat..">
                      <small class="text-danger">Jika Berupa Jasa Maka Harap Masukan ( - Garis Mendatar)</small>
                    </div>
                    <div class="form-group">
                      <label for="Biaya">Biaya</label>
                      <input type="number" class="form-control" name="biaya" id="biaya" placeholder="Masukkan Biaya..">
                      <small class="text-danger">Masukkan tanpa tanda (. titik) ataupun (, koma)</small>
                    </div>
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Tambah Data</button>
                  </div>
                </form>
              </div>
            </div>
        </div>

        <!-- Modal edit data -->
        @foreach ($kunjungan as $item)
        <div class="modal fade" id="editdata-{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="{{ route('updatekunjungan',['id' => $item->id]) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="mb-3">
                    <label for="pasien_id">Nama Pasien</label>
                    <select class="form-control" id="pasien_id" name="pasien_id">
                      <option value="" disabled selected>Pilih Pasien</option>
                      @foreach($pasien as $p)
                          <option value="{{ $p->id }}" @if ($p->id == $item->pasien_id) selected @endif>{{ $p->nama }}</option>
                      @endforeach
                    </select>
                  </div>

                    <div class="mb-3">
                      <label for="dokter_id">Nama Dokter</label>
                      <select class="form-control" id="dokter_id" name="dokter_id">
                        <option value="" disabled selected>Pilih Dokter</option>
                        @foreach($dokter as $p)
                            <option value="{{ $p->id }}" @if ($p->id == $item->dokter_id) selected @endif>{{ $p->nama_dokter }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="mb-3">
                      <label for="poli_id">Nama Poli</label>
                      <select class="form-control" name="poli_id">
                        @foreach($poli as $po)
                          <option value="{{ $po->id }}" @if ($po->id == $item->datapoli_id) selected @endif>
                            {{ $po->poli }}
                          </option>
                        @endforeach
                      </select>
                    </div>
  
                    <div class="form-group">
                      <label for="tanggal_lahir">Tanggal Kunjungan</label>
                      <input type="date" class="form-control" name="tanggal" id="tanggal" placeholder="Masukkan Tanggal Kunjungan.." value="{{ $item->tanggal }}">
                    </div>
                    <div class="form-group">
                      <label for="diagnosa">Diagnosa</label>
                      <input type="text" class="form-control" name="diagnosa" id="diagnosa" placeholder="Masukkan Diagnosa.." value="{{ $item->diagnosa }}">
                    </div>
                    <div class="form-group">
                      <label for="tindakan">Tindakan</label>
                      <input type="text" class="form-control" name="tindakan" id="tindakan" placeholder="Masukkan Tindakan.." value="{{ $item->tindakan }}">
                    </div>
                    <div class="form-group">
                      <label for="obat">Obat</label>
                      <input type="text" class="form-control" name="obat" id="obat" placeholder="Masukkan Obat.." value="{{ $item->obat }}">
                      <small class="text-danger">Jika Berupa Jasa Maka Harap Masukan ( - Garis Mendatar)</small>
                    </div>
                    <div class="form-group">
                      <label for="Biaya">Biaya</label>
                      <input type="number" class="form-control" name="biaya" id="biaya" placeholder="Masukkan Biaya.." value="{{ $item->biaya }}">
                      <small class="text-danger">Masukkan tanpa tanda (. titik) ataupun (, koma)</small>
                    </div>
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                  </div>
                </form>
            </div>
          </div>
        </div>
        @endforeach




@endsection