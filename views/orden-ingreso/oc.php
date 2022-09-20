<?php
function dv($r){
    $s=1;
    for($m=0;$r!=0;$r/=10)
        $s=($s+$r%10*(9-$m++%6))%11;
        return chr($s?$s+47:75);
}
?>
<table style="width:510.4pt;margin-left:0;border-collapse:collapse;border:none;">
    <tbody>
        <tr>
            <td style="width: 364.35pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;height: 40.2pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;'><img width="150" src="/web/logoniqui.png" />
            </td>
            <td align="center"valign="center" rowspan="2" style="width: 166.55pt;border-top: 1pt solid windowtext;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-image: initial;border-left: none;padding: 0cm 5.4pt;height: 40.2pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;text-align:center;'><strong><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></strong></p>
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;text-align:center;'><strong><span style='font-size:15px;font-family:"Calibri",sans-serif;'>RUT: 77.901.920-9</span></strong></p>
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;text-align:center;'><strong><span style='font-size:20px;font-family:"Calibri",sans-serif;'>ORDEN DE COMPRA</span></strong></p>
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;text-align:center;'><strong><span style='font-size:20px;font-family:"Calibri",sans-serif;'>&nbsp;</span></strong><span style='font-size:15px;font-family:"Calibri",sans-serif;'>No <?php echo $model->idordenIngreso; ?></span></p>
            </td>
        </tr>
        <tr>
            <td style="width: 320.35pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;height: 37.45pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;'><strong><span style='font-size:13px;font-family:"Calibri",sans-serif;'>M y C Promociones Ltda.&nbsp;</span></strong></p>
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;'><strong><span style='font-size:12px;font-family:"Calibri",sans-serif;'>IMPORTACION Y DISTRIBUCION&nbsp;</span></strong></p>
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;'><strong><span style='font-size:13px;font-family:"Calibri",sans-serif;'>AVDA KENNEDY 6800, SANTIAGO&nbsp;</span></strong></p>
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;'>&nbsp;</p>
            </td>
        </tr>
    </tbody>
</table>
<br>
<table style="float: left;width:510.4pt;border-collapse:collapse;border:none;margin-left:4.8pt;margin-right:4.8pt;">
    <tbody>
        <tr>
            <td style="width: 83.65pt;border: 1pt solid windowtext;background: rgb(191, 191, 191);padding: 0cm 5.4pt;height: 19.3pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;background:#BCBCBC;'><strong><span style='font-size:13px;font-family:"Calibri",sans-serif;'>Señor(es)&nbsp;</span></strong></p>
            </td>
            <td style="width: 158.15pt;border-top: 1pt solid windowtext;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-image: initial;border-left: none;padding: 0cm 5.4pt;height: 19.3pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;'><?php echo $model->rutProveedor0->nombreProveedor ?></p>
            </td>
            <td style="width: 111.9pt;border-top: 1pt solid windowtext;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-image: initial;border-left: none;background: rgb(191, 191, 191);padding: 0cm 5.4pt;height: 19.3pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;background:#BCBCBC;'><strong><span style='font-size:13px;font-family:"Calibri",sans-serif;'>RUT</span></strong></p>
            </td>
            <td style="width: 158.15pt;border-top: 1pt solid windowtext;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-image: initial;border-left: none;padding: 0cm 5.4pt;height: 19.3pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;'><?php 
                
                $digito = dv($model->rutProveedor0->rutProveedor);
                echo $model->rutProveedor0->rutProveedor."-".$digito; ?></p>
            </td>
        </tr>
        <tr>
            <td style="width: 83.65pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;background: rgb(191, 191, 191);padding: 0cm 5.4pt;height: 19.3pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;background:#BCBCBC;'><strong><span style='font-size:13px;font-family:"Calibri",sans-serif;'>Giro&nbsp;</span></strong></p>
            </td>
            <td style="width: 158.15pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;height: 19.3pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;'><?php echo $model->rutProveedor0->giroProveedor; ?></p>
            </td>
            <td style="width: 111.9pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;background: rgb(191, 191, 191);padding: 0cm 5.4pt;height: 19.3pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;background:#BCBCBC;'><strong><span style='font-size:13px;font-family:"Calibri",sans-serif;'>Fecha Emisión&nbsp;</span></strong></p>
            </td>
            <td style="width: 158.15pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;height: 19.3pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;'><?php echo date('d/m/Y',strtotime($model->fechaIngreso)); ?></p>
            </td>
        </tr>
        <tr>
            <td style="width: 83.65pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;background: rgb(191, 191, 191);padding: 0cm 5.4pt;height: 18.1pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;background:#BCBCBC;'><strong><span style='font-size:13px;font-family:"Calibri",sans-serif;'>Dirección&nbsp;</span></strong></p>
            </td>
            <td style="width: 158.15pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;height: 18.1pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;'><?php echo $model->rutProveedor0->direccionProveedor; ?></p>
            </td>
            <td style="width: 111.9pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;background: rgb(191, 191, 191);padding: 0cm 5.4pt;height: 18.1pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;background:#BCBCBC;'><strong><span style='font-size:13px;font-family:"Calibri",sans-serif;'>Comuna&nbsp;</span></strong></p>
            </td>
            <td style="width: 158.15pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;height: 18.1pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;'><?php echo $model->rutProveedor0->comunaProveedor; ?></p>
            </td>
        </tr>
        <tr>
            <td style="width: 83.65pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;background: rgb(191, 191, 191);padding: 0cm 5.4pt;height: 19.3pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;background:#BCBCBC;'><strong><span style='font-size:13px;font-family:"Calibri",sans-serif;'>Contacto&nbsp;</span></strong></p>
            </td>
            <td style="width: 158.15pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;height: 19.3pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;'><?php echo $model->rutProveedor0->contacto; ?></p>
            </td>
            <td style="width: 111.9pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;background: rgb(191, 191, 191);padding: 0cm 5.4pt;height: 19.3pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;background:#BCBCBC;'><strong><span style='font-size:13px;font-family:"Calibri",sans-serif;'>Fono&nbsp;</span></strong></p>
            </td>
            <td style="width: 158.15pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;height: 19.3pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;'><?php echo $model->rutProveedor0->telefonoProveedor; ?></p>
            </td>
        </tr>
    </tbody>
