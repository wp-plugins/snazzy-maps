jQuery(document).ready(function($){    
    try{
        var style = JSON.parse(SnazzyDataForSnazzyMaps['json']);
        (function(g, s) {        
            var _map = g.Map;
            g.Map = function(map, options) {
                var that = Object.create(_map.prototype);
                options.styles = s;
                _map.apply(that, arguments);
                return that;
            };
        })(google.maps, style);
    }catch(error){/*Quietly die and leave the maps unstyled*/}
});
	    