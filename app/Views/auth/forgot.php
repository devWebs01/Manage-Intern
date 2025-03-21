<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>

<h2 class="card-header border-0 pb-0">
    <?=lang('Auth.forgotPassword')?>
</h2>
<div class="card-body">

    <p>
        <?=lang('Auth.enterEmailForInstructions')?>
    </p>

    <form action="<?= url_to('forgot') ?>" method="post">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="email">
                <?=lang('Auth.emailAddress')?>
            </label>
            <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>"
                name="email" aria-describedby="emailHelp" placeholder="<?=lang('Auth.email')?>">
            <div class="invalid-feedback">
                <?= session('errors.email') ?>
            </div>
        </div>

        <br>

        <button type="submit" class="btn btn-primary btn-block">
            <?=lang('Auth.sendInstructions')?>
        </button>
    </form>

</div>

<?= $this->endSection() ?>