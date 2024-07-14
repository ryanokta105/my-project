<!doctype html>
<html lang="ar">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">

    <title>Iventori</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-success">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold fs-4 text-light" href="#">Inventori</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/kategori">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold active" aria-current="page"
                            href="/klasifikasi">Klasifikasi</a>
                    </li>
                    <li class="nav-item position-absolute top-0 start-0 ls-3 mt-2 ms-2">
                        <form action="/logout" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-light text-dark fw-bold fs-6">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="title">
            <h2 class="mt-2 text-center mb-5">Kasifikasi Barang
                <button type="submit" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <img src="{{ asset('plus.svg') }}" alt="">
                </button>
            </h2>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Klasifikasi
                            </h1>
                        </div>
                        <form action="/tambah_kl" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-2">
                                    <label for="formFileLg" class="form-label">Klasifikasi</label>
                                    <select class="form-select" name="klasifikasi" aria-label="Default select example">
                                        <option selected> Pilih Klasifikasi</option>
                                        <option value="Elekstronik">Elektronik</option>
                                        <option value="Fashon">Fashon</option>
                                        <option value="Aksesoris">Aksesoris</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label for="formFileLg" class="form-label">Nama Barang</label>
                                    <select class="form-select" name="kode_barang" aria-label="Default select example">
                                        <option selected> Pilih Barang</option>
                                        @foreach ($barang as $br)
                                            <option value="{{ $br->kode_barang }}">
                                                {{ $br->merek_barang }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Kasifikasi</th>
                        <th scope="col">Barang</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($klasifikasi as $kl)
                        <tr>
                            <td>{{ $kl->id }}</td>
                            <td>{{ $kl->klasifikasi }}</td>
                            <td>{{ $kl->barang->merek_barang }}</td>
                            <td>
                                <a href="{{ route('edit_klasifikasi', [$kl->id, $kl->barang->merek_barang]) }}">
                                    <button type="button" class="btn btn-success mx-2" data-bs-dismiss="modal">
                                        <img src="{{ asset('edit.svg') }}" alt="">
                                    </button>
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('destroy_klasifikasi', $kl->id) }}" method="POST"
                                    class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <img src="{{ asset('trash.svg') }}" alt="">
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const deleteForms = document.querySelectorAll('.delete-form');

            deleteForms.forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    const confirmed = confirm('Apakah Anda yakin ingin menghapus?');
                    if (confirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    -->
</body>

</html>
