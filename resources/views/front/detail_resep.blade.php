@extends('layouts.front')
@section('content')
    <div class="receipe-content-area py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8 mx-auto text-center">
                    <div class="receipe-headline my-4">
                        <h2 class="text-dark">{{ $detail->nama_resep }}</h2>
                        <span class="text-muted">Kategori: <strong>{{ $detail->kategori->nama_kategori }}</strong></span>
                    </div>
                </div>
            </div>

            <div class="row align-items-start">
                <div class="col-md-6">
                    <div class="receipe-img mb-4">
                        <img src="{{ asset('gambars/resep/' . $detail->gambar) }}" class="img-fluid rounded shadow"
                            alt="{{ $detail->nama_resep }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <h3 class="text-success">Bahan-bahan dan Langkah-langkah</h3>
                    <div class="preparation-steps" v-html="deskripsi">
                        {!! nl2br($detail->deskripsi) !!}
                    </div>
                </div>
            </div>

            {{-- Komentar --}}
            <div class="row mt-5">
                <div class="col-md-8 mx-auto">
                    <h4>Komentar</h4>
                    <div id="list-komentar" style="max-height: 300px; overflow-y: auto;" class="mb-3">
                        <!-- Komentar akan dimuat di sini -->
                    </div>

                    @auth
                        <textarea id="input-komentar" class="form-control mb-2" placeholder="Tulis komentar..."></textarea>
                        <button id="btn-kirim" class="btn btn-success">Kirim Komentar</button>
                    @else
                        <p><a href="{{ route('login') }}">Login</a> untuk memberi komentar</p>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    {{-- Kirim data user ke JS --}}
    <script>
        const authUser = @json(Auth::user());
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const idResep = "{{ $detail->id }}";
            const komentarContainer = document.getElementById("list-komentar");
            const btnKirim = document.getElementById("btn-kirim");
            const inputKomentar = document.getElementById("input-komentar");

            loadKomentar();

            function loadKomentar() {
                fetch(`/komentar-public/${idResep}`)
                    .then(response => response.json())
                    .then(data => {
                        komentarContainer.innerHTML = "";
                        if (data.length === 0) {
                            komentarContainer.innerHTML = "<p class='text-muted'>Belum ada komentar.</p>";
                            return;
                        }

                        data.forEach(komentar => {
                            let bolehHapus = false;

                            if (authUser) {
                                // user bisa hapus komentarnya sendiri, admin bisa hapus semuanya
                                bolehHapus = (authUser.id === komentar.id_user || authUser.role === 1);
                            }

                            komentarContainer.innerHTML += `
                                <div class="komentar-item border-bottom py-2 d-flex justify-content-between align-items-start" id="komentar-${komentar.id}">
                                    <div>
                                        <strong>${komentar.user.username}</strong>
                                        <p class="mb-1">${komentar.isi_komentar}</p>
                                        <small class="text-muted">${new Date(komentar.created_at).toLocaleString()}</small>
                                    </div>
                                    ${bolehHapus ? `
                                                            <form onsubmit="hapusKomentar(event, ${komentar.id})" class="ms-2">
                                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus komentar">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        ` : ''}
                                </div>
                            `;
                        });
                    })
                    .catch(error => {
                        komentarContainer.innerHTML = "<p class='text-danger'>Gagal memuat komentar.</p>";
                        console.error("Error:", error);
                    });
            }

            // Kirim komentar
            if (btnKirim) {
                btnKirim.addEventListener("click", function() {
                    const isiKomentar = inputKomentar.value.trim();
                    if (!isiKomentar) {
                        alert("Komentar tidak boleh kosong.");
                        return;
                    }

                    fetch(`/komentar/${idResep}`, {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                                    .content
                            },
                            body: JSON.stringify({
                                isi_komentar: isiKomentar
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            alert(data.message);
                            inputKomentar.value = "";
                            loadKomentar();
                            komentarContainer.scrollTop = komentarContainer.scrollHeight;
                        })
                        .catch(error => {
                            alert("Gagal mengirim komentar.");
                            console.error(error);
                        });
                });
            }

            // Fungsi hapus komentar
            window.hapusKomentar = function(event, idKomentar) {
                event.preventDefault();

                if (!confirm('Yakin ingin menghapus komentar ini?')) return;

                fetch(`/komentar/${idKomentar}`, {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                            "Accept": "application/json"
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Respon tidak berhasil");
                        }
                        return response.json();
                    })
                    .then(data => {
                        alert(data.message);

                        const komentarElement = document.getElementById(`komentar-${idKomentar}`);
                        if (komentarElement) {
                            komentarElement.remove();
                        } else {
                            console.warn(
                                `Element komentar dengan ID komentar-${idKomentar} tidak ditemukan di DOM.`
                            );
                        }
                    })
                    .catch(error => {
                        alert("Gagal menghapus komentar. Silakan coba lagi.");
                        console.error("Error saat menghapus komentar:", error);
                    });
            };
        });
    </script>
@endsection
