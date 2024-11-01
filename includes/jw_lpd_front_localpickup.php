<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<tr class="pickup_location_row"> 
<th colspan="1">Please select your preference pickup location:* 
<td> 
<p>Locations</p> 
<select name="pickup_location" class="pickup_locations" placeholder="Choose one" style="width: 100%;"> 
<option value="" disabled selected hidden>Please choose one</option> 
<?php foreach ($pickup_location_value as $pickup_locations) { ?>
    <option value="<?php echo $pickup_locations ?>"><?php echo $pickup_locations ?></option>
<?php } ?>
<input name="pickup_location_date" type="text" class="pickup_location_date" placeholder="dd/mm/yyyy" id="datepicker" style="width: 49%; float:left; margin-right: 5px;"> 
<select name="pickup_location_time_slot" class="pickup_location_time_slots" placeholder="Choose one" style="width: 50%;"> 
<option value="" disabled selected hidden>Please choose one</option> 
<?php foreach ($pickup_location_time_slot_value as $pickup_location_time_slot_option) { ?>
    <option value="<?php echo $pickup_location_time_slot_option ?>"><?php echo $pickup_location_time_slot_option ?></option>
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
