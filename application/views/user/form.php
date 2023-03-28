<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">


            <?= $this->session->flashdata('message'); ?>

            <?= form_open_multipart('user/form'); ?>
            <form class="user" method="post" action="<?= base_url('user/form'); ?>">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Category</label>
                    <select class="form-control" id="category" name="category">
                        <option value="">Category</option>
                        <option>Lost</option>
                        <option>Found</option>
                    </select>
                    <?= form_error('category', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group ">
                    <label for="exampleFormControlInput1">Contact</label>
                    <input type="text" class="form-control" id="contact" name="contact">
                    <?= form_error('contact', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    <?= form_error('description', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group ">
                    <div>Picture</div>
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="image">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group ">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
        </div>


        </form>
        <?= form_close(); ?>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->