<html lang="en">
    <head>
        <title>Kredita - <?= $this->e($title) ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- INCLUDE BOOTSTRAP -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">

        <link rel="stylesheet" href="./static/main.css">
    </head>
    <body>
        <header>

            <?php $path = $_SERVER['REQUEST_URI']; ?>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container">
                    <a class="navbar-brand" href="/">Kredita</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <?php if(user()): ?>
                                <li class="nav-item">
                                    <a class="nav-link <?= strpos($path, "/requests?status=new") !== false ? "active" : "" ?>" href="/requests?status=new">Naujos paraiškos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= strpos($path, "/requests?status=with_offers") !== false ? "active" : "" ?>" href="/requests?status=with_offers">Pateikti pasiūlymai</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= strpos($path, "/requests?status=signed") !== false ? "active" : "" ?>" href="/requests?status=signed">Pasirašytos paraiškos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= strpos($path, "/requests?status=archived") !== false ? "active" : "" ?>" href="/requests?status=archived">Archyvas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/logout.php">Atsijungti</a>
                                </li>
                            <?php else: ?>
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="/login.php">Prisijungti</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/submit.php">Nauja paraiška</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <main role="main" class="container my-4">
            <?php if(get_error()): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?=get_error()?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <?php del_error(); ?>
            <?php endif; ?>

            <?php if(get_success()): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?=get_success()?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <?php del_success(); ?>
            <?php endif; ?>

            <?= $this->section('content') ?>
        </main>
    </body>
</html>
