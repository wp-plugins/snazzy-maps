<?php
defined( 'ABSPATH' ) OR exit;



    function admin_my_snazzymaps_head($tab){           
        if(isset($_POST['api_key'])){
            update_option('MySnazzyAPIKey', $_POST['api_key']);   
        }
    }

    function admin_my_snazzymaps_tab($tab){
        if(isset($_GET['action']) && $_GET['action'] == 'delete_key'){
            delete_option('MySnazzyAPIKey');
        }        
        $api_key = get_option('MySnazzyAPIKey', null);
?>
   
    <div class="message row">
        <div class="col-md-8">
            <h3>API Key</h3>
            <p>
                If you have a <a href="https://snazzymaps.com" target="_blank">Snazzy Maps</a> account you can access your favorites and private styles from within the plugin.
                Sign up for an <a href="https://snazzymaps.com/account/developer" target="_blank">API Key</a> and paste it into the text box below to access these styles on the <a href="?page=snazzy_maps&tab=1">Explore</a> tab.
            </p>

            <form action="?page=snazzy_maps&tab=2" method="post" class="pure-form pure-form-stacked api-form box-shadow-cell">

               <label for="api_key"><strong>API Key</strong></label>
               <input type="text" id="api_key" name="api_key" 
                      placeholder="Enter your API Key" value="<?php echo $api_key; ?>"/>
               <button type="submit" class="button button-primary">SAVE</button>
               <?php if(!is_null($api_key)){ ?>
                  <a href="?page=snazzy_maps&tab=2&action=delete_key" 
                                class="button button-error">DELETE</a>
               <?php } ?>             
            </form>
        </div>
    </div>
   
<?php } ?>