<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style type="text/css">
    #gridarea {
        display: flex;
        overflow:scroll;
        background: rgba(136, 153, 119, 0.23);
        height: 400px;
        padding: 2px;
    }

    #tbl_est_data tbody tr td{
        padding: 13px;
    }

    .editrowClass {
      background-color: #f1b9b9;
    }

    .fullpad div {
      padding-left: 0px;
      padding-right: 0px;
    }
</style>
<div class="content-wrapper" id="app">
    <div class="box-header" style="background: #b4f3c8">
                    <div class="col-sm-4"><span><b><?php echo $pagetitle; ?></b></span>
                            
                    </div>
                    <div class="col-sm-8">
                        <div class="row">
                            <?php if($invHed->InvIsCancel==1){$disabled='disabled'; }else{$disabled='';}?>

                            <div class="col-sm-2"></div>
                            <div class="col-sm-2"></div>
                            <div class="col-sm-1"></div>
                            <?php if (in_array("SM162", $blockView) || $blockView == null) { ?>
                                <div class="col-sm-2">
                                    <button type="button" id="btnPrint" class="btn btn-primary btn-sm btn-block">Print
                                    </button>
                                </div>
                            <?php } ?>
                            <!--div class="col-sm-1"><a href="<?php echo base_url('admin/Salesinvoice/view_sales_invoice_pdf/') . base64_encode($invNo); ?>" target="blank_" class="btn btn-primary btn-sm">Pdf</a></div-->
                         
                           <div class="col-sm-1"><a
                                        href="<?php echo base_url('admin/Salesinvoice/addSalesInvoice?action=1&id=') . base64_encode($invNo); ?>"
                                        target="blank_" class="btn btn-info btn-sm">Clone</a></div>
                            <?php if (in_array("SM42", $blockEdit) || $blockEdit == null) { ?>
                                <div class="col-sm-1"><?php if ($ispayment == 0 && $invHed->InvIsCancel == 0) { ?>
                                        <a href="<?php echo base_url('admin/Salesinvoice/addSalesInvoice?action=2&id=') . base64_encode($invNo); ?>"
                                           target="blank_" class="btn btn-info btn-sm">Edit</a>
                                    <?php } ?></div>
                            <?php } ?>
                            <?php if (in_array("SM42", $blockDelete) || $blockDelete == null) { ?>
                            <div class="col-sm-2"><?php if ($invHed->InvIsCancel == 0) { ?>
                                <button type="button" <?php echo $disabled; ?> id="btnCancel"
                                        class="btn btn-danger btn-sm btn-block">Cancel</button><?php } ?></div>
                            <?php } ?>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                            </div>
                        </div>       
                    </div>
                        <!-- </div> -->
                    </div><!-- /.box-header -->
  
    <section class="content">
      <div class="row">
        <div class="col-lg-8">
          <input type="hidden" name="inv" id="inv" value="<?php echo $invNo;?>">
        <div class="row" id="printArea" align="center" style='margin:5px;'>
                                <!-- load comapny common header -->
    <?php // $this->load->view('admin/_templates/company_header.php',true); ?>
            <table style="border-collapse:collapse;width:730px;font-family: Arial, Helvetica, sans-serif;" border="0"  align="center">
            <tr style="text-align:left;font-size:15px;">
      <td colspan="2"> <?php if($invHed->SalesInvType==2){?> Vat Reg No: <?php   echo  $invCus->DocNo; } ?></td>
      <!--<td> &nbsp;</td>-->
      
      <!--<td colspan="4"  style="font-size:18px;font-weight: bold;text-align:right; "> SALES INVOICE</td>-->
    </tr>
    <tr style="text-align:left;font-size:15px;">

        <td colspan="2" rowspan="6" style="border:0px solid #000;font-size:15px;width:430px;padding: 5px;" v-align="top">
            <?php $this->load->view('admin/_templates/company_header.php',true); ?>
            <span style="font-size: 13px;"  ><b>BILL TO :</b>&nbsp;&nbsp;
                <a href="<?php echo base_url('admin/payment/view_customer/').$invCus->CusCode ?>">
                <?php echo $invCus->DisplayName;?></a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="font-size: 13px;" id="lbladdress2">TP : <?php echo $invCus->LanLineNo;?> Mobile : <?php echo $invCus->MobileNo;?></span>
            <?php if ($invCus->DisType==4): ?>
                <?php echo $invCus->ContactPerson;?><br>

            <?php endif ?>

            
        </td>
    </tr>

                <tr style="text-align:left;font-size:25px;">
                    <!--        <td> &nbsp;</td>-->
                    <!--<td style="text-align:left;"></td>-->
                    <!--<td style=""></td>-->
                    <td colspan="4" style="text-align:right;"><b>&nbsp;Invoice</b></td>
                </tr>
