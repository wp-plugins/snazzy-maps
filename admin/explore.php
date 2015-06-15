<?php
defined( 'ABSPATH' ) OR exit;


define('PAGE_SIZE', 3);

function render_options($options, $selected){
    foreach((array)$options as $value => $text){
    ?>
        <option value="<?php echo $value;?>"
                <?php echo $value == $selected ? 'selected' : '' ?>>
                <?php echo $text;?>
        </option>
    <?php
    }  
}

function admin_explore_head($tab){

}

function admin_explore_tab($tab){ 
    
    $sort = isset($_GET['sort']) ? $_GET['sort'] : ''; 
    $tag = isset($_GET['tag']) ? $_GET['tag'] : ''; 
    $color = isset($_GET['color']) ? $_GET['color'] : ''; 
    $type = isset($_GET['type']) ? $_GET['type'] : 'all'; 
    $text = isset($_GET['text']) ? $_GET['text'] : '';
?>
  
    <div id="explore-list">
        <form id="search-form" class="clearfix">
           <div class="search-box">
               <input name="text" type="text" placeholder="Search..." value="<?php echo $text ?>"/>
               <button class="button" type="submit">Search Styles</button>
            </div>
        </form>
        <div id="filters" class="clearfix">
           <select name="type">
                <?php
                    $options = array("all" => "All Styles",
                                     "my-styles" => "My Styles",
                                     "my-favorites" => "My Favorites");
                    render_options($options, $type);
                ?>                    
            </select>
            <select name="sort">
                <option value="">Sort by...</option>
                <?php
                    $options = array("popular" => "Popular",
                                     "recent" => "Recent",
                                     "name" => "Name");
                    render_options($options, $sort);
                ?>
            </select> 
            <select name="tag">
                <option value="">Filter by Tag</option>
                <?php
                    $options = array("colorful" => "Colorful",
                                     "complex" => "Complex",
                                     "dark" => "Dark",
                                     "greyscale" => "Greyscale",
                                     "light" => "Light",
                                     "monochrome" => "Monochrome",
                                     "no-labels" => "No Labels",
                                     "simple" => "Simple",
                                     "two-tone" => "Dark",
                                     "dark" => "Two Tone");
                    render_options($options, $tag);
                ?>
            </select>            
            <select name="color">
                <option value="">Filter By Color</option>
                <?php
                    $options = array("black" => "Black",
                                     "blue" => "Blue",
                                     "gray" => "Gray",
                                     "green" => "Green",
                                     "multi" => "Multi",
                                     "orange" => "Orange",
                                     "purple" => "Purple",
                                     "red" => "Red",
                                     "white" => "White",
                                     "yellow" => "Yellow");
                    render_options($options, $color);
                ?>
            </select>
        </div>
        <div class="tablenav top clearfix">
            <div class="tablenav-pages">
                <span class="displaying-num"># items</span>
                <span class="pagination-links">
                    <a class="first-page" title="Go to the first page" href="#">«</a>
                    <a class="prev-page" title="Go to the previous page" href="#">‹</a>
                    <span class="paging-input">
                        <label for="current-page-selector" class="screen-reader-text">Select Page</label>
                        <input class="current-page" id="current-page-selector" title="Current page" type="text" name="paged" value="1" size="1"> 
                        of 
                        <span class="total-pages">#</span>
                    </span>
                    <a class="next-page" title="Go to the next page" href="#">›</a>
                    <a class="last-page" title="Go to the last page" href="#">»</a>
                </span>
            </div>              
        </div>

        <div class="results row">
        </div>
        <div class="search-error nothing" style="display:none;">
            <p>No styles were found matching your current filters. Try widening your search a bit!</p>
        </div>     

        <div class="tablenav bottom clearfix">
            <div class="tablenav-pages">
                <span class="displaying-num"># items</span>
                <span class="pagination-links">
                    <a class="first-page" title="Go to the first page" href="#">«</a>
                    <a class="prev-page" title="Go to the previous page" href="#">‹</a>
                    <span class="paging-input">
                        <label for="current-page-selector" class="screen-reader-text">Select Page</label>
                        <input class="current-page" id="current-page-selector" title="Current page" type="text" name="paged" value="1" size="1"> 
                        of 
                        <span class="total-pages">#</span>
                    </span>
                    <a class="next-page" title="Go to the next page" href="#">›</a>
                    <a class="last-page" title="Go to the last page" href="#">»</a>
                </span>
            </div>
        </div>
    </div>
<?php } ?>