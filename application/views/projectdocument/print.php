<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .footer-doc {
            position: absolute;
            bottom: -20px;
            font-size: 12px;
            color: #111;
            text-align: left
        }

        body {
            padding: 50px;
            position: relative;
        }

        .heading {
            font-family: 'Times New Roman', Times, serif;
            text-align: center;
            margin-bottom: 10px;

            margin-top: 30px;
        }

        .sub-heading {
            width: 100%;
            text-align: center;
            border: 1px solid black;
            margin-bottom: 3px;
            margin-top: 3px;
            padding: 5px;
        }

        table td span.form {
            margin: 5px 20px;
        }

        table td span.field {
            display: inline;
            border-bottom: 1px solid black;
        }

        table {

            width: 100%;
            padding: 5px 20px;
            border: 1px solid black;
        }

        table.project-information tr td:first-child {
            width: 0px;
        }

        table.project-information tr td:nth-child(2) {
            width: 0px;
        }

        table.project-information tr td:last-child {
            width: 160px;
        }

        table.payment-details tr>th {
            text-align: center;
            padding-bottom: 1em;
        }

        table.payment-details tr>td {
            text-align: center;
            padding-bottom: 1em;
        }

        table.sign {
            text-align: center;
        }

        table.sign tr td p {
            display: block;
            margin-top: 70px;
        }

        img {
            position: absolute;
            width: 130px;
            top: 10;
            left: 10;
        }
    </style>
</head>

