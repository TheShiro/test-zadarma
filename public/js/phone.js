function setCurPhone(ctrl) {
	var start = getCaretPos(ctrl);
	var data = ctrl.value;   
	var phone=data.replace(/[^0-9]/g,'').split( /(?=.)/ );
	var i = phone.length-1; 

	if( 0 < i && phone) {
		phone.splice( 0, 0, '(' ); if((data.search(/\(/) == -1) || (data[1]=='(' && start==1)) start++; 
	}

	if( 3 <= i ) {
		phone.splice( 4, 0, ') ' ); 

		if((data.search(/\) /) == -1 && (data.search(/\)/) == -1) && start==5)) start=start+2; if(data[5]==')' && start==4) start++;if(data[5]!=' ' && start==6) start++;
	}

	if( 6 <= i ) {
		phone.splice( 8, 0, '-' ); if((data.search(/-/) == -1 && start==10) || (data[10]=='-' && start==10)) start++; 
	}

	if( 8<= i ) {
		phone.splice( 11, 0, '-' );  var dash = data.match(/-/g); if (dash) var col = dash.length; if(col < 2 && start==13) start++; 
	}

	if( 10 <= i && (phone[1]==7 || phone[1]==8)) {
		phone.splice(1, 1);
		phone.splice(3, 1);
		phone.splice(4, 0, ') ');
		phone.splice(7, 1);
		phone.splice(8, 0, '-');
		phone.splice(10, 1);
		phone.splice(11, 0, '-');
	}

	if( 10 <= i) {
		phone.splice( 14, phone.length - 14);
	}

	str = phone.join( '' );
	var end = start;
	ctrl.value = str;

	if(ctrl.setSelectionRange) {
		ctrl.focus();
		ctrl.setSelectionRange(start, end);
	} else if (ctrl.createTextRange) {
		var range = ctrl.createTextRange();
		range.collapse(true);
		range.moveEnd('character', end);
		range.moveStart('character', start);
		range.select();
	}
}

function getCaretPos(input) {
	if(input.createTextRange) {
		var range = document.selection.createRange.duplicate();
		range.moveStart('character', -input.value.length);
		return range.text.length;
	} else {
		return input.selectionStart;
	}
}