</table>
<br>
<table style="float: left;width:510.4pt;border-collapse:collapse;border:none;margin-left:4.8pt;margin-right:4.8pt;">
    <tbody>
        <tr>
            <td colspan="2" style="width: 515.1pt;border: 1pt solid windowtext;background: rgb(191, 191, 191);padding: 0cm 5.4pt;height: 13.75pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;background:#BCBCBC;'><strong><span style='font-size:13px;font-family:"Calibri",sans-serif;'>DATOS DE PAGO</span></strong></p>
            </td>
        </tr>
        <tr>
            <td style="width: 77.75pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;background: rgb(191, 191, 191);padding: 0cm 5.4pt;height: 13.75pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;background:#BCBCBC;'><strong><span style='font-size:13px;font-family:"Calibri",sans-serif;'>Forma:&nbsp;</span></strong></p>
            </td>
            <td style="width: 437.35pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;height: 13.75pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;'><?php echo $model->forma; ?></p>
            </td>
        </tr>
        <tr>
            <td style="width: 77.75pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;background: rgb(191, 191, 191);padding: 0cm 5.4pt;height: 12.85pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;background:#BCBCBC;'><strong><span style='font-size:13px;font-family:"Calibri",sans-serif;'>Medio:&nbsp;</span></strong></p>
            </td>
            <td style="width: 437.35pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;height: 12.85pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;'><?php echo $model->medio; ?></p>
            </td>
        </tr>
        <tr>
            <td style="width: 77.75pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;background: rgb(191, 191, 191);padding: 0cm 5.4pt;height: 13.75pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;background:#BCBCBC;'><strong><span style='font-size:13px;font-family:"Calibri",sans-serif;'>Pago:&nbsp;</span></strong></p>
            </td>
            <td style="width: 437.35pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;height: 13.75pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;'><?php echo $model->pago; ?></p>
            </td>
        </tr>
    </tbody>
