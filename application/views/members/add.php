<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Penambahan Anggota</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p>
            <div class="container-fluid">
              <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="card card-primary">
                    <!-- /.card-header -->
                    <!-- form start -->
                      <div class="card-body">
                      <div class="form-group">
                          <label for="exampleInputEmail1">ID Juleha</label>
                          <input type="text" class="form-control" id="txtJulehaId" placeholder="ID Juleha">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Password</label>
                          <input type="password" class="form-control" id="txtPassword" placeholder="Password">
                        </div>
                      <div class="form-group">
                          <label for="exampleInputEmail1">Nama Panggilan</label>
                          <input type="text" class="form-control" id="txtNickName" placeholder="Nama Panggilan">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Nama Pertama</label>
                          <input type="text" class="form-control" id="txtFirstName" placeholder="Nama Pertama">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Nama Akhir</label>
                          <input type="text" class="form-control" id="txtLastName" placeholder="Nama Akhir">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Alamat</label>
                          <input type="text" class="form-control" id="txtAddress" placeholder="Alamat">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Kab/Kota</label>
                          <?php echo form_dropdown("region",array("sby"=>"Surabaya","sda"=>"Sidoarjo"),"1","id=cmbRegion");?>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Keanggotaan</label>
                          <?php echo form_dropdown("region",array("0"=>"Anggota","1"=>"Pengurus"),"1","id=cmbRole");?>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputFile">File input</label>
                          <img src="" alt="" id="img">
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="exampleInputFile">
                              <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                              <span class="input-group-text">Upload</span>
                            </div>
                          </div>
                        </div>
                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" id="exampleCheck1">
                          <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                      </div>
                      <!-- /.card-body -->
                  </div>
                  <!-- /.card -->

                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <!--/.col (right) -->
              </div>
              <!-- /.row -->
            </div><!-- /.container-fluid -->
            </p>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            <button type="button" class="btn btn-primary" id="btnSave">Simpan</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<script src="/assets/puji/puji.image.js"></script>
<script>
console.log('add invoked');
(function($){
  $('#btnSave').click(function(){
    console.log('test');
    myimg = document.getElementById("img");
    $.ajax({
      url:'/members/save',
      data:{
        tableName:'members',
        columns:{
          juleha_id:$('#txtJulehaId').val(),
          nickname:$('#txtNickName').val(),
          firstname:$('#txtFirstName').val(),
          lastname:$('#txtLastName').val(),
          address:$('#txtAddress').val(),
          region:$('#cmbRegion').val(),
          position:$('#cmbRole').val(),
          password:$('#txtPassword').val()
        },
        img:getBase64Image(myimg)
      },
      type:'post',
      dataType:'json'
    })
    .done(res=>{
      console.log('Res',res)
      $("#modal-lg").modal("hide")
    })
    .fail(err=>{
      console.log("Err",err)
      $("#modal-lg").modal("hide")
    })
  });
  $("#exampleInputFile").change(function(){
    var reader = new FileReader()
    reader.onload = imageIsLoaded
    reader.readAsDataURL(this.files[0])
  })
  imageIsLoaded = e=>{
    $('#img').attr('src',e.target.result)
  }
}(jQuery))
</script>
