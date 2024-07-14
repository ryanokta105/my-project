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
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Tambah {{ $kategori->jenis }}
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            @foreach ($kategori->barang as $b)
                <div class="col-3 card mt-2 mx-2 mb-3" style="height: 23%;">
                    <a href="/barang" class="text-decoration-none">
                        <div class="gambar" style="white: 75%;">
                            <img src="{{ asset('storage/' . $b->gambar) }}" class="card-img-top" style="height: 200px;"
                                alt="...">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-center fw-bold text-black">{{ $b->merek_barang }}</h5>
                        </div>
                        <div class="text mt-0 text-black">
                            <p style="margin-top: -7%">Kode Barang : {{ $b->kode_barang }}</p>
                            <p style="margin-top: -7%">Tipe : {{ $b->tipe }}</p>
                            <p style="margin-top: -7%">Tahun : {{ $b->tahun }}</p>
                            <p style="margin-top: -7%">Kategori : {{ $kategori->jenis }}</p>
                        </div>
                    </a>
                    <div class="modal-footer mb-3">
                        <a href="{{ route('edit_barang', [$b->kode_barang, $kategori->jenis]) }}">
                            <button type="button" class="btn btn-success mx-2" data-bs-dismiss="modal">
                                <img src="{{ asset('edit.svg') }}" alt="">
                            </button>
                        </a>
                        <form action="{{ route('destroy_barang', [$b->kode_barang, $kategori]) }}" method="POST"
                            class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <img src="{{ asset('trash.svg') }}" alt="">
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 m-auto" id="exampleModalLabel">Tambah {{ $kategori->jenis }}
                    </h1>
                </div>
                <div class="modal-body">
                    <form action="/tambah" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="disabledTextInput" class="form-label">Kode Barang</label>
                            <input type="text" id="disabledTextInput" name="kode_barang" class="form-control"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="disabledTextInput" class="form-label">Merek Barang</label>
                            <input type="text" id="disabledTextInput" name="merek_barang" class="form-control"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="disabledTextInput" class="form-label">Tipe</label>
                            <input type="text" id="disabledTextInput" name="tipe" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="disabledTextInput" class="form-label">Tahun</label>
                            <input type="text" id="disabledTextInput" name="tahun" class="form-control"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="disabledTextInput" class="form-label">Jenis</label>
                            <select class="form-select" name="kode_kategori">
                                <option value="{{ $kategori->kode_kategori }}">{{ $kategori->jenis }}</option>
                            </select>
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
