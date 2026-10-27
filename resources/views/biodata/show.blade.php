<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CV {{ $data->nama }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --brand: #3b4cca; --brand-dark: #2c3aa3; --ink: #1f2440; --page: #f3f5fb; }
        body { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; background: var(--page); color: var(--ink); }

        .cv-card { border: 0; border-radius: 1.25rem; overflow: hidden; box-shadow: 0 8px 30px rgba(31, 36, 64, .09); }
        .cv-cover { height: 130px; background: linear-gradient(120deg, var(--brand-dark), var(--brand)); }
        .cv-body { padding: 0 2rem 2rem; }
        .cv-avatar {
            width: 140px; height: 140px; object-fit: cover; border-radius: 50%;
            border: 5px solid #fff; box-shadow: 0 4px 14px rgba(31, 36, 64, .2);
            margin-top: -70px;
        }
        .cv-avatar-empty {
            width: 140px; height: 140px; border-radius: 50%;
            border: 5px solid #fff; background: #eceffc; color: #8b93b8; font-size: 3.5rem;
            display: inline-flex; align-items: center; justify-content: center;
            margin-top: -70px; box-shadow: 0 4px 14px rgba(31, 36, 64, .2);
        }
        .cv-jurusan { color: var(--brand); font-weight: 600; }
        .chip-nim {
            display: inline-block; background: #eceffc; color: var(--brand-dark);
            font-weight: 600; font-size: .85rem; border-radius: .5rem; padding: .3rem .7rem;
        }

        .section-title {
            display: flex; align-items: center; gap: .6rem;
            font-size: 1.1rem; font-weight: 700; margin: 2rem 0 1rem;
        }
        .section-title i {
            width: 34px; height: 34px; border-radius: .6rem;
            background: #eceffc; color: var(--brand);
            display: inline-flex; align-items: center; justify-content: center; font-size: 1rem;
        }

        .contact-item { background: #f7f8ff; border-radius: .9rem; padding: .9rem 1rem; height: 100%; }
        .contact-item small { color: #7a82a6; display: block; margin-bottom: .15rem; }
        .contact-item span { font-weight: 600; word-break: break-word; }

        .edu-list { border-left: 3px solid #d9defa; margin-left: .5rem; padding-left: 1.25rem; }
        .edu-item { position: relative; margin-bottom: 1.1rem; }
        .edu-item::before {
            content: ''; position: absolute; left: -1.78rem; top: .35rem;
            width: 12px; height: 12px; border-radius: 50%;
            background: var(--brand); border: 2px solid #fff;
        }
        .edu-year { color: #7a82a6; font-size: .85rem; }

        .skill-badge {
            display: inline-block; background: #e4e8ff; color: var(--brand-dark);
            font-weight: 600; font-size: .85rem; border-radius: 2rem;
            padding: .4rem .9rem; margin: 0 .35rem .5rem 0;
        }
        .skill-badge em { font-style: normal; color: #6a73a8; font-weight: 500; }

        .btn-main {
            background: var(--brand); color: #fff; border: 0; font-weight: 600;
            border-radius: .75rem; padding: .6rem 1.3rem;
        }
        .btn-main:hover { background: var(--brand-dark); color: #fff; }
        .btn-soft {
            background: #eceffc; color: var(--brand-dark); border: 0; font-weight: 600;
            border-radius: .75rem; padding: .6rem 1.3rem;
        }
        .btn-soft:hover { background: #dde2fb; color: var(--brand-dark); }
    </style>
</head>
<body>
<div class="container py-5" style="max-width:850px">
    <div class="card cv-card">
        <div class="cv-cover"></div>
        <div class="cv-body">

            <div class="text-center mb-4">
                @if($data->foto)
                    <img src="{{ asset('storage/'.$data->foto) }}" alt="Foto {{ $data->nama }}" class="cv-avatar">
                @else
                    <span class="cv-avatar-empty"><i class="bi bi-person"></i></span>
                @endif

                <h1 class="fw-bold fs-2 mt-3 mb-1">{{ $data->nama }}</h1>
                <p class="cv-jurusan mb-2">{{ $data->jurusan }}</p>
                <span class="chip-nim">NIM: {{ $data->nim }}</span>
            </div>

            <div class="section-title"><i class="bi bi-person-lines-fill"></i> Tentang Saya</div>
            <p class="mb-0" style="line-height:1.8">{{ $data->tentang_saya ?: 'Belum ada deskripsi.' }}</p>

            <div class="section-title"><i class="bi bi-telephone"></i> Informasi Kontak</div>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="contact-item"><small>Email</small><span>{{ $data->email ?: '-' }}</span></div>
                </div>
                <div class="col-md-6">
                    <div class="contact-item"><small>Telepon</small><span>{{ $data->telepon ?: '-' }}</span></div>
                </div>
                <div class="col-12">
                    <div class="contact-item"><small>Alamat</small><span>{{ $data->alamat ?: '-' }}</span></div>
                </div>
            </div>

            <div class="section-title"><i class="bi bi-mortarboard"></i> Pendidikan</div>
            @forelse($data->pendidikan as $item)
                @if($loop->first)<div class="edu-list">@endif
                <div class="edu-item">
                    <strong>{{ $item->nama_sekolah }}</strong><br>
                    {{ $item->jurusan }}
                    <div class="edu-year">
                        {{ $item->tahun_mulai ?: '?' }} - {{ $item->tahun_selesai ?: '?' }}
                    </div>
                </div>
                @if($loop->last)</div>@endif
            @empty
                <p class="text-secondary">Belum ada data pendidikan.</p>
            @endforelse

            <div class="section-title"><i class="bi bi-stars"></i> Keahlian</div>
            @forelse($data->keahlian as $item)
                <span class="skill-badge">
                    {{ $item->nama_keahlian }}
                    @if($item->tingkat)
                        <em>· {{ $item->tingkat }}</em>
                    @endif
                </span>
            @empty
                <p class="text-secondary">Belum ada data keahlian.</p>
            @endforelse

            <hr class="my-4">

            <div class="d-flex gap-2">
                <a href="{{ route('biodata.index') }}" class="btn btn-soft">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
                <a href="{{ route('biodata.edit', $data) }}" class="btn btn-main">
                    <i class="bi bi-pencil-square me-1"></i> Edit CV
                </a>
            </div>
        </div>
    </div>
</div>
</body>
</html>