<!--                <tr style="text-align:left;font-size:15px;">-->
<!--                            <td> &nbsp;</td>-->
<!--                    <td style="font-size:15px;text-align:left;"></td>-->
<!--                    <td style=""></td>-->
<!--                    <td colspan="2" style="font-size:15px;text-align:right;">&nbsp;</td>-->
<!--                </tr>-->
                <tr style="text-align:left;font-size:13px;">
                    <!--        <td> &nbsp;</td>-->
                    <td style="padding-top:0px;font-size:13px;text-align:left;"><b>INVOICE#</b> </td>
                    <td style="">:</td>
                    <td colspan="2" style="font-size:13px;text-align:right;"><?php echo $invHed->SalesInvNo ?></td>
                </tr>
                <tr style="text-align:left;font-size:13px;">
                    <!--        <td> &nbsp;</td>-->
                    <td style="text-align:left;"><b>INVOICE DATE</b></td>
                    <td >:</td>
                    <td colspan="2" style="text-align:right;"><?php echo date('Y-m-d',strtotime($invHed->SalesDate));?>&nbsp;</td>
                </tr>
                <tr style="text-align:left;font-size:13px;">
                    <!--        <td> &nbsp;</td>-->
                    <td style="padding-top:0px;font-size:13px;text-align:left;">Pay. Terms </td>
                    <td style="">:</td>
                    <td colspan="2" style="font-size:13px;text-align:right;"><?php if ($invHed->JobCreditAmount > 0) { $invtype= 'CREDIT'; } else { $invtype= 'CASH'; } ?><?php echo $invtype; ?></td>
                </tr>
             

<style type="text/css" media="screen">

    #tbl_po_data2 tbody tr td{
    padding: 5px  !important;
    border-bottom:1px solid #fff !important;
    }

