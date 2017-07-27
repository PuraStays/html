	<?php
//session_start();

if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
ini_set('session.cookie_secure', 1);
}

###  THIS FILE CONTAINS ALL POSSIBLE CONFIGURE SETTINGS OF THE SITE
### IN CASE OF SITE UPLOADING PLEASE MAKE THE CHANGES INTO THIS CONFIGURE FILE
### AND ONE CONNECTION FILE(db.inc.php) AVAILABLE INTO INCLUDES FOLDER. JUST CHANGE THE CONNECTION SETTINGS ONLY.
########

$websitename = "apra 07-01-13 modified";
$websitename1 = "apra 07-01-13 modified/hotelaprainn";

######## NUMBER OF RECORDS PER PAGE ######
define("PAGING", 20);
$SANpaging = 12;
$SANShowPageingUrl = 5;
/*$currency = "$";
$InvoiceCONFIG = "";
*/


####### FROM EMAIL AID THAT IS USED IN CASE OF SENDING OUT THE MAIL ###########

$websiteurl="http://localhost:8080/apra 07-01-13 modified/";
$websiteurl1="http://localhost:8080/apra 07-01-13 modified/hotelaprainn/";



// setting up the web root and server root for
// this shopping cart application
$thisFile = str_replace('\\', '/', __FILE__);
$docRoot = $_SERVER['DOCUMENT_ROOT'];

//$GoogleMapKey = "ABQIAAAAnFBD5Aws_58OMAp1EIk57xSxGisdqUQjymhncaxG107MOA5QtRTQlsMvbb31i1OOHJWceVPPX3IKIg";


$Paypalcurrency= "USD";

$sesid = session_id();

######## TABLE DEFINITIONS #######
define("ADMIN", "admin");

//$adminmail="info@anythingedible.com";


########### smtp mail sending details
define("HOST_NAME", "localhost");
define("LOCALHOST", "localhost");
define("SMTP_USER", "");
define("SMTP_PWD", "");

$Type=array(
             '0'  => 'INT',
			 '1'  => 'IN'
			 );


$type = array(
                "0"         => "Normal",
                "1"         => "Contact Form" ,
                "2"         => "Location Map",
			    "3"         => "Careers",
				"4"         => "feedback"
										
                             );

$position = array(
                                        "0"         => "Both",
                                        "1"         => "Header" ,
                                        "2"         => "Footer" 
                             );

$sposition = array(
                                        "0"         => "Both",
                                        "1"         => "Left" ,
                                        "2"         => "Right" 
                             );

