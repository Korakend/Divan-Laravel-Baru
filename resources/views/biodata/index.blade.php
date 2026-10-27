<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola CV | Divan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --brand: #3b4cca;
            --brand-dark: #2c3aa3;
            --ink: #1f2440;
            --page: #f3f5fb;
        }
        body {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            background: var(--page);
            color: var(--ink);
        }

        /* Header */
        .page-header {
            background: linear-gradient(120deg, var(--brand-dark), var(--brand));
            color: #fff;
            border-radius: 1rem;
            padding: 1.75rem 2rem;
        }
        .page-header p { color: rgba(255, 255, 255, .8); }
        .btn-add {
            background: #fff;
            color: var(--brand-dark);
            font-weight: 600;
            border: 0;
            border-radius: .75rem;
            padding: .6rem 1.2rem;
        }
        .btn-add:hover { background: #e9ecff; color: var(--brand-dark); }

        /* Tabel */
        .table-card { border: 0; border-radius: 1rem; overflow: hidden; box-shadow: 0 6px 24px rgba(31, 36, 64, .07); }
        .table thead th {
            background: #eceffc;
            color: #4a5170;
            font-weight: 600;
            font-size: .85rem;
            border-bottom: 0;
            padding: .9rem 1rem;
        }
        .table tbody td { padding: .9rem 1rem; }
        .table-hover tbody tr:hover { background: #f7f8ff; }

        .avatar {
            width: 52px; height: 52px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #fff;
            box-shadow: 0 0 0 2px #d9defa;
        }
        .avatar-empty {
            width: 52px; height: 52px;
            border-radius: 50%;
            background: #eceffc;
            color: #8b93b8;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 1.4rem;
        }
        .badge-nim {
            background: #eceffc;
            color: var(--brand-dark);
            font-weight: 600;
            border-radius: .5rem;
            padding: .4rem .65rem;
        }

        /* Tombol aksi: satu baris, ukuran sama, jarak rata */
        .action-group { display: flex; gap: .4rem; align-items: center; }
        .action-group form { margin: 0; }
        .btn-action {
            display: inline-flex; align-items: center; gap: .35rem;
            font-size: .85rem; font-weight: 600;
            padding: .4rem .8rem;
            border-radius: .6rem;
            border: 0;
            transition: background .15s, color .15s;
        }
        .btn-view   { background: #e4e8ff; color: var(--brand-dark); }
        .btn-view:hover   { background: var(--brand); color: #fff; }
        .btn-edit   { background: #fff1d6; color: #9a6200; }
        .btn-edit:hover   { background: #f0a500; color: #fff; }
        .btn-delete { background: #ffe3e3; color: #b42323; }
        .btn-delete:hover { background: #d63636; color: #fff; }
    </style>
</head>
<body>
<div class="container py-5">

    <div class="page-header d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1">CV Portfolio</h2>
            <p class="mb-0">Kelola biodata dan foto profil</p>
        </div>
        <a href="{{ route('biodata.create') }}" class="btn btn-add">
            <i class="bi bi-plus-lg me-1"></i> Tambah Biodata
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-3">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger border-0 shadow-sm rounded-3">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>Periksa kembali data yang dimasukkan.
        </div>
    @endif

    <div class="card table-card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Jurusan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($biodata as $item)
                    <tr>
                        <td>
                            @if($item->foto)
                                <img src="{{ asset('storage/'.$item->foto) }}" alt="Foto {{ $item->nama }}" class="avatar">
                            @else
                                <span class="avatar-empty" title="Belum ada foto"><i class="bi bi-person"></i></span>
                            @endif
                        </td>
                        <td class="fw-semibold">{{ $item->nama }}</td>
                        <td><span class="badge-nim">{{ $item->nim }}</span></td>
                        <td>{{ $item->jurusan }}</td>
                        <td>
                            <div class="action-group">
                                <a href="{{ route('biodata.show', $item->id) }}" class="btn-action btn-view">
                                    <i class="bi bi-eye"></i> Lihat
                                </a>
                                <a href="{{ route('biodata.edit', $item->id) }}" class="btn-action btn-edit">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('biodata.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete"
                                            onclick="return confirm('Yakin ingin menghapus biodata ini?')">
                                        <i class="bi bi-trash3"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-secondary py-5">
                            <i class="bi bi-folder2-open fs-2 d-block mb-2"></i>
                            Belum ada biodata. Silakan tambah data pertama.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>