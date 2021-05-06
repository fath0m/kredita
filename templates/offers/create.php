<?php $this->layout('shared/layout', ['title' => 'Naujas pasiūlymas']) ?>

<h2>
    Naujas pasiūlymas
</h2>

<hr />

<div class="row">
    <div class="col-lg-5">
        <form method="post">
            <div class="row g-3">
                <div class="col-md-12">
                    <label for="credit_type" class="form-label">Paskolos tipas</label>

                    <select class="form-select" id="credit_type" name="credit_type" required>
                        <option selected disabled>Pasirinkite paskolos tipą</option>
                        <?php foreach ($credit_types as $credit_type): ?>
                            <option value="<?= $credit_type["id"] ?>">
                                <?= $credit_type["name"] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="credit_amount_from" class="form-label">Paskolos suma (nuo)</label>

                    <div class="input-group">
                        <input type="number" class="form-control" min="100" max="25000" id="credit_amount_from" name="credit_amount_from" required />
                        <span class="input-group-text">€</span>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="credit_amount_to" class="form-label">Paskolos suma (iki)</label>

                    <div class="input-group">
                        <input type="number" class="form-control" min="100" max="25000" id="credit_amount_to" name="credit_amount_to" required />
                        <span class="input-group-text">€</span>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="credit_length_from" class="form-label">Paskolos laikotarpis (nuo)</label>

                    <div class="input-group">
                        <input type="number" class="form-control" min="3" max="120" id="credit_length_from" name="credit_length_from" required />
                        <span class="input-group-text">mėn.</span>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="credit_length_to" class="form-label">Paskolos laikotarpis (iki)</label>

                    <div class="input-group">
                        <input type="number" class="form-control" min="3" max="120" id="credit_length_to" name="credit_length_to" required />
                        <span class="input-group-text">mėn.</span>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="interest_rate" class="form-label">Palūkanos</label>

                    <div class="input-group">
                        <input type="number" class="form-control" min="0" step="any" id="interest_rate" name="interest_rate" required />
                        <span class="input-group-text">%</span>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="bvkkmn" class="form-label">BVKKMN</label>

                    <div class="input-group">
                        <input type="number" class="form-control" min="0" step="any" id="bvkkmn" name="bvkkmn" required />
                        <span class="input-group-text">%</span>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="payment" class="form-label">Įmoka</label>

                    <div class="input-group">
                        <input type="number" class="form-control" min="0" step="any" id="payment" name="payment" required />
                        <span class="input-group-text">€ / mėn.</span>
                    </div>
                </div>

                <div class="col-md-12">
                    <label for="comment" class="form-label">
                        Papildomas komentaras (<em>nebūtina</em>)
                    </label>

                    <textarea class="form-control" id="comment" name="comment"></textarea>
                </div>


                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Sukurti pasiūlymą</button>
                </div>
            </div>
        </form>
    </div>
</div>