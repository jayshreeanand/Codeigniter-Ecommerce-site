var act = null;

$("#ingredient-form").validate({
	rules: {
	    name: {
	      required: true
	    }
	},
		
	submitHandler: function(form) {
		act(form);
	}
 });
	
$(document).on('click', 'button.add', function(event){
	act = add;
});

$(document).on('click', 'button.update', function(event){
	act = edit;
});

function add(form){
	$('#ingredient-form').attr('action', siteurl+'adminingredient/add');
	form.submit();
}
function edit(form){
	$('#ingredient-form').attr('action', siteurl+'adminingredient/edit');
	form.submit();
}

$(document).ready(function() {

	$('#textarea').textext({
        plugins : 'tags prompt focus autocomplete ajax arrow',
        tagsItems : editRecipes,
        prompt : 'Add one...',
        ajax : {
            url : siteurl+'adminrecipe/getajax',
            dataType : 'json',
            cacheResults : true
        }
    });
});