<body>

    <?php
    $queryMataUang = $this->MataUang_model->getMataUangById($commVoucher['id_mata_uang']);
    $simbolMataUang = $queryMataUang['simbol_mata_uang'];
    $pemisahMataUang = $queryMataUang['pemisah'];
    ?>

    <img src="/var/www/html/dev-digital-market/assets/img/logomri.png" alt="">
    <h4 class="heading">COMMISION VOUCHER</h4>
    <h5 class="sub-heading">A.PROJECT INFORMATION</h5>
    <table class="project-information">
        <tr>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <td>
                1. Project Title
            </td>
            <td>
                :
            </td>
            <td>
                <p style="width: 100%; border-bottom:1px solid black;"><?= $commVoucher['nama_project']; ?></p>
            </td>
        </tr>
        <tr>
            <td>
                2. Internal Project Title
            </td>
            <td>
                :
            </td>
            <td>
                <p style="width: 100%; border-bottom:1px solid black;"><?= ($commVoucher['nama_project_internal']) ?  $commVoucher['nama_project_internal'] : '-' ?></p>
            </td>
        </tr>
        <tr>
            <td>
                3. Order No.
            </td>
            <td>
                :
            </td>
            <td>
                <p style="width: 100%; border-bottom:1px solid black;"><?= $commVoucher['nomor_project']; ?></p>
            </td>
        </tr>
        <tr>
            <td>
                4. No. Commission Voucher
            </td>
            <td>
                :
            </td>
            <td>
                <p style="width: 100%; border-bottom:1px solid black;"><?= ($commVoucher['nomor_commission_voucher']) ? ($commVoucher['nomor_commission_voucher']) : '-' ?></p>
            </td>
        </tr>
        <tr>
            <td>
                5. Project Type
            </td>
            <td>
                :
            </td>
            <td>
                <p style="width: 100%; border-bottom:1px solid black;">
                    <?php
                    $arrMethod = unserialize($commVoucher['tipe_project']);
                    for ($i = 0; $i < count($arrMethod); $i++) {
                        echo $arrMethod[$i];
                        if ($i < count($arrMethod) - 1) echo ', ';
                    }
                    ?>
                </p>
            </td>
        </tr>
        <tr>
            <td>
                6. Client
            </td>
            <td>
                :
            </td>
            <td>
                <p style="width: 100%; border-bottom:1px solid black;"><?= $commVoucher['client']; ?></p>
            </td>
        </tr>
        <tr>
            <td>
                7. Address
            </td>
            <td>
                :
            </td>
            <td>
                <p style="width: 100%; border-bottom:1px solid black;"><?= $commVoucher['alamat']; ?></p>
            </td>
        </tr>
        <tr>
            <td>
                8. Phone No
            </td>
            <td>
                :
            </td>
            <td>
                <p style="width: 100%; border-bottom:1px solid black;"><?= ($commVoucher['telp']) ?  $commVoucher['telp'] : '-' ?></p>
            </td>
        </tr>
        <tr>
            <td>
                9. Email
            </td>
            <td>
                :
            </td>
            <td>
                <p style="width: 100%; border-bottom:1px solid black;"><?= ($commVoucher['email']) ?  $commVoucher['email'] : '-' ?></p>
            </td>
        </tr>
        <tr>
            <td>
                10. Contact Person
            </td>
            <td>
                :
            </td>
            <td>
                <p style="width: 100%; border-bottom:1px solid black;">
                    <?php
                    $arrNamaCp = unserialize($commVoucher['nama_contact_person']);
                    $arrJabatanCp = unserialize($commVoucher['jabatan_contact_person']);
                    $arrNomorCp = unserialize($commVoucher['nomor_contact_person']);
                    for ($i = 0; $i < count($arrNamaCp); $i++) {
                        echo $arrNamaCp[$i] . " ($arrJabatanCp[$i])" . ' - ' . $arrNomorCp[$i];
                        if ($i < count($arrNomorCp) - 1) echo ', ';
                    }
                    ?>
                </p>
            </td>
        </tr>
        <tr>
            <td>
                11. Harga Pokok Produksi
            </td>
            <td>
                :
            </td>
            <td>
                <p style="width: 100%; border-bottom:1px solid black;"><?= $simbolMataUang . ' ' . number_format($commVoucher['harga_pokok_produksi'], 0, ",", "$pemisahMataUang"); ?></p>
            </td>
        </tr>
        <tr>
            <td>
                12. Management Fee
            </td>
            <td>
                :
            </td>
            <td>
                <p style="width: 100%; border-bottom:1px solid black;"> <?= $simbolMataUang . ' ' . number_format($commVoucher['management_fee'], 0, ",", "$pemisahMataUang"); ?></p>
            </td>
        </tr>
        <tr>
            <td>
                13. Pajak Pertambahan Nilai
            </td>
            <td>
                :
            </td>
            <td>
                <p style="width: 100%; border-bottom:1px solid black;"><?= ($commVoucher['ppn'] == 1) ? '10' : '0' ?>%</p>
            </td>
        </tr>
        <tr>
            <td>
                14. Contract Value
            </td>
            <td>
                :
            </td>
            <td>
                <p style="width: 100%; border-bottom:1px solid black;"><?= $simbolMataUang . ' ' . number_format($commVoucher['contract_value'], 0, ",", "$pemisahMataUang"); ?></p>
            </td>
        </tr>
    </table>


    <h5 class="sub-heading">B. PAYMENT DETAILS</h5>
    <table class="payment-details">
        <tr>
            <th style="width: 16%;">#</th>
            <th>Terms of Payment (%)</th>
            <th style="width: 20%;">Based On LOA</th>
            <th>Collection Plan Date</th>
            <th>Invoice Date</th>
            <th>Invoice Number</th>
            <th style="width: 5%;">Paraf</th>
        </tr>
        <?php
        $status = ['First Invoice', 'Second Invoice', 'Third Invoice', 'Fourth Invoice'];
        $arrPayment = unserialize($commVoucher['terms_of_payment']);
        $arrLoa = unserialize($commVoucher['based_on_loa']);
        $arrDate = unserialize($commVoucher['payment_date']);
        $invoiceDate = unserialize($commVoucher['invoice_date']);
        for ($i = 0; $i < count($arrPayment); $i++) { ?>
            <tr>
                <td><?= $status[$i] ?></td>
                <td><?= $arrPayment[$i]; ?> %</td>
                <td><?= $arrLoa[$i]; ?></td>
                <td><?= $arrDate[$i]; ?></td>
                <td><?= $invoiceDate[$i]; ?></td>
                <td></td>
                <td></td>
            </tr>
        <?php } ?>

    </table>

    <h5 class="sub-heading">C. LOA or Order Confirmation</h5>
    <table class="project-information">
        <tr>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <td>
                Research Executive
            </td>
            <td>
                :
            </td>
            <td>

                <?php
                $researchExecutive = $this->User_model->getUserById($commVoucher['research_executive']);
                $jabatan = $this->Dept_model->getDeptById($researchExecutive['dept']);
                ?>
                <p style="width: 100%; border-bottom:1px solid black;"><?= $researchExecutive['nama_user']; ?> - <?= $jabatan['dept']; ?></p>
            </td>
        </tr>
        <tr>
            <td>
                LOA to be followed up by
            </td>
            <td>
                :
            </td>
            <td>
                <?php
                $letterTo = $this->User_model->getUserById($commVoucher['letter_to_followed_by']);
                $jabatan = $this->Dept_model->getDeptById($letterTo['dept']);
                ?>
                <p style="width: 100%; border-bottom:1px solid black;"><?= $letterTo['nama_user']; ?> - <?= $jabatan['dept']; ?></p>
            </td>
        </tr>
    </table>

    <table class="sign" style="margin-top: 2px;">
        <tr>
            <td>Prepared by,</td>
            <td>Acknowledged by,</td>
            <td>Authorized by <br>Management,</td>
        </tr>
        <tr>
            <td>
                <p>_______________</p>
            </td>
            <td>
                <p>_______________</p>
            </td>
            <td>
                <p>_______________</p>
            </td>
        </tr>
    </table>


    <span class="footer-doc">Dokumen ini dibuat melalui Aplikasi Digitalisasi Marketing. Kode Dokumen: <?= $commVoucher['kode_dokumen']; ?></span>
</body>

</html>