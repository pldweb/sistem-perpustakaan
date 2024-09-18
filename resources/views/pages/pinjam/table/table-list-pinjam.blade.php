<table class="table align-items-center mb-0">
    <thead class="thead-light">
    <tr>
        <th scope="col">No</th>
        <th scope="col">Nama Peminjam</th>
        <th scope="col" class="text-start">Tanggal Peminjaman</th>
        <th scope="col" class="text-start">Tenggat Pengembalian</th>
        <th scope="col" class="text-start">Status</th>
        <th scope="col" class="text-center">Total</th>
        <th scope="col" class="text-center">Opsi</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($pinjam as $index => $item)
        <tr>
            <th scope="row">{{ $pinjam->firstItem() + $index }}</th>
            <th scope="row">
                {{ $item->nama}}
            </th>
            <td class="text-start"><span
                    class="badge badge-primary">{{ $item->tanggal_pinjam }}</span></td>
            <td class="text-start"><span
                    class="badge badge-danger">{{ $item->tanggal_pengembalian }}</span></td>
            <td class="text-start">
                @if($item->status === 'selesai')
                    <span class="badge badge-success">{{ $item->status}}</span>
                @else
                    <span class="badge badge-secondary">{{ $item->status}}</span>
                @endif
            </td>
            <td class="text-center">
                {{ $item->total_buku }} buku
            </td>
            <td class="text-start d-flex column-gap-1">
                <a href="{{ route('detailPinjam', ['tanggal_pinjam' => $item->tanggal_pinjam, 'id' => $item->id]) }}">
                    <button class="btn btn-warning w500">
                        <span class="btn-label">
                            <i class="fas fa-bars"></i>
                        </span>
                    </button>
                </a>
                <form
                    action="{{ route('destroyPinjam', ['tanggal_pinjam' => $item->tanggal_pinjam, 'id' => $item->id]) }}"
                    method="post"
                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger w500">
                        <span class="btn-label">
                            <i class="fas fa-times"></i>
                        </span>
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<div class="py-2 px-3">
    {{ $pinjam->links() }}
</div>