</style>
<table id="tbl_po_data" style="border-collapse:collapse;width:730px;padding:5px;font-size:15px;" border="0">
                <?php if($invHed->SalesInvType==2 || $invHed->SalesInvType==3){?>
                    <thead id="taxHead" border="1">
                        <tr><td colspan="3" style="border-top:1px solid #fff;border-left:1px solid #fff;border-right:1px solid #fff;text-align: right;"></td></tr>
                        <tr style="background-color:#5d5858 !important;color:#fff !important;line-height:20px; border-bottom:1px solid #000000; border-top:1px solid #000000; ">
                            <!--<th style='padding: 3px;color:#fff; text-align:center;'>Code</th>-->
                            <th style='padding: 3px;color:#fff; text-align:center;'>Description</th>
                            <!--<th style='padding: 3px;color:#fff; text-align:center;'>Warranty</th>-->
                            <th style='padding: 3px;color:#fff; text-align:center;'>Qty</th>
                            <th style='padding: 3px;color:#fff; text-align:center;' >Unit Price</th>
                            <th style='padding: 3px;color:#fff; text-align:center;'>Amount</th>
                        </tr>
                    </thead>
                  <?php }elseif($invHed->SalesInvType==1){?>
                    <thead  id="invHead" border="1">
                        <tr style="background-color:#5d5858 !important;color:#fff !important;line-height:20px; border-bottom:1px solid #000000; border-top:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000;">
                            <!--<th style='padding: 3px;color:#fff; text-align:center; border-bottom:1px solid #000000; border-top:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000;'>Code</th>-->
                            <th style='padding: 3px;color:#fff; text-align:center; border-bottom:1px solid #000000; border-top:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000;'>Description</th>
                            <!--<th style='padding: 3px;color:#fff; text-align:center; border-bottom:1px solid #000000; border-top:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000;'>Warranty</th> -->
                            <th style='padding: 3px;color:#fff; text-align:center; border-bottom:1px solid #000000; border-top:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000;'>Qty</th>
                            <th style='padding: 3px;color:#fff; text-align:center; border-bottom:1px solid #000000; border-top:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000;'>Unit Price</th>
                            <th style='padding: 3px;color:#fff; text-align:center; border-bottom:1px solid #000000; border-top:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000;'>Amount</th>
                        </tr>
                    </thead>
                    <?php } ?>
                    <tbody>
                    <?php 
                    $i=1;
                     //var_dump($invDtlArr);
                    foreach ($invDtl AS $invdata) {

                      if($invHed->SalesInvType==1 || $invHed->SalesInvType==3){
                      //normal invoice
                       
                         ?>
                        <tr style="line-height:20px; border-bottom:1px solid #000000; border-top:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000;">
                          <!--<td style="border-right:1px solid #000000;"><//?php echo $invdata->SalesProductCode;?></td>-->
                          <td style="border-right:1px solid #000000;"><?php echo $invdata->SalesProductName."<br>".$invdata->SalesSerialNo;?></td>
                          <!--<td style="border-right:1px solid #000000;"><?//php echo $invdata->type;?></td>-->
                          <td style="border-right:1px solid #000000; text-align:center;"><?php echo number_format(($invdata->SalesQty),0)?></td>
                          <td style="border-right:1px solid #000000; text-align:right;" class='text-right'><?php echo number_format(($invdata->SalesUnitPrice),2)?></td>
                          <td style="border-right:1px solid #000000; text-align:right;" class='text-right'><?php echo number_format(($invdata->SalesInvNetAmount),2)?></td>
                        </tr>
                    <?php $i++; 
                         
                      }elseif($invHed->SalesInvType==2){
                      //Tax Invoice
                        
                         ?>
                        <tr style="line-height:20px; border-bottom:1px solid #000000; border-top:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000;">
                          <!--<td style="border-bottom:1px solid #e4dbdb;"><?//php echo $invdata->SalesProductCode;?></td>-->
                          <td style="border-bottom:1px solid #e4dbdb;" ><?php echo $invdata->SalesProductName."<br>".$invdata->SalesSerialNo;?> </td>
                          <!--<td style="border-bottom:1px solid #e4dbdb;"><?//php echo number_format(($invdata->WarrantyMonth),0)?>&nbsp; Month</td>-->
                          <td style="border-bottom:1px solid #e4dbdb; text-align:center;"><?php echo number_format(($invdata->SalesQty),0)?></td>
                          <td style="border-bottom:1px solid #e4dbdb; text-align:right;" class='text-right'><?php echo number_format(($invdata->SalesUnitPrice),2)?></td>
                          <td style="border-bottom:1px solid #e4dbdb; text-align:right;" class='text-right'><?php echo number_format(($invdata->SalesTotalAmount),2)?></td>
                        </tr>
                    <?php $i++; 
                        
                      }
                    }//foreach end
