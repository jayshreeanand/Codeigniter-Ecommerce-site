var act = null;

$("#recipe-form").validate({
	rules: {
	    name: {
	      required: true
	    }
	},
		
	submitHandler: function(form) {
		act(form);
	}
 });
	
$(document).ready(function() {

	$('#textarea').textext({
        plugins : 'tags prompt focus autocomplete ajax arrow',
        tagsItems : editIngredients,
        prompt : 'Add one...',
        ajax : {
            url : siteurl+'adminingredient/getajax',
            dataType : 'json',
            cacheResults : true
        }
    });

    $('#related').textext({
        plugins : 'tags prompt focus autocomplete ajax arrow',
        tagsItems : related,
        prompt : 'Add one...',
        ajax : {
            url : siteurl+'adminrecipe/getajax',
            dataType : 'json',
            cacheResults : true
        }
    });
});

$(document).on('click', 'button.add', function(event){
	act = add;
});

$(document).on('click', 'button.update', function(event){
	act = edit;
});

function add(form){
	$('#recipe-form').attr('action', siteurl+'adminrecipe/add');
	form.submit();
}
function edit(form){
	$('#recipe-form').attr('action', siteurl+'adminrecipe/edit');
	form.submit();
}