</table>
<br><table style="float: left;width:510.4pt;border-collapse:collapse;border:none;margin-left:4.8pt;margin-right:4.8pt;">
    <tbody>
        <tr>
            <td colspan="5" style="width: 515.1pt;border: 1pt solid windowtext;background: rgb(191, 191, 191);padding: 0cm 5.4pt;height: 12.85pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;'>Detalle</p>
            </td>
        </tr>
        <tr>
            <td style="width: 102.95pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;background: rgb(191, 191, 191);padding: 0cm 5.4pt;height: 12.35pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;'>C&oacute;digo</p>
            </td>
            <td style="width: 244.1pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;background: rgb(191, 191, 191);padding: 0cm 5.4pt;height: 12.35pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;'>Descripci&oacute;n</p>
            </td>
            <td style="width: 63.8pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;background: rgb(191, 191, 191);padding: 0cm 5.4pt;height: 12.35pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;'>Cantidad</p>
            </td>
            <td style="width: 2cm;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;background: rgb(191, 191, 191);padding: 0cm 5.4pt;height: 12.35pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;'>$ UNI</p>
            </td>
            <td style="width: 47.55pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;background: rgb(191, 191, 191);padding: 0cm 5.4pt;height: 12.35pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;'>Neto</p>
            </td>
        </tr>
      
      
      
        <?php foreach($model->detalle as $d){ ?>
         <tr>
            <td style="width: 102.95pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;height: 12.85pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;'><?php echo $d->idproducto0->SKU; ?></p>
            </td>
            <td style="width: 244.1pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;height: 12.85pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;'><?php echo $d->idproducto0->nombreProducto; ?></p>
            </td>
            <td style="width: 63.8pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;height: 12.85pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;'><?php echo number_format($d->cantidad,'0', ',','.'); ?></p>
            </td>
            <td style="width: 2cm;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;height: 12.85pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;'>$<?php echo number_format($d->precio,'0', ',','.'); ?></p>
            </td>
            <td style="width: 47.55pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;height: 12.85pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;'>$<?php echo number_format($d->total,'0', ',','.'); ?></p>
            </td>
         </tr>
         <?php
		} ?>
  


    </tbody>
</table>
<br><br>

<table style="float: left;width:510.4pt;border-collapse:collapse;border:none;margin-left:4.8pt;margin-right:4.8pt;">
    <tbody>
        <tr>
            <td style="width: 127.6pt;border: 1pt solid windowtext;padding: 0cm 5.4pt;height: 17.05pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:0pt;'>Observaciones:</p>
            </td>
            <td rowspan="3" style="width: 262pt;border-top: 1pt solid windowtext;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-image: initial;border-left: none;padding: 0cm 5.4pt;height: 17.05pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;'><?php echo $model->observaciones; ?></p>
            </td>
            <td style="width: 2cm;border-top: 1pt solid windowtext;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-image: initial;border-left: none;background: rgb(191, 191, 191);padding: 0cm 5.4pt;height: 17.05pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;text-align:right;'><span style="font-size:14px;">Valor neto</span></p>
            </td>
            <td style="width: 64.1pt;border-top: 1pt solid windowtext;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-image: initial;border-left: none;padding: 0cm 5.4pt;height: 17.05pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;'><?php echo number_format($model->totalNeto,'0', ',','.'); ?></p>
            </td>
        </tr>
        <tr>
            <td rowspan="2" style="width: 127.6pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;height: 16.35pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;'>&nbsp;</p>
            </td>
            <td style="width: 2cm;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;background: rgb(191, 191, 191);padding: 0cm 5.4pt;height: 16.35pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;text-align:right;'><span style="font-size:14px;">19% IVA</span></p>
            </td>
            <td style="width: 64.1pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;height: 16.35pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;'><?php echo number_format($model->IVA,'0', ',','.'); ?></p>
            </td>
        </tr>
        <tr>
            <td style="width: 2cm;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;background: rgb(191, 191, 191);padding: 0cm 5.4pt;height: 17.05pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;text-align:right;'><span style="font-size:14px;">Total</span></p>
            </td>
            <td style="width: 64.1pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;height: 17.05pt;vertical-align: top;">
                <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Calibri",sans-serif;margin:0cm;margin-bottom:.0001pt;'><?php echo number_format($model->Total,'0', ',','.'); ?></p>
            </td>
        </tr>
    </tbody>
</table>
<p style="float:left; width:60%;"><img src="pie.jpeg"></p>