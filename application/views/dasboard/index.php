<!-- Begin Page Content -->
<div class="container-fluid">


	<div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
	<div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>

	<!-- Page Heading -->

	<div class="row justify-content-center">
		<div class="col-12">
			<div class="d-sm-flex align-items-center justify-content-between mb-4">
				<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
				<button type="button" onclick="document.location.reload(true)" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-redo fa-sm text-white-50"></i> Refresh</button>
			</div>
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Alur Penggunaan Aplikasi</h6>
				</div>
				<div class="card-body">

					<ul class="timeline" id="timeline" style="margin-right: 35px;">
						<li class="li complete">
							<div class="timestamp">
								<a type="button" style="margin-right: 10px;" data-toggle="modal" data-target="#detailResearchBrief">
									Detail
								</a>
								<!-- <span class="date">#1<span> -->
							</div>
							<div class="status">
								<h4> <a href="<?= base_url('researchBrief') ?>" target="_blank" style="text-decoration: none;">Research Brief</a> </h4>
							</div>
						</li>
						<li class="li complete">
							<div class="timestamp">
								<a type="button" style="margin-right: 10px;" data-toggle="modal" data-target="#detailResearchRequest">
									Detail
								</a>
								<!-- <span class="date">11/15/2014<span> -->
							</div>
							<div class="status">
								<h4> <a href="<?= base_url('rfq') ?>" target="_blank" style="text-decoration: none;">Research Request</a></h4>
							</div>
						</li>
						<li class="li complete">
							<div class="timestamp">
								<a type="button" style="margin-right: 10px;" data-toggle="modal" data-target="#detailCommisionVoucher">
									Detail
								</a>
								<!-- <span class="date">TBD<span> -->
							</div>
							<div class="status">
								<h4> <a href="<?= base_url('commisionVoucher') ?>" target="_blank" style="text-decoration: none;">Commision Voucher</a> </h4>
							</div>
						</li>
						<li class="li complete">
							<div class="timestamp">
								<a type="button" style="margin-right: 10px;" data-toggle="modal" data-target="#detailProjectDocument">
									Detail
								</a>
								<!-- <span class="date">TBD<span> -->
							</div>
							<div class="status">
								<h4> <a href="<?= base_url('projectDocument') ?>" target="_blank" style="text-decoration: none;">Project Document</a> </h4>
							</div>
						</li>
						<li class="li complete">
							<div class="timestamp">
								<a type="button" style="margin-right: 20px;" data-toggle="modal" data-target="#detailTimePlan">
									Detail
								</a>
								<!-- <span class="date">TBD<span> -->
							</div>
							<div class="status">
								<h4> <a href="<?= base_url('projectPlan') ?>" target="_blank" style="text-decoration: none;">Time Plan & Project Spec</a> </h4>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Notification</h6>
				</div>
				<div class="card-body">
					<ul class="cbp_tmtimeline">

						<?php
						$no = 1;
						foreach ($rfq as $rfq) : ?>
							<?php
							$nomorReq = $rfq['nomor_rfq'];
							$commVoucher = $this->db->query("SELECT id_comm_voucher FROM comm_voucher WHERE nomor_project = '$nomorReq'")->row_array();

							$document = $this->db->query("SELECT * FROM project_document WHERE nomor_rfq = '$nomorReq'")->row_array();
							$doc21 = isset($document['document_x21']) ? unserialize($document['document_x21']) : 0;
							$doc22 = isset($document['document_x22']) ? unserialize($document['document_x22']) : 0;
							$doc = isset($document['document_x24']) ? unserialize($document['document_x24']) : 0;

							$projectPlan = $this->db->query("SELECT * FROM project_plan WHERE nomor_rfq = '$nomorReq'")->row_array();
							?>
							<?php if (($rfq['last_status'] != 1 && $rfq['last_status'] != 2) || ($rfq['last_status'] == 1 && !$commVoucher) || ($rfq['last_status'] == 1 && !$projectPlan) || ($rfq['last_status'] != 2 && (!@$doc21[0] || !@$doc21[1] || !@$doc21[2] || !@$doc22[0] || !@$doc23[1] || !@$doc23[1] || !@$doc23[2]))) : ?>
								<li>
									<div class="cbp_tmtime mt-1" style="width: 300px;">
										<b><?= $rfq['nomor_rfq'] ?></b>
									</div>
									<div class="cbp_tmicon" style="background-color: white;"><i class="fas fa-arrow-circle-right mt-2" style="color: black;"></i></div>
									<div class="cbp_tmlabel clearfix">
										<!-- <h2><span><?php echo $rfq['nomor_rfq'] ?> (<?php echo $rfq['nomor_rfq'] ?>)</span> - <a href="<?php echo base_url('rfq') ?>/status/<?php echo $rfq['nomor_rfq'] ?>"><?php echo $rfq['nomor_rfq'] ?></a></h2> -->
										<p><b>Status Request:
												<?php
												if ($rfq['last_status'] == 1) $color = "green";
												else if ($rfq['last_status'] == 2) $color = "red";
												else $color = "blue";
												?>
												<span style="color:<?= $color ?>"><?php echo $rfq['status'] ?></span>
											</b>
										</p>
										<?php $link = base_url('rfq/status/') . $rfq['nomor_rfq']; ?>
										<?php if ($rfq['last_status'] == 1) : ?>
											<?php if (!isset($commVoucher['id_comm_voucher'])) : ?>
												<p><b>Commision Voucher: </b>
													<span>Data tidak ada</span>
												</p>
												<?php $status = 1; ?>
												<?php $link = base_url('commisionVoucher?rfq=') . $rfq['nomor_rfq']; ?>
											<?php endif; ?>
										<?php endif; ?>
										<?php if (@unserialize($document['document_x21'])) : ?>
											<p>
												<b>Kekurangan Dokumen:</b>
											<ul>
												<?php if (!@$doc21[0]) : ?>
													<li>Term of Reference Tidak ada</li>
												<?php endif; ?>
												<?php if (!@$doc21[1]) : ?>
													<li>Surat Penawaran Harga Tidak ada</li>
												<?php endif; ?>
												<?php if (!@$doc21[2]) : ?>
													<li>Proposal Final Tidak ada</li>
												<?php endif; ?>

												<?php if (!@$doc22[0]) : ?>
													<li>Surat Perintah Kerja Tidak ada</li>
												<?php endif; ?>

												<?php if (!@$doc[0]) : ?>
													<li>Kontrak Kerja Tidak ada</li>
												<?php endif; ?>
												<?php if (!@$doc[1]) : ?>
													<li>Bank Garasi Tidak ada</li>
												<?php endif; ?>
												<?php if (!@$doc[2]) : ?>
													<li>NDA Tidak ada</li>
												<?php endif; ?>
											</ul>
											</p>
											<?php $status = 0; ?>
										<?php if ($status != 1) :
												$status = 1;
												$link = base_url('projectDocument/document/') . $rfq['nomor_rfq'];
											endif;
										endif; ?>

										<?php if ($rfq['last_status'] == 1) : ?>
											<?php if (!isset($projectPlan['id_project_plan'])) : ?>
												<p><b>Project Plan: </b>
													<span>Data tidak ada</span>
												</p>
												<?php if ($status != 1) : ?>
													<?php $link = base_url('projectSpec/view/') . $rfq['nomor_rfq']; ?>
												<?php endif; ?>
											<?php endif; ?>
										<?php endif; ?>

										<a href="<?= $link ?>" target="_blank" type="button" class="btn btn-primary btn-sm float-right rounded">Take Action</a>
									</div>
								</li>
							<?php endif; ?>
						<?php
							// break;
							$no++;
							$status = 0;
						endforeach; ?>

					</ul>

				</div>
			</div>
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Display Jadwal Fu</h6>
				</div>
				<div class="card-body">
					<ul class="cbp_tmtimeline">

						<?php
						$no = 1;
						foreach ($fu as $data) : ?>
							<?php if ($no == 1) : ?>
								<li>
									<time class="cbp_tmtime" datetime="2017-11-04T18:30"><span class="hidden text-success"><?php echo date('h:i A', strtotime($data['date'])) ?></span> <span class="large"><?php echo date('d F Y', strtotime($data['date'])) ?></span></time>
									<div class="cbp_tmicon"><i class="fas fa-bell"></i></div>
									<div class="cbp_tmlabel">
										<h2><span><?php echo $data['nama_project'] ?> (<?php echo $data['kode_project'] ?>)</span> - <a href="<?php echo base_url('rfq') ?>/status/<?php echo $data['nomor_rfq'] ?>"><?php echo $data['nomor_rfq'] ?></a></h2>
										<p><b>Schedule :</b> <?php echo $data['ket'] ?></p>
									</div>
								</li>
							<?php else : ?>
								<li>
									<time class="cbp_tmtime" datetime="2017-11-04T18:30"><span class="hidden"><?php echo date('h:i A', strtotime($data['date'])) ?></span> <span class="large"><?php echo date('d F Y', strtotime($data['date'])) ?></span></time>
									<div class="cbp_tmicon"><i class="fas fa-calendar"></i></div>
									<div class="cbp_tmlabel">
										<h2><span><?php echo $data['nama_project'] ?> (<?php echo $data['kode_project'] ?>)</span> - <a href="<?php echo base_url('rfq') ?>/status/<?php echo $data['nomor_rfq'] ?>"><?php echo $data['nomor_rfq'] ?></a></h2>
										<p><b>Schedule :</b> <?php echo $data['ket'] ?></p>
									</div>
								</li>
							<?php endif; ?>
						<?php
							$no++;
						endforeach; ?>

					</ul>
				</div>
			</div>
		</div>
	</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<!-- Modal -->
