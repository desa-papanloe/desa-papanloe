{{-- resources/views/admin/agenda/show.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Agenda - {{ $agenda->judul }}</title>
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
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            margin-bottom: 24px; 
            padding-bottom: 16px; 
            border-bottom: 1px solid #e5e7eb; 
        }
        .title { 
            font-size: 24px; 
            font-weight: 700; 
            color: #111827; 
            margin: 0; 
        }
        .badge { 
            padding: 4px 12px; 
            border-radius: 12px; 
            font-size: 12px; 
            font-weight: 600; 
            text-transform: capitalize; 
        }
        .badge-aktif { background: #d1fae5; color: #065f46; }
        .badge-nonaktif { background: #f3f4f6; color: #6b7280; }
        .badge-selesai { background: #dbeafe; color: #1e40af; }
        .badge-dibatalkan { background: #fecaca; color: #991b1b; }
        .info-grid { 
            display: grid; 
            grid-template-columns: 1fr 1fr; 
            gap: 20px; 
            margin-bottom: 24px; 
        }
        .info-item { 
            background: #f9fafb; 
            padding: 16px; 
            border-radius: 8px; 
        }
        .info-label { 
            font-size: 12px; 
            color: #6b7280; 
            font-weight: 500; 
            text-transform: uppercase; 
            margin-bottom: 4px; 
        }
        .info-value { 
            font-size: 14px; 
            color: #111827; 
            font-weight: 600; 
        }
        .description { 
            background: #f9fafb; 
            padding: 16px; 
            border-radius: 8px; 
            margin-bottom: 24px; 
        }
        .btn { 
            padding: 8px 16px; 
            border-radius: 6px; 
            text-decoration: none; 
            font-weight: 500; 
            font-size: 14px; 
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
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 class="title">📅 {{ $agenda->judul }}</h1>
            <span class="badge badge-{{ $agenda->status }}">{{ ucfirst($agenda->status) }}</span>
        </div>

        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Kategori</div>
                <div class="info-value">{{ ucfirst(str_replace('_', ' ', $agenda->kategori)) }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Prioritas</div>
                <div class="info-value">{{ ucfirst($agenda->prioritas) }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Tanggal Mulai</div>
                <div class="info-value">{{ $agenda->tanggal_mulai->format('d M Y') }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Tempat</div>
                <div class="info-value">{{ $agenda->tempat }}</div>
            </div>
        </div>

        @if($agenda->deskripsi)
        <div class="description">
            <div class="info-label">Deskripsi</div>
            <div class="info-value">{{ $agenda->deskripsi }}</div>
        </div>
        @endif

        <div style="margin-top: 24px;">
            <a href="{{ route('admin.agenda.edit', $agenda) }}" class="btn btn-primary">✏️ Edit</a>
            <a href="{{ route('admin.agenda.index') }}" class="btn btn-secondary">← Kembali</a>
        </div>
    </div>
</body>
</html>