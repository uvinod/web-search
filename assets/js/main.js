$(function(){
	
	/**
	 * Form submit
	 * @return Call getData function
	 */
	$("#form").submit(function(e){
   	 	e.preventDefault();	
   	 	var domains = ['google', 'bing'];
   	 	
   	 	$(domains).each(function(i){
   	 		getAPIData(0, domains[i]);
   	 	});
	});
	
	/**
	 * Call server side get contents using AJAX
	 * @param  offset Page offset
	 * @return html   Populate page with contents HTML
	 */
	var getAPIData = function(offset, domain){

		$('.data-container').css('display', 'block');
		$('#data-container-'+domain).html('<div class="data-loader"><img src="'+base_url+'assets/images/cube.gif" /></div>');	

		$.post(base_url+"search/get_web_search_results/"+offset,
	    {
	        keyword: $("#keyword").val(),
	        page: offset,
	        domain: domain
	    },
	    function(data, status){	    	
	        $('#data-container-'+domain).html(data);
	    });
	}

	/**
	 * Click to call pagination	 
	 * @return Call getData function
	 */
	$(document).on('click', '.data-container .pagination a', function(e) {
		
	   e.preventDefault();	   

	   var offset = $(this).attr('attr-pageno');

	   if($(this).parent().parent().attr('id') == 'data-container-google')
	   	getAPIData(offset, 'google');
	   else if($(this).parent().parent().attr('id') == 'data-container-bing')
	   	getAPIData(offset, 'bing');
    });
    
});