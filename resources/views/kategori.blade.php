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
                    <li class="nav-item active">
                        <a class="nav-link text-white fw-bold active" aria-current="page" href="/kategori">Home</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" aria-current="page" href="/klasifikasi">Klasifikasi</a>
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
        <div class="row justify-content-center">
            @foreach ($kategori as $k)
                <div class="col-3 card mt-2 mx-2 shadow p-3 bg-body-tertiary rounded" style="width: 23%;">
                    <div class="icon d-flex justify-content-end">
                        <a href="{{ route('edit_kategori', $k->kode_kategori) }}">
                            <button type="submit" class="btn">
                                <img src="{{ asset('edit.svg') }}" class="card-img-top" style="width: 1rem;">
                            </button>
                        </a>
                        <form action="{{ route('destroy', $k->kode_kategori) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn">
                                <img src="{{ asset('hapus.svg') }}" class="card-img-top" style="width: 1rem;">
                            </button>
                        </form>
                    </div>
                    <a href="{{ route('barang', $k->jenis) }}" class="text-decoration-none">
                        <div class="gambar m-auto">
                            <img src="{{ asset('storage/' . $k->gambar) }}" class="card-img-top" style="height: 200px;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-center fw-bold text-black ">{{ $k->jenis }}</h5>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <div class="mt-3" style="display: flex;">
            <div class="m-auto">
                <div class="card mx-2 shadow-sm p-3 mb-5 bg-body-tertiary rounded m-auto"
                    style="width: 18rem; height: 18rem;" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <img src="{{ asset('add.png') }}" style="width: 5rem;" class="card-img-top m-auto" alt="...">
                </div>
            </div>
        </div>
    </a>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 m-auto" id="exampleModalLabel">Tambah Kategori</h1>
                </div>
                <div class="modal-body">
                    <form action="/kategori" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="disabledTextInput" class="form-label">Kode Kategori</label>
                            <input type="text" id="disabledTextInput" name="kode_kategori" class="form-control"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="disabledTextInput" class="form-label">Kategori</label>
                            <input type="text" id="disabledTextInput" name="jenis" class="form-control"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="disabledTextInput" class="form-label">Gambar</label>
                            <div class="input-group">
                                <input type="file" class="form-control" name="gambar" id="inputGroupFile02"
                                    required>
                            </div>
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
