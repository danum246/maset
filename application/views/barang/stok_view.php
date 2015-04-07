<div class="row">
	<div class="span12">      		  		
  		<div class="widget ">
  			<div class="widget-header">
  				<i class="icon-user"></i>
  				<h3>Data Stok Barang</h3>
			</div> <!-- /widget-header -->
			
			<div class="widget-content">
				<div class="span11">
					<!--a data-toggle="modal" href="#myModal" class="btn btn-primary"> Tambah Vendor </a--><hr>
					<table id="example1" class="table table-bordered table-striped">
	                	<thead>
	                        <tr> 
	                        	<th>No</th>
	                            <th>Kode Barang</th>
	                            <th>Barang</th>
	                            <th>Jumlah</th>
                                <th>Satuan</th>
	                            <th width="40">Aksi</th>
	                        </tr>
	                    </thead>
	                    <tbody>
							
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
                                <td></td>
								<td class="td-actions">
									<a class="btn btn-small btn-success" href="#"><i class="btn-icon-only icon-table"> </i></a>
									<!--a class="btn btn-primary btn-small" href="#"><i class="btn-icon-only icon-pencil"> </i></a-->
									<!--a onclick="return confirm('Apakah Anda Yakin?');" class="btn btn-danger btn-small" href="#"><i class="btn-icon-only icon-remove"> </i></a-->
								</td>
							</tr>
	                      
	                    </tbody>
	               	</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">FORM DATA VENDOR</h4>
            </div>
            <form class ='form-horizontal' action="#" method="post">
                <div class="modal-body" style="margin-left: -60px;">    
                    <div class="control-group" id="">
                        <label class="control-label">Nama Vendor</label>
                        <div class="controls">
                            <input type="text" class="span4" name="" placeholder="Input Nama Vendor" class="form-control" value="" required/>
                        </div>
                    </div>
                    <div class="control-group" id="">
                        <label class="control-label">Alamat</label>
                        <div class="controls">
                            <textarea class="span4" name="" placeholder="Input Alamat Vendor" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="control-group" id="">
                        <label class="control-label">Telepon 1</label>
                        <div class="controls">
                            <input type="text" class="span4" name="" placeholder="Input Telepon 1 Vendor" class="form-control" value="" required/>
                        </div>
                    </div>
                    <div class="control-group" id="">
                        <label class="control-label">Telepon 2</label>
                        <div class="controls">
                            <input type="text" class="span4" name="" placeholder="Input Telepon 2 Vendor" class="form-control" value="" required/>
                        </div>
                    </div>
                    <div class="control-group" id="">
                        <label class="control-label">E - mail</label>
                        <div class="controls">
                            <input type="text" class="span4" name="" placeholder="Input E - mail Vendor" class="form-control" value="" required/>
                        </div>
                    </div>
					
                </div> 
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                    <input type="submit" class="btn btn-primary" value="Simpan"/>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->