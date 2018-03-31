
$(document).ready(function() {

    $('#login').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            id: {
                validators: {
                    notEmpty: {
                        message: 'ID is required'
                    },
                    stringLength: {
                        min: 0,
                        max: 30,
                        message: 'ID must be more than 0 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'ID can only consist of alphabetical, number, dot and underscore'
                    }
                }
            },
            pass: {
                validators: {
                    notEmpty: {
                        message: 'The password is required'
                    },
                }
            },
            category: {
                validators: {
                    notEmpty: {
                        message: 'You must choose a Category'
                    }
                }
            }
        }
    });
});

/**
function formValidation()  
{  
	var userid = document.registration.id;  
	var password = document.registration.pass;   
	var cat = document.registration.category;
	if(id_validation(userid,0,12)){  
		if(pass_validation(password,0,12)){
					if(categoryselect(cat)){
					}
				}
			}
	return false;
}

function id_validation(userid,mx,my)  
{  
	var id_len = userid.value.length;  
	if (id_len == 0 || id_len >= my || id_len < mx){  
		alert("User Id should not be empty / length be between "+mx+" to "+my);  
		userid.focus();  
		return false;  
	}  
	return true;  
}

function pass_validation(password,mx,my)  
{  
	var pass_len = password.value.length;  
	if (pass_len == 0 ||pass_len >= my || pass_len < mx)  
		{  
		alert("Password should not be empty / length be between "+mx+" to "+my);  
		password.focus();  
		return false;  
		}  
	return true;  
}

function categoryselect(cat)  
{  
	if(cat.value == "Default")  
		{  
		alert('Select your category from the list');  
		cat.focus();  
		return false;  
		}  
	else  
		{  
		return true;  
		}  
}
*/