/*$country = array(
				""  =>  "Country",
                "Afghanistan"  =>  "Afghanistan",
                "Albania"  =>  "Albania",
                "Algeria"  =>  "Algeria",
                "American Samoa"  =>  "American Samoa",
                "Andorra"  =>  "Andorra",
                "Angola"  =>  "Angola",
                "Anguilla"  =>  "Anguilla",
                "Antarctica"  =>  "Antarctica",
                "Antigua and Barbuda"  =>  "Antigua and Barbuda",
                "Argentina"  =>  "Argentina",
                "Armenia"  =>  "Armenia",
                "Aruba"  =>  "Aruba",
                "Ascension Island"  =>  "Ascension Island",
                "Australia"  =>  "Australia",
                "Austria"  =>  "Austria",
                "Azerbaijan"  =>  "Azerbaijan",
                "Bahamas"  =>  "Bahamas",
                "Bahrain"  =>  "Bahrain",
                "Bangladesh"  =>  "Bangladesh",
                "Barbados"  =>  "Barbados",
                "Belarus"  =>  "Belarus",
                "Belgium"  =>  "Belgium",
                "Belize"  =>  "Belize",
                "Benin"  =>  "Benin",
                "Bermuda"  =>  "Bermuda",
                "Bhutan"  =>  "Bhutan",
                "Bolivia"  =>  "Bolivia",
                "Bosnia and Herzegovina"  =>  "Bosnia and Herzegovina",
                "Botswana"  =>  "Botswana",
                "Bouvet Island"  =>  "Bouvet Island",
                "Brazil"  =>  "Brazil",
                "British Indian Ocean Territory"  =>  "British Indian Ocean Territory",
                "British Virgin Islands"  =>  "British Virgin Islands",
                "Brunei Darussalam"  =>  "Brunei Darussalam",
				"Bulgaria"  =>  "Bulgaria",
				"Burkina Faso"  =>  "Burkina Faso",
				"Burundi"  =>  "Burundi",
				"Cambodia"  =>  "Cambodia",
				"Cameroon"  =>  "Cameroon",
				"Canada"  =>  "Canada","
				Cape Verde"  =>  "Cape Verde",
				"Cayman Islands"  =>  "Cayman Islands",
				"Central African Republic"  =>  "Central African Republic",
				"Chad"  =>  "Chad",
				"Chile"  =>  "Chile",
				"China"  =>  "China",
				"Christmas Island"  =>  "Christmas Island",
				"Cocos (Keeling) Island"  =>  "Cocos (Keeling) Island",
				"Colombia"  =>  "Colombia",
				"Comoros"  =>  "Comoros",
				"Congo"  =>  "Congo",
				"Congo, Republic of"  =>  "Congo, Republic of",
				"Cook Islands"  =>  "Cook Islands",
				"Costa Rica"  =>  "Costa Rica",
				"Cote dIvoire"  =>  "Cote dIvoire",
				"Croatia"  =>  "Croatia",
				"Cuba"  =>  "Cuba",
				"Cyprus"  =>  "Cyprus",
				"Czech Republic"  =>  "Czech Republic",
				"Denmark"  =>  "Denmark",
				"Djibouti"  =>  "Djibouti",
				"Dominica"  =>  "Dominica",
				"Dominican Republic"  =>  "Dominican Republic",
				"Ecuador"  =>  "Ecuador",
				"Egypt"  =>  "Egypt",
				"El Salvador"  =>  "El Salvador",
				"Equatorial Guinea"  =>  "Equatorial Guinea",
				"Eritrea"  =>  "Eritrea",
				"Estonia"  =>  "Estonia",
				"Ethiopia"  =>  "Ethiopia",
				"Falkland Islands"  =>  "Falkland Islands",
				"Faroe Islands"  =>  "Faroe Islands",
				"Fiji"  =>  "Fiji",
				"Finland"  =>  "Finland",
				"France"  =>  "France",
				"French Guiana"  =>  "French Guiana",
				"French Polynesia"  =>  "French Polynesia",
				"Gabon"  =>  "Gabon",
				"Gambia"  =>  "Gambia",
				"Georgia"  =>  "Georgia",
				"Germany"  =>  "Germany",
				"Ghana"  =>  "Ghana",
				"Gibraltar"  =>  "Gibraltar",
				"Greece"  =>  "Greece",
				"Greenland"  =>  "Greenland",
				"Grenada"  =>  "Grenada",
				"Guadeloupe"  =>  "Guadeloupe",
				"Guam"  =>  "Guam",
				"Guatemala"  =>  "Guatemala",
				"Guernsey"  =>  "Guernsey",
				"Guinea"  =>  "Guinea",
				"Guinea-Bissau"  =>  "Guinea-Bissau",
				"Guyana"  =>  "Guyana",
				"Haiti"  =>  "Haiti",
				"Honduras"  =>  "Honduras",
				"Hong Kong"  =>  "Hong Kong",
				"Hungary"  =>  "Hungary",
				"Iceland"  =>  "Iceland",
				"India"  =>  "India",
				"Indonesia"  =>  "Indonesia",
				"Iran"  =>  "Iran",
				"Iraq"  =>  "Iraq",
				"Ireland"  =>  "Ireland",
				"Isle of Man"  =>  "Isle of Man",
				"Israel"  =>  "Israel",
				"Italy"  =>  "Italy",
				"Jamaica"  =>  "Jamaica",
				"Japan"  =>  "Japan",
				"Jersey"  =>  "Jersey",
				"Jordan"  =>  "Jordan",
				"Kazakhstan"  =>  "Kazakhstan",
				"Kenya"  =>  "Kenya",
				"Kiribati"  =>  "Kiribati",
				"Korea, North"  =>  "Korea, North",
				"Korea, South"  =>  "Korea, South",
				"Kuwait"  =>  "Kuwait",
				"Kyrgyzstan"  =>  "Kyrgyzstan",
				"Laos"  =>  "Laos",
				"Latvia"  =>  "Latvia",
				"Lebanon"  =>  "Lebanon",
				"Lesotho"  =>  "Lesotho",
				"Liberia"  =>  "Liberia",
				"Libya"  =>  "Libya",
				"Liechtenstein"  =>  "Liechtenstein",
				"Lithuania"  =>  "Lithuania",
				"Luxembourg"  =>  "Luxembourg",
				"Macau"  =>  "Macau",
				"Macedonia"  =>  "Macedonia",
				"Madagascar"  =>  "Madagascar",
				"Malawi"  =>  "Malawi",
				"Malaysia"  =>  "Malaysia",
				"Maldives"  =>  "Maldives",
				"Mali"  =>  "Mali",
				"Malta"  =>  "Malta",
				"Marshall Islands"  =>  "Marshall Islands",
				"Martinique"  =>  "Martinique",
				"Mauritania"  =>  "Mauritania",
				"Mauritius"  =>  "Mauritius",
				"Mayotte"  =>  "Mayotte",
				"Mexico"  =>  "Mexico",
				"Micronesia"  =>  "Micronesia",
				"Moldova"  =>  "Moldova",
				"Monaco"  =>  "Monaco",
				"Mongolia"  =>  "Mongolia",
				"Montenegro"  =>  "Montenegro",
				"Montserrat"  =>  "Montserrat",
				"Morocco"  =>  "Morocco",
				"Mozambique"  =>  "Mozambique",
				"Myanmar"  =>  "Myanmar",
				"Namibia"  =>  "Namibia",
				"Nauru"  =>  "Nauru",
				"Nepal"  =>  "Nepal",
				"Netherlands"  =>  "Netherlands",
				"Netherlands Antilles"  =>  "Netherlands Antilles",
				"New Caledonia"  =>  "New Caledonia",
				"New Zealand"  =>  "New Zealand",
				"Nicaragua"  =>  "Nicaragua",
				"Niger"  =>  "Niger",
				"Nigeria"  =>  "Nigeria",
				"Niue"  =>  "Niue",
				"Norfolk Island"  =>  "Norfolk Island",
				"Northern Mariana Islands"  =>  "Northern Mariana Islands",
				"Norway"  =>  "Norway",
				"Oman"  =>  "Oman",
				"Pakistan"  =>  "Pakistan",
				"Palau"  =>  "Palau",
				"Palestinian Territory"  =>  "Palestinian Territory",
				"Panama"  =>  "Panama",
				"Papua New Guinea"  =>  "Papua New Guinea",
				"Paraguay"  =>  "Paraguay",
				"Peru"  =>  "Peru",
				"Philippines"  =>  "Philippines",
				"Pitcairn Island"  =>  "Pitcairn Island",
				"Poland"  =>  "Poland",
				"Portugal"  =>  "Portugal",
				"Puerto Rico"  =>  "Puerto Rico",
				"Qatar"  =>  "Qatar",
				"Reunion"  =>  "Reunion",
				"Romania"  =>  "Romania",
				"Russia"  =>  "Russia",
				"Rwanda"  =>  "Rwanda",
				"Saint Helena"  =>  "Saint Helena",
				"Saint Kitts and Nevis"  =>  "Saint Kitts and Nevis",
				"Saint Lucia"  =>  "Saint Lucia",
				"Saint Pierre and Miquelon"  =>  "Saint Pierre and Miquelon",
				"Samoa"  =>  "Samoa",
				"San Marino"  =>  "San Marino",
				"Sao Tome and Principe"  =>  "Sao Tome and Principe",
				"Saudia Arabia"  =>  "Saudia Arabia",
				"Senegal"  =>  "Senegal",
				"Serbia"  =>  "Serbia",
				"Seychelles"  =>  "Seychelles",
				"Sierra Leone"  =>  "Sierra Leone",
				"Singapore"  =>  "Singapore",
				"Slovakia"  =>  "Slovakia",
				"Slovenia"  =>  "Slovenia",
				"Solomon Islands"  =>  "Solomon Islands",
				"Somalia"  =>  "Somalia",
				"South Africa"  =>  "South Africa",
				"Spain"  =>  "Spain",
				"Sri Lanka"  =>  "Sri Lanka",
				"Sudan"  =>  "Sudan",
				"Suriname"  =>  "Suriname",
				"Swaziland"  =>  "Swaziland",
				"Sweden"  =>  "Sweden",
				"Switzerland"  =>  "Switzerland",
				"Syria"  =>  "Syria",
				"Taiwan"  =>  "Taiwan",
				"Tajikistan"  =>  "Tajikistan",
				"Tanzania"  =>  "Tanzania",
				"Thailand"  =>  "Thailand",
				"Timor-Leste"  =>  "Timor-Leste",
				"Togo"  =>  "Togo",
				"Tokelau"  =>  "Tokelau",
				"Tonga"  =>  "Tonga",
				"Trinidad and Tobago"  =>  "Trinidad and Tobago",
				"Tunisia"  =>  "Tunisia",
				"Turkey"  =>  "Turkey",
				"Turkmenistan"  =>  "Turkmenistan",
				"Turks and Caicos Islands"  =>  "Turks and Caicos Islands",
				"Tuvalu"  =>  "Tuvalu",
				"Uganda"  =>  "Uganda",
				"Ukraine"  =>  "Ukraine",
				"United Arab Emirates"  =>  "United Arab Emirates",
				"United Kingdom"  =>  "United Kingdom",
				"United States"  =>  "United States",
				"United States Virgin Islands"  =>  "United States Virgin Islands",
				"Uruguay"  =>  "Uruguay",
				"US Minor Outlying Islands"  =>  "US Minor Outlying Islands",
				"USSR"  =>  "USSR",
				"Uzbekistan"  =>  "Uzbekistan",
				"Vanuatu"  =>  "Vanuatu",
				"Vatican City State"  =>  "Vatican City State",
				"Venezuela"  =>  "Venezuela",
				"Vietnam"  =>  "Vietnam",
				"Wallis and Futuna Islands"  =>  "Wallis and Futuna Islands",
				"Western Sahara"  =>  "Western Sahara",
				"Yemen"  =>  "Yemen",
				"Yugoslavia"  =>  "Yugoslavia",
				"Zambia"  =>  "Zambia",
				"Zimbabwe"  =>  "Zimbabwe"

				);	*/						 

###### used to avoid the error
error_reporting(1);

########## new

?>
