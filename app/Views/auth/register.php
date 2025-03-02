<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>

<h2 class="card-header border-0 pb-0">
    <?=lang('Auth.register')?>
</h2>
<div class="card-body">

    <form action="<?= url_to('register') ?>" method="post">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="email">
                <?=lang('Auth.email')?>
            </label>
            <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>"
                name="email" aria-describedby="emailHelp" placeholder="<?=lang('Auth.email')?>"
                value="<?= old('email') ?>">
            <small id="emailHelp" class="form-text text-muted">
                <?=lang('Auth.weNeverShare')?>
            </small>
        </div>

        <div class="form-group">
            <label for="username">
                <?=lang('Auth.username')?>
            </label>
            <input type="text" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>"
                name="username" placeholder="<?=lang('Auth.username')?>" value="<?= old('username') ?>">
        </div>

        <div class="form-group">
            <label for="password">
                <?=lang('Auth.password')?>
            </label>
            <input type="password" name="password"
                class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>"
                placeholder="<?=lang('Auth.password')?>" autocomplete="off">
        </div>

        <div class="form-group">
            <label for="pass_confirm">
                <?=lang('Auth.repeatPassword')?>
            </label>
            <input type="password" name="pass_confirm"
                class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>"
                placeholder="<?=lang('Auth.repeatPassword')?>" autocomplete="off">
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <button type="submit" class="btn btn-primary btn-block">
                <?=lang('Auth.register')?>
            </button>

            
            <span class="mt-1">
                <?=lang('Auth.alreadyRegistered')?> <a href="<?= url_to('login') ?>">
                    <?=lang('Auth.signIn')?>
                </a>
                </span>
        </div>
    </form>
</div>

<?= $this->endSection() ?>