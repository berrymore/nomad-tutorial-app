<?php
/**
 * @var string $cached
 * @var string $rate
 */

?>

<?php $this->layout('_base') ?>

<div class="container">
    <div class="row mt-5">
        <div class="col">
            <h1>Dashboard</h1>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="alert alert-primary">
                Previously Viewed Rate: <?= $this->e($cached) ?>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col">
            <h3>Request a New Rate</h3>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form">
                <form action="/">
                    <div class="form-group">
                        <label for="symbol">Currency</label>
                        <div class="row">
                            <div class="col-12 col-md-10">
                                <select name="symbol" id="symbol" class="form-control">
                                    <option value="RUB">Russian Ruble</option>
                                    <option value="NOK">Norwegian Krone</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-2">
                                <input type="submit" class="btn btn-primary btn-block" value="Request">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php if (isset($rate)): ?>
        <div class="row">
            <div class="col">
                <div class="alert alert-success">
                    Fresh Rate: <?= $this->e($rate) ?>
                    <a href="/" class="close">
                        <span>&times;</span>
                    </a>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="row mt-5">
        <div class="col">
            <p>Debug Information</p>
            <code>
                <?= print_r($_ENV, true) ?>
            </code>
        </div>
    </div>
</div>
