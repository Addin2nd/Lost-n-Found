<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
            <form action="" method="post">
                <input type="hidden" name="id" value="<?= $subMenu['id']; ?>">
                <div class="form-group">
                    <label for="subMenu">Title</label>
                    <input type="text" class="form-control" id="subMenu" name="subMenu" value="<?= $subMenu['title']; ?>">
                    <?= form_error('subMenu', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="menu_id">Menu</label>
                    <select name="menu_id" id="menu_id" class="form-control">
                        <option value="">Select Menu</option>
                        <?php foreach ($menu as $m) : ?>
                            <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('menu_id', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="subMenuUrl">Url</label>
                    <input type="text" class="form-control" id="subMenuUrl" name="subMenuUrl" value="<?= $subMenu['url']; ?>">
                    <?= form_error('subMenuUrl', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="subMenuIcon">Icon</label>
                    <input type="text" class="form-control" id="subMenuIcon" name="subMenuIcon" value="<?= $subMenu['icon']; ?>">
                    <?= form_error('subMenuIcon', '<small class="text-danger">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-fw fa-save"></i>
                        </span>
                        <span class="text">Confirm</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->