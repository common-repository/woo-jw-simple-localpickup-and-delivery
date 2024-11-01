<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<tr class="delivery_row"> 
<th colspan="1">Please select your preference date and time:* 
<td> 
<p>Data and time</p> 
<input name="deliver_date" type="text" class="deliver_date" placeholder="dd/mm/yyyy" id="datepicker" style="width: 46%; float:left; margin-right: 5px;"> 
<select name="deliver_time_slot" class="deliver_time_slots" placeholder="Choose one" style="width: 46%;"> 
<option value="" disabled selected hidden>Please choose one</option> 
<?php foreach ($deliver_value as $deliver_time_slot_option) { ?>
    <option value="<?php echo $deliver_time_slot_option ?>"><?php echo $deliver_time_slot_option ?></option>
<?php } ?>
</td> 
</tr> 
<!--script>
    var today = new Date().toISOString().split('T')[0];
    document.getElementsByName('deliver_date')[0].setAttribute('min', today);
</script-->
<script>
    jQuery(document).ready(function($) {
        $("#datepicker").datepicker({ minDate: 0 });
    });
</script>