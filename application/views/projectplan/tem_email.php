<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0;">
    <meta name="format-detection" content="telephone=no"/>

    <!-- Responsive Mobile-First Email Template by Konstantin Savchenko, 2015.
    https://github.com/konsav/email-templates/  -->

    <style>
        /* Reset styles */ 
        body { margin: 0; padding:0; min-width: 100%; width: 100% !important; height: 100% !important;}
        body, table, td, div, p, a { -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%; }
        table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse !important; border-spacing: 0; }
        img { border: 0; line-height: 100%; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; }
        #outlook a { padding: 0; }
        .ReadMsgBody { width: 100%; } .ExternalClass { width: 100%; }
        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div { line-height: 100%; }

        /* Extra floater space for advanced mail clients only */ 
        @media all and (max-width: 600px) {
            .floater { width: 320px; }
        }

        /* Set color for auto links (addresses, dates, etc.) */ 
        a, a:hover {
            color: #127DB3;
        }
        .footer a, .footer a:hover {
            color: #999999;
        }

    </style>

</head>

<!-- BODY -->
<!-- Set message background color (twice) and text color (twice) -->
<body topmargin="0" rightmargin="0" bottommargin="0" leftmargin="0" marginwidth="0" marginheight="0" width="100%" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; width: 100%; height: 100%; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%;
    background-color: #f8f8f8;;
    color: #000000;"
    bgcolor="#f8f8f8;"
    text="#000000">

<!-- SECTION / BACKGROUND -->
<!-- Set section background color -->
<table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;  display: block !important; clear: both !important; margin: 0 auto !important; max-width: 580px !important;" class="background"><tr><td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;"
    bgcolor="#007bff">

<!-- WRAPPER -->
<!-- Set wrapper width (twice) -->
<table border="0" cellpadding="0" cellspacing="0" align="center"
    width="600" style="border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit;
    max-width: 600px;" class="wrapper">

    <tr>
        <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
            padding-top: 20px; padding-bottom: 20px;">

            <!-- PREHEADER -->
            <!-- Set text color to background color -->
            

            <!-- LOGO -->
            <!-- Image text color should be opposite to background color. Set your url, image src, alt and title. Alt text should fit the image size. Real image size should be x2. URL format: http://domain.com/?utm_source={{Campaign-Source}}&utm_medium=email&utm_content=logo&utm_campaign={{Campaign-Name}} -->
            <img src="http://180.211.92.132:60/digital-market/images/logo.png" width="100" style="width: 100%; max-width: 100px">

        </td>
    </tr>

    <!-- HEADER -->
    <!-- Set text color and font family ("sans-serif" or "Georgia, serif") -->
    
<!-- End of WRAPPER -->
</table>

<!-- SECTION / BACKGROUND -->
<!-- Set section background color -->
</td></tr><tr><td valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 20px;
    padding-top: 20px;"
    bgcolor="#FFFFFF">

<!-- WRAPPER -->
<!-- Set conteiner background color -->
<table border="0" cellpadding="0" cellspacing="0"
    width="600" style="border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit;
    max-width: 600px;">

    
    <tr>
        <td>
            <h2 style="font-family: 'Avenir Next', 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; line-height: 1.65;">Dear <?php echo $user ?></h2>
            <p id="isiTem" style="font-family: 'Avenir Next', 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; line-height: 1.65;">
                Untuk dapat Menghadiri undangan <?php echo $ket ?> project <?php echo $project ?> pada :
                <br>
                <table  style="border-collapse: collapse; border-spacing: 0; margin-left: 50px; width: inherit; max-width: 600px;">
                    <tr>
                        <td style="padding: 3px">Tanggal</td>
                        <td style="padding: 3px">: <?php  echo $tanggal ?></td>
                    </tr>
                    <tr>
                        <td style="padding: 3px">Jam</td>
                        <td style="padding: 3px">: <?php echo $jam ?></td>
                    </tr>
                    <tr>
                        <td style="padding: 3px">Tempat</td>
                        <td style="padding: 3px">: <?php echo $tempat ?></td>
                    </tr>
                </table> 
                Terimakasih atas perhatiannya
            </p>

            <br>
            <br>
            <br>
            <p style="font-family: 'Avenir Next', 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; line-height: 1.65;">Regards</p>
            <p><em>– <?php  echo $this->session->userdata('ses_nama'); ?></em></p>
        </td>
    </tr>


<!-- End of WRAPPER -->
</table>

<!-- SECTION / BACKGROUND -->
<!-- Set section background color -->
</td></tr><tr><td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;"
    bgcolor="#FFFFFF">

