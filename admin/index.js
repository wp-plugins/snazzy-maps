jQuery(document).ready(function($){
         
    var showError = function(message){
        $(".search-error").html(message).show();
        $(".results").hide();
        $(".tablenav-pages").hide();
    }
    var hideError = function(){
        $(".search-error").hide();
        $(".results").show();
        $(".tablenav-pages").show();
    }
    
    //Style list with pagination and filtering
    var refreshExplore = function(){
        var params = queryString.parse(location.search);   
        var data = {};
        data['pageSize'] = 12;  
        data['page'] = params.ppage;
        data['sort'] = params.sort;
        data['color'] = params.color;
        data['tag'] = params.tag;
        data['text'] = params.text;
        
        var endPoint = '';
        if(params.type == 'my-styles'){
            endPoint = 'my-styles.json';   
            data['key'] = SnazzyData['USER_API_KEY'];
            if(SnazzyData['USER_API_KEY'] == null){
                showError('<p>You need to add your API key in the <a href="?page=snazzy_maps&tab=2">Settings</a> tab.</p>');
                return;
            }
            
        }else if(params.type == 'my-favorites'){
            endPoint = 'favorites.json';               
            data['key'] = SnazzyData['USER_API_KEY'];
            if(SnazzyData['USER_API_KEY'] == null){
                showError('<p>You need to add your API key in the <a href="?page=snazzy_maps&tab=2">Settings</a> tab.</p>');
                return;
            }
        }
        else{
            endPoint = 'explore.json';               
            data['key'] = SnazzyData['API_KEY'];
            $('.missing-api-key').hide();
            $('.results').show();
            $('.pagination').show();
        }
        
        
        //Clean up the data before getting the response
        for(var key in data){
            if(data[key] == undefined || data[key] == null || data[key] == "undefined"){
                delete data[key];
            }
        }
        
        var failedTimeout = setTimeout(function(){
            showError("<p>Oops, it seems that Snazzy Maps is temporarily down or your API key is incorrect.</p>");
        }, 3000);        
        $.ajax({
            url: SnazzyData['API_BASE'] + endPoint,
            jsonp: 'callback',
            data: data,
            dataType: 'jsonp',
            success: function(response) {
                clearTimeout(failedTimeout);
                
                if('statusCode' in response && response['statusCode'] != 200){
                    showError("<p>Oops, it seems that Snazzy Maps is temporarily down or your API key is incorrect.</p>");                    
                }else{
                    updatePagination(response['pagination']);
                    renderStyles($('#explore-list').find('.results'), response['styles']);   
                }
            },
            error: function(response){     
                clearTimeout(failedTimeout);       
                showError("<p>Oops, it seems that Snazzy Maps is temporarily down or your API key is incorrect.</p>");
            }
        }); 
        
        //JSONP doesn't support native jQuery errors
    };
                       
    var styleTemplate = $('#style-template').html();
    var renderStyles = function(container, styles){        
        container.html('');
        $.each(styles, function(i,style){          
            var data = {
                name: style['name'],
                imageUrl: style['imageUrl'],
                url: style['url'],
                author: style['createdBy']['name'],
                views: style['views'],
                favorites: style['favorites']
            };
            
            //Add to the last row           
            container.append($(Mustache.to_html(styleTemplate, data)).data('style', style));
        });        
    };
    
    History.Adapter.bind(window,'statechange', function(){
        refreshExplore();
    });
    $(window).trigger('statechange');
    
    //An easy way to replace the GET parameters and also replace the state at the same time
    var replaceGET = function(params){
        var oldParams = queryString.parse(location.search);
        for(var key in params)
        {
            oldParams[key] = params[key];
        }        
        History.replaceState(oldParams, document.title, '?' + queryString.stringify(oldParams));
    };
    
    $('#explore-list select').live('change', function(){
        var q = {};
        q[this.name] = $(this).val();
        q['ppage'] = 1; //Reset the page number because we are changing the results
        replaceGET(q);
    });
    $('#search-form').live('submit', function(){    
        replaceGET({
            text: $(this).find('input[name="text"]').val(),
            ppage: 1 //Reset the page number because we are changing the results
        });        
        return false;
    });
    
    $('.style').live('submit', function(){        
        $(this).find('input[name="new_style"]')
            .val(encodeURIComponent(JSON.stringify($(this).data('style'))));
    });
        
    //Pagination
    $('.tablenav-pages a').live('click', function(){ 
        replaceGET({ ppage: $(this).data('page') }); 
        return false;
    });
    
    $('.current-page').live('change', function(){
        
        var start = $('.first-page').data('page');
        var end = $('.last-page').data('page');
        var page = parseInt($(this).val(), 10);
        if ($(this).val() == page && page >= start && page <= end){        
            replaceGET({ ppage: page }); 
        }        
    });
       
    var updatePagination = function (options){
        
        var page = options['currentPage'];
                       
        if(options['totalItems'] == 0){
            showError('<p>No styles were found matching your current filters. Try widening your search a bit!</p>');
            return;
        }
        else{        
            hideError();
        }
        
        $('.first-page').toggleClass('disabled', options['currentPage'] <= 1);
        $('.first-page').data('page', 1);
        
        $('.prev-page').toggleClass('disabled', options['currentPage'] <= 1);
        $('.prev-page').data('page', options['currentPage']*1 - 1);
        
        $('.next-page').toggleClass('disabled', options['currentPage'] >= options['totalPages']);
        $('.next-page').data('page', options['currentPage']*1 + 1);
        
        $('.last-page').toggleClass('disabled', options['currentPage'] >= options['totalPages']);
        $('.last-page').data('page', options['totalPages']);
                
        if(options['totalItems'] > 1){
            $('.tablenav-pages .displaying-num').html(options['totalItems'] + ' items');
        }
        else if(options['totalItems'] == 1){
            $('.tablenav-pages .displaying-num').html('1 item');
        }
        else{        
            $('.tablenav-pages .displaying-num').html('0 items');
        }
        
        $('.tablenav-pages .total-pages').html(options['totalPages']);
        if(options['totalPages'] > 0){
            $('.current-page').val(options['currentPage']);
            $('.current-page').attr('disabled', false);
        }
        else{        
            $('.current-page').val(0);
            $('.current-page').attr('disabled', true);
        }
                
    }
});
	    