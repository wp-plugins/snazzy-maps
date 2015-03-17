<?php
defined( 'ABSPATH' ) OR exit;



    function admin_help_head($tab){
    
    }

    function admin_help_tab($tab){
?>    

    <div class="row">
        <div class="col-md-10 col-lg-6">
            <h3>Instructions</h4>
            <p>
                Follow the instructions below to apply styles to your Google Maps:
            </p>
            <ol>
                <li>Browse hundreds of free map styles in the <a href="?page=snazzy_maps&tab=1">Explore</a> tab.</li>
                <li>Click "Save Style" to add styles you like to your <a href="?page=snazzy_maps&tab=0">collection</a>.</li>
                <li>Enable a style on the <a href="?page=snazzy_maps&tab=0">Site Styles</a> tab. This will apply the selected style to all Google Maps on your site.</li>
                <li>
                    (Optional) Add your <a href="https://snazzymaps.com/account/developer" target="_blank">API key</a> 
                    in the <a href="?page=snazzy_maps&tab=2">Settings</a> tab to enable your <a href="?page=snazzy_maps&tab=1&type=my-favorites">Favorites</a>.
                </li>
            </ol>
            <h3>Frequently Asked Questions</h3>
            <h4>Is the plugin free to use?</h4>
            <p>
                The Snazzy Maps plugin is free to use for personal and open source projects. 
                Business licenses are available for single and multiple sites and can be purchased at 
                <a href="https://snazzymaps.com/plugins" target="_blank">https://snazzymaps.com/plugins</a>.
            </p>
            <h4>How do I add a Google Map to my page?</h4>
            <p>
                This plugin does not add a Google Map to your page. It simply adds styles to your existing maps. If you haven't
                added a map yet, search <a href="https://wordpress.org/plugins" target="_blank">WordPress Plugins</a> for a suitable Google Map plugin.
            </p>
            <h4>Snazzy Maps doesn't work with my Google Maps plugin!</h4>
            <p>
                We've tested Snazzy Maps with several different Google Maps plugins. If you happen to find one that our plugin doesn't
                work with please send us an email at <a href="mailto:support@snazzymaps.com" target="_blank">support@snazzymaps.com</a>.
            </p>
            <h4>How can I access my favorites or private styles from Snazzy Maps?</h4>
            <ol>
                <li>Sign up for an account at <a href="https://snazzymaps.com" target="_blank">https://snazzymaps.com</a>.</li>
                <li>Click your email address in the top left corner.</li>
                <li>Click the developer menu item on the left side.</li>
                <li>Click the "Generate API Key" button.</li>
                <li>Copy the long generated API Key.</li>
                <li>Paste the key into the "Settings" tab in the Snazzy Maps plugin.</li>
                <li>You should now be able to access your favorites and private styles in the 'Explore' tab by changing the first filter dropdown.</li>
            </ol>
        </div>
    </div>   

<?php } ?>