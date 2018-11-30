<div class="row">
    <div class="col-md-6">
        <form method="post" action="<?php echo base_url('account/login'); ?>">
            <h3>Masuk ke Akun Anda</h3>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Email address" class="form-control" />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Password" class="form-control" />
            </div>
            <button type="submit" class="btn btn-primary">Log in</button>
        </form>
    </div>
</div>