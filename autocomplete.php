<!-- Using jQuery with a CDN -->
<script src="js/jquery-3.2.1.min.js"></script>
<!-- JS file -->
<script src="EasyAutocomplete-1.3.5/jquery.easy-autocomplete.min.js"></script> 

<!-- CSS file -->
<link rel="stylesheet" href="EasyAutocomplete-1.3.5/easy-autocomplete.min.css"> 

<!-- Additional CSS Themes file - not required-->
<link rel="stylesheet" href="EasyAutocomplete-1.3.5/easy-autocomplete.themes.min.css"> 

<input id="basics" /> Basic
<script>
var options = {
    data: ["blue", "green", "pink", "red", "yellow"]
};

$("#basics").easyAutocomplete(options);
</script>

<hr/>
<input id="provider-file" /> File Source
<script>
var options = {
    url: "resources/colors.js"
};

$("#provider-file").easyAutocomplete(options);
</script>

<hr/>
<input id="provider-json" /> JSON Source
<script>
var options = {
    url: "resources/countries.json",
    theme: "yellow", // dark,blue,purple,yellow,blue-light,green-light,bootstrap
    getValue: function(element) {
	return element.name;
    },
    // or getValue: "name",
    list: {
            match: {
                    enabled: true
            }
    }
};

$("#provider-json").easyAutocomplete(options);
</script>
<hr/>
<input id="provider-xml" /> XML Source
<script>
var options = {
	url: "resources/countries.xml",

	dataType: "xml",
	xmlElementName: "country",

	getValue: function(element) {
		return $(element).find("name").text();
	},

	list: {
		match: {
			enabled: true
		}
	}
};

$("#provider-xml").easyAutocomplete(options);
</script>
<hr/>
<input id="template-desc" /> Template "description"
<script>
var options = {
	data: [ {name: "Avionet", type: "air", icon: "http://lorempixel.com/100/50/transport/2"},
		{name: "Car", type: "ground", icon: "http://lorempixel.com/100/50/transport/8"},
		{name: "Motorbike", type: "ground", icon: "http://lorempixel.com/100/50/transport/10"},
		{name: "Plane", type: "air", icon: "http://lorempixel.com/100/50/transport/1"},
		{name: "Train", type: "ground", icon: "http://lorempixel.com/100/50/transport/6"}],

	getValue: "name",

	template: {
		type: "description",
		fields: {
			description: "type"
		}
	}
};

$("#template-desc").easyAutocomplete(options);
</script>
<hr/>
<input id="template-icon-left" /> Template icon-left
<script>
var options = {
	data: [ {name: "Avionet", type: "air", icon: "http://lorempixel.com/100/50/transport/2"},
		{name: "Car", type: "ground", icon: "http://lorempixel.com/100/50/transport/8"},
		{name: "Motorbike", type: "ground", icon: "http://lorempixel.com/100/50/transport/10"},
		{name: "Plane", type: "air", icon: "http://lorempixel.com/100/50/transport/1"},
		{name: "Train", type: "ground", icon: "http://lorempixel.com/100/50/transport/6"}],

	getValue: "name",

	template: {
		type: "iconLeft",
		fields: {
			iconSrc: "icon"
		}
	}
};

$("#template-icon-left").easyAutocomplete(options);
</script>
<hr/>
<input id="template-icon-right" /> Template icon-right
<script>
var options = {
	data: [ {name: "Avionet", type: "air", icon: "http://lorempixel.com/100/50/transport/2"},
		{name: "Car", type: "ground", icon: "http://lorempixel.com/100/50/transport/8"},
		{name: "Motorbike", type: "ground", icon: "http://lorempixel.com/100/50/transport/10"},
		{name: "Plain", type: "air", icon: "http://lorempixel.com/100/50/transport/1"},
		{name: "Train", type: "ground", icon: "http://lorempixel.com/100/50/transport/6"}],


	getValue: "name",

	template: {
		type: "iconRight",
		fields: {
			iconSrc: "icon"
		}
	}
};

$("#template-icon-right").easyAutocomplete(options);
</script>

