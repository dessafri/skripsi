<ul class="navbar-nav" id="accordionSidebar">
    <a href="index.php" class="d-flex align-items-center justify-content-center">
        <div class="container sidebar-title mt-2 mb-5 text-left">
            <span>SIPEKU</span>
        </div>
    </a>
    <li class="nav-item active">
        <a class="nav-link sidebar-text" href="index.php">
            <span>Dashboard</span>
        </a>
    </li>
    <hr class="sidebar-bagi" />
    <li class="nav-item">
        <a class="nav-link sidebar-text" href="pertanyaan.php">
            <span>Kelola Pertanyaan</span>
        </a>
    </li>
    <hr class="sidebar-bagi" />
    <li class="nav-item">
        <a class="nav-link sidebar-text" href="indikator.php">
            <span>Kelola Indikator</span>
        </a>
    </li>
    <hr class="sidebar-bagi" />
    <li class="nav-item">
        <a class="nav-link sidebar-text" href="hasil.php">
            <span>Kelola Hasil</span>
        </a>
    </li>
    <hr class="sidebar-bagi" />
    <li class="nav-item">
        <a class="nav-link sidebar-text" href="peran.php">
            <span>Kelola Peran</span>
        </a>
    </li>
    <hr class="sidebar-bagi" />
    <li class="nav-item">
        <a class="nav-link sidebar-text" href="sekolah.php">
            <span>Kelola Sekolah</span>
        </a>
    </li>
    <hr class="sidebar-bagi" />
    <li class="nav-item">

        <span class="nav-link sidebar-text btn-link-kuesioner" style="cursor:pointer;"><button class="btn btn-primary"
                style="cursor: pointer;">Link Kuesioner <i class="fa-solid fa-paper-plane"></i></button></span>

    </li>
    <input type="hidden" name="link" id="link" value="copy-text">
</ul>
<script src="https://code.jquery.com/jquery-3.6.0.slim.js"
    integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(".btn-link-kuesioner").on("click", function(e) {
    let url = window.location.href
    let split = url.split('/');
    let urlSplit = '';
    for (let i = 0; i < split.length - 1; i++) {
        urlSplit += split[i] + '/'
    }
    let linkKuesioner;
    fetch('dataKunci.php', {
        method: 'POST'
    }).then(Response => {
        return Response.json()
    }).then(responsejson => {
        let kunci = responsejson[0].VALUE;
        let inputCopy = document.createElement('input')
        document.body.appendChild(inputCopy);
        inputCopy.value = urlSplit + `isikuesioner.php?key=${kunci}`
        inputCopy.select();
        document.execCommand('copy');
        linkKuesioner = inputCopy.value;
        document.body.removeChild(inputCopy);
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'success',
            title: 'Link Berhasil di Salin'
        })
        let formData = new FormData();
        formData.append("link", linkKuesioner)
        // fetch('qrcode.php', {
        //     method: 'POST',
        //     body: formData
        // })
        setTimeout(() => {
            fetch("buatKunci.php", {
                method: 'POST'
            })
        }, 86400000);
    })
})
</script>