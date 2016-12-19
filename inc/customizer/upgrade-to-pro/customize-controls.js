( function( api ) {

	// Extends our custom "photo-fusion" section.
	api.sectionConstructor['photo-fusion'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
