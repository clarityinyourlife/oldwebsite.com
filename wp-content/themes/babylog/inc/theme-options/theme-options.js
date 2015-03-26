jQuery( document ).ready( function( $ ) {

	var templatedirectory = template.directory;

	$(".description").click ( function() {
		if ( $("#color-blue").is(":checked") )
		{
			color = "blue";
			backgroundcolor = "#86afbf";
		}
		else if ( $("#color-pink").is(":checked") )
		{
			color = "pink";
			backgroundcolor = "#e29393";
		}
		else if ( $("#color-green").is(":checked") )
		{
			color = "green";
			backgroundcolor = "#c2e2bf";
		}
		else
		{
			color = "purple";
			backgroundcolor = "#bfa1c6";
		}

		if ( $("#skin-medium").is(":checked") )
		{
			skin = "medium";
		}
		else if ( $("#skin-dark").is(":checked") )
		{
			skin = "dark";
		}
		else
		{
			skin = "light";
		}

		if ( $( "#hair-black" ).is( ":checked" ) )
		{
			hair = "black";
		}
		else if ( $( "#hair-blonde" ).is( ":checked" ) )
		{
			hair = "blonde";
		}
		else if ( $( "#hair-red" ).is( ":checked" ) )
		{
			hair = "red";
		}
		else
		{
			hair = "brown";
		}

		if ( $("#show-baby-no").is(":checked") )
		{
			$( "#preview-image img" ).hide();
			$( "#preview-image" ).css( "background-color", backgroundcolor );
		}
		else {
			$( "#preview-image img" ).show();
			$( "#preview-image img" ).attr( "src", templatedirectory + color + "-" + skin + "-" + hair + ".png" );
			$( "#preview-image" ).css( "background-color", backgroundcolor );
		}



	});
}
);