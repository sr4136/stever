jQuery(function($) {
	var map = new ol.Map({
		target: 'map',
		layers: [
		  new ol.layer.Tile({
			title: "Global Imagery",
			source: new ol.source.TileWMS({
			  url: 'http://maps.opengeo.org/geowebcache/service/wms',
			  params: {LAYERS: 'blue', VERSION: '1.1.1'}
			})
		  }),
		  new ol.layer.Vector({
			  title: 'Cool Places',
			  source: new ol.source.GeoJSON({
				url: '/_misc/new/latest.json'
			  }),
			  style: new ol.style.Style({
				
				image: new ol.style.Circle({
					cursor: "pointer",
					radius: 3,
					fill: new ol.style.Fill({color: 'red'})
				})
			  })
			})
		],
		view: new ol.View({
		  projection: 'EPSG:4326',
		  center: [0, 0],
		  zoom: 1.5,
		  maxResolution: 0.703125
		})
	  });
	  
	var displayFeatureInfo = function(pixel, x, y) {
		
		var feature = map.forEachFeatureAtPixel(pixel, function(feature, layer) {
			return feature;
		});
		if(feature) {
			var info = document.getElementById('info');
			$("#tooltip").html(buildTooltip(feature)).css("top", y+"px").css("left", x+"px").show();
		}else {
			$("#tooltip").fadeOut();
		}
	}
	 
	var buildTooltip = function(feature){
		var retStr = '';
			retStr += '<h3>' + feature.get("name") + '</h3>'
			retStr += '<p>';
				if(feature.get("type")) { retStr += feature.get("type"); }
				if(feature.get("count") && parseInt(feature.get("count")) > 1) { retStr += ': ' + feature.get("count"); }
			retStr += '</p>';
		return retStr;
	}
	  
	$(map.getViewport()).on('mousemove', function(e) {
		var pixel = map.getEventPixel(e.originalEvent);
		var parentOffset = $(this).parent().offset(); 
		var x = e.pageX - parentOffset.left;
		var y = e.pageY - parentOffset.top;

		displayFeatureInfo(pixel, x, y);
	});
});