<div class="modal fade" id="detailResearchBrief" tabindex="-1" aria-labelledby="detailResearchBriefLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="detailResearchBriefLabel">Detail Research Brief</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Pembuatan Research Brief dilakukan untuk mengetahui identitas perusahaan dan keperluan riset yang akan dilakukan.
				<br><br>
				Pada pembuatan research brief, diwajibkan untuk mengisi beberapa pertanyaan mengenai profil perusahaan, Latar Belakang Riset, Methodology, dst.
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button onclick="window.open('researchBrief','_blank');" type="button" class="btn btn-primary">Go To</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="detailResearchRequest" tabindex="-1" aria-labelledby="detailResearchRequestLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="detailResearchRequestLabel">Detail Research Request</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Research Request diperlukan untuk mendata proses request dari client.
				<br><br>
				Pada research request, diwajibkan untuk mengisi beberapa data serta menyertakan beberapa file seperti research brief dari perusahaan tersebut dan Term of Reference (TOR).
				<br><br>
				Keberlangsungan permintaan riset dapat dilihat dari Research Request yang sebelumnya telah dibuat.
				<br><br>
				Research Request harus selalu up to date terhadap status dari permintaan riset tersebut. Status pada research request dapat berupa Deal, No Deal, Pending, dll.

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button onclick="window.open('rfq','_blank');" type="button" class="btn btn-primary">Go To</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="detailCommisionVoucher" tabindex="-1" aria-labelledby="detailCommisionVoucherLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="detailCommisionVoucherLabel">Detail Commision Voucher</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Commision Voucher merupakan tahap akhir dari proses permintaan riset.
				<br><br>
				Commision Voucher dibuat setelah research request berakhir dengan status "Deal". Commision Voucher juga berguna untuk pembukaan akses budget terhadap project tersebut.
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button onclick="window.open('commisionVoucher','_blank');" type="button" class="btn btn-primary">Go To</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="detailProjectDocument" tabindex="-1" aria-labelledby="detailProjectDocumentLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="detailProjectDocumentLabel">Detail Project Document</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Project Document merupakan Kumpulan Dokumen yang berkaitan dengan project dan harus dilengkapi.
				<br><br>
				Kelengkapan Project Document perlu ditambahkan untuk melengkapi informasi mengenai project yang ada. Dokumen yang perlu ditambahkan seperti Term of Reference, Surat Penawaran Harga, Surat Perintah Kerja, dll.
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button onclick="window.open('projectDocument','_blank');" type="button" class="btn btn-primary">Go To</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="detailTimePlan" tabindex="-1" aria-labelledby="detailTimePlanLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="detailTimePlanLabel">Detail Time Plan & Project Spec</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Time Plan dan Project Specification dibuat setelah project request mencapai status deal
				<br><br>
				Pada Project Specification diwajibkan mengisi detail dari project dan diperlukan memilih team yang akan terlibat dalam pekerjaan sebuah project.
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button onclick="window.open('projectPlan','_blank');" type="button" class="btn btn-primary">Go To</button>
			</div>
		</div>
	</div>
</div>