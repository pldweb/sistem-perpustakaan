<div class="modal-body">
    <div>
        <h1>History Laporan User</h1>
    </div>

    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Buku</th>
            <th>Jumlah</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $num => $item)
            <tr>
                <td class="text-center">{{$num+1}}</td>
                <td>{{$item->tanggal_pinjam}}</td>
                <td class="text-center">{{$item->judul_buku}}</td>
                <td class="text-center">{{$item->jumlah}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
