<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
 ?>
<h3>Simple Local Pickup</h3>
<form method="POST">
    <div class="jw_lpd_admin_form">
        <div class="row">
            <h4>Please add deliver time slot</h4>
            <div id="jw_simple_deliver_time_slot">
                <a href="#" class="add button"><?php _e( '+ Add Deliver Time Slot'); ?></a>
                <br/>
                <table>
                    <tbody class="pickup_locations">
                        <?php if ($deliver_value) { ?>
                            <?php foreach ($deliver_value as $deliver_time_slots ) { ?>
                            <tr>
                            <td>
                                <label for="deliver_time_slot">Deliver time slot</label>
                                <input type="text" name="jw_simple_deliver_time_slot[]" id="deliver_time_slot" value="<?php echo $deliver_time_slots; ?>"><a href="#" class="remove button"><?php _e( 'Delete'); ?></a>
                            </td>
                            </tr>
                            <?php }?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <hr>
        <div class="row">
            <div id="jw_simple_pickup_locations">
                <h4>Please add pickup location</h4>
                <a href="#" class="add button"><?php _e( '+ Add Pickup Location'); ?></a>
                <br/>
                <table>
                    <tbody class="pickup_locations">
                        <?php if ($pickup_location_value) { ?>
                            <?php foreach ($pickup_location_value as $pickup_locations ) { ?>
                            <tr>
                            <td>
                                <label for="pickup_locations">Pickup locations</label>
                                <input type="text" name="jw_simple_pickup_locations[]" id="pickup_locations" value="<?php echo $pickup_locations; ?>"><a href="#" class="remove button"><?php _e( 'Delete'); ?></a>
                            </td>
                            </tr>
                            <?php }?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div id="jw_simple_pickup_locations_time_slot">
                <h4>Please add pickup time slot</h4>
                <a href="#" class="add button"><?php _e( '+ Add Pickup Location Time Slot'); ?></a>
                <br/>
                <table>
                    <tbody class="pickup_locations">
                        <?php if ($pickup_location_time_slot_value) { ?>
                            <?php foreach ($pickup_location_time_slot_value as $pickup_location_time_slot ) { ?>
                            <tr>
                            <td>
                                <label for="pickup_locations_time_slot">Pickup locations time slot</label>
                                <input type="text" name="jw_simple_pickup_locations_time_slot[]" id="pickup_locations_time_slot" value="<?php echo $pickup_location_time_slot; ?>"><a href="#" class="remove button"><?php _e( 'Delete'); ?></a>
                            </td>
                            </tr>
                            <?php }?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <input type="submit" value="Save" class="button button-primary button-large">
        </div>
    </div>
</form>
<script type="text/javascript">
            //add delivery time slot
            jQuery( document ).ready( function( $ ) {
                
                // add deliver time slot row
                $( '#jw_simple_deliver_time_slot a.add' ).on( 'click', function() {
                    var row = '<tr><td><label for="deliver_time_slot">Deliver time slot</label><input type="text" name="jw_simple_deliver_time_slot[]" id="deliver_time_slot" value=""><a href="#" class="remove button"><?php _e( 'Delete'); ?></a></td></tr>';
                    $( '#jw_simple_deliver_time_slot table tbody.pickup_locations' ).append( row );
                    return false;
                } );

                // Remove deliver time slot row
                $( '#jw_simple_deliver_time_slot table tbody tr td a.remove' ).live( 'click', function() {
                    var answer = confirm( "<?php _e( 'Delete the selected deliver time slot?'); ?>" );
                    if ( answer ) {
                        $(this).parents("tr").remove();
                    }
                    return false;
                } );
                
                // add pickup location row
                $( '#jw_simple_pickup_locations a.add' ).on( 'click', function() {
                    var row = '<tr><td><label for="pickup_locations">Pickup locations</label><input type="text" name="jw_simple_pickup_locations[]" id="pickup_locations" value=""><a href="#" class="remove button"><?php _e( 'Delete'); ?></a></td></tr>';
                    $( '#jw_simple_pickup_locations table tbody.pickup_locations' ).append( row );
                    return false;
                } );

                // Remove pickup location row
                $( '#jw_simple_pickup_locations table tbody tr td a.remove' ).live( 'click', function() {
                    var answer = confirm( "<?php _e( 'Delete the selected pickup locations?'); ?>" );
                    if ( answer ) {
                        $(this).parents("tr").remove();
                    }
                    return false;
                } );
                
                // add pickup location time slot row
                $( '#jw_simple_pickup_locations_time_slot a.add' ).on( 'click', function() {
                    var row = '<tr><td><label for="pickup_locations_time_slot">Pickup location time slot</label><input type="text" name="jw_simple_pickup_locations_time_slot[]" id="pickup_locations_time_slot" value=""><a href="#" class="remove button"><?php _e( 'Delete'); ?></a></td></tr>';
                    $( '#jw_simple_pickup_locations_time_slot table tbody.pickup_locations' ).append( row );
                    return false;
                } );

                // Remove pickup location time slot row
                $( '#jw_simple_pickup_locations_time_slot table tbody tr td a.remove' ).live( 'click', function() {
                    var answer = confirm( "<?php _e( 'Delete the selected deliver time slot?'); ?>" );
                    if ( answer ) {
                        $(this).parents("tr").remove();
                    }
                    return false;
                } );
                
            } );
</script>