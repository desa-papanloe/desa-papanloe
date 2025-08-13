{{-- resources/views/admin/agenda/create.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Agenda Baru</title>
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            background: #f8fafc; 
            margin: 0; 
            padding: 20px; 
        }
        .container { 
            max-width: 800px; 
            margin: 0 auto; 
            background: white; 
            border-radius: 12px; 
            padding: 24px; 
            box-shadow: 0 2px 4px rgba(0,0,0,0.1); 
        }
        .header { 
            margin-bottom: 24px; 
            padding-bottom: 16px; 
            border-bottom: 1px solid #e5e7eb; 
        }
        .title { 
            font-size: 24px; 
            font-weight: 700; 
            color: #111827; 
            margin: 0 0 8px 0; 
        }
        .subtitle { 
            color: #6b7280; 
            margin: 0; 
        }
        .form-group { 
            margin-bottom: 20px; 
        }
        .form-label { 
            display: block; 
            font-size: 14px; 
            font-weight: 500; 
            color: #374151; 
            margin-bottom: 6px; 
        }
        .form-input, .form-select, .form-textarea { 
            width: 100%; 
            padding: 8px 12px; 
            border: 1px solid #d1d5db; 
            border-radius: 6px; 
            font-size: 14px; 
            box-sizing: border-box; 
        }
        .form-textarea { 
            min-height: 80px; 
            resize: vertical; 
        }
        .form-grid { 
            display: grid; 
            grid-template-columns: 1fr 1fr; 
            gap: 20px; 
        }
        .btn { 
            padding: 10px 16px; 
            border-radius: 6px; 
            text-decoration: none; 
            font-weight: 500; 
            font-size: 14px; 
            border: none; 
            cursor: pointer; 
        }
        .btn-primary { 
            background: #3b82f6; 
            color: white; 
            margin-right: 8px; 
        }
        .btn-secondary { 
            background: #f3f4f6; 
            color: #374151; 
        }
        .alert { 
            padding: 12px 16px; 
            border-radius: 6px; 
            margin-bottom: 20px; 
        }
        .alert-success { 
            background: #d1fae5; 
            color: #065f46; 
            border: 1px solid #a7f3d0; 
        }
        .alert-error { 
            background: #fef2f2; 
            color: #991b1b; 
            border: 1px solid #fecaca; 
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 class="title">➕ Buat Agenda Baru</h1>
            <p class="subtitle">Tambahkan agenda kegiatan atau acara baru</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">
                <strong>Terdapat kesalahan:</strong>
                <ul style="margin: 8px 0 0 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.agenda.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label class="form-label">Judul Agenda *</label>
                <input type="text" name="judul" class="form-input" value="{{ old('judul') }}" required 
                       placeholder="Masukkan judul agenda">
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi *</label>
                <textarea name="deskripsi" class="form-textarea" required 
                          placeholder="Jelaskan agenda secara singkat">{{ old('deskripsi') }}</textarea>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Kategori *</label>
                    <select name="kategori" class="form-select" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($kategoris as $key => $value)
                            <option value="{{ $key }}" {{ old('kategori') == $key ? 'selected' : '' }}>
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Status *</label>
                    <select name="status" class="form-select" required>
                        @foreach($statuses as $key => $value)
                            <option value="{{ $key }}" {{ old('status', 'aktif') == $key ? 'selected' : '' }}>
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Prioritas *</label>
                    <select name="prioritas" class="form-select" required>
                        @foreach($prioritas as $key => $value)
                            <option value="{{ $key }}" {{ old('prioritas', 'normal') == $key ? 'selected' : '' }}>
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Tempat *</label>
                    <input type="text" name="tempat" class="form-input" value="{{ old('tempat') }}" required 
                           placeholder="Lokasi pelaksanaan">
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Tanggal Mulai *</label>
                    <input type="date" name="tanggal_mulai" class="form-input" value="{{ old('tanggal_mulai') }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" class="form-input" value="{{ old('tanggal_selesai') }}">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Penyelenggara *</label>
                <input type="text" name="penyelenggara" class="form-input" value="{{ old('penyelenggara') }}" required 
                       placeholder="Nama penyelenggara kegiatan">
            </div>

            <div style="margin-top: 24px;">
                <button type="submit" class="btn btn-primary">💾 Simpan Agenda</button>
                <a href="{{ route('admin.agenda.index') }}" class="btn btn-secondary">← Batal</a>
            </div>
        </form>
    </div>
</body>
</html>