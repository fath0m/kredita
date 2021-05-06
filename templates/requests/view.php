<?php $this->layout('shared/layout', ['title' => 'Paraiška']) ?>

<a href="javascript:history.go(-1)" class="btn btn-light btn-sm">
    <i class="bi bi-arrow-bar-left"></i>
    Grįžti atgal
</a>

<h2 class="mt-2">
    Paraiška #<?= $request["id"] ?>
</h2>

<hr />

<div class="row g-5">
    <div class="col-md-6">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>
                        Nr.
                    </th>
                    <td>
                        <?= $this->e($request["id"]) ?>
                    </td>
                </tr>

                <tr>
                    <th>
                        Statusas
                    </th>
                    <td>
                        <?php if($status === "waiting_offer"): ?>
                            <span class="badge bg-primary">Laukia pasiūlymo</span>
                        <?php elseif ($status === "waiting_sign"): ?>
                            <span class="badge bg-secondary">Turi pasiūlymą</span>
                        <?php elseif ($status === "signed"): ?>
                            <span class="badge bg-success">Pasirašyta</span>
                        <?php elseif ($status === "archived"): ?>
                            <span class="badge bg-danger">Neaktyvi</span>
                        <?php endif; ?>
                    </td>
                </tr>

                <tr>
                    <th>
                        Sukūrimo data
                    </th>
                    <td>
                        <?= $this->e($request["created_at"]) ?>
                    </td>
                </tr>

                <tr>
                    <th>
                        Vardas
                    </th>
                    <td>
                        <?= $this->e($request["first_name"]) ?>
                    </td>
                </tr>

                <tr>
                    <th>
                        Pavardė
                    </th>
                    <td>
                        <?= $this->e($request["last_name"]) ?>
                    </td>
                </tr>

                <tr>
                    <th>
                        Asmens kodas
                    </th>
                    <td>
                        <?= $this->e($request["personal_id"]) ?>
                    </td>
                </tr>

                <tr>
                    <th>
                        Elektroninis paštas
                    </th>
                    <td>
                        <a href="mailto:<?= $this->e($request["email"]) ?>">
                            <?= $this->e($request["email"]) ?>
                        </a>
                    </td>
                </tr>

                <tr>
                    <th>
                        Kontaktinis telefonas
                    </th>
                    <td>
                        <a href="tel:+370<?= $this->e($request["contact_number"]) ?>">
                            +370<?= $this->e($request["contact_number"]) ?>
                        </a>
                    </td>
                </tr>

                <tr>
                    <th>
                        Ar susituokęs?
                    </th>
                    <td>
                        <?= $request["is_married"] == 1 ? "Taip" : "Ne" ?>
                    </td>
                </tr>

                <tr>
                    <th>
                        Paskolos tipas
                    </th>
                    <td>
                        <?= $this->e($request["credit_type"]) ?>
                    </td>
                </tr>

                <tr>
                    <th>
                        Norima suma
                    </th>
                    <td>
                        <?= $this->e($request["credit_amount"]) ?> €
                    </td>
                </tr>

                <tr>
                    <th>
                        Norimas laikotarpis
                    </th>
                    <td>
                        <?= $this->e($request["credit_length"]) ?> mėn.
                    </td>
                </tr>

                <tr>
                    <th>
                        Pajamos
                    </th>
                    <td>
                        <?= $this->e($request["personal_income"]) ?> € / mėn.
                    </td>
                </tr>

                <tr>
                    <th>
                        Finansiniai įsipareigojimai
                    </th>
                    <td>
                        <?= $this->e($request["financial_obligations"]) ?> € / mėn.
                    </td>
                </tr>

                <tr>
                    <th>
                        Darbo stažas dabartinėje darbovietėje
                    </th>
                    <td>
                        <?= $this->e($request["work_experience"]) ?> mėn.
                    </td>
                </tr>
            </tbody>
        </table>

        <?php if($status !== "signed" && $status !== "archived"): ?>
            <div class="mt-4">
                <h3>Atmesti paraišką</h3>

                <p>
                    Klientas nebenori paskolos arba neatitinka kreditingumo kriterijų?
                </p>

                <a href="/requests/archive.php?id=<?= $request["id"] ?>" class="btn btn-sm btn-danger">
                    Archyvuoti paraišką
                </a>
            </div>

        <?php endif; ?>
    </div>

    <div class="col-md-6">
        <?php if($status !== "signed" && $status !== "archived"): ?>
            <div>
                <h3>
                    Pateiktas pasiūlymas
                </h3>

                <?php if($request["offer"]): ?>
                    <table class="table table-bordered table-striped mt-3">
                        <tbody>
                        <tr>
                            <th>Paskolos tipas</th>
                            <td>
                                <?= $request["offer.credit_type"] ?>
                            </td>
                        </tr>

                        <tr>
                            <th>Suma (nuo, iki)</th>
                            <td>
                                <?= $request["offer.credit_amount_from"] ?> €
                                -
                                <?= $request["offer.credit_amount_to"] ?> €
                            </td>
                        </tr>

                        <tr>
                            <th>Terminas (nuo, iki)</th>
                            <td>
                                <?= $request["offer.credit_length_from"] ?> mėn.
                                -
                                <?= $request["offer.credit_length_to"] ?> mėn.
                            </td>
                        </tr>

                        <tr>
                            <th>Palūkanos</th>
                            <td>
                                <?= $request["offer.interest_rate"] ?> %
                            </td>
                        </tr>

                        <tr>
                            <th>BVKKMN</th>
                            <td>
                                <?= $request["offer.bvkkmn"] ?> %
                            </td>
                        </tr>

                        <tr>
                            <th>Įmoka</th>
                            <td>
                                <?= $request["offer.payment"] ?> € / mėn.
                            </td>
                        </tr>

                        <tr>
                            <th>Komentaras</th>
                            <td>
                                <?= $request["offer.comment"] ?? "-" ?>
                            </td>
                        </tr>

                        <tr>
                            <th>Pasiūlymo data</th>
                            <td>
                                <?= $request["offer.created_at"] ?>
                            </td>
                        </tr>

                        <tr>
                            <th>Pasiūlymą pateikė</th>
                            <td>
                                <?= $request["offer.manager"] ?? "-" ?>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <a href="/requests/sign.php?id=<?= $request["id"] ?>" class="btn btn-sm btn-success">
                        Pasirašyti sutartį
                    </a>

                    <a href="/offers/delete.php?id=<?= $request["offer.id"] ?>" class="btn btn-sm btn-danger">
                        Ištrinti pasiūlymą
                    </a>
                <?php else: ?>
                    <p>
                        Šiuo metu paraiška neturi pateikto pasiūlymo.
                    </p>

                    <a href="/offers/create.php?request=<?= $request["id"] ?>" class="btn btn-sm btn-primary">
                        Pateikti pasiūlymą
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if($status === "signed"): ?>
            <div>
                <h3>
                    Pasirašytos sutarties informacija
                </h3>

                <table class="table table-bordered table-striped mt-3">
                    <tbody>
                        <tr>
                            <th>
                                Suma
                            </th>
                            <td>
                                <?= $request["signature.credit_amount"] ?> €
                            </td>
                        </tr>

                        <tr>
                            <th>
                                Laikotarpis
                            </th>
                            <td>
                                <?= $request["signature.credit_length"] ?> mėn.
                            </td>
                        </tr>

                        <tr>
                            <th>
                                Paskolos tipas
                            </th>
                            <td>
                                <?= $request["signature.credit_type"] ?>
                            </td>
                        </tr>

                        <tr>
                            <th>
                                Palūkanos
                            </th>
                            <td>
                                <?= $request["signature.interest_rate"] ?> %
                            </td>
                        </tr>

                        <tr>
                            <th>
                                BVKKMN
                            </th>
                            <td>
                                <?= $request["signature.bvkkmn"] ?> %
                            </td>
                        </tr>

                        <tr>
                            <th>
                                Įmoka
                            </th>
                            <td>
                                <?= $request["signature.payment"] ?> € / mėn.
                            </td>
                        </tr>

                        <tr>
                            <th>
                                Vadybininkas
                            </th>
                            <td>
                                <?= $request["signature.manager"] ?>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <div class="mt-5">
            <h3>
                Papildomi dokumentai
            </h3>

            <?php if (sizeof($documents) === 0): ?>
                <p>
                    Šiuo metu paraiška neturi papildomų dokumentų.
                </p>
            <?php else: ?>
                <table class="my-4">
                    <?php foreach($documents as $document): ?>
                        <tr>
                            <td>
                                <strong>
                                    <?= $this->e($document["name"]) ?>
                                </strong>
                            </td>
                            <td class="text-right">
                                <a href="/documents/view.php?id=<?= $document["id"] ?>" class="btn btn-sm btn-link">Peržiūrėti</a>

                                <a href="/documents/delete.php?id=<?= $document["id"] ?>" class="btn btn-sm btn-danger">Ištrinti</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>



            <form method="post" action="/documents/create.php" enctype="multipart/form-data">
                <input type="hidden" name="request" value="<?= $request["id"] ?>" />

                <div class="modal fade" id="add_document_modal" tabindex="-1" aria-labelledby="add_document_modal_title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered"">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="add_document_modal_title">Prisegti dokumentą</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Pavadinimas</label>
                                    <input type="text" class="form-control" id="name" name="name" required />
                                </div>

                                <div class="mb-3">
                                    <label for="document" class="form-label">Dokumentas</label>
                                    <input type="file" class="form-control" name="document" id="document" accept="image/*" required />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Atšaukti</button>
                                <button type="submit" class="btn btn-primary">
                                    Išsaugoti
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>


            <button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#add_document_modal">
                Prisegti dokumentą
            </button>
        </div>
    </div>
</div>


