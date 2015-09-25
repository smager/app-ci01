<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Stores</title>
<?php
    includeHeader();
?>
</head>
<body>
<?php menu(); ?>

<div class="container page">
<form id="frm" action="<?php echo base_url('stores/update');?>" method="post" >
<table class="zTable fullWidth">
    <tr>
        <th style="width: 25px"></th>
        <th>Store Name</th>
        <th>Supplier</th>
        <th>Products/Supplies</th>
    </tr>
<?php

 $q=$this->stores_model->getdata();
 $d=$q->result();


for ($x = 0; $x < $q->num_rows(); $x++) {
    $ssq=$this->store_supplies_model->getdata($d[$x]->store_id);
    $ssd=$ssq->result();

    $l_supplies = '';
    $l_br = '';

    for ($y = 0; $y < $ssq->num_rows(); $y++) {
        $l_supplies = $l_supplies . $l_br . $ssd[$y]->supply_code;
        $l_br = '<br />';
    }

?>
    <tr>

            <td><input type="hidden" name="p_store_id[]" value="<?php echo $d[$x]->store_id; ?>">
                <?php checkbox( array( 'name'=>'cb[]','value'=>$d[$x]->store_id  )); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"store_name[]",'value'=>$d[$x]->store_name  )); ?> </td>
            <td><?php selectBox( array( 'name'=>'supplier_id[]','value'=>$d[$x]->supplier_id,'selectedValue'=>$d[$x]->supplier_id   )); ?> </td>
            <td><a href="javascript:manageItems(<?php echo $d[$x]->store_id; ?>);">Manage Items</a>
                | <a href="javascript:void(0)" onclick="collapseList(this,'prodlist<?php echo $x; ?>');">Show</a>
                <div style="display: none;" id='prodlist<?php echo $x; ?>'>
                <?php echo $l_supplies; ?>
                </div>
            </td>

    </tr>

<?php
}

for ($x = 0; $x < 5; $x++) {
?>
    <tr>

            <td><input type="hidden" name="p_store_id[]">
                <?php checkbox( array( 'name'=>'select[]')); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"store_name[]")); ?> </td>
            <td><?php selectBox( array( 'name'=>'supplier_id[]')); ?> </td>
            <td></td>
    </tr>


<?php
}
?>
</table>

<div class="buttonGroup">
<?php
    Button(array('name'=>'Save','type'=>'submit'));
    Button(array('name'=>'Delete','onclick'=>"return checkDelete('" . base_url("stores/delete")  . "');"));
?>
</div>

</form>

</div> <!---end of container-page-->
<?php includeHandleBars(); ?>
<?php includePageJS(); ?>
<?php includeFooter(); ?>
</body>
</html>