@if ($historynya->isEmpty())
    <div class="alert alert-danger">
        Data tidak ditemukan!
    </div>
@endif

@foreach ($historynya as $item)
    <ul class="listview image-listview">
        @php
            $path = Storage::url('uploads/absensi/' . $item->foto_in);
        @endphp
        <li>
            <div class="item">
                <img src="{{ url($path) }}" alt="image" class="image">
                <div class="in">
                    <div>
                        <b>{{ date('d-m-Y', strtotime($item->tgl_presensi)) }}</b>
                        {{-- <br> --}}
                        {{-- <small class="text-muted">{{ $item->jabatan }}</small> --}}
                    </div>
                    <span class="badge {{ $item->jam_in > '07:00' ? 'bg-danger' : 'bg-success' }}">
                        {{ $item->jam_in }}
                    </span>
                    <span class="badge bg-primary">{{ $item->jam_out }}</span>
                </div>
            </div>
        </li>
    </ul>
@endforeach