// print_r($returnDtlArr);
                    
                       ?>                    
                    </tbody>
                    <tfoot>
                    <?php
                    $payment_term ='';
                     if($invHed->SalesInvType==2){ ?>
                        <tr style="line-height:25px; border-top:1px solid #000000;  border-right:1px solid #000000;" id="rowTotal">
                        <td colspan="2" style="border-top: 1px #000000 solid;border-right: 1px #000000 solid;"></td>
                        <td style="text-align:right;padding: 3px;">Sub Total </td>
                        <td id="lbltotalPOAmount"   style='text-align:right;padding: 3px;'><?php echo number_format($invHed->SalesInvAmount,2);?></td>
                        </tr><?php }else{ ?> 
                        <tr style="line-height:25px; border-top:1px solid #000000; border-right:1px solid #000000;" id="rowTotal"><td colspan="2" style="border-bottom: 1px #00000 solid;"></td><td style="text-align:right;border-bottom:1px solid #000000; border-top:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000;"><b>Total Amount</b> </td>
                        <td id="lbltotalPOAmount"   style='text-align:right; border-bottom:1px solid #000000; border-top:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000;'><?php echo number_format($invHed->SalesInvAmount,2);?></td></tr>
                        <?php } ?>
                        <?php if($invHed->SalesDisAmount>0){?>
                         <tr style="line-height:25px;" id="rowDiscount">
                          <td colspan="2" style="border-left: 1px #fff solid;border-bottom: 1px #fff solid;"></td><td style="text-align:right">Discount  </td><td id="lbltotalDicount"   style='text-align:right'><?php echo number_format($invHed->SalesDisAmount,2);?></td>
                         </tr>
                         
                          <?php }?>

                              <?php if($invHed->SalesAdvancePayment>0){?>
                            <tr>                                                      
                        
  <td colspan="2"  style="border-left: 1px #fff solid; border-bottom: 1px #fff solid;border-right: 1px #000 solid;"></td>
                               <td style="text-align:right;border-right: 1px #000 solid;" ><b>Advance</b>  </td>
                                <td id="totalAdvance" style='text-align:right;border-right: 1px #000 solid; '><?php echo number_format($invHed->SalesAdvancePayment,2);?></td>
                            </tr>
                              <?php }?>



                         <?php if($invHed->SalesVatAmount>0 && $invHed->SalesInvType==2){?>
                         <tr style="line-height:25px;" id="rowVAT">
                          <td colspan="2" style="border-left: 1px #fff solid;border-bottom: 1px #fff solid;"></td><td style="text-align:right">VAT Amount  </td><td id="lbltotalVat"   style='text-align:right'><?php echo number_format($invHed->SalesVatAmount,2);?></td>
                         </tr><?php } ?>
                          <?php if($invHed->SalesNbtAmount>0 && $invHed->SalesInvType==2){?>
                        <tr style="line-height:25px;" id="rowNBT">
                          <td colspan="2" style="border-left: 1px #fff solid;border-bottom: 1px #fff solid;"></td><td style="text-align:right">NBT Amount  </td><td id="lbltotalNbt"   style='text-align:right'><?php echo number_format($invHed->SalesNbtAmount,2);?></td>
                        </tr>
                         <?php } ?>
                         <?php if($invHed->SalesShipping>0){?>
                         <tr style="line-height:25px;" id="rowDiscount">
                          <td colspan="4" style="border-left: 1px #fff solid;border-bottom: 1px #fff solid;"></td><td style="text-align:right"><?php echo $invHed->SalesShippingLabel; ?>  </td><td id="lbltotalDicount"   style='text-align:right'><?php echo number_format($invHed->SalesShipping,2);?></td>
                         </tr>
                          <?php }?>
                         <?php if($invHed->SalesVatAmount>0 || $invHed->SalesNbtAmount>0 || $invHed->SalesShipping>0 || $invHed->SalesDisAmount>0){?>
                        <tr style="line-height:25px;" id="rowNET">
                          <td colspan="2" style="border-left: 1px #fff solid;border-bottom: 1px #fff solid;"></td><td style="font-weight:bold;text-align:right">Total  </td><td id="lbltotalNet"   style='font-weight:bold;text-align:right'><?php echo number_format($invHed->SalesNetAmount,2);?></td>
                        </tr>
                        <?php } ?>

                        
                        <?php if($invHed->SalesCashAmount>0){
                          $payment_term="Cash";
                          ?>
                         <tr style="line-height:25px;" id="rowDiscount">
                          <td colspan="2" style="border-left: 1px #fff solid;border-bottom: 1px #fff solid;"></td><td style="text-align:right; border-bottom:1px solid #000000; border-top:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000;"><b>Balance Due</b></td>
                          <td id="lbltotalDicount"   style='text-align:right; border-bottom:1px solid #000000; border-top:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000;'><?php echo number_format($invHed->SalesCashAmount,2);?></td>
                         </tr>
                          <?php } else { ?>
                            <tr style="line-height:25px;">
                                <td colspan="2" style="border-left: 1px #fff solid;border-bottom: 1px #fff solid;"></td><td style="text-align:right"> </td><td id=""   style='text-align:right'></td>
                            </tr>

                        <?php } ?>
                          <?php if($invHed->SalesBankAmount>0){
                          $payment_term="Bank";
                          ?>
                        <tr style="line-height:25px;" id="rowNBT">
                          <td colspan="2" style="border-left: 1px #fff solid;border-bottom: 1px #fff solid;"></td><td style="text-align:right">Bank Transfer  </td><td id="lbltotalNbt"   style='text-align:right'><?php echo number_format($invHed->SalesBankAmount,2);?></td>
                        </tr>
                         <?php } ?>
                          <?php if($invHed->SalesChequeAmount>0){
                            $payment_term="Cheque";
                            ?>
                        <tr style="line-height:25px;" id="rowNBT">
                          <td colspan="2" style="border-left: 1px #fff solid;border-bottom: 1px #fff solid;"></td><td style="text-align:right">Cheque  Amount  </td><td id="lbltotalNbt"   style='text-align:right'><?php echo number_format($invHed->SalesChequeAmount,2);?></td>
                        </tr>
                         <?php } ?>
                         <?php if($invHed->SalesCCardAmount>0){
                          $payment_term="Card";
                          ?>
                        <tr style="line-height:25px;" id="rowNBT">
                          <td colspan="2" style="border-left: 1px #fff solid;border-bottom: 1px #fff solid;"></td><td style="text-align:right">Card Amount  </td><td id="lbltotalNbt"   style='text-align:right'><?php echo number_format($invHed->SalesCCardAmount,2);?></td>
                        </tr>
                         <?php } ?>
                    <?php if($invHed->SalesReturnPayment>0){
                        $payment_term="Card";
                        ?>
                        <tr style="line-height:25px;" id="rowNBT">
                            <td colspan="2" style="border-left: 1px #fff solid;border-bottom: 1px #fff solid;"></td><td style="text-align:right">Return Payment  </td><td id="lbltotalNbt"   style='text-align:right'><?php echo number_format($invHed->SalesReturnPayment,2);?></td>
                        </tr>
                    <?php } ?>
                         

                         <?php if($invHed->SalesCreditAmount>0){
                          $payment_term="Credit";
                          ?>
                         <tr style="line-height:25px;" id="rowVAT">
                          <td colspan="2" style="border-left: 1px #fff solid;border-bottom: 1px #fff solid;"></td><td style="text-align:right;font-weight:bold;background-color:#e4dbdb !important;">TOTAL PAYABLE  </td><td id="lbltotalVat"   style='font-weight:bold;text-align:right;background-color:#e4dbdb !important;'><?php echo number_format($invHed->SalesCreditAmount,2);?></td>
                         </tr><?php } ?>
                         <?php if($invHed->SalesReturnAmount>0){
                          
                          ?>
                        <tr style="line-height:25px;" id="rowNBT">
                          <td colspan="2" style="border-left: 1px #fff solid;border-bottom: 1px #fff solid;"></td><td style="text-align:right">Return Amount  </td><td id="lbltotalNbt"   style='text-align:right'><?php echo number_format($invHed->SalesReturnAmount,2);?></td>
                        </tr>
                        <tr><td colspan="6">
                          Return Items 
                            <p>
                           <?php  if($returnDtlArr){ foreach ($returnDtlArr AS $rtinvdata) { ?>
                            <?php echo $rtinvdata->SalesProductName ?>-<?php echo $rtinvdata->SalesReturnQty ?>, &nbsp;
                             <?php } ?></p>
                           

                         </td></tr>
                         <?php } } ?>

                         <tr>
                           <td colspan="6">
                             <table style="width:730px; font-size:14px;" border="0">
