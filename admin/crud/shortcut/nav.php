<nav class="navbar navbar-expand-lg bg-body-tertiary position-fixed bg-dark" data-bs-theme="dark" style="
    color: white;
    width: 100%;
    z-index: 10;
    top: 0;">
    <div class="container-fluid">
        <a class="navbar-brand" href="./">GaleryTek</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./#main">Home</a>
                </li>
            </ul>
            <div class="d-flex justify-content-evenly">
                <a href="user.php" class="d-flex btn btn-sm btn-primary justify-content-center me-2">
                    <div class="fs-5">User</div><i class="fa fa-user fa-2x ms-2 mt-1" aria-hidden="true"></i>
                </a>
                <a href="../logout.php" class="d-flex btn btn-sm btn-danger justify-content-center" onclick="return confirm('Anda yakin ingin logout ?')">
                    <div class="fs-5">Logout</div><i class="fa-solid fa-right-to-bracket fa-2x ms-2 mt-1"></i>
                </a>
            </div>
        </div>
    </div>
</nav>
<div style="margin-bottom: 32px;">_</div>