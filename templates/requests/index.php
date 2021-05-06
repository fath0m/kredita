<?php $this->layout('shared/layout', ['title' => $title]) ?>

<h2>
    <?= $this->e($title) ?>
</h2>

<table class="table table-bordered mt-3">
    <thead class="table-dark">
    <tr>
        <th>
            #
        </th>
        <th>
            Sukūrimo data
        </th>
        <th>
            Paskolos tipas
        </th>
        <th>
            Norima suma
        </th>
        <th>
            Norimas laikotarpis
        </th>
        <th>
            Asmens kodas
        </th>
        <td>

        </td>
    </tr>
    </thead>
    <tbody>

    <?php foreach($requests as $request): ?>
        <tr>
            <td>
                <?= $this->e($request["id"]) ?>
            </td>
            <td>
                <?= $this->e($request["created_at"]) ?>
            </td>
            <td>
                <?= $this->e($request["credit_type"]) ?>
            </td>
            <td>
                <?= $this->e($request["credit_amount"]) ?> €
            </td>
            <td>
                <?= $this->e($request["credit_length"]) ?> mėn.
            </td>
            <td>
                <?= $this->e($request["personal_id"]) ?>
            </td>
            <td class="text-right">
                <a href="/requests/view.php?id=<?= $request["id"] ?>">peržiūrėti</a>
            </td>
        </tr>
    <?php endforeach; ?>

    </tbody>
</table>