utils.define('formattypes', function(formattypes) {
	
	var format = utils.require('utils.format');
	var EMAIL_REGEX = /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/;
	var USERNAME_REGEX = /^(?=.*\d+)(?=.*[a-z])[0-9a-z]{6,}$/;
	var NAME_REGEX = /^(?=.*[a-z\ ])[a-z\ ]{6,}$/;
	
	format.set('number',function(i,o){
		o.isValid = (!isNaN(i.iVal-0) && typeof(i.iVal-0)=='number');
	});
	
	format.set('username',function(i,o){
		o.isValid = USERNAME_REGEX.test((i.iVal).toLowerCase().trim());
	});
	format.set('name',function(i,o){
		o.isValid = NAME_REGEX.test((i.iVal).toLowerCase().trim());
	});
	format.set('email',function(i,o){
		if(i.iVal=="" && i.iVal==undefined){
			o.isValid = true;
		} else {
			o.isValid = EMAIL_REGEX.test(i.iVal)
		}
	});
	var date = utils.require('utils.date');
	format.set('date',function(i,o){
		if(i.iVal=="" && i.iVal==undefined){
			o.isValid = true;
		} else {
			var d = date.getDateObject(i.iVal);
			o.isValid = d.isValid;
			if(o.isValid){
				o.dVal = d.display;
			} else {
				o.dVal = i.iVal;
			}
		}
	});
	
});