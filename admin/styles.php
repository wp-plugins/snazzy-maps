<?php
defined( 'ABSPATH' ) OR exit;

    //Removed closures for PHP 5.0.x support
    function _getStyleIndex(&$styles, $id){
        foreach((array)$styles as $index => $style){
            if($style['id'] == $id){
                return $index;
            }
        }
        return null;
    }
    function _getStyle(&$styles, $id){
        $index = _getStyleIndex($styles, $id);
        return !is_null($index) ? $styles[$index] : null;
    }

    function _styleAction(&$style, $action){
        return "?page=snazzy_maps&tab=0&action=$action&style=" . $style['id'];
    };

    function admin_styles_head($tab){   
        
        $styles = get_option('SnazzyMapStyles', null);
        if($styles == null){
            $styles = array();
        }        
        
        
        //When a new style is selected we have to go through some checks
        if(isset($_POST['new_style'])){
            $json = new SnazzyMaps_Services_JSON();
            $newStyle = _object_to_array($json->decode(urldecode($_POST['new_style'])));
            if(!_getStyle($styles, $newStyle['id'])){
                $styles[] = $newStyle;
                update_option('SnazzyMapStyles', $styles);
            }            
        }
    }

    function admin_styles_tab($tab){
        
        $styles = get_option('SnazzyMapStyles', null);
        if($styles == null){
            $styles = array();
        }
                
                
        //Delete the specified style from the array
        if(isset($_GET['action']) && $_GET['action'] == 'delete_style'){
            $index = _getStyleIndex($styles, $_GET['style']);
            $defaultStyle = get_option('SnazzyMapDefaultStyle', null);  
            if(!is_null($index)){                
                $oldStyle = $styles[$index];
                array_splice($styles, $index, 1);    
                update_option('SnazzyMapStyles', $styles);     
                
                //Delete the default style when it is removed from this list
                if(!is_null($defaultStyle) && $defaultStyle['id'] == $oldStyle['id']){
                    delete_option('SnazzyMapDefaultStyle');
                }
            }
        }
        
        //Enable the specified style
        if(isset($_GET['action']) && $_GET['action'] == 'enable_style'){
            $index = _getStyleIndex($styles, $_GET['style']);
            if(!is_null($index)){
                update_option('SnazzyMapDefaultStyle', $styles[$index]);
            }        
        }
        
        //Disable the specified style        
        if(isset($_GET['action']) && $_GET['action'] == 'disable_style'){
            $index = _getStyleIndex($styles, $_GET['style']);
            $defaultStyle = get_option('SnazzyMapDefaultStyle', null);    
            if(!is_null($index) && !is_null($defaultStyle) 
                && $styles[$index]['id'] == $defaultStyle['id']){
                delete_option('SnazzyMapDefaultStyle');
            }        
        }
        
        
        $defaultStyle = get_option('SnazzyMapDefaultStyle', null);
        
        //Used during testing
        if(isset($_GET['clear_styles'])){
            delete_option('SnazzyMapStyles');
        }
?>
            
        <?php if (count($styles) > 0) { ?>
            <div class="results row">
                <?php foreach((array)$styles as $index => $style){ 
                    $isEnabled = !is_null($defaultStyle) && $defaultStyle['id'] == $style['id'];
                ?>        
                    <div class="style col-sm-6 col-md-4 <?php echo $isEnabled ? 'enabled' : '';?>">
                        <div class="sm-style">
                            <div class="sm-map">
                                <img src="<?php echo $style['imageUrl']; ?>"
                                     alt="<?php echo $style['name']; ?>"/>
                                <?php
                                if($isEnabled) {
                                ?>    
                                    <span class="overlay-icon">
                                        <span class="icon-checkmark"></span>
                                    </span>
                                <?php 
                                } ?>
                            </div>
                            <div class="sm-content info">
                                <h3>
                                    <a href="<?php echo $style['url']; ?>" class="title" target="_blank">
                                        <?php echo $style['name']; ?>
                                    </a>
                                </h3>
                                <div class="author">                            
                                    by <?php echo $style['createdBy']['name'];?></span>
                                </div>
                                <div class="stats">
                                    <div class="views">
                                        <span class="icon-eye"></span>
                                        <?php echo $style['views']; ?> views
                                    </div>
                                    <div class="favorites">
                                        <span class="icon-star"></span>
                                        <?php echo $style['favorites']; ?> favorites
                                    </div>
                                </div>
                                <?php
                                if($isEnabled){
                                ?>                    
                                    <a href="<?php echo _styleAction($style, 'disable_style'); ?>" 
                                        class="button button-secondary button-large">Disable</a>
                                <?php
                                }
                                else{ 
                                ?>                    
                                    <a href="<?php echo _styleAction($style, 'enable_style'); ?>" 
                                        class="button button-primary button-large">Enable</a>
                                <?php 
                                } ?>
                                <a href="<?php echo _styleAction($style, 'delete_style'); ?>" 
                                    class="delete button button-error button-large">Remove</a>
                            </div>
                        </div>
                    </div>     
                <?php } ?>
            </div>
        <?php }else{ ?>            
            <div class="nothing">
                <p>Looks like you haven't picked any styles yet.</p>
                <p><a href="?page=snazzy_maps&tab=1">Explore</a> and choose some styles for your site!</p>
            </div>
        <?php } ?>

<?php } ?>