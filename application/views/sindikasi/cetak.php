<?php 
$perusahaan = $this->Perusahaan_model->getPerusahaanById($rfq['id_perusahaan']);
$customer = $this->Customer_model->getCustomerById($rfq['id_customer']);
 ?>

<style>
	body{
		font-family: "Arial Black", Gedget, sans-serif;
	}
	.row h2,h5{
		text-align: center;
	}

	.row h5{
		padding-top: -10;
	}

	.table{
		border-collapse: collapse;
		width: 100%;
	}

	.table{
		border: 1px solid black;
		text-align: center;
		font-size: 12px;
	}

	.table-c{
		border: 0px;
		font-size: 12px;
		padding-left: 50px;
		padding-top: 10px;
		padding-bottom: 10px;
	}

	.table-c th{
		width: 100px;
	}

	.table-t{
		font-size: 12px;
		padding-left: 50px;
		padding-right: 50px;
		padding-top: 10px;
		width: 100%;
	}
	.table-t th{
		border: 0px solid black;
		width: 100px;
		text-align: center;
	}
	.table-t td{
		border-bottom: 1px solid black;
		padding: 20px;
	}

	.cs{
		font-size: 12px;
		padding-top: 20px;
	}

	.cs td{
		padding: 10px;
	}

	.bot1{
		width: 200px;
		font-size: 12px;
		padding-left: 50px;
		padding-right: 50px;
		padding-top: 20px;	
	}

	.bot1 th{
		text-align: center;
	}

	.bot1 td{
		border-bottom: 1px solid black;
		padding: 20px;
		padding-top: 60px;
	}

	.bot2{
		width: 350px;
		font-size: 12px;
		padding-top: -103px;
		margin-left: 220px;	
	}

	.bot2 th{
		text-align: center;
	}

	.bot2 td{
		border-bottom: 1px solid black;
		padding: 20px;
		padding-top: 60px;
	}

	.bot3{
		width: 500px;
		font-size: 12px;
		padding-top: -103px;
		margin-left: 400px;	
	}

	.bot3 th{
		text-align: center;
	}

	.bot3 td{
		border-bottom: 1px solid black;
		padding: 20px;
		padding-top: 60px;
	}

	.bawah{
		width: 500px;
		padding-top: 30px;
		padding-left: 200px;
		border-collapse: collapse;
		font-size: 12px;
		padding-bottom: 40px;
		text-align: center;
	}
	.bawah th{
		border: 1px solid black;
	}

	.bawah td{
		border: 1px solid black;
		padding: 10px;
	}

	p{
		font-size: 10px;
	}
	
</style>
<body>
<div class="row">	
	<h2>COMMISSION VOUCHER</h2>
	<h5>ACC - FIN -TAX</h5>

	<div>
		<table class="table">
			<td>A. PROJECT INFORMATION</td>
		</table>
	</div>

	<div class="content">
		<table class="table-c">
			<tr>
				<th>1. Project Name</th>
				<td>:</td>
				<td><?php echo $rfq['nama_project'] ?></td>
			</tr>
			<tr>
				<th>2. Project No</th>
				<td>:</td>
				<td><?php echo $rfq['kode_project'] ?></td>
			</tr>
			<tr>
				<th>3. Project Type</th>
				<td>:</td>
				<td></td>
			</tr>
			<tr>
				<th>4. Client</th>
				<td>:</td>
				<td><?php echo $perusahaan['nama'] ?></td>
			</tr>
			<tr>
				<th>5. Address</th>
				<td>:</td>
				<td><?php echo $perusahaan['alamat'] ?></td>
			</tr>
			<tr>
				<th>6. Phone No</th>
				<td>:</td>
				<td><?php echo $perusahaan['telp'] ?></td>
			</tr>
			<tr>
				<th>7. Fax No</th>
				<td>:</td>
				<td><?php echo $perusahaan['fax'] ?></td>
			</tr>
			<tr>
				<th>8. Contact Person</th>
				<td>:</td>
				<td><?php echo $customer['nama'] ?></td>
			</tr>
			<tr>
				<th>9. Contract Value</th>
				<td>:</td>
				<td></td>
			</tr>
		</table>
	</div>

	<div>
		<table class="table">
			<td>B. PAYMENT DETAILS</td>
		</table>
	</div>
	<div>
		<table class="table-t">
			<tr>
				<th></th>
				<th>Terms Of Payment</th>
				<th>Based On LOA</th>
				<th>Payment Details Collection Date</th>
				<th>Signature</th>
			</tr>
			<tr>
				<th>1. First Invoice</th>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<th>2. Second Invoice</th>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<th>3. Third Invoice</th>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<th>4. Fourth Invoice</th>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</table>
	</div>

	<div class="cs">
		LOA or Order Confirmation 
		<table>
			<tr>
				<td width="150px">Letter to be followed by</td>
				<td>:</td>
				<td class="isi"></td>
			</tr>
			<tr>
				<td>Research Executive</td>
				<td>:</td>
				<td class="isi"></td>
			</tr>
		</table>
	</div>

	<div class"a1">
	<table class="bot1">
		<tr>
			<th>Prepared By,</th>
		</tr>
		<tr>
			<td></td>
		</tr>
	</table>
	</div>
	<div class="a2">
	<table class="bot2">
		<tr>
			<th>Acknowledged by,</th>
		</tr>
		<tr>
			<td></td>
		</tr>
	</table>
	</div>

	<div class="a2">
	<table class="bot3">
		<tr>
			<th>Received By,</th>
		</tr>
		<tr>
			<td></td>
		</tr>
	</table>
	</div>

</div>

	<div>
		<table class="bawah">
			<tr>
				<th colspan="2">Input By</th>
				<th colspan="2">Checked By</th>
			</tr>
			<tr>
				<th>Paraf</th>
				<th>Date</th>
				<th>Paraf</th>
				<th>Date</th>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<th colspan="2">Finance Officer</th>
				<th colspan="2">Head Of Accounting</th>
			</tr>
		</table>
	</div>

	<div>
		<p>- LOA Proposal Subcontract(Qualitative, Quantitaive & Banking Project) must be attached with commision Voucher upon Submission </p>
		<p>- Order form and Confirmation Letter(Syndicated Projects) must be attached with Voucher Upon Submission</p>
	</div>
