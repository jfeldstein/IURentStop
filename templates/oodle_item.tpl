
	<listing>
		<category>Apartments For Rent</category>
		<id>{$item.id}</id>
		<title>{$item.title}</title>
		<url>{$item.link}</url>


		<city>Bloomington</city>
		<country>US</country>
		<state>IN</state>
		<latitude>{$item.lat}</latitude>
		<longitude>{$item.lon}</longitude>

		<amenities>{$item.amenities_list}</amenities>
		<bathrooms>{$item.bathrooms}</bathrooms>
		<bedrooms>{$item.bedrooms}</bedrooms>
		<create_time>{$todays_date}</create_time>
		<currency>USD</currency>

		<description>{$item.description}</description>

		<image_url>{$item.image_link}</image_url>

		<price>{$item.price}</price>
		<price_type>monthly</price_type>
		<registration>no</registration>
		<seller_url>{$item.link}</seller_url>
		<square_feet>{$item.area}</square_feet>
	</listing>
