<table class="table align-items-center mb-0">
    <thead class="thead-light">
    <tr>
        <th scope="col">No</th>
        <th scope="col">Nama Peminjam</th>
        <th scope="col" class="text-start">Tanggal Pengembalian</th>
        <th scope="col" class="text-start">Total Buku</th>
        <th scope="col" class="text-start">Opsi</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($pengembalianData as $num => $item)
        <tr>
            <th scope="row">{{ $pengembalianData->firstItem() + $num }}</th>
            <th scope="row">
                {{ $item->nama_peminjam}}
            </th>
            <td class="text-start"><span class="badge badge-info">{{ $item->tanggal_pengembalian }}</span></td>
            <td class="text-start">
                {{ $item->total_buku}}
            </td>
            <td class="text-start d-flex column-gap-1">
                <a href="">
                    <button class="btn btn-warning w500">
                        <span class="btn-label">
                            <i class="fas fa-bars"></i>
                        </span>
                    </button>
                </a>
                <form action="" method="post"
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
    {{ $pengembalianData->links() }}
</div>
