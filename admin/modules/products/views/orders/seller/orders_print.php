<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <link href="<?php echo base_url(); ?>assets/backend/css/bootstrap.min.css" rel="stylesheet" media="all">
        <script src="<?php echo base_url(); ?>assets/frontend/js/jquery-1.11.0.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/frontend/js/jquery-barcode-2.0.2.js"></script>

        <style type="text/css">
            @media print {
                html, body {
                    /*changing width to 100% causes huge overflow and wrap*/
                    font-family: tahoma;
                    font-size: 8pt;
                }
            }
            .height {
                min-height: 200px;
            }

            .icon {
                font-size: 47px;
                color: #5CB85C;
            }

            .iconbig {
                font-size: 77px;
                color: #5CB85C;
            }

            .table > tbody > tr > .emptyrow {
                border-top: none;
            }

            .table > thead > tr > .emptyrow {
                border-bottom: none;
            }

            .table > tbody > tr > .highrow {
                border-top: 3px solid;}
            .col-lg-12{margin: 0; padding: 0;}
            .col-lg-4{margin: 0; padding: 0;}
            @media print
            {
                #idprint { display: none; }
                // #idprint { display: block; }
            }
        </style>
    </head>
    <body>
        <div class="container" style="width: 910px; margin: 2px auto; font:normal 10pt Verdana, Geneva, sans-serif;">
            <div style="padding:5px;">
                <div style=" padding: 0; margin: 0; text-align: center;">
                    <input type="image" id="idprint" src="https://www.jib.co.th/web/images/print_icon.jpg" width="43" height="43" 
                           onClick="JavaScript:printWindow();" title="พิมพ์"/>
                </div>
                <script>
                  function printWindow() {
                      $('#linkPrint').attr('media', 'print');
                      browserVersion = parseInt(navigator.appVersion)
                      if (browserVersion >= 4) {
                          //window.print();
                          var onPrintFinished = function (printed) {
                              console.log(printed);
                          }
                          onPrintFinished(window.print());

                          $('#linkPrint').attr('media', 'all');
                      }
                  }
                </script>
                <table cellpadding="2" cellspacing="2" width="100%" border="0">
                    <tr>
                        <td valign="top" width="33%">
                            <p><img src="http://www.jib.co.th/ws/assets/frontend/images/logo/logo_insideitdistribution.PNG" width="140" /></p>
                            <div>
                                เลขที่ 21 ถนนพหลโยธิน แขวงสนามบิน เขตดอนเมือง กรุงเทพฯ 10210<br/>
                                Tel. 02-791-2000 ต่อ 0<br/>
                                Fax. 02-791-2020<br/>
                                จันทร์ - เสาร์ 08.30 - 18.10 น.<br/>
                            </div>                              
                        </td>
                        <td valign="top" width="33%"><h2 align="center">ใบสั่งซื้อเลขที่ <?php //echo $item->orders_code;                         ?></h2></td>
                        <td valign="top" style=" padding-top: 35px;">
                            <div align="center">
                                <div id="border_barcode" align="center" style="display: inline-block; margin: 0; padding: 0;"></div>
                                <div style=" font-size: 16pt; font-weight: bold;"><?php echo $item->orders_code; ?></div>
                            </div>
                            <table cellpadding="2" cellspacing="2" width="100%" border="0" style="border-collapse:collapse; margin-top: 20px;">
                                <tr>
                                    <td valign="middle" width="150" align="right">เลขที่ใบสั่งซื้อ :</td>
                                    <td valign="middle"><?php echo $item->orders_code; ?></td>
                                </tr>
                                <tr>
                                    <td valign="middle" align="right">วันที่สังซื้อ :</td>
                                    <td valign="middle"><?php echo date("Y-m-d : H:i:s", $item->created_at); ?></td>
                                </tr>
                            </table>                               
                            <script type="text/javascript">
                              $('#border_barcode').barcode('<?php echo $item->orders_code; ?>', 'code128', {barWidth: 2, barHeight: 35, moduleSize: 2, showHRI: false, fontSize: 16});
                            </script>                             
                        </td>
                    </tr>
                </table>
                <div style=" padding: 10px 0;">
                    <table cellpadding="2" cellspacing="2" width="100%" style="border-collapse:collapse;">
                        <tr>
                            <td valign="top" style="border:1px solid #DDD; padding: 2px;">
                                <div style="padding:4px; background:#E0E0E0;  font-weight: bold;">ที่อยู่ในการจัดส่งสินค้า</div>
                                <div style=" padding: 10px;">
                                    <p><strong><?php echo $item->first_name . " " . $item->last_name; ?></strong></p>
                                    <p>ที่อยู่ : <?php echo $address_1; ?></p>
                                </div>
                            </td>
                            <td valign="top" width="1">&nbsp;</td>
                            <td valign="top" width="400" style="border:1px solid #DDD; padding: 2px;">
                                <div style="padding:4px; background:#E0E0E0; font-weight: bold;">ข้อมูลลูกค้า</div>
                                <div style=" padding: 10px;">
                                    <p><strong><?php echo $item->first_name . " " . $item->last_name; ?></strong></p>
                                    <p>ที่อยู่ : <?php echo $this->Users_model->get_address_dealer(0, $item->user_id); ?></p>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-condensed">
                                        <thead>
                                            <tr>
                                                <td><strong>รหัสสินค้า</strong></td>
                                                <td><strong>สินค้า</strong></td>
                                                <td class="text-center"><strong>ราคา</strong></td>
                                                <td class="text-center"><strong>จำนวน</strong></td>
                                                <td class="text-right"><strong>รวม</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $totalWeight = 0;
                                            foreach ($prod as $items):
                                              $subtotal = $items['price'] * $items['qty'];
                                              ?>                                        
                                              <tr>
                                                  <td><?php echo $items['product_code']; ?></td>
                                                  <td><?php echo $items['cnt_title']; ?></td>
                                                  <td class="text-center"><?php echo number_format($items['price']); ?></td>
                                                  <td class="text-center"><?php echo $items['qty']; ?></td>
                                                  <td class="text-right"><?php echo number_format($subtotal); ?></td>
                                              </tr>
                                            <?php endforeach; ?>
                                            <tr>
                                                <td class="highrow text-right" colspan="4"><strong>รวมราคา</strong></td>
                                                <td class="highrow text-right"><?php echo number_format($item->total_price); ?></td>
                                            </tr>
                                            <tr>
                                                <td class="emptyrow text-right" colspan="4"><strong>ยอดชำระสินค้าทั้งหมด</strong></td>
                                                <td class="emptyrow text-right"><?php echo number_format($item->sum_price); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div style=" padding: 0; margin: 0; ">
                    <h4 style=" margin-bottom: 0; padding-bottom: 2px;">รูปแบบการจัดส่ง</h4>
                    <p style=" padding: 0; margin: 0; padding-left: 6px; "><?php echo $shipping_item->title; ?></p>
                </div>

                <div class="row" style=" padding: 0; margin: 0; ">
                    <div class="col-xs-12" style=" padding: 0; margin: 0; ">
                        <div class="panel-body" style=" padding: 0; margin: 0; ">
                            <h4>ข้อมูลชำระเงิน</h4>
                            <div style=" padding: 0; margin: 0; padding-left: 6px; ">
                                <?php
                                foreach ($payment_item as $value2) {
                                  echo $value2->desc_invoice;
                                }
                                ?> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </body>
</html>