<!--                          <tr><td colspan="5" style="text-align:right;">&nbsp;</td></tr>-->
                          <tr><td colspan="6" style="text-align:left;font-size:14px;"><b>Remarks&nbsp;&nbsp;:&nbsp;&nbsp;</b><?php echo $invHed->salesInvRemark; ?></td></tr>
                         
                          <tr><td colspan="6" style="text-align:justify; font-size:12px;"><b>Note</b><br><b>
                              -Goods once sold will not be taken back.<br>
                              -No warranty for the Toner, Cartridges,Cables and Ribbons.<br>
                              -Warranty will be valid for one year less 14 working days from the date of invoiced unless otherwise mentioned above with description.<br>
                              -Warranty does not cover for physical damages by power surge, corrosion, and natural disaster.<br>
                              -Original invoice must be produced for warranty claims and serial numbers or items must be intact with each item.<br><br><br>
                          </b></td></tr>
                          <!--Warranty cover only Manufactures defects, damages or defects due to other causes such as negligence, mususe, improper operation-->
                          <!--, power fluctuation lightning or other natural disaster, sabotage or accident etc. Are not included under this warranty, Repairs or replacement necessitated by such-->
                          <!--causes are not covered by the warranty are subject to change for labour, time and material.-->
                          <tr><td colspan="6" style="text-align:left;"><b>Cheques to be drawn in favour of "Lead IT Solutions (PVT) LTD"</b></td></tr>
         <tr><td colspan="5" style="text-align:right;width:550px;">&nbsp;</td></tr> 
                      
                           <tr>
                            <td style="width:150px;text-align: left">&nbsp;</td>
                            <td style="width:100px;">&nbsp;</td>
                            <td style="width:150px;text-align: center">&nbsp;</td>
                            <td style="width:100px;">&nbsp;</td>
                            <td style="width:200px;text-align: left">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="border-bottom:1px dashed #000;" >&nbsp;</td>
                            <td style="">&nbsp;</td>
                            <td style="border-bottom:1px dashed #000;">&nbsp;</td>
                            <td style="">&nbsp;</td>
                           <td style="border-bottom:1px dashed #000;">&nbsp;</td>
                        </tr>
                         <tr>
                            <td style="text-align: center;font-size:15px;">Prepared By</td>
                            <td style="">&nbsp;</td>
                            <td style="text-align: center">Authorised By</td>
                            <td style="">&nbsp;</td>
                            <td style="text-align: center;font-size:15px;">Customer Signature</td>
