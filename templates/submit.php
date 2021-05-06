<?php $this->layout('shared/layout', ['title' => 'Nauja paraiška']) ?>

<h2>
    Nauja paraiška
</h2>

<hr />

<div class="row">
    <div class="col-lg-5">
        <form method="post">
            <div class="row g-3">
                <div class="col-md-12">
                    <h5 class="mb-0">Asmeninė informacija</h5>
                </div>

                <div class="col-md-6">
                    <label for="first_name" class="form-label">Vardas</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" required />
                </div>

                <div class="col-md-6">
                    <label for="last_name" class="form-label">Pavardė</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" required />
                </div>

                <div class="col-md-12">
                    <label for="personal_id" class="form-label">Asmens kodas</label>
                    <input type="number" class="form-control" id="personal_id" name="personal_id" required />
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label">El. paštas</label>
                    <input type="email" class="form-control" id="email" name="email" required />
                </div>

                <div class="col-md-6">
                    <label for="contact_number" class="form-label">Kontaktinis telefonas</label>

                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">+370</span>
                        <input type="number" class="form-control" placeholder="6XXXXXXX" aria-describedby="basic-addon1" id="contact_number" name="contact_number" required />
                    </div>
                </div>

                <div class="col-md-12">
                    <input type="checkbox" class="form-check-input" id="is_married" name="is_married">
                    <label class="form-check-label" for="is_married">Esu susituokęs</label>
                </div>

                <div class="col-md-12 mt-4">
                    <h5 class="mb-0">Paskolos informacija</h5>
                </div>

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
                    <label for="credit_amount" class="form-label">Paskolos suma</label>

                    <div class="input-group">
                        <input type="number" class="form-control" aria-describedby="basic-addon2" min="100" max="25000" id="credit_amount" name="credit_amount" required />
                        <span class="input-group-text" id="basic-addon2">€</span>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="credit_length" class="form-label">Paskolos laikotarpis</label>

                    <div class="input-group">
                        <input type="number" class="form-control" aria-describedby="basic-addon2" min="3" max="120" id="credit_length" name="credit_length" required />
                        <span class="input-group-text" id="basic-addon2">mėn.</span>
                    </div>
                </div>

                <div class="col-md-12 mt-4">
                    <h5 class="mb-0">Finansinė informacija</h5>
                </div>

                <div class="col-md-6">
                    <label for="personal_income" class="form-label">Pajamos</label>

                    <div class="input-group">
                        <input type="number" class="form-control" aria-describedby="basic-addon2" min="0" id="personal_income" name="personal_income" required />
                        <span class="input-group-text" id="basic-addon2">€ / mėn.</span>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="financial_obligations" class="form-label">Įsipareigojimai</label>

                    <div class="input-group">
                        <input type="number" class="form-control" aria-describedby="basic-addon2" id="financial_obligations" min="0" name="financial_obligations" required />
                        <span class="input-group-text" id="basic-addon2">€ / mėn.</span>
                    </div>
                </div>

                <div class="col-md-12">
                    <label for="work_experience" class="form-label">Darbo stažas dabartinėje darbovietėje</label>

                    <select class="form-select" id="work_experience" name="work_experience" required>
                        <option selected disabled>Pasirinkite darbo stažą</option>
                        <option value="0 - 3">0 - 3 mėn.</option>
                        <option value="3 - 6">3 - 6 mėn.</option>
                        <option value="6 - 12">6 - 12 mėn.</option>
                        <option value="12 - 24">12 - 24 mėn.</option>
                        <option value="24 - 48">24 - 48 mėn.</option>
                        <option value="48+">48+ mėn.</option>
                    </select>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Sukurti paraišką</button>
                </div>
            </div>
        </form>
    </div>
</div>

