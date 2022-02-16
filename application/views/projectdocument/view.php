 <!-- Begin Page Content -->
 <div class="container-fluid">
   <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
   <!-- Page Heading -->
   <h1 class="h3 mb-4 text-gray-800">Project Document</h1>
   <!-- DataTales Example -->
   <div class="card shadow mb-4">
     <div class="card-header py-3">
       <h6 class="m-0 font-weight-bold text-primary">Form</h6>
     </div>
     <!-- TAMBAHAN BY ADAM SANTOSO -->
     <?php //proses pengecekan form dokumen
      error_reporting(0); //menyembunyikan pesan kesalahan karena beberapa var belum di set jika halaman project document baru pertama diakses
      function templateFile($file, $check = null)
      {
        // var_dump(count($file['nomor_project']) > 2);
        if (count($file) > 1) {
          return  '<a  target="_blank" href="' . base_url('projectDocument/printPdf/' . $file["nomor_project"] . '?status=view') . '">View</a> - <a href="' . base_url('projectDocument/printPdf/' . $file["nomor_project"] . '?status=download') . '" target="_blank" class="text-primary">Download</a>';
        }
        if ($file) {
          return substr($file, 0, 20) . '... <small><a onclick="view(\'' . $file . '\');" class="text-primary" data-toggle="modal" data-target="#viewModal" style="cursor:pointer;">View</a> - <a href="' . base_url('projectDocument/download/' . $file) . '" class="text-primary">Download</a></small>';
        } else {
          if ($check == 'disabled') {
            return '<small class="font-italic">Dokumen sebelumnya perlu ditambahkan</small>';
          } else {
            return '<small class="font-italic">Perlu ditambahkan</small>';
          }
        }
      }

      if ($file != null) {


        $cekProposal = $file['documentCheck_x212'];
        $x21 = unserialize($file['document_x21']);
        $x22 = unserialize($file['document_x22']);
        $x23 = unserialize($file['document_x23']);
        $x24 = unserialize($file['document_x24']);
        $x211 = $x21[0];
        $x212 = $x21[1];
        $x213 = $x21[2];
        $x221 = $x22[0];
        $x231 = $commVoucher;
        $x241 = $x24[0];
        $x242 = $x24[1];
        $x243 = $x24[2];

        if ($x211 != null and $x212 != null and ($x213 != null or $x213 == null)) {
          $x22check = '';
        } else {
          $x22check = 'disabled';
        }

        if ($x221 != null) {
          $x23check = '';
        } else {
          $x23check = 'disabled';
        }

        if ($x231 != null) {
          $x24check = '';
        } else {
          $x24check = 'disabled';
        }
      } else {
        $x22check = 'disabled';
        $x23check = 'disabled';
        $x24check = 'disabled';
      }



      ?>
     <div class="card-body">
       <?php echo form_open_multipart('projectDocument/upload/' . $this->uri->segment(3)); ?>

       <div class="container-fluid">
         <p>x.2.1</p>
         <div class="row ">
           <div class="col-12 col-md-6 mb-2 form-group">
             <div class="custom-file mt-4">
               <input type="file" class="custom-file-input" id="x211" name="x21[]">
               <label class="custom-file-label x211" for="x211">Term of reference</label>
             </div>
             <?= templateFile($x211); ?>
           </div>
           <div class="col-12 col-md-6 mb-2">
             <div class="custom-control custom-checkbox">
               <input type="checkbox" class="custom-control-input" name="cekProposal" id="cekProposal" value="1" <?= $cekProposal; ?>>
               <label class="custom-control-label" for="cekProposal">Cek jika proposal sudah termasuk penawaran harga</label>
             </div>
             <div class="custom-file">
               <input type="file" class="custom-file-input" id="x212" name="x21[]">
               <label class="custom-file-label x212" for="x212">Proposal Final</label>
             </div>
             <?= templateFile($x212); ?>
           </div>
           <div class="col-12 col-md-6 mb-2">
             <div class="custom-file">
               <input type="file" class="custom-file-input" id="x213" name="x21[]">
               <label class="custom-file-label x213" for="x213">Surat Penawaran Harga</label>
             </div>
             <span class="hideCekProposal"><?= templateFile($x213); ?></span>
           </div>
         </div>

         <p>x.2.2</p>
         <div class="row">
           <div class="col-12 col-md-6 mb-2">
             <div class="custom-file">
               <input type="file" class="custom-file-input" id="x221" name="x22[]" <?= $x22check; ?>>
               <label class="custom-file-label x221" for="x221">Surat Perintah Kerja</label>
             </div>
             <?= templateFile($x221, $x22check); ?>
           </div>
         </div>

         <p>x.2.3</p>
         <div class="row">
           <div class="col-12 col-md-6 mb-2">
             <div class="custom-file">
               <?php
                $id_login = $this->session->userdata('ses_id');
                $jbtn_login = $this->session->userdata('ses_jabatan');
                $dept_login = $this->session->userdata('ses_level');
                if (($dept_login == '0' and $jbtn_login == '0') or ($dept_login == '1' and $jbtn_login != '0') or ($dept_login == '8' and $jbtn_login == '5' or $jbtn_login == '57')) {
                  if ($commVoucher['created_by'] == $id_login or ($dept_login == '13' and $jbtn_login == '5' or $jbtn_login == '57')) {
                    // echo '<p>Commision Voucher</p>';
                    echo 'Commision Voucher : ' . templateFile($x231, $x23check);
                  } else {
                    echo 'Commision Voucher : Data tidak ada';
                  }
                  //     if ($commVoucher) echo '<button type="button" class="btn btn-primary editCommVoucher" data-toggle="modal" data-target="#formCommVoucher" id="editCommVoucher" ' . $x23check . '>
                  //      Edit Commision Voucher
                  //    </button>';
                  //     else echo '<button type="button" class="btn btn-primary createCommVoucher" data-toggle="modal" data-target="#formCommVoucher" id="createCommVoucher"  ' . $x23check . '>
                  //    Create Commision Voucher
                  //  </button>';
                  // if ($commVoucher) echo '<p>Commision Voucher' . $x23check . '</p>';
                  //    Edit Commision Voucher
                  //  </button>';
                  // else echo '<p>Commision Voucher: <span>Data tidak ada</span> ' . $x23check . '>';
                  //    Create Commision Voucher
                  //  </button>';
                } else {
                  echo '<small class="font-italic">Akses dokumen dibatasi</small>';
                }

                ?>

               <!-- <input type="file" class="custom-file-input" id="x231" name="x23[]" <?= $x23check; ?>>
               <label class="custom-file-label x231" for="x231">Form Commission Voucher</label> -->
             </div>
             <?php
              // if ($commVoucher['created_by'] == $id_login or ($dept_login == '13' and $jbtn_login == '5' or $jbtn_login == '57')) {
              //   echo '<p>Commision Voucher</p>' . templateFile($x231, $x23check);
              // }
              ?>
           </div>
         </div>

         <p>x.2.4</p>
         <div class="row">
           <div class="col-12 col-md-6 mb-2">
             <div class="custom-file">
               <input type="file" class="custom-file-input" id="x241" name="x24[]" <?= $x24check; ?>>
               <label class="custom-file-label x241" for="x241">Kontrak Kerja</label>
             </div>
             <?= templateFile($x241, $x24check); ?>
           </div>
           <div class="col-12 col-md-6 mb-2">
             <div class="custom-file">
               <input type="file" class="custom-file-input" id="x242" name="x24[]" <?= $x24check; ?>>
               <label class="custom-file-label x242" for="x242">NDA</label>
             </div>
             <?= templateFile($x242, $x24check); ?>
           </div>
           <div class="col-12 col-md-6 mb-2">
             <div class="custom-file form-group">
               <input type="file" class="custom-file-input" id="x243" name="x24[]" <?= $x24check; ?>>
               <label class="custom-file-label x243" for="x243">Bank Garansi</label>
             </div>
             <?= templateFile($x243, $x24check); ?>
           </div>
         </div>
       </div>
       <div class="form-group pt-2">
         <button class="btn btn-primary" type="submit" name="upload_document">Save</button>
         <a href="" onclick="window.history.go(-1); return false;" class=" btn btn-danger"> Back</a>
       </div>
       </form>
     </div>
   </div>
 </div>
 </div>

 <!-- Modal -->
 <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewDocumentLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="viewDocumentLabel">View Document</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
         <div id="viewDocument"></div>
       </div>
     </div>
   </div>
 </div>

 <!-- Modal Commision Voucher -->
 <div class="modal fade" id="formCommVoucher" tabindex="-1" aria-labelledby="judulModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
   <div class="modal-dialog modal-lg modal-dialog-scrollable">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="judulModalLabel">Create Commision Voucher</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>

       <div class="modal-body modal-body-comm-voucher">
         <?= form_open('projectDocument/tambahCommVoucher', 'class=commForm') ?>
         <input type="hidden" name="nomor_rfq" id="nomor_rfq" value="<?= $user['nomor_rfq']; ?>">

         <div class="row">
           <div class="col-md offset-md-4">
             <h4 style="font-weight:bold">Project Information</h4>
           </div>
         </div>

         <div class="row">
           <div class="col-lg-4">
             <div class="form-group">
               <label for="projectName">Project Name</label>
               <input type="text" class="form-control" id="projectName" name="projectName" value="" autocomplete="off" required>
               <?= form_error('projectName', '<small class="text-danger ml-3">', '</small>'); ?>
             </div>
           </div>
           <div class="col-lg-4">
             <div class="form-group">
               <label for="internalProjectName">Internal Project Name</label>
               <input type="text" class="form-control" id="internalProjectName" name="internalProjectName" value="" autocomplete="off" required>
               <?= form_error('internalProjectName', '<small class="text-danger ml-3">', '</small>'); ?>
             </div>
           </div>
           <div class="col-lg-4">
             <div class="form-group">
               <label for="projectNumber">Project Number</label>
               <input type="text" class="form-control" id="projectNumber" name="projectNumber" value="<?= $user['nomor_rfq'] ?>" readonly="readonly">
               <?= form_error('projectNumber', '<small class="text-danger ml-3">', '</small>'); ?>
             </div>
           </div>
         </div>
         <div class="row">
           <div class="col-lg-6">
             <div class="form-group">
               <label for="client">Client</label>
               <input type="text" class="form-control" id="client" name="client" value="" autocomplete="off" required>
               <?= form_error('client', '<small class="text-danger ml-3">', '</small>'); ?>
             </div>
           </div>

           <div class="col-lg-3">
             <div class="form-group">
               <label for="phoneNumber">Phone Number</label>
               <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="" autocomplete="off" required>
               <?= form_error('phoneNumber', '<small class="text-danger ml-3">', '</small>'); ?>
             </div>
           </div>
           <div class="col-lg-3">
             <div class="form-group">
               <label for="faxNumber">Fax Number</label>
               <input type="text" class="form-control" id="faxNumber" name="faxNumber" autocomplete="off" value="">
             </div>
           </div>
         </div>
         <div class="row">
           <div class="col-lg-12 col-project-type">
             <div class="form-group">
               <label for="ProjectType">Project Type</label>
               <select multiple class="form-control" id="projectType" name="projectType[]" required>
                 <?php foreach ($methodology as $m) : ?>
                   <option value="<?= $m['methodology'] . ' - ' . $m['keterangan'] ?>"><?= $m['methodology'] . ' - ' . $m['keterangan'] ?></option>
                 <?php endforeach; ?>
               </select>
               <?= form_error('projectType[]', '<small class="text-danger ml-3">', '</small>'); ?>
             </div>
           </div>
         </div>
         <div class="row">
           <div class="col-lg-12">
             <div class="form-group">
               <label for="address">Address</label>
               <textarea type="textarea" class="form-control" id="address" name="address" autocomplete="off" required></textarea>
               <?= form_error('address', '<small class="text-danger ml-3">', '</small>'); ?>
             </div>
           </div>
         </div>
         <div class="row cp-body">
           <div class="col-lg-6">
             <div class="form-group">
               <label for="contactPerson">Name</label>
               <input type="text" class="form-control" id="contactPersonName" name="contactPersonName[]" value="" autocomplete="off" required>
               <?= form_error('contactPersonName[]', '<small class="text-danger ml-3">', '</small>'); ?>
             </div>
           </div>
           <div class="col-lg-6">
             <div class="form-group">
               <label for="contactPerson">Phone Number</label>
               <input type="text" class="form-control" id="contactPersonNumber" name="contactPersonNumber[]" value="" autocomplete="off" required>
               <?= form_error('contactPersonNumber[]', '<small class="text-danger ml-3">', '</small>'); ?>
             </div>
           </div>
         </div>
         <div class="col text-right"><button type="button" class="tambahCp btn-sm btn-success text-light" style="cursor:pointer;"><i class="fas fa-plus"></i> Tambah</button></div>

         <div class="row">

           <div class="col-lg-3">
             <div class="form-group">
               <label for="valueAddedTax">Value Added Tax</label>
               <input type="text" class="form-control subValue" id="valueAddedTax" name="valueAddedTax" value="0" autocomplete="off">
               <?= form_error('valueAddedTax', '<small class="text-danger ml-3">', '</small>'); ?>
             </div>
           </div>
           <div class="col-lg-3">
             <div class="form-group">
               <label for="hargaPokokProduksi">Harga Pokok Produksi</label>
               <input type="text" class="form-control subValue" id="hargaPokokProduksi" name="hargaPokokProduksi" value="0" autocomplete="off">
               <?= form_error('hargaPokokProduksi', '<small class="text-danger ml-3">', '</small>'); ?>
             </div>
           </div>
           <div class="col-lg-3">
             <div class="form-group">
               <label for="managementFee">Management Fee</label>
               <input type="text" class="form-control subValue" id="managementFee" name="managementFee" value="0" autocomplete="off">
               <?= form_error('managementFee', '<small class="text-danger ml-3">', '</small>'); ?>
             </div>
           </div>
           <div class="col-lg-3">
             <div class="form-group">
               <label for="contractValue">Contract Value</label>
               <input type="text" class="form-control" id="contractValue" name="" value="0" autocomplete="off" readonly>
               <input type="hidden" class="form-control" id="contractValue2" name="contractValue" value="0" autocomplete="off" readonly>
               <?= form_error('contractValue', '<small class="text-danger ml-3">', '</small>'); ?>
             </div>
           </div>
         </div>

         <hr>

         <div class="row">
           <div class="col-md offset-md-4">
             <h4 style="font-weight:bold">Payment Details</h4>
           </div>
         </div>

         <div class="row">
           <div class="col-md">
             <h5 style="font-weight:bold">Invoice</h5>
           </div>
         </div>

         <div class="row invoice-body">
           <div class="col-lg-3">
             <div class="form-group">
               <label for="termsPayment">Terms of Payment</label>
               <input type="number" class="form-control" id="termsPayment" name="termsPayment[]" value="" autocomplete="off" max="100" required>
               <?= form_error('termsPayment[]', '<small class="text-danger ml-3">', '</small>'); ?>
             </div>
           </div>
           <div class="col-lg-3">
             <div class="form-group">
               <label for="loa">Based on LOA</label>
               <input type="text" class="form-control" id="loa" name="loa[]" value="" autocomplete="off" required>
               <?= form_error('loa[]', '<small class="text-danger ml-3">', '</small>'); ?>
             </div>
           </div>
           <div class="col-lg-3">
             <div class="form-group">
               <label for="paymenDetails">Collection Plan Date</label>
               <input type="date" class="form-control" id="paymentDate" name="paymentDate[]" value="" autocomplete="off" required>
               <?= form_error('paymentDate[]', '<small class="text-danger ml-3">', '</small>'); ?>
             </div>
           </div>
           <div class="col-lg-3">
             <div class="form-group">
               <label for="invoiceDate">Invoice Date</label>
               <input type="date" class="form-control" id="invoiceDate" name="invoiceDate[]" value="" autocomplete="off" required>
             </div>
           </div>
         </div>

         <div class="col text-right"><button type="button" class="tambahInvoice btn-sm btn-success text-light" style="cursor:pointer;"><i class="fas fa-plus"></i> Tambah</button></div>

         <div class="row mt-4">
           <div class="col-md">
             <h5 style="font-weight:bold">LOA or Order Confirmation</h5>
           </div>
         </div>
         <div class="row">
           <div class="col-lg-6">
             <label for="research Executive">Research Executive</label>
             <input type="text" class="form-control" id="researchExecutive" name="researchExecutive" value="" autocomplete="off" required>
             <?= form_error('researchExecutive', '<small class="text-danger ml-3">', '</small>'); ?>
           </div>
           <div class="col-lg-6">
             <label for="confirmLetter">Letter to be confirmed</label>
             <input type="text" class="form-control" id="confirmLetter" name="confirmLetter" value="" autocomplete="off">
           </div>
         </div>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
         <button type="submit" class="btn btn-primary">Submit</button>
       </div>
       </form>
     </div>
   </div>
 </div>

 <script type="application/javascript">
   const addInvoice = document.querySelector('.tambahInvoice');
   const addCp = document.querySelector('.tambahCp');

   const valueAddedTax = document.querySelector('#valueAddedTax');
   valueAddedTax.addEventListener('keyup', function() {
     countContractValue();
   })
   const hargaPokokProduksi = document.querySelector('#hargaPokokProduksi');
   hargaPokokProduksi.addEventListener('keyup', function() {})
   const managementFee = document.querySelector('#managementFee');
   managementFee.addEventListener('keyup', function() {
     countContractValue();
   })

   addInvoice.addEventListener('click', function() {
     const divBaru = document.createElement('div');
     countDiv = document.querySelectorAll('.invoice-body');
     console.log(this);
     if (countDiv.length < 4) {

       divBaru.className = "row invoice-body";
       divBaru.innerHTML = `
             <div class="col-lg-3">
               <div class="form-group">
                 <label for="termsPayment">Terms of Payment</label>
                 <input type="number" class="form-control" id="termsPayment` + countDiv.length + `" name="termsPayment[]" value="" autocomplete="off" max="100">
               </div>
             </div>
             <div class="col-lg-3">
               <div class="form-group">
                 <label for="loa">Based on LOA</label>
                 <input type="text" class="form-control" id="loa` + countDiv.length + `" name="loa[]" value="" autocomplete="off">
               </div>
             </div>
             <div class="col-lg-3">
               <div class="form-group">
                 <label for="paymenDetails">Collection Plan Date</label>
                 <input type="date" class="form-control" id="paymentDate` + countDiv.length + `" name="paymentDate[]" value="" autocomplete="off">
               </div>
             </div>
             <div class="col-lg-3">
               <div class="form-group">
                 <label for="invoiceDate">Invoice Date</label>
                 <input type="date" class="form-control" id="invoiceDate` + countDiv.length + `" name="invoiceDate[]" value="" autocomplete="off">
               </div>
             </div>
             `;
       document.querySelector('.invoice-body').parentElement.insertBefore(divBaru, this.parentElement);
     }
   });

   addCp.addEventListener('click', function() {
     console.log(this);
     const divBaru = document.createElement('div');
     countDivCp = document.querySelectorAll('.cp-body');
     divBaru.className = "row cp-body";
     divBaru.innerHTML = `
                     <div class="col-lg-6">
                         <div class="form-group">
                             <label for="contactPerson">Name</label>
                             <input type="text" class="form-control" id="contactPersonName` + countDivCp.length + `" name="contactPersonName[]" value="" autocomplete="off">
                         </div>
                     </div>
                     <div class="col-lg-6">
                         <div class="form-group">
                             <label for="contactPerson">Phone Number</label>
                             <input type="text" class="form-control" id="contactPersonNumber` + countDivCp.length + `" name="contactPersonNumber[]" value="" autocomplete="off">
                         </div>
                     </div>`;
     document.querySelector('.cp-body').parentElement.insertBefore(divBaru, this.parentElement);
   });

   //  buttonEdit.addEventListener('click', function() {})

   //  buttonTambah.addEventListener('click', function() {
   //    console.log(this);
   //  });
   $('#createCommVoucher').click(function() {

     console.log(this);
     const judulModal = document.querySelector('#judulModalLabel');
     judulModal.textContent = 'Create Commision Voucher';

     const form = document.querySelector('.modal-body-comm-voucher form');
     form.setAttribute('action', "<?= base_url('projectDocument/tambahCommVoucher') ?>");
     fillData();
   });
   $('#editCommVoucher').click(function() {

     console.log(this);
     const judulModal = document.querySelector('#judulModalLabel');
     judulModal.textContent = 'Edit Commision Voucher';

     const form = document.querySelector('.modal-body-comm-voucher form');
     form.setAttribute('action', "<?= base_url('projectDocument/updateCommVoucher') ?>");

     fillData();
   });



   $(document).ready(function() {
     var cekProposal = '<?php echo $cekProposal; ?>';
     if (parseInt(cekProposal)) {
       $(".hideCekProposal").hide();
       $('#cekProposal').attr('checked', true);
       $("#x213").attr("disabled", true);
       $("#x213").removeAttr('name');
     }
   });

   $('#cekProposal').change(function() {
     if (this.checked) {
       $("#x213").attr("disabled", true);
       $("#x213").removeAttr('name');
       $(".hideCekProposal").hide();
     } else {
       $("#x213").attr("disabled", false);
       $("#x213").attr('name', 'x21[]');
       $(".hideCekProposal").show();
     }
   });
   $('#x211').on('change', function(e) {
     var x211 = e.target.files[0].name;
     $(this).next('.x211').html(x211);
   });
   $('#x212').on('change', function(e) {
     var x212 = e.target.files[0].name;
     $(this).next('.x212').html(x212);
   });
   $('#x213').on('change', function(e) {
     var x213 = e.target.files[0].name;
     $(this).next('.x213').html(x213);
   });

   $('#x221').on('change', function(e) {
     var x221 = e.target.files[0].name;
     $(this).next('.x221').html(x221);
   });

   $('#x231').on('change', function(e) {
     var x231 = e.target.files[0].name;
     $(this).next('.x231').html(x231);
   });

   $('#x241').on('change', function(e) {
     var x241 = e.target.files[0].name;
     $(this).next('.x241').html(x241);
   });
   $('#x242').on('change', function(e) {
     var x242 = e.target.files[0].name;
     $(this).next('.x242').html(x242);
   });
   $('#x243').on('change', function(e) {
     var x243 = e.target.files[0].name;
     $(this).next('.x243').html(x243);
   });

   function view(e) {
     var url = '<?php echo base_url('file/document/') ?>';
     var options = {
       height: "500px"
     };
     PDFObject.embed(url + e, "#viewDocument", options);
   }

   function countContractValue() {
     const subValue = document.querySelectorAll('.subValue');
     const contractValue = document.querySelector('#contractValue');
     const contractValue2 = document.querySelector('#contractValue2');
     let total = 0;
     subValue.forEach(function(e, i) {
       total += parseInt(e.value);
     })
     if (isNaN(total)) total = 0;
     contractValue.value = 'Rp. ' + numberWithCommas(total);
     contractValue2.value = total;
   }

   function numberWithCommas(x) {
     return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
   }

   function fillData() {
     const addInvoice = document.querySelector('.tambahInvoice');
     const addCp = document.querySelector('.tambahCp');
     const selectedVal = $('#projectNumber option:selected').val();

     countDivCp = document.querySelectorAll('.cp-body').length;
     for (let i = 1; i < countDivCp; i++) {
       $('.cp-body-num' + i).remove();
     }
     countDivInvoice = document.querySelectorAll('.invoice-body').length;
     for (let i = 1; i < countDivInvoice; i++) {
       $('.invoice-body-num' + i).remove();
     }
     const projectNumberVal = $('#projectNumber').val();
     $.ajax({
       url: "<?= base_url('commisionVoucher/checkData') ?>",
       type: 'post',
       data: {
         rfq: projectNumberVal,
       },
       success: function(data) {
         data = JSON.parse(data);
         console.log(data.projectNumber);
         $('#projectName').val(data.projectName);
         $('#internalProjectName').val(data.internalProjectName);
         $('#projectNumber').val(data.projectNumber);
         $('#client').val(data.client);
         $('#phoneNumber').val(data.phone);
         $('#faxNumber').val(data.fax);
         $.each(data.projectType, function(i, e) {
           $("#projectType option[value='" + e + "']").prop("selected", true);
         })
         $('#address').val(data.address);
         const divBaruCp = document.createElement('div');
         countDivCp = document.querySelectorAll('.cp-body');
         for (let i = 0; i < data.contactPersonName.length; i++) {
           if (i != 0) {
             divBaruCp.className = "row cp-body cp-body-num" + i;
             divBaruCp.innerHTML = `
                   <div class="col-lg-6">
                       <div class="form-group">
                           <label for="contactPerson">Name</label>
                           <input type="text" class="form-control" id="contactPersonName` + i + `" name="contactPersonName[]" value="` + data.contactPersonName[i] + `" autocomplete="off">
                       </div>
                   </div>
                   <div class="col-lg-6">
                       <div class="form-group">
                           <label for="contactPerson">Phone Number</label>
                           <input type="text" class="form-control" id="contactPersonNumber` + i + `" name="contactPersonNumber[]" value="` + data.contactPersonNumber[i] + `" autocomplete="off">
                       </div>
                   </div>`;
             document.querySelector('.cp-body').parentElement.insertBefore(divBaruCp, addCp.parentElement);
           } else {
             console.log(data.contactPersonName[i]);
             $('#contactPersonName').val(data.contactPersonName[i]);
             $('#contactPersonNumber').val(data.contactPersonNumber[i]);
           }
         }
         $('#contractValue').val('Rp. ' + numberWithCommas(data.contractValue));
         $('#contractValue2').val(data.contractValue);
         $('#valueAddedTax').val(data.valueAddedTax);
         $('#hargaPokokProduksi').val(data.hargaPokokProduksi);
         $('#managementFee').val(data.managementFee);

         const divBaru = document.createElement('div');
         for (let i = 0; i < data.termsPayment.length; i++) {
           console.log(data.termsPayment[i]);
           if (i != 0) {
             divBaru.className = "row invoice-body invoice-body-num" + i;
             divBaru.innerHTML = `
                                   <div class="col-lg-3">
                                     <div class="form-group">
                                       <label for="termsPayment">Terms of Payment</label>
                                       <input type="number" class="form-control" id="termsPayment` + i + `" name="termsPayment[]" value="` + data.termsPayment[i] + `" autocomplete="off" max="100">
                                     </div>
                                   </div>
                                   <div class="col-lg-3">
                                     <div class="form-group">
                                       <label for="loa">Based on LOA</label>
                                       <input type="text" class="form-control" id="loa` + i + `" name="loa[]" value="` + data.loa[i] + `" autocomplete="off">
                                     </div>
                                   </div>
                                   <div class="col-lg-3">
                                     <div class="form-group">
                                       <label for="paymenDetails">Collection Plan Date</label>
                                       <input type="date" class="form-control" id="paymentDate` + i + `" name="paymentDate[]" value="` + data.paymentDate[i] + `" autocomplete="off">
                                     </div>
                                   </div>
                                   <div class="col-lg-3">
                                     <div class="form-group">
                                       <label for="invoiceDate">Invoice Date</label>
                                       <input type="date" class="form-control" id="invoiceDate` + i + `" name="invoiceDate[]" value="` + data.invoiceDate[i] + `" autocomplete="off">
                                     </div>
                                   </div>
                                   `;

           } else {
             $('#termsPayment').val(data.termsPayment[i]);
             $('#loa').val(data.loa[i]);
             $('#paymentDate').val(data.paymentDate[i]);
             $('#invoiceDate').val(data.invoiceDate[i]);
           }
           document.querySelector('.invoice-body').parentElement.insertBefore(divBaru, addInvoice.parentElement);
         }
         $('#researchExecutive').val(data.researchExecutive);
         $('#confirmLetter').val(data.confirmLetter);

       }
     })
   }
 </script>