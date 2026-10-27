<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Biodata</title>
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

        .btn-main { background: var(--brand); color: #fff; border: 0; font-weight: 600; border-radius: .75rem; padding: .65rem 1.5rem; }
        .btn-main:hover { background: var(--brand-dark); color: #fff; }
        .btn-soft { background: #eceffc; color: var(--brand-dark); border: 0; font-weight: 600; border-radius: .75rem; padding: .65rem 1.5rem; }
        .btn-soft:hover { background: #dde2fb; color: var(--brand-dark); }
    </style>
</head>
<body>
<div class="container py-5" style="max-width:800px">
    <div class="card form-card">
        <div class="form-head">
            <h2 class="fw-bold mb-1">Tambah Biodata CV</h2>
            <p class="mb-0">Isi data diri untuk membuat CV baru.</p>
        </div>

        <div class="form-body">
            @if($errors->any())
                <div class="alert alert-danger border-0 rounded-3 mb-4">
                    <strong><i class="bi bi-exclamation-triangle-fill me-1"></i> Periksa kembali isian kamu:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('biodata.store') }}" method="POST"
                  enctype="multipart/form-data">
                @csrf

                <div class="group">
                    <div class="group-title"><i class="bi bi-person-badge"></i> Data diri</div>

                    <div class="mb-3">
                        <label class="form-label">Nama lengkap *</label>
                        <input name="nama" class="form-control"
                               value="{{ old('nama') }}" required>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-5">
                            <label class="form-label">NIM *</label>
                            <input name="nim" class="form-control"
                                   value="{{ old('nim') }}" required>
                        </div>
                        <div class="col-md-7">
                            <label class="form-label">Jurusan *</label>
                            <input name="jurusan" class="form-control"
                                   value="{{ old('jurusan', 'Teknik Informatika') }}" required>
                        </div>
                    </div>
                </div>

                <div class="group">
                    <div class="group-title"><i class="bi bi-telephone"></i> Kontak</div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control"
                                   value="{{ old('email') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nomor telepon</label>
                            <input name="telepon" class="form-control"
                                   value="{{ old('telepon') }}">
                        </div>
                    </div>

                    <div>
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3">{{ old('alamat') }}</textarea>
                    </div>
                </div>

                <div class="group">
                    <div class="group-title"><i class="bi bi-chat-quote"></i> Tentang saya</div>
                    <textarea name="tentang_saya" class="form-control"
                              rows="4">{{ old('tentang_saya') }}</textarea>
                </div>

                <div class="group">
                    <div class="group-title"><i class="bi bi-image"></i> Foto profil</div>
                    <input type="file" name="foto" class="form-control"
                           accept=".jpg,.jpeg,.png,.webp">
                    <small class="text-secondary">Format JPG, PNG, WebP; maksimal 2 MB.</small>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button class="btn btn-main"><i class="bi bi-check-lg me-1"></i> Simpan Biodata</button>
                    <a href="{{ route('biodata.index') }}" class="btn btn-soft">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>