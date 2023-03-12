jQuery(document).ready(function($){
	$('.add-new-education').on('click', function(){
		$('.instructor-education tbody tr').eq(0).clone(true).appendTo('.instructor-education tbody');
		$('.instructor-education tbody tr').eq(1).clone(true).appendTo('.instructor-education tbody');
		$('.instructor-education tbody tr').eq(2).clone(true).appendTo('.instructor-education tbody');
		return false;
	});

	$('.remove-education').on('click', function() {
		var index = $('.instructor-education tbody tr').last().index();
		if ( index > 1 ) {
			$('.instructor-education tbody tr').eq(index).remove();
			$('.instructor-education tbody tr').eq(index - 1).remove();
			$('.instructor-education tbody tr').eq(index - 2).remove();
		}
		return false;
	});

	//
	$('.add-new-experience').on('click', function(){
		$('.instructor-experience tbody tr').eq(0).clone(true).appendTo('.instructor-experience tbody');
		$('.instructor-experience tbody tr').eq(1).clone(true).appendTo('.instructor-experience tbody');
		$('.instructor-experience tbody tr').eq(2).clone(true).appendTo('.instructor-experience tbody');
		return false;
	});

	$('.remove-experience').on('click', function() {
		var index = $('.instructor-experience tbody tr').last().index();
		if ( index > 1 ) {
			$('.instructor-experience tbody tr').eq(index).remove();
			$('.instructor-experience tbody tr').eq(index - 1).remove();
			$('.instructor-experience tbody tr').eq(index - 2).remove();
		}
		return false;
	});
});