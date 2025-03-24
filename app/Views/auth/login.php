<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>

<h2 class="card-header border-0 pb-0">
    <?= lang('Auth.loginTitle') ?>
</h2>
<div class="card-body">


    <form action="<?= url_to('login') ?>" method="post">
        <?= csrf_field() ?>

        <?php if ($config->validFields === ['email']): ?>
            <div class="form-group">
                <label for="login">
                    <?= lang('Auth.email') ?>
                </label>
                <input type="email" class="form-control <?php if (session('errors.login')): ?>is-invalid<?php endif ?>"
                    name="login" placeholder="<?= lang('Auth.email') ?>">
                <div class="invalid-feedback">
                    <?= session('errors.login') ?>
                </div>
            </div>
        <?php else: ?>
            <div class="form-group">
                <label for="login">
                    <?= lang('Auth.emailOrUsername') ?>
                </label>
                <input type="text" class="form-control <?php if (session('errors.login')): ?>is-invalid<?php endif ?>"
                    name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>">
                <div class="invalid-feedback">
                    <?= session('errors.login') ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="form-group">
            <label for="password">
                <?= lang('Auth.password') ?>
            </label>
            <input type="password" name="password"
                class="form-control  <?php if (session('errors.password')): ?>is-invalid<?php endif ?>"
                placeholder="<?= lang('Auth.password') ?>">
            <div class="invalid-feedback">
                <?= session('errors.password') ?>
            </div>
        </div>

        <?php if ($config->allowRemembering): ?>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" name="remember" class="form-check-input" <?php if (old('remember')): ?> checked
                        <?php endif ?>>
                    <?= lang('Auth.rememberMe') ?>
                </label>
            </div>
        <?php endif; ?>
        <button type="submit" class="btn btn-outline-dark btn-block w-100">
            <?= lang('Auth.loginAction') ?>
        </button>
    </form>

    <div class="d-flex justify-content-between align-items-center mt-3">
        
        <!-- <?php if ($config->allowRegistration): ?>
            <p>
                <a href="<?= url_to('register') ?>">
                    <?= lang('Auth.needAnAccount') ?>
                </a>
            </p>
        <?php endif; ?> -->

        <?php if ($config->activeResetter): ?>
            <p>
                <a class="text-dark" href="<?= url_to('forgot') ?>">
                    <?= lang('Auth.forgotYourPassword') ?>
                </a>
            </p>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>