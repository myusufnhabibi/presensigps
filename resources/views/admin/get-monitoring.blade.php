@php
    function selisih($jam_masuk, $jam_keluar)
    {
        [$h, $m, $s] = explode(':', $jam_masuk);
        $dtAwal = mktime($h, $m, $s, '1', '1', '1');
        [$h, $m, $s] = explode(':', $jam_keluar);
        $dtAkhir = mktime($h, $m, $s, '1', '1', '1');
        $dtSelisih = $dtAkhir - $dtAwal;
        $totalmenit = $dtSelisih / 60;
        $jam = explode('.', $totalmenit / 60);
        $sisamenit = $totalmenit / 60 - $jam[0];
        $sisamenit2 = $sisamenit * 60;
        $jml_jam = $jam[0];
        return $jml_jam . ':' . round($sisamenit2);
    }
@endphp

@if (!$results->isEmpty())
    @foreach ($results as $item)
        <tr>
            <td>{{ $loop->iteration + $results->firstItem() - 1 }}</td>
            <td>{{ $item->nik }}</td>
            <td>{{ $item->nama_lengkap }}</td>
            <td>{{ $item->nama_dep }}</td>
            <td>{{ $item->jam_in }}</td>
            @php
                $fotoin = Storage::url('uploads/absensi/' . $item->foto_in);
                $fotoout = Storage::url('uploads/absensi/' . $item->foto_out);
            @endphp
            <td><img src="{{ url($fotoin) }}" class="avatar" alt=""></td>
            <td>{!! $item->jam_out ?: '<span class="badge bg-danger">Belum Absen</span>' !!}</td>
            <td>
                @if ($item->jam_out != null)
                    <img src="{{ url($fotoin) }}" class="avatar" alt="">
                @else
                    <img src="" alt="" class="avatar">
                @endif
            </td>
            @php
                $terlambat = selisih('07:00:00', $item->jam_in);
            @endphp
            <td>{!! $item->jam_in > '07:00'
                ? '<span class="badge bg-danger">Terlambat {{ $terlambat }}</span>'
                : '<span class="badge bg-success">Tepat Waktu</span>' !!}</td>
            <td>
                <button class="btn btn-primary showmap" id="{{ $item->id }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-2" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 18.5l-3 -1.5l-6 3v-13l6 -3l6 3l6 -3v7.5"></path>
                        <path d="M9 4v13"></path>
                        <path d="M15 7v5.5"></path>
                        <path
                            d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z">
                        </path>
                        <path d="M19 18v.01"></path>
                    </svg>
                </button>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td class="text-center" colspan="9">Data Tidak ada!</td>
    </tr>
@endif
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    $('.showmap').click(function() {
        const id = $(this).attr('id')
        // console.log('asas')
        $.ajax({
            url: '/showmap',
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                id: id
            },
            cache: false,
            success: function(respon) {
                $('#loadform').html(respon)
            }
        })
        $('#bukamap').modal('show')

    })
</script>
