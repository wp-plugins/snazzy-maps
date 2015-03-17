<?php
defined( 'ABSPATH' ) OR exit;



    function admin_styles_head($tab){   
        
        $styles = get_option('SnazzyMapStyles', null);
        if($styles == null){
            $styles = array();
        }        
        //Used to get a style by an id from the style array
        $getStyleIndex = function($id) use ($styles){
            foreach($styles as $index => $style){
                if($style['id'] == $id){
                    return $index;
                }
            }
            return null;
        };
        
        $getStyle = function($id) use ($styles, $getStyleIndex){
            $index = $getStyleIndex($id);
            return !is_null($index) ? $styles[$index] : null;
        };
        
        //When a new style is selected we have to go through some checks
        if(isset($_POST['new_style'])){
            $newStyle = json_decode(base64_decode($_POST['new_style']), true);            
            if(!$getStyle($newStyle['id'])){
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
        
        //Used to get a style by an id from the style array
        $getStyleIndex = function($id) use ($styles){
            foreach($styles as $index => $style){
                if($style['id'] == $id){
                    return $index;
                }
            }
            return null;
        };
        
        $getStyle = function($id) use ($styles, $getStyleIndex){
            $index = $getStyleIndex($id);
            return !is_null($index) ? $styles[$index] : null;
        };
                
        //Delete the specified style from the array
        if(isset($_GET['action']) && $_GET['action'] == 'delete_style'){
            $index = $getStyleIndex($_GET['style']);
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
            $index = $getStyleIndex($_GET['style']);
            if(!is_null($index)){
                update_option('SnazzyMapDefaultStyle', $styles[$index]);
            }        
        }
        
        //Disable the specified style        
        if(isset($_GET['action']) && $_GET['action'] == 'disable_style'){
            $index = $getStyleIndex($_GET['style']);
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
                <?php foreach($styles as $index => $style){ 
                    $isEnabled = !is_null($defaultStyle) && $defaultStyle['id'] == $style['id'];

                    $styleAction = function($action) use ($style){
                        return "?page=snazzy_maps&tab=0&action=$action&style=" . $style['id'];
                    };
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
                                    <a href="<?php echo $styleAction('disable_style'); ?>" 
                                        class="button button-secondary button-large">Disable</a>
                                <?php
                                }
                                else{ 
                                ?>                    
                                    <a href="<?php echo $styleAction('enable_style'); ?>" 
                                        class="button button-primary button-large">Enable</a>
                                <?php 
                                } ?>
                                <a href="<?php echo $styleAction('delete_style'); ?>" 
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