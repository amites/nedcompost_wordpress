jQuery(function($)
    {
        function my_check_categories()
        {
            var cat_id = parseInt($('#cat_id').val());
            
            $('#hamza_lite_testimonail_designation').hide();
 
            if(cat_id != 0){
            $('#categorychecklist input[type="checkbox"]').each(function(i,e)
            {
                var id = $(this).attr('id').match(/-([0-9]*)$/i);                
                
                id = (id && id[1]) ? parseInt(id[1]) : null ;
                                
                if ($.inArray(id, [cat_id]) > -1 && $(this).is(':checked'))
                {
                    $('#hamza_lite_testimonail_designation').show();
                }
            });
            }
            //console.log(cat_id);
        }
 
        $('#categorychecklist input[type="checkbox"]').on('click', my_check_categories);
 
        my_check_categories();
        
        $('#page_template').on('change', function(){
            //var value = $(this).val();
            console.log($(this).val());
        });
        
    });

$(document).ready(function(){
    $('.cat-testimonial-list').hover(slideToggle);
});