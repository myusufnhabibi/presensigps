<div class="table-responsive">
    <table class="table card-table table-vcenter text-nowrap datatable">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">NIK</th>
                <th rowspan="2">Nama</th>
                <th class="text-center" colspan="{{ $calday }}">Tanggal</th>
                <th rowspan="2">TH</th>
                <th rowspan="2">TT</th>
            </tr>
            <tr>
                @for ($i = 1; $i <= $calday; $i++)
                    <th>{{ $i }}</th>
                @endfor
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nik }}</td>
                    <td>{{ $item->nama_lengkap }}</td>
                    <?php
                    $totalhadir = 0;
                    $totaltelat = 0;
                    for ($i = 1; $i <= $calday; $i++) {
                        $tgl = 'tgl_' . $i;
                        if (empty($item->$tgl)) {
                            $hadir = ['', ''];
                        } else {
                            $hadir = explode('-', $item->$tgl);
                            $totalhadir += 1;
                            if ($hadir[0] > '07:00:00') {
                                $totaltelat += 1;
                            }
                        }
                    
                    ?>
                    <td class="text-center">
                        <span style="color: {{ $hadir[0] > '07:00:00' ? 'red' : '' }}">{{ $hadir[0] }}</span> <br>
                        <span style="color: {{ $hadir[1] > '15:30:00' ? 'red' : '' }}">{{ $hadir[1] }}</span>
                    </td>
                    <?php } ?>
                    <td>{{ $totalhadir }}</td>
                    <td>{{ $totaltelat }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
    <div class="container-xl mt-2">
        {{ $results->links('pagination::bootstrap-5') }}
    </div>
</div>
