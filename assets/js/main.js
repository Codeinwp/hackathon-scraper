$( function () {
	console.log( 'Cool!' );

	$.ajax({
		url: "?api=check_list",
		method: 'POST',
		data: query_links,
		dataType: 'json'
	}).done(function( data ) {
		var index = 0
		$('#scraper_table_body tr').each( function() {
			console.log( index );
			console.log( data[index] );
			if( data[index] == true ) {
				$( this ).find( 'td:nth-child(3)' ).html('<b class="has-text-success">Pass</b>');
			} else {
				$( this ).find( 'td:nth-child(3)' ).html('<b class="has-text-danger">Fail</b>');
			}
			index++;
		});
	});
} );

function get_result() {
	var link = $('#check_link').val();
	var slug = $('#check_slug').val();

	console.log( link );
	console.log( slug );

	var post_data = [
		{
			'link': link,
			'slug': slug
		}
	];

	console.log( post_data );

	$.ajax({
		url: "?api=check_url",
		method: 'POST',
		data: JSON.stringify( post_data ),
		dataType: 'json'
	}).done(function( data ) {
		if( data[0] == true ) {
			alert( 'Link is a ' + slug + ' theme!' );
		} else {
			alert( 'Link is NOT a ' + slug + ' theme!' );
		}
	});

	return false;
}