<!--                            <td style="text-align: center">--><?php //if($invHed->SalesReceiver!=''){ ?><!--On behalf of --><?php //} ?><!--Authorized Signature</td>-->
                        </tr>
<!--                        <tr>-->
<!--                            <td style="text-align: center"> --><?php ////echo $invHed->first_name; ?><!-- </td>-->
<!--                            <td style="">&nbsp;</td>-->
<!--                            <td style="text-align: center"></td>-->
<!--                            <td style="">&nbsp;</td>-->
<!--                            <td style="text-align: center"></td>-->
<!--                        </tr>-->
<!--                        --><?php ////if($invHed->SalesReceiver!=''){ ?>
<!--                         <tr>-->
<!--                            <td style="width:150px;text-align: left">&nbsp;</td>-->
<!--                            <td style="width:100px;">&nbsp;</td>-->
<!--                            <td style="width:150px;text-align: center">&nbsp;</td>-->
<!--                            <td style="width:100px;">&nbsp;</td>-->
<!--                            <td style="width:200px;text-align: left">&nbsp;</td>-->
<!--                        </tr>-->
                       <!--<tr>-->
<!--                            <td  >&nbsp;</td>-->
<!--                            <td style="">&nbsp;</td>-->
                            <!--<td colspan="6" style="border-bottom:1px double #000;text-align: center;"><?php echo $invHed->SalesReceiver; ?></td>-->
