@extends('partials.main')

@section('judul', 'Data Pasien')

@section('konten')

      <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Pasien</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Data Pasien</li>
            </ol>
          </div>
          
          <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Daftar Pasien</h6>
                </div>
                <div class="row mb-4 justify-content-between">
                  <div class="col-sm-4 px-4">
                    <form action="{{ route('datapasien') }}" method="GET" enctype="multipart/form-data">
                      <input type="text" class="form-control form-control-md" name="cari" id="cari"
                            placeholder="Cari Nama dan NIK..." value="{{ request('cari') }}">
                    </form>
                  </div>
                  <div class="col-sm-4">
                    <button class="btn btn-primary btn-md mr-2 ml-5" data-toggle="modal" data-target="#tambahdata">
                      Tambah Data (+)
                    </button>
                    <button class="btn btn-success btn-md">
                      <i class="fas fa-file-excel"></i> Download data
                    </button>
                  </div>
                </div>

                  @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show ml-2 mr-2" role="alert">
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
                        <th>NIK</th>
                        <th>Nama Pasien</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($pasien as $item)
                        
                      <tr class="text-center align-items-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nik }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->jenis_kelamin }}</td>
                        <td>{{  \Carbon\Carbon::parse($item->tanggal_lahir)->format('d/m/Y') }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>
                          @if ($item->foto)
                            <img src="{{ asset('images/' . $item->foto) }}" alt="Gambar" style="width: 100px; height: 100px;">
                          @else
                            <span>Tidak ada gambar</span>
                          @endif
                        </td>
                         
                        <td>
                          <a href="#" class="btn btn-icon btn-primary mb-1" data-toggle="modal" data-target="#editdata-{{ $item->id }}"><i class="far fa-edit"></i></a>
                          <form id="delete-form-{{ $item->id }}" action="{{ route('hapuspasien', $item->id) }}" method="POST">
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
                    </tbody>
                    @empty
            
                      <tr>
                          <td colspan="7" class="text-center">Tidak ada data dari database</td>
                      </tr>

                    @endforelse
                  </table>
                  <div class="d-flex justify-content-center mt-3">
                      {{ $pasien->appends(request()->query())->links() }}
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
              <div class="modal-body">
                <form action="{{ route('tambahpasien') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('POST')
                    <div class="form-group">
                      <label for="NIK">NIK</label>
                      <input type="text" class="form-control" name="nik" id="nik" placeholder="Masukkan NIK..">
                    </div>
                    <div class="form-group">
                      <label for="nama">Nama Pasien</label>
                      <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama Pasien..">
                    </div>
                    <div class="form-group">
                      <label for="tanggal_lahir">Tanggal Lahir</label>
                      <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" placeholder="Masukkan Tanggal Lahir..">
                    </div>
                    <div class="form-group">
                      <label for="jenis_kelamin">Jenis Kelamin</label><br>
                      
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin_L" value="L">
                        <label class="form-check-label" for="jenis_kelamin_L">Laki-laki</label>
                      </div>
                      
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin_P" value="P">
                        <label class="form-check-label" for="jenis_kelamin_P">Perempuan</label>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="alamat">Alamat</label>
                      <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Masukkan Alamat..">
                    </div>
                    <div class="form-group">
                      <label for="Foto">Foto Pasien</label>
                      <input type="file" class="form-control" name="foto" id="foto" placeholder="Masukkan Foto..">
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
        @foreach ($pasien as $item)
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
                <form action="{{ route('updatepasien',['id' => $item->id]) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                      <label for="NIK">NIK</label>
                      <input type="text" class="form-control" name="nik" id="nik" placeholder="Masukkan NIK.." value="{{ $item->nik }}">
                    </div>
                    <div class="form-group">
                      <label for="nama">Nama Pasien</label>
                      <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama Pasien.." value="{{ $item->nama }}">
                    </div>
                    <div class="form-group">
                      <label for="tanggal_lahir">Tanggal Lahir</label>
                      <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" placeholder="Masukkan Tanggal Lahir.." value="{{ $item->tanggal_lahir }}">
                    </div>
                    <div class="form-group">
                      <label for="jenis_kelamin">Jenis Kelamin</label><br>
                      
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin_L" value="L"{{ $item->jenis_kelamin == 'L' ? 'checked' : ''}}>
                        <label class="form-check-label" for="jenis_kelamin_L">Laki-laki</label>
                      </div>
                      
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin_P" value="P"{{ $item->jenis_kelamin == 'P' ? 'checked' : '' }}>
                        <label class="form-check-label" for="jenis_kelamin_P">Perempuan</label>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="alamat">Alamat</label>
                      <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Masukkan Alamat.." value="{{ $item->alamat }}">
                    </div>
                    <div class="form-group">
                      <label for="Foto">Foto Pasien</label>
                      <input type="file" class="form-control" name="foto" id="foto" placeholder="Masukkan Foto..">
                      <small class="text-danger">Masukkan Foto Baru</small>
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
