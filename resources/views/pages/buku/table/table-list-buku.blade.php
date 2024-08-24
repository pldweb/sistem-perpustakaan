<table class="table align-items-center mb-0">
    <thead class="thead-light">
    <tr>
        <th scope="col" class="text-start">No</th>
        <th scope="col">Judul Buku</th>
        <th scope="col" class="text-start">Penulis</th>
        <th scope="col" class="text-start">Penerbit</th>
        <th scope="col" class="text-start">Tahun Terbit</th>
        <th scope="col" class="text-start">Stock Buku</th>
        <th scope="col" class="text-start">Photo</th>
        <th scope="col" class="text-start">Opsi</th>
    </tr>
    </thead>
    <tbody id="tbody">
    @foreach ($data as $index => $item)
        <tr>
            <td class="text-start">{{ $data->firstItem() + $index }}</td>
            <th scope="row">
                {{ $item->judul_buku}}
            </th>
            <td class="text-start">{{ $item->penulis }}</td>
            <td class="text-start">{{ $item->penerbit }}</td>
            <td class="text-start">{{ $item->tahun_terbit }}</td>
            <td class="text-start">{{ $item->stock }}</td>
            <td class="">
                @if(!empty($item->photo))
                    <a href="{{ $item->photo }}" target="_blank" style="white-space: nowrap; text-decoration: underline;">Lihat Gambar</a>
                @else
                    <span style="color: black;">Tidak ada gambar</span>
                @endif
            </td>
            <td class="text-start d-flex column-gap-1">
                <a href="{{ route('editBuku', $item->id) }}">
                    <button class="btn btn-warning w500">
                        <span class="btn-label">
                            <i class="fas fa-bars"></i>
                        </span>
                    </button>
                </a>
                <form action="{{ route('destroyBuku', $item->id) }}" method="post"
                      onsubmit="return confirm('yakin?')">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger w500">
                        <span class="btn-label">
                            <i class="fas fa-times"></i>
                        </span>
                    </button>
                </form>
            </td>
    @endforeach
    </tbody>
</table>
<div class="py-2 px-3">

    {{ $data->links() }}

</div>
