<?php error_reporting(0); 
$daritanggal=$_GET['daritanggal'];
$sampaitanggal=$_GET['sampaitanggal'];
$bulan=$_GET['bulan'];
$tahun=$_GET['tahun'];
$tanggalhariini=date('Y-m-d'); ?>
<div class="btn-group float-right">
	<button class="btn btn-secondary dropdown-toggle mt-2 " type="button" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-search"></i> Cek Laporan
	</button>
	<div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="font-size: 15px;">
	  <a href='#' class="dropdown-item" data-toggle='modal' data-target='#bulanan'>Laporan Bulanan</a>
	  <a href='#' class="dropdown-item" data-toggle='modal' data-target='#tahunan'>Laporan Tahunan</a>
	</div>
</div>

<div class="modal fade" id="bulanan" tabindex="1" role="dialog" aria-labelledby="edit" aria-hidden="true" >
<div class="modal-dialog modal-md" role="document">
  <div class="modal-content">
	<div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	        <span aria-hidden="true">&times;</span>
	    </button>
	</div>
	<form action="" method="get">
	<div class="modal-body">
	<input type="hidden" name="laporan" value="bulanan">
		<div class="form-group row">
			<label class="col-md-5" style="font-size: 20px;">&nbsp;Bulan &nbsp;</label>
			<select name="bulan" class="btn btn-muted text-left form-control col-6" style="border-color: #c2c2c2;">
              <option value="">-- Pilih Bulan --</option>
              <option value="01">Januari</option>
              <option value="02">Februari</option>
              <option value="03">Maret</option>
              <option value="04">April</option>
              <option value="05">Mei</option>
              <option value="06">Juni</option>
              <option value="07">Juli</option>
              <option value="08">Agustus</option>
              <option value="09">September</option>
              <option value="10">Oktober</option>
              <option value="11">November</option>
              <option value="12">Desember</option>
            </select>
		</div> 
		<div class="form-group row">
			<label class="col-md-5" style="font-size: 20px;">&nbsp;Tahun &nbsp;</label>
			<select name="tahun" class="btn btn-muted text-left form-control col-6" style="border-color: #c2c2c2;">
            <?php $mulai= date('Y') - 1; for($i = $mulai;$i<$mulai + 4;$i++){ $sel = $i == date('Y') ? ' selected="selected"' : '';  echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';}?>
            </select>
		</div>                                    
	</div>          
    <div class="modal-footer">
       <button class="btn btn-info col-12" type="submit">Cek</button>
    </div>
    </form> 
  </div>
</div>
</div> 

<div class="modal fade" id="tahunan" tabindex="1" role="dialog" aria-labelledby="edit" aria-hidden="true" >
<div class="modal-dialog modal-md" role="document">
  <div class="modal-content">
	<div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	        <span aria-hidden="true">&times;</span>
	    </button>
	</div>
	<form action="" method="get">
	<div class="modal-body">
	<input type="hidden" name="laporan" value="tahunan">
		<label class="col-md-5" style="font-size: 20px;">&nbsp;Tahun &nbsp;</label>
			<select name="tahun" class="btn btn-muted text-left form-control col-6" style="border-color: #c2c2c2;">
            <?php $mulai= date('Y') - 1; for($i = $mulai;$i<$mulai + 4;$i++){ $sel = $i == date('Y') ? ' selected="selected"' : '';  echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';}?>
            </select>                     
	</div>          
    <div class="modal-footer">
       <button class="btn btn-info col-12" type="submit">Cek</button>
    </div>
    </form> 
  </div>
</div>
</div> 