<!--                            <td style="">&nbsp;</td>-->
<!--                           <td style="border-bottom:1px dashed #000;text-align: center;">--><?php //echo $invHed->SalesRecNic; ?><!--</td>-->
                        <!--</tr>-->
                                 <!--<tr style="text-align: center; tab-size: 20px">-->
                                 <!--    <td colspan="6"><b></b></td>-->
                                 <!--</tr>-->
<!--                         <tr>-->
<!--                            <td style="text-align: center">-->
<!--                            </td>-->
<!--                            <td style="">&nbsp;</td>-->
<!--                            <td style="text-align: center">Name</td>-->
<!--                            <td style="">&nbsp;</td>-->
<!--                            <td style="text-align: center">NIC</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td style="text-align: center;"></td>-->
<!--                            <td style="">&nbsp;</td>-->
<!--                            <td style="text-align: center"></td>-->
<!--                            <td style="">&nbsp;</td>-->
<!--                            <td style="text-align: center"></td>-->
<!--                        </tr>-->
<!--                        --><?php //} ?>
                        <!--<tr><td colspan="6" style="text-align:right;">&nbsp;</td></tr> -->
                        <!--<tr><td colspan="6" style="text-align:center;font-size: 18px;"><i></i></td></tr>-->
                    </table>
                           </td>
                         </tr>
                          
                    </tfoot>
                </table>
                
    <style type="text/css" media="screen">
    #tbl_po_data tbody tr td{
        padding: 13px;
    }
</style>
</div>
        </div>
          <div class="col-lg-1">
<table class="table table-hover">
              <thead> 
              <th> <center> All Sales Invoice</center></th>
                 </thead>
              <tbody>
                                        <?php foreach($sale as $v){?>
                                        <tr>
                                           <td><a href="<?php echo base_url('admin/Salesinvoice/view_sales_invoice/').base64_encode($v->SalesInvNo); ?>"><?php echo $v->SalesInvNo;?></a></td>
                                           </tr>
                                           <?php }?>
                                        </tbody>
                                    </table>
</div>
        <div class="col-lg-3">
          <table class="table">
            <tr><td>Create by</td><td>:</td><td><?php echo $invHed->first_name." ".$invHed->last_name ?></td></tr>
            <tr><td>Create Date</td><td>:</td><td><?php echo $invHed->SalesDate ?></td></tr>
            <?php if($invCancel): ?>
            <tr><td>Cancel By</td><td>:</td><td><?php echo $invCancel->first_name." ".$invHed->last_name ?></td></tr>
            <tr><td>Cancel Date</td><td>:</td><td><?php echo $invCancel->CancelDate ?></td></tr>
            <tr><td>Remark</td><td>:</td><td><?php echo $invCancel->Remark ?></td></tr>
          <?php endif; ?>
          <?php if($invUpdate):  ?>
          <tr><td colspan="3">Last Updates</td></tr>
          <?php  foreach ($invUpdate AS $up) { ?>
            <tr><td><?php echo $up->UpdateDate ?></td><td>:</td><td><?php echo $up->first_name." ".$up->last_name ?></td></tr>
          <?php }
          endif; ?>
          </table>
        </div>
      </div>
    
</section>
    <div>
    </div>
</div>
<?php //die; ?>
 <!-- print parts goes here -->
        
<!-- print 2 -->
        


<script type="text/javascript">

var inv =$("#inv").val();

$("#btnPrint").click(function(){
$('#printArea').focus().print();
});

$("#btnPrint2").click(function(){
$('#printArea2').focus().print();
});


$("#btnCancel").click(function(){

  var r = prompt('Do you really want to cancel this invoice? Please enter a remark.');

    if (r == null || r=='') {
      return false; 
    }else{
      cancelInvoice(inv,r);
      return false;
    }
});



