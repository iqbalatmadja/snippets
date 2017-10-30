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
