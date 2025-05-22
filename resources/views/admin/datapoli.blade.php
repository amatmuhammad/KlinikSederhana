@extends('partials.main')

@section('judul', 'Data Poli')

@section('konten')

      <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Poli</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Data Poli</li>
            </ol>
          </div>
          
          <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Daftar Poli</h6>
                </div>

               <div class="row mb-4">
                  <div class="col text-right">
                    <button class="btn btn-primary btn-md mr-3" data-toggle="modal" data-target="#tambahdata">Tambah Data (+)</button>
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
                        <th>Nama Poli</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($poli as $item)
                        
                      <tr class="text-center align-items-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->poli }}</td>
                         
                        <td>
                          <a href="#" class="btn btn-icon btn-primary mb-1" data-toggle="modal" data-target="#editdata-{{ $item->id }}"><i class="far fa-edit"></i></a>
                          <form id="delete-form-{{ $item->id }}" action="{{ route('hapuspoli', $item->id) }}" method="POST">
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
                      {{-- {{ $poli->links() }} --}}
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
                <form action="{{ route('tambahpoli') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('POST')
                    <div class="form-group">
                      <label for="Nama_Poli">Nama Poli</label>
                      <input type="text" class="form-control" name="poli" id="poli" placeholder="Masukkan Nama Poli..">
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
        @foreach ($poli as $item)
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
                <form action="{{ route('updatepoli',['id' => $item->id]) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                      <label for="Nama_Poli">Nama Poli</label>
                      <input type="text" class="form-control" name="poli" id="poli" placeholder="Masukkan Nama Poli.." value="{{ $item->poli }}">
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
