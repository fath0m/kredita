<?php $this->layout('shared/layout', ['title' => 'Prisijungti']) ?>

<h2>
    Prisijunkite prie sistemos
</h2>

<hr />

<div class="row">
    <div class="col-lg-5">
        <form method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Prisijungimo vardas</label>
                <input type="text" class="form-control" id="username" name="username" required />
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Slaptažodis</label>
                <input type="password" class="form-control" id="password" name="password" required />
            </div>
            <button type="submit" class="btn btn-primary">Prisijungti prie sistemos</button>
        </form>
    </div>
</div>