function cancelInvoice(invoice,remark) {
  $.ajax({
        url:'../../salesinvoice/cancelSalesInvoice',
        dataType:'json',
        type:'POST',
        data:{salesinvno:invoice,remark:remark},
        success:function(data) {
            if(data==1){
              $.notify("Invoice canceled successfully.", "success");
              $("#btnCancel").attr('disabled', true);
            }else if(data==2){
              $.notify("Error. Customer has done payment for this invoice. If you want to cancel this invoice please cancel the payment", "danger");
              $("#btnCancel").attr('disabled', false);
            }else if(data==3){
              $.notify("Error. Invoice has already canceled.", "danger");
              $("#btnCancel").attr('disabled', false);
            }else if(data==4){
                $.notify("Error. This Invoice not in your Location Please contact Your Admin.", "danger");
                $("#btnCancel").attr('disabled', false);
            }else{
              $.notify("Error. Invoice not canceled successfully.", "danger");
              $("#btnCancel").attr('disabled', false);
            }
        }
      });
}



var Base64 = {
                _keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",

               

                encode: function(input) {

                    var output = "";

                    var chr1, chr2, chr3, enc1, enc2, enc3, enc4;

                    var i = 0;



                    input = Base64._utf8_encode(input);



                    while (i < input.length) {



                        chr1 = input.charCodeAt(i++);

                        chr2 = input.charCodeAt(i++);

                        chr3 = input.charCodeAt(i++);



                        enc1 = chr1 >> 2;

                        enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);

                        enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);

                        enc4 = chr3 & 63;



                        if (isNaN(chr2)) {

                            enc3 = enc4 = 64;

                        } else if (isNaN(chr3)) {

                            enc4 = 64;

                        }



                        output = output +

                                this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +

                                this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);



                    }



                    return output;

                },

               

                decode: function(input) {

                    var output = "";

                    var chr1, chr2, chr3;

                    var enc1, enc2, enc3, enc4;

                    var i = 0;



                    input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");



                    while (i < input.length) {



                        enc1 = this._keyStr.indexOf(input.charAt(i++));

                        enc2 = this._keyStr.indexOf(input.charAt(i++));

                        enc3 = this._keyStr.indexOf(input.charAt(i++));

                        enc4 = this._keyStr.indexOf(input.charAt(i++));



                        chr1 = (enc1 << 2) | (enc2 >> 4);

                        chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);

                        chr3 = ((enc3 & 3) << 6) | enc4;



                        output = output + String.fromCharCode(chr1);



                        if (enc3 != 64) {

                            output = output + String.fromCharCode(chr2);

                        }

                        if (enc4 != 64) {

                            output = output + String.fromCharCode(chr3);

                        }



                    }



                    output = Base64._utf8_decode(output);



                    return output;



                },

               

                _utf8_encode: function(string) {

                    string = string.replace(/\r\n/g, "\n");

                    var utftext = "";



                    for (var n = 0; n < string.length; n++) {



                        var c = string.charCodeAt(n);



                        if (c < 128) {

                            utftext += String.fromCharCode(c);

                        }

                        else if ((c > 127) && (c < 2048)) {

                            utftext += String.fromCharCode((c >> 6) | 192);

                            utftext += String.fromCharCode((c & 63) | 128);

                        }

                        else {

                            utftext += String.fromCharCode((c >> 12) | 224);

                            utftext += String.fromCharCode(((c >> 6) & 63) | 128);

                            utftext += String.fromCharCode((c & 63) | 128);

                        }



                    }



                    return utftext;

                },

           

                _utf8_decode: function(utftext) {

                    var string = "";

                    var i = 0;

                    var c = c1 = c2 = 0;



                    while (i < utftext.length) {



                        c = utftext.charCodeAt(i);



                        if (c < 128) {

                            string += String.fromCharCode(c);

                            i++;

                        }

                        else if ((c > 191) && (c < 224)) {

                            c2 = utftext.charCodeAt(i + 1);

                            string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));

                            i += 2;

                        }

                        else {

                            c2 = utftext.charCodeAt(i + 1);

                            c3 = utftext.charCodeAt(i + 2);

                            string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));

                            i += 3;

                        }



                    }



                    return string;

                }



            }

</script>
 
