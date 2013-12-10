var act = null;

$("#shipping-form").validate({
	rules: {
		email:{
			required: true
		},

	    first: {
	      required: true
	    },
	    last: {
	      required: true
	    },
	    address1: {
	      required: true
	    },
	    city: {
	      required: true
	    },
	    state: {
	      required: true
	    },
	    postalcode: {
	      required: true
	    },
	    mobile: {
	      required: true
	    },

	    bfirst: {
	      required: true
	    },
	    blast: {
	      required: true
	    },
	    baddress1: {
	      required: true
	    },
	    bcity: {
	      required: true
	    },
	    bstate: {
	      required: true
	    },
	    bpostalcode: {
	      required: true
	    },
	    bmobile: {
	      required: true
	    }
	},
		
	submitHandler: function(form) {
		act(form);
	}
 });
	
$(document).on('click', 'input.checkout', function(event){
	act = add;
});

$(document).on('click', 'input.cancel', function(event){
	act = cancel;
});

function add(form){
	form.submit();
}

function cancel(form){
	window.location = siteurl+'ggcart';
}

var states1 = [];
var states356 = [];

states1[1] = 'Alabama'; 
states1[2] = 'Alaska';
states1[3] = 'Arizona';
states1[4] = 'Arkansas';
states1[5] = 'California';
states1[6] = 'Colorado';
states1[7] = 'Connecticut';
states1[8] = 'Delaware';
states1[9] = 'Florida';
states1[10] = 'Georgia';
states1[11] = 'Hawaii';
states1[12] = 'Idaho';
states1[13] = 'Illinois';
states1[14] = 'Indiana';
states1[15] = 'Iowa';
states1[16] = 'Kansas';
states1[17] = 'Kentucky';
states1[18] = 'Louisiana';
states1[19] = 'Maine';
states1[20] = 'Maryland';
states1[21] = 'Massachusetts';
states1[22] = 'Michigan';
states1[23] = 'Minnesota';
states1[24] = 'Mississippi';
states1[25] = 'Missouri';
states1[26] = 'Montana';
states1[27] = 'Nebraska';
states1[28] = 'Nevada';
states1[29] = 'New Hampshire';
states1[30] = 'New Jersey';
states1[31] = 'New Mexico';
states1[32] = 'New York';
states1[33] = 'North Carolina';
states1[34] = 'North Dakota';
states1[35] = 'Ohio';
states1[36] = 'Oklahoma';
states1[37] = 'Oregon';
states1[30] = 'Pennsylvania';
states1[39] = 'Rhode Island';
states1[40] = 'South Carolina';
states1[41] = 'South Dakota';
states1[42] = 'Tennessee';
states1[43] = 'Texas';
states1[44] = 'Utah';
states1[45] = 'Vermont';
states1[46] = 'Virginia';
states1[47] = 'Washington';
states1[48] = 'West Virginia';
states1[49] = 'Wisconsin';
states1[50] = 'Wyoming';
states1[51] = 'Washington D.C.';

states356[1] = 'Andhra Pradesh'; 
states356[2] = 'Arunachal Pradesh';
states356[3] = 'Assam';
states356[4] = 'Bihar';
states356[5] = 'Chhattisgarh';
states356[6] = 'Goa';
states356[7] = 'Gujarat';
states356[8] = 'Haryana';
states356[9] = 'Himachal Pradesh';
states356[10] = 'Jammu and Kashmir';
states356[11] = 'Jharkhand';
states356[12] = 'Karnataka';
states356[13] = 'Kerala';
states356[14] = 'Madhya Pradesh';
states356[15] = 'Maharashtra';
states356[16] = 'Manipur';
states356[17] = 'Meghalya';
states356[18] = 'Mizoram';
states356[19] = 'Nagaland';
states356[20] = 'Odisha';
states356[21] = 'Punjab';
states356[22] = 'Rajasthan';
states356[23] = 'Sikkim';
states356[24] = 'TamilNadu';
states356[25] = 'Tripura';
states356[26] = 'Uttar Pradesh';
states356[27] = 'Uttarakhand';
states356[28] = 'West Bengal';



function copystoa(){
	var copyFlag = $("#squaredFour").is(':checked');
	if(copyFlag){

		fillStates(356);
		$('#bfirst').val($('#first').val());
		$('#blast').val($('#last').val());
		$('#baddress1').val($('#address1').val());
		$('#baddress2').val($('#address2').val());
		$('#bcity').val($('#city').val());
		$('#bstate').val($('#state').val());
		$('#bpostalcode').val($('#postalcode').val());
		$('#bcountry').val('356');
		$('#bmobile').val($('#mobile').val());
	} else {
		$('#bfirst').val('');
		$('#blast').val('');
		$('#baddress1').val('');
		$('#baddress2').val('');
		$('#bcity').val('');
		$('#bcountry').val('');
		$('#bstate').val('');
		$('#bpostalcode').val('');
		$('#bmobile').val('');
	}
}

function fillStates(bcountry){
	var s = eval('states'+bcountry);
	html = '';
	var statelength = s.length;
	for(var i=1;i < statelength;i++){
		html += '<option value="'+i+'">'+s[i]+'</option>';
	}
	$('#bstate').empty();
	$('#bstate').append(html);
}

$(document).ready(function(){
	$('#bcountry').change(function(){
		var bcountry = $('#bcountry').val();
		fillStates(bcountry);

	});
});