<!-- WRAPPER -->
<!-- Set wrapper width (twice) -->
<table border="0" cellpadding="0" cellspacing="0" align="center"
    width="600" style="border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit;
    max-width: 600px;" class="wrapper">

    <!-- SOCIAL NETWORKS -->
    <!-- Image text color should be opposite to background color. Set your url, image src, alt and title. Alt text should fit the image size. Real image size should be x2 -->

    <!-- FOOTER -->
    <!-- Set text color and font family ("sans-serif" or "Georgia, serif"). Duplicate all text styles in links, including line-height -->
    <tr>
        <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 1%; padding-right: 6.25%; width: 87.5%; font-size: 13px; font-weight: 400; line-height: 150%;
            padding-top: 20px;
            padding-bottom: 20px;
            color: #999999;
            font-family: sans-serif;" class="footer">
            <p>Scan QRCode saat absensi</p>
            <img src="http://180.211.92.132:60/digital-market/assets/images/<?php echo $image ?>">
        </td>
    </tr>

<!-- End of WRAPPER -->
</table>

<!-- End of SECTION / BACKGROUND -->
</td></tr>

<tr><td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;"
    bgcolor="#F0F0F0">

<!-- WRAPPER -->
<!-- Set wrapper width (twice) -->
<table border="0" cellpadding="0" cellspacing="0" align="center"
    width="600" style="border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit;
    max-width: 600px;" class="wrapper">

    <!-- SOCIAL NETWORKS -->
    <!-- Image text color should be opposite to background color. Set your url, image src, alt and title. Alt text should fit the image size. Real image size should be x2 -->
    <tr>
        <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
            padding-top: 25px;" class="social-icons"><table
            width="80" border="0" cellpadding="0" cellspacing="0" align="center" style="border-collapse: collapse; border-spacing: 0; padding: 0;">
            <tr>

                <!-- ICON 1 -->
                <td align="center" valign="middle" style="margin: 0; padding: 0; padding-left: 5px; padding-right: 5px; border-collapse: collapse; border-spacing: 0;"><a target="_blank"
                    href="https://www.facebook.com/mriresearchindonesia/"
                style="text-decoration: none;"><img border="0" vspace="0" hspace="0" style="padding: 0; margin: 0; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; border: none; display: inline-block;
                    color: #000000;"
                    alt="F" title="Facebook"
                    width="30" height="30"
                    src="http://180.211.92.132:60/digital-market/images/facebook.png"></a></td>

                <!-- ICON 2 -->
                <td align="center" valign="middle" style="margin: 0; padding: 0; padding-left: 5px; padding-right: 5px; border-collapse: collapse; border-spacing: 0;"><a target="_blank"
                    href="https://www.instagram.com/marketingresearch.indonesia/"
                style="text-decoration: none;"><img border="0" vspace="0" hspace="0" style="padding: 0; margin: 0; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; border: none; display: inline-block;
                    color: #000000;"
                    alt="T" title="Instagram"
                    width="30" height="30"
                    src="http://180.211.92.132:60/digital-market/images/instagram2.png"></a></td>             

                <!-- ICON 3 -->
                <td align="center" valign="middle" style="margin: 0; padding: 0; padding-left: 5px; padding-right: 5px; border-collapse: collapse; border-spacing: 0;"><a target="_blank"
                    href="https://www.linkedin.com/company/marketing-research-indonesia/"
                style="text-decoration: none;"><img border="0" vspace="0" hspace="0" style="padding: 0; margin: 0; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; border: none; display: inline-block;
                    color: #000000;"
                    alt="G" title="Google Plus"
                    width="30" height="30"
                    src="http://180.211.92.132:60/digital-market/images/linkedin.png"></a></td>      

            </tr>
            </table>
        </td>
    </tr>

    <!-- FOOTER -->
    <!-- Set text color and font family ("sans-serif" or "Georgia, serif"). Duplicate all text styles in links, including line-height -->
    <tr>
        <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 13px; font-weight: 400; line-height: 150%;
            padding-top: 20px;
            padding-bottom: 20px;
            color: #999999;
            font-family: sans-serif;" class="footer">

               <p style="margin-bottom: 0; color: #888; text-align: center; font-size: 14px; font-family: 'Avenir Next', 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; line-height: 1.65;">Sent by <a href="#" style="color: #888; text-decoration: none; font-weight: bold;">Marketing Research Indonesia</a>, Soho Pancoran, Tower Splendor 19th Floor, Jl. Let.Jend. MT. Haryono kav 2-3, Jakarta Selatan 12810</p>
                <p style="margin-bottom: 0; color: #888; text-align: center; font-size: 14px; font-family: 'Avenir Next', 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; line-height: 1.65;"><a href="mailto:" style="color: #888; text-decoration: none; font-weight: bold;">mri@mri-research-ind.com</a></p>

                <!-- ANALYTICS -->
                <!-- http://www.google-analytics.com/collect?v=1&tid={{UA-Tracking-ID}}&cid={{Client-ID}}&t=event&ec=email&ea=open&cs={{Campaign-Source}}&cm=email&cn={{Campaign-Name}} -->
                <img width="1" height="1" border="0" vspace="0" hspace="0" style="margin: 0; padding: 0; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; border: none; display: block;"
                src="https://raw.githubusercontent.com/konsav/email-templates/master/images/tracker.png" />

        </td>
    </tr>

<!-- End of WRAPPER -->
</table>

<!-- End of SECTION / BACKGROUND -->
</td></tr></table>

</body>
</html>