@extends('layouts.app')
@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h1 class="h4 mb-0">Detail Pemeriksaan</h1>
                    <a href="{{ route('periksa.index') }}" class="btn btn-light btn-sm">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Tanggal Pemeriksaan</div>
                        <div class="col-md-8">{{ \Carbon\Carbon::parse($periksa->tgl_periksa)->format('d F Y') }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Pasien</div>
                        <div class="col-md-8">{{ $periksa->pasien->name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Dokter</div>
                        <div class="col-md-8">{{ $periksa->dokter->name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Catatan</div>
                        <div class="col-md-8">{{ $periksa->catatan ?: '-' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Biaya Pemeriksaan</div>
                        <div class="col-md-8">Rp {{ number_format($periksa->biaya_periksa, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h2 class="h5 mb-0">Aksi</h2>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('periksa.edit', $periksa->id) }}" class="btn btn-warning">
                            <i class="bi bi-pencil"></i> Edit Pemeriksaan
                        </a>
                        <form action="{{ route('periksa.destroy', $periksa->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Hapus data pemeriksaan ini?')">
                                <i class="bi bi-trash"></i> Hapus Pemeriksaan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h2 class="h5 mb-0">Detail Obat</h2>
                    <a href="#" class="btn btn-light btn-sm">
                        <i class="bi bi-plus-circle"></i> Tambah Obat
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Obat</th>
                                    <th>Kemasan</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($periksa->detailPeriksas as $index => $detail)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $detail->obat->name_obat }}</td>
                                    <td>{{ $detail->obat->kemasan }}</td>
                                    <td>Rp {{ number_format($detail->obat->harga, 0, ',', '.') }}</td>
                                    <td>{{ $detail->jumlah }}</td>
                                    <td>Rp {{ number_format($detail->obat->harga * $detail->jumlah, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="#" class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="#" method="POST" class="d-inline">
                                                @csrf 
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus obat ini?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data obat</td>
                                </tr>
                                @endforelse
                            </tbody>
                           
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
