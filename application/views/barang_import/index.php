 <!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Barang Import</h1>


<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <?php
    if ($this->session->userdata('level')=="admin") { ?>
        <form id="importForm" method="post" enctype="multipart/form-data">
    <div class="row mb-4">
        <label class="col-2">Pilih File Excel</label>
        <div class="col-3 col-md-7">
        <input type="file" name="fileExcel" class="form-control" required accept=".xls, .xlsx">
        </div>
        <button class='btn btn-success' type="submit">
        Import
        <i class="fas fas fa-upload"></i>
        </button>
    </div>

    </form>
    <?php } ?>
  </div>
  <div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered table-hover" id="table" width="100%" cellspacing="0">
            <thead class="thead-light">
            <tr>
                <th>No</th>
                <th>Nama File</th>
                <th>Proses</th>
                <th>Ukuran</th>
                <th>Status</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>No</th>
                <th>Nama File</th>
                <th>Proses</th>
                <th>Ukuran</th>
                <th>Status</th>
            </tr>
            </tfoot>
            <tbody>
            </tbody>
        </table>
    </div>
  </div>
</div>

</div>

<script>

$(document).ready(function() {
    tableBarang = $('#table').DataTable({
        "processing": true,
        "serverSide": true,
        "retrieve": true,
        "ajax": {
        "url": "<?= base_url('Barang_Import/list_ajax') ?>",
        "type": "POST",
        },
        "columnDefs": [{}, ],
    });


    $('#importForm').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission
        var formData = new FormData(this);
        $.ajax({
            url: '<?php echo site_url('Barang_Import/submit'); ?>', // URL to the controller method
            type: 'POST',
            data: formData, 
            processData: false,
            contentType: false,
            success: function(response) {
                console.log('Form submitted successfully:', response);
                // Handle the response here
            },
            error: function(error) {
                console.log('Error submitting form:', error);
                // Handle the error here
            }
        });
    });
});
</script>