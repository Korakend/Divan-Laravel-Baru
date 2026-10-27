<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Biodata CV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --brand: #3b4cca; --brand-dark: #2c3aa3; --ink: #1f2440; --page: #f3f5fb; }
        body { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; background: var(--page); color: var(--ink); }

        .form-card { border: 0; border-radius: 1.25rem; overflow: hidden; box-shadow: 0 8px 30px rgba(31, 36, 64, .09); }
        .form-head { background: linear-gradient(120deg, var(--brand-dark), var(--brand)); color: #fff; padding: 1.75rem 2rem; }
        .form-head p { color: rgba(255, 255, 255, .8); }
        .form-body { padding: 2rem; }

        .group-title {
            display: flex; align-items: center; gap: .6rem;
            font-weight: 700; font-size: 1rem; margin: 0 0 1rem;
        }
        .group-title i {
            width: 32px; height: 32px; border-radius: .6rem; background: #eceffc; color: var(--brand);
            display: inline-flex; align-items: center; justify-content: center;
        }
        .group + .group { margin-top: 1.75rem; padding-top: 1.75rem; border-top: 1px dashed #d9defa; }

        .form-label { font-weight: 600; font-size: .9rem; }
        .form-control { border-radius: .7rem; border-color: #d9defa; padding: .6rem .9rem; }
        .form-control:focus { border-color: var(--brand); box-shadow: 0 0 0 .2rem rgba(59, 76, 202, .15); }

        .photo-box { display: flex; align-items: center; gap: 1.25rem; background: #f7f8ff; border-radius: 1rem; padding: 1rem 1.25rem; margin-bottom: 1rem; }
        .photo-now {
            width: 100px; height: 100px; object-fit: cover; border-radius: 50%;
            border: 3px solid #fff; box-shadow: 0 0 0 2px #d9defa; flex-shrink: 0;
        }
        .photo-empty {
            width: 100px; height: 100px; border-radius: 50%; background: #eceffc; color: #8b93b8;
            font-size: 2.4rem; display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0;
        }

        .btn-main { background: var(--brand); color: #fff; border: 0; font-weight: 600; border-radius: .75rem; padding: .65rem 1.5rem; }
        .btn-main:hover { background: var(--brand-dark); color: #fff; }
        .btn-soft { background: #eceffc; color: var(--brand-dark); border: 0; font-weight: 600; border-radius: .75rem; padding: .65rem 1.5rem; }
        .btn-soft:hover { background: #dde2fb; color: var(--brand-dark); }
    </style>
</head>

<body>

<div class="container py-5" style="max-width: 800px;">

    <div class="card form-card">
        <div class="form-head">
            <h2 class="fw-bold mb-1">Edit Biodata CV</h2>
            <p class="mb-0">Perbarui informasi pribadi dan foto profil kamu.</p>
        </div>

        <div class="form-body">

            {{-- Menampilkan pesan error validasi --}}
            @if ($errors->any())
                <div class="alert alert-danger border-0 rounded-3 mb-4">
                    <strong><i class="bi bi-exclamation-triangle-fill me-1"></i> Terjadi kesalahan!</strong>

                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('biodata.update', $data->id) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="group">
                    <div class="group-title"><i class="bi bi-person-badge"></i> Data diri</div>

                    {{-- Nama lengkap --}}
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap *</label>
                        <input type="text" id="nama" name="nama" class="form-control"
                               value="{{ old('nama', $data->nama) }}" required>
                    </div>

                    <div class="row g-3">
                        {{-- NIM --}}
                        <div class="col-md-5">
                            <label for="nim" class="form-label">NIM *</label>
                            <input type="text" id="nim" name="nim" class="form-control"
                                   value="{{ old('nim', $data->nim) }}" required>
                        </div>

                        {{-- Jurusan --}}
                        <div class="col-md-7">
                            <label for="jurusan" class="form-label">Jurusan *</label>
                            <input type="text" id="jurusan" name="jurusan" class="form-control"
                                   value="{{ old('jurusan', $data->jurusan) }}" required>
                        </div>
                    </div>
                </div>

                <div class="group">
                    <div class="group-title"><i class="bi bi-telephone"></i> Kontak</div>

                    <div class="row g-3 mb-3">
                        {{-- Email --}}
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                   value="{{ old('email', $data->email) }}">
                        </div>

                        {{-- Nomor telepon --}}
                        <div class="col-md-6">
                            <label for="telepon" class="form-label">Nomor Telepon</label>
                            <input type="text" id="telepon" name="telepon" class="form-control"
                                   value="{{ old('telepon', $data->telepon) }}">
                        </div>
                    </div>

                    {{-- Alamat --}}
                    <div>
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea id="alamat" name="alamat" class="form-control"
                                  rows="3">{{ old('alamat', $data->alamat) }}</textarea>
                    </div>
                </div>

                <div class="group">
                    <div class="group-title"><i class="bi bi-chat-quote"></i> Tentang saya</div>

                    {{-- Tentang saya --}}
                    <textarea id="tentang_saya" name="tentang_saya" class="form-control" rows="4"
                              placeholder="Ceritakan sedikit tentang diri kamu...">{{ old('tentang_saya', $data->tentang_saya) }}</textarea>
                </div>

                <div class="group">
                    <div class="group-title"><i class="bi bi-image"></i> Foto profil</div>

                    {{-- Foto profil saat ini --}}
                    <div class="photo-box">
                        @if ($data->foto)
                            <img src="{{ asset('storage/' . $data->foto) }}"
                                 alt="Foto profil {{ $data->nama }}"
                                 class="photo-now">
                        @else
                            <span class="photo-empty"><i class="bi bi-person"></i></span>
                        @endif

                        <div>
                            <div class="fw-semibold">Foto profil saat ini</div>
                            <small class="text-secondary">
                                {{ $data->foto ? 'Unggah file baru di bawah jika ingin menggantinya.' : 'Belum ada foto profil.' }}
                            </small>
                        </div>
                    </div>

                    <label for="foto" class="form-label">Ganti Foto Profil</label>
                    <input type="file" id="foto" name="foto" class="form-control"
                           accept=".jpg,.jpeg,.png,.webp">

                    <div class="form-text">
                        Format JPG, JPEG, PNG, atau WebP.
                        Maksimal ukuran 2 MB.
                        Kosongkan jika tidak ingin mengganti foto.
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-main">
                        <i class="bi bi-check-lg me-1"></i> Simpan Perubahan
                    </button>

                    <a href="{{ route('biodata.index') }}" class="btn btn-soft">Kembali</a>
                </div>

            </form>

        </div>
    </div>

</div>

</body>
</html>