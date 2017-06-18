<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>New Order</title>

        <style type="text/css">
            /* Client-specific Styles */
            #outlook a {padding:0;} /* Force Outlook to provide a "view in browser" menu link. */
            body{width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0;}
            /* Prevent Webkit and Windows Mobile platforms from changing default font sizes, while not breaking desktop design. */
            .ExternalClass {width:100%;} /* Force Hotmail to display emails at full width */
            .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Force Hotmail to display normal line spacing.  */
            #backgroundTable {margin:0; padding:0; width:100% !important; line-height: 100% !important;}
            img {outline:none; text-decoration:none;border:none; -ms-interpolation-mode: bicubic;}
            a img {border:none;}
            .image_fix {display:block;}
            p {margin: 0px 0px !important;}
            table td {border-collapse: collapse;}
            table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }
            a {color: #33b9ff;text-decoration: none;text-decoration:none!important;}
            /*STYLES*/
            table[class=full] { width: 100%; clear: both; }
            /*IPAD STYLES*/
            @media only screen and (max-width: 640px) {
                a[href^="tel"], a[href^="sms"] {
                    text-decoration: none;
                    color: #33b9ff; /* or whatever your want */
                    pointer-events: none;
                    cursor: default;
                }
                .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
                    text-decoration: default;
                    color: #33b9ff !important;
                    pointer-events: auto;
                    cursor: default;
                }
                table[class=devicewidth] {width: 440px!important;text-align:center!important;}
                table[class=devicewidthinner] {width: 420px!important;text-align:center!important;}
                img[class=banner] {width: 440px!important;height:220px!important;}
                img[class=colimg2] {width: 440px!important;height:220px!important;}


            }
            /*IPHONE STYLES*/
            @media only screen and (max-width: 480px) {
                a[href^="tel"], a[href^="sms"] {
                    text-decoration: none;
                    color: #ffffff; /* or whatever your want */
                    pointer-events: none;
                    cursor: default;
                }
                .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
                    text-decoration: default;
                    color: #ffffff !important; 
                    pointer-events: auto;
                    cursor: default;
                }
                table[class=devicewidth] {width: 280px!important;text-align:center!important;}
                table[class=devicewidthinner] {width: 260px!important;text-align:center!important;}
                img[class=banner] {width: 280px!important;height:140px!important;}
                img[class=colimg2] {width: 280px!important;height:140px!important;}
                td[class="padding-top15"]{padding-top:15px!important;}


            }
        </style>
    </head>
    <body>
        <?php
        $bg_1 = "#FFF"; //header
        $bg_2 = "#1E8AB2";
        ?>
        <div style="padding:0; margin:0;">
            <div style="width:600px; margin:20px auto; font:normal 10pt Verdana, Geneva, sans-serif;">
                <div style="padding:3px; background-color:<?= $bg_1 ?>; -webkit-border-top-right-radius: 6px; -moz-border-radius-topright: 6px; border-top-right-radius: 6px; 
                     border-bottom:2px solid <?= $bg_2 ?>;">
                    <table cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td valign="top" width="155">
                                <a href="https://www.jib.co.th/ws" title="บริษัท เจ.ไอ.บี. คอมพิวเตอร์ กรุ๊ป จำกัด จัดจำหน่ายสินค้า ไอที่ ทกชนิด J.I.B. 
                                   COMPUTER GROUP HARDWARE NOTEBOOK PC MAINBOARD CPU RAM HARD DISK THUMB DRIVE"
                                   style="margin:0; padding:0; text-decoration:none;">
                                    <img src="https://www.jib.co.th/ws/assets/frontend/images/logo/logo.jpg" alt="" width="150" 
                                         style="margin:0; padding:0; text-decoration:none; border:0 solid;"/>
                                </a>                    
                            </td>
                            <td valign="bottom" align="right">
                                <a href="https://www.jib.co.th" title="" style="color:#069; text-decoration:none;">J.I.B</a>
                                &nbsp;|&nbsp;
                                <a href="https://www.jib.co.th" title="" style="color:#069; text-decoration:none;">ติดต่อเรา</a>
                            </td>
                        </tr>
                    </table>
                </div>

                <div><?php echo $long_desc; ?></div>
                <div style="border-top:2px solid <?= $bg_2 ?>; background:#FaFaFa;">
                    <h3 style="background:<?= $bg_2 ?>; padding:6px 10px; margin:0; display:inline-block; color:#FFF; font-size:12pt;">ข้อมูลการสั่งซื้อ</h3>
                </div>
                <div style="padding:10px 5px; background:#FaFaFa;">
                    <table cellpadding="2" cellspacing="2" width="100%" border="0">
                        <tr>
                            <td valign="middle" width="120" align="right"><strong>เลขที่สั่งซื้อ :</strong></td>
                            <td valign="middle">710150033</td>
                        </tr>
                        <tr>
                            <td valign="middle" align="right"><strong>วันที่สั่งซื้อ :</strong></td>
                            <td valign="middle">วันพุธ 15 ตุลาคม 2557 เวลา 10:37</td>
                        </tr>
                        <tr>
                            <td valign="middle" align="right"><strong>ยอดที่ต้องชำระ :</strong></td>
                            <td valign="middle">467,600 บาท</td>
                        </tr>
                        <tr>
                            <td valign="top" align="right"><strong>ช่องทางชำระ :</strong></td>
                            <td valign="top">
                                ธนาคาร : ธนาคารไทยพาณิชย์<br />
                                สาขาย่อย : เซียร์รังสิต<br />
                                ชื่อบัญชี : บริษัท เจ.ไอ.บี. คอมพิวเตอร์ กรุ๊ป จำกัด<br />
                                ประเภทบัญชี : ออมทรัพย์<br />
                                เลขที่บัญชี : 364-2-34604-8<br />
                            </td>
                        </tr>
                        <tr>
                            <td valign="middle" align="right"><strong>ดูรายการสั่งซื้อ :</strong></td>
                            <td valign="middle"><a href="https://www.jib.co.th/ws/index.php/products/order/view/51" title="" 
                                                   style="color:#06C;">คลิกเพื่อดูรายละเอียดสินค้า</a></td>
                        </tr>            
                    </table>        
                </div>

                <div style="padding:5px; background:<?= $bg_2 ?>; color:#FFF;">
                    <table cellpadding="3" cellspacing="3" width="100%">
                        <tr>
                            <td valign="top" width="50%">
                                <h3>บริษัท อินไซด์ ไอที ดิสทริบิวชั่น จำกัด</h3>
                                <p>
                                    เลขที่ 801/70-72 ม.8 ถ.พหลโยธิน ต.คูคต อ.ลำลูกกา จ.ปทุมธานี 12130
                                </p>
                            </td>
                            <td valign="top">
                                <h3>ติดต่อเรา</h3>
                                <p>
                                    เบอร์ติดต่อ 02-992-5000<br/>
                                    แฟกซ์ 02-992-5300<br/>
                                    โทรศัพท์ 094-480-1851 ถึง 53<br/>
                                    อีเมล์ sale.inside.it@gmail.com
                                </p>
                            </td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>


    </body>
</html>