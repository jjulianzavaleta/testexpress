<?php
function sanzo_get_list_family_fonts(){
	$fonts = array(
					"Arial" => "Arial"
					,"Advent Pro" => "Advent Pro"
					,"Verdana" => "Verdana, Geneva"
					,"Trebuchet" => "Trebuchet"
					,"Georgia" => "Georgia"
					,"Times New Roman" => "Times New Roman"
					,"Tahoma, Geneva" => "Tahoma, Geneva"
					,"Palatino" => "Palatino"
					,"Helvetica" => "Helvetica"
					,"CustomFont" => "Custom Font"
				);
	return apply_filters('sanzo_list_family_fonts', $fonts);
}

function sanzo_get_list_google_fonts(){
	$fonts = array(
					"ABeeZee" => "ABeeZee"
					,"Abel" => "Abel"
					,"Abhaya Libre" => "Abhaya Libre"
					,"Abril Fatface" => "Abril Fatface"
					,"Aclonica" => "Aclonica"
					,"Acme" => "Acme"
					,"Actor" => "Actor"
					,"Adamina" => "Adamina"
					,"Advent Pro" => "Advent Pro"
					,"Aguafina Script" => "Aguafina Script"
					,"Akronim" => "Akronim"
					,"Aladin" => "Aladin"
					,"Aldrich" => "Aldrich"
					,"Alef" => "Alef"
					,"Alegreya" => "Alegreya"
					,"Alegreya SC" => "Alegreya SC"
					,"Alegreya Sans" => "Alegreya Sans"
					,"Alegreya Sans SC" => "Alegreya Sans SC"
					,"Aleo" => "Aleo"
					,"Alex Brush" => "Alex Brush"
					,"Alfa Slab One" => "Alfa Slab One"
					,"Alice" => "Alice"
					,"Alike" => "Alike"
					,"Alike Angular" => "Alike Angular"
					,"Allan" => "Allan"
					,"Allerta" => "Allerta"
					,"Allerta Stencil" => "Allerta Stencil"
					,"Allura" => "Allura"
					,"Almendra" => "Almendra"
					,"Almendra Display" => "Almendra Display"
					,"Almendra SC" => "Almendra SC"
					,"Amarante" => "Amarante"
					,"Amaranth" => "Amaranth"
					,"Amatic SC" => "Amatic SC"
					,"Amethysta" => "Amethysta"
					,"Amiko" => "Amiko"
					,"Amiri" => "Amiri"
					,"Amita" => "Amita"
					,"Anaheim" => "Anaheim"
					,"Andada" => "Andada"
					,"Andika" => "Andika"
					,"Angkor" => "Angkor"
					,"Annie Use Your Telescope" => "Annie Use Your Telescope"
					,"Anonymous Pro" => "Anonymous Pro"
					,"Antic" => "Antic"
					,"Antic Didone" => "Antic Didone"
					,"Antic Slab" => "Antic Slab"
					,"Anton" => "Anton"
					,"Arapey" => "Arapey"
					,"Arbutus" => "Arbutus"
					,"Arbutus Slab" => "Arbutus Slab"
					,"Architects Daughter" => "Architects Daughter"
					,"Archivo" => "Archivo"
					,"Archivo Black" => "Archivo Black"
					,"Archivo Narrow" => "Archivo Narrow"
					,"Aref Ruqaa" => "Aref Ruqaa"
					,"Arima Madurai" => "Arima Madurai"
					,"Arimo" => "Arimo"
					,"Arizonia" => "Arizonia"
					,"Armata" => "Armata"
					,"Arsenal" => "Arsenal"
					,"Artifika" => "Artifika"
					,"Arvo" => "Arvo"
					,"Arya" => "Arya"
					,"Asap" => "Asap"
					,"Asap Condensed" => "Asap Condensed"
					,"Asar" => "Asar"
					,"Asset" => "Asset"
					,"Assistant" => "Assistant"
					,"Astloch" => "Astloch"
					,"Asul" => "Asul"
					,"Athiti" => "Athiti"
					,"Atma" => "Atma"
					,"Atomic Age" => "Atomic Age"
					,"Aubrey" => "Aubrey"
					,"Audiowide" => "Audiowide"
					,"Autour One" => "Autour One"
					,"Average" => "Average"
					,"Average Sans" => "Average Sans"
					,"Averia Gruesa Libre" => "Averia Gruesa Libre"
					,"Averia Libre" => "Averia Libre"
					,"Averia Sans Libre" => "Averia Sans Libre"
					,"Averia Serif Libre" => "Averia Serif Libre"
					,"B612" => "B612"
					,"B612 Mono" => "B612 Mono"
					,"Bad Script" => "Bad Script"
					,"Bahiana" => "Bahiana"
					,"Bai Jamjuree" => "Bai Jamjuree"
					,"Baloo" => "Baloo"
					,"Baloo Bhai" => "Baloo Bhai"
					,"Baloo Bhaijaan" => "Baloo Bhaijaan"
					,"Baloo Bhaina" => "Baloo Bhaina"
					,"Baloo Chettan" => "Baloo Chettan"
					,"Baloo Da" => "Baloo Da"
					,"Baloo Paaji" => "Baloo Paaji"
					,"Baloo Tamma" => "Baloo Tamma"
					,"Baloo Tammudu" => "Baloo Tammudu"
					,"Baloo Thambi" => "Baloo Thambi"
					,"Balthazar" => "Balthazar"
					,"Bangers" => "Bangers"
					,"Barlow" => "Barlow"
					,"Barlow Condensed" => "Barlow Condensed"
					,"Barlow Semi Condensed" => "Barlow Semi Condensed"
					,"Barrio" => "Barrio"
					,"Basic" => "Basic"
					,"Battambang" => "Battambang"
					,"Baumans" => "Baumans"
					,"Bayon" => "Bayon"
					,"Belgrano" => "Belgrano"
					,"Bellefair" => "Bellefair"
					,"Belleza" => "Belleza"
					,"BenchNine" => "BenchNine"
					,"Bentham" => "Bentham"
					,"Berkshire Swash" => "Berkshire Swash"
					,"Bevan" => "Bevan"
					,"Bigelow Rules" => "Bigelow Rules"
					,"Bigshot One" => "Bigshot One"
					,"Bilbo" => "Bilbo"
					,"Bilbo Swash Caps" => "Bilbo Swash Caps"
					,"BioRhyme" => "BioRhyme"
					,"BioRhyme Expanded" => "BioRhyme Expanded"
					,"Biryani" => "Biryani"
					,"Bitter" => "Bitter"
					,"Black And White Picture" => "Black And White Picture"
					,"Black Han Sans" => "Black Han Sans"
					,"Black Ops One" => "Black Ops One"
					,"Bokor" => "Bokor"
					,"Bonbon" => "Bonbon"
					,"Boogaloo" => "Boogaloo"
					,"Bowlby One" => "Bowlby One"
					,"Bowlby One SC" => "Bowlby One SC"
					,"Brawler" => "Brawler"
					,"Bree Serif" => "Bree Serif"
					,"Bubblegum Sans" => "Bubblegum Sans"
					,"Bubbler One" => "Bubbler One"
					,"Buda" => "Buda"
					,"Buenard" => "Buenard"
					,"Bungee" => "Bungee"
					,"Bungee Hairline" => "Bungee Hairline"
					,"Bungee Inline" => "Bungee Inline"
					,"Bungee Outline" => "Bungee Outline"
					,"Bungee Shade" => "Bungee Shade"
					,"Butcherman" => "Butcherman"
					,"Butterfly Kids" => "Butterfly Kids"
					,"Cabin" => "Cabin"
					,"Cabin Condensed" => "Cabin Condensed"
					,"Cabin Sketch" => "Cabin Sketch"
					,"Caesar Dressing" => "Caesar Dressing"
					,"Cagliostro" => "Cagliostro"
					,"Cairo" => "Cairo"
					,"Calligraffitti" => "Calligraffitti"
					,"Cambay" => "Cambay"
					,"Cambo" => "Cambo"
					,"Candal" => "Candal"
					,"Cantarell" => "Cantarell"
					,"Cantata One" => "Cantata One"
					,"Cantora One" => "Cantora One"
					,"Capriola" => "Capriola"
					,"Cardo" => "Cardo"
					,"Carme" => "Carme"
					,"Carrois Gothic" => "Carrois Gothic"
					,"Carrois Gothic SC" => "Carrois Gothic SC"
					,"Carter One" => "Carter One"
					,"Catamaran" => "Catamaran"
					,"Caudex" => "Caudex"
					,"Caveat" => "Caveat"
					,"Caveat Brush" => "Caveat Brush"
					,"Cedarville Cursive" => "Cedarville Cursive"
					,"Ceviche One" => "Ceviche One"
					,"Chakra Petch" => "Chakra Petch"
					,"Changa" => "Changa"
					,"Changa One" => "Changa One"
					,"Chango" => "Chango"
					,"Charm" => "Charm"
					,"Charmonman" => "Charmonman"
					,"Chathura" => "Chathura"
					,"Chau Philomene One" => "Chau Philomene One"
					,"Chela One" => "Chela One"
					,"Chelsea Market" => "Chelsea Market"
					,"Chenla" => "Chenla"
					,"Cherry Cream Soda" => "Cherry Cream Soda"
					,"Cherry Swash" => "Cherry Swash"
					,"Chewy" => "Chewy"
					,"Chicle" => "Chicle"
					,"Chivo" => "Chivo"
					,"Chonburi" => "Chonburi"
					,"Cinzel" => "Cinzel"
					,"Cinzel Decorative" => "Cinzel Decorative"
					,"Clicker Script" => "Clicker Script"
					,"Coda" => "Coda"
					,"Coda Caption" => "Coda Caption"
					,"Codystar" => "Codystar"
					,"Coiny" => "Coiny"
					,"Combo" => "Combo"
					,"Comfortaa" => "Comfortaa"
					,"Coming Soon" => "Coming Soon"
					,"Concert One" => "Concert One"
					,"Condiment" => "Condiment"
					,"Content" => "Content"
					,"Contrail One" => "Contrail One"
					,"Convergence" => "Convergence"
					,"Cookie" => "Cookie"
					,"Copse" => "Copse"
					,"Corben" => "Corben"
					,"Cormorant" => "Cormorant"
					,"Cormorant Garamond" => "Cormorant Garamond"
					,"Cormorant Infant" => "Cormorant Infant"
					,"Cormorant SC" => "Cormorant SC"
					,"Cormorant Unicase" => "Cormorant Unicase"
					,"Cormorant Upright" => "Cormorant Upright"
					,"Courgette" => "Courgette"
					,"Cousine" => "Cousine"
					,"Coustard" => "Coustard"
					,"Covered By Your Grace" => "Covered By Your Grace"
					,"Crafty Girls" => "Crafty Girls"
					,"Creepster" => "Creepster"
					,"Crete Round" => "Crete Round"
					,"Crimson Text" => "Crimson Text"
					,"Croissant One" => "Croissant One"
					,"Crushed" => "Crushed"
					,"Cuprum" => "Cuprum"
					,"Cute Font" => "Cute Font"
					,"Cutive" => "Cutive"
					,"Cutive Mono" => "Cutive Mono"
					,"Damion" => "Damion"
					,"Dancing Script" => "Dancing Script"
					,"Dangrek" => "Dangrek"
					,"David Libre" => "David Libre"
					,"Dawning of a New Day" => "Dawning of a New Day"
					,"Days One" => "Days One"
					,"Dekko" => "Dekko"
					,"Delius" => "Delius"
					,"Delius Swash Caps" => "Delius Swash Caps"
					,"Delius Unicase" => "Delius Unicase"
					,"Della Respira" => "Della Respira"
					,"Denk One" => "Denk One"
					,"Devonshire" => "Devonshire"
					,"Dhurjati" => "Dhurjati"
					,"Didact Gothic" => "Didact Gothic"
					,"Diplomata" => "Diplomata"
					,"Diplomata SC" => "Diplomata SC"
					,"Do Hyeon" => "Do Hyeon"
					,"Dokdo" => "Dokdo"
					,"Domine" => "Domine"
					,"Donegal One" => "Donegal One"
					,"Doppio One" => "Doppio One"
					,"Dorsa" => "Dorsa"
					,"Dosis" => "Dosis"
					,"Dr Sugiyama" => "Dr Sugiyama"
					,"Duru Sans" => "Duru Sans"
					,"Dynalight" => "Dynalight"
					,"EB Garamond" => "EB Garamond"
					,"Eagle Lake" => "Eagle Lake"
					,"East Sea Dokdo" => "East Sea Dokdo"
					,"Eater" => "Eater"
					,"Economica" => "Economica"
					,"Eczar" => "Eczar"
					,"El Messiri" => "El Messiri"
					,"Electrolize" => "Electrolize"
					,"Elsie" => "Elsie"
					,"Elsie Swash Caps" => "Elsie Swash Caps"
					,"Emblema One" => "Emblema One"
					,"Emilys Candy" => "Emilys Candy"
					,"Encode Sans" => "Encode Sans"
					,"Encode Sans Condensed" => "Encode Sans Condensed"
					,"Encode Sans Expanded" => "Encode Sans Expanded"
					,"Encode Sans Semi Condensed" => "Encode Sans Semi Condensed"
					,"Encode Sans Semi Expanded" => "Encode Sans Semi Expanded"
					,"Engagement" => "Engagement"
					,"Englebert" => "Englebert"
					,"Enriqueta" => "Enriqueta"
					,"Erica One" => "Erica One"
					,"Esteban" => "Esteban"
					,"Euphoria Script" => "Euphoria Script"
					,"Ewert" => "Ewert"
					,"Exo" => "Exo"
					,"Exo 2" => "Exo 2"
					,"Expletus Sans" => "Expletus Sans"
					,"Fahkwang" => "Fahkwang"
					,"Fanwood Text" => "Fanwood Text"
					,"Farsan" => "Farsan"
					,"Fascinate" => "Fascinate"
					,"Fascinate Inline" => "Fascinate Inline"
					,"Faster One" => "Faster One"
					,"Fasthand" => "Fasthand"
					,"Fauna One" => "Fauna One"
					,"Faustina" => "Faustina"
					,"Federant" => "Federant"
					,"Federo" => "Federo"
					,"Felipa" => "Felipa"
					,"Fenix" => "Fenix"
					,"Finger Paint" => "Finger Paint"
					,"Fira Mono" => "Fira Mono"
					,"Fira Sans" => "Fira Sans"
					,"Fira Sans Condensed" => "Fira Sans Condensed"
					,"Fira Sans Extra Condensed" => "Fira Sans Extra Condensed"
					,"Fjalla One" => "Fjalla One"
					,"Fjord One" => "Fjord One"
					,"Flamenco" => "Flamenco"
					,"Flavors" => "Flavors"
					,"Fondamento" => "Fondamento"
					,"Fontdiner Swanky" => "Fontdiner Swanky"
					,"Forum" => "Forum"
					,"Francois One" => "Francois One"
					,"Frank Ruhl Libre" => "Frank Ruhl Libre"
					,"Freckle Face" => "Freckle Face"
					,"Fredericka the Great" => "Fredericka the Great"
					,"Fredoka One" => "Fredoka One"
					,"Freehand" => "Freehand"
					,"Fresca" => "Fresca"
					,"Frijole" => "Frijole"
					,"Fruktur" => "Fruktur"
					,"Fugaz One" => "Fugaz One"
					,"GFS Didot" => "GFS Didot"
					,"GFS Neohellenic" => "GFS Neohellenic"
					,"Gabriela" => "Gabriela"
					,"Gaegu" => "Gaegu"
					,"Gafata" => "Gafata"
					,"Galada" => "Galada"
					,"Galdeano" => "Galdeano"
					,"Galindo" => "Galindo"
					,"Gamja Flower" => "Gamja Flower"
					,"Gentium Basic" => "Gentium Basic"
					,"Gentium Book Basic" => "Gentium Book Basic"
					,"Geo" => "Geo"
					,"Geostar" => "Geostar"
					,"Geostar Fill" => "Geostar Fill"
					,"Germania One" => "Germania One"
					,"Gidugu" => "Gidugu"
					,"Gilda Display" => "Gilda Display"
					,"Give You Glory" => "Give You Glory"
					,"Glass Antiqua" => "Glass Antiqua"
					,"Glegoo" => "Glegoo"
					,"Gloria Hallelujah" => "Gloria Hallelujah"
					,"Goblin One" => "Goblin One"
					,"Gochi Hand" => "Gochi Hand"
					,"Gorditas" => "Gorditas"
					,"Gothic A1" => "Gothic A1"
					,"Goudy Bookletter 1911" => "Goudy Bookletter 1911"
					,"Graduate" => "Graduate"
					,"Grand Hotel" => "Grand Hotel"
					,"Gravitas One" => "Gravitas One"
					,"Great Vibes" => "Great Vibes"
					,"Griffy" => "Griffy"
					,"Gruppo" => "Gruppo"
					,"Gudea" => "Gudea"
					,"Gugi" => "Gugi"
					,"Gurajada" => "Gurajada"
					,"Habibi" => "Habibi"
					,"Halant" => "Halant"
					,"Hammersmith One" => "Hammersmith One"
					,"Hanalei" => "Hanalei"
					,"Hanalei Fill" => "Hanalei Fill"
					,"Handlee" => "Handlee"
					,"Hanuman" => "Hanuman"
					,"Happy Monkey" => "Happy Monkey"
					,"Harmattan" => "Harmattan"
					,"Headland One" => "Headland One"
					,"Heebo" => "Heebo"
					,"Henny Penny" => "Henny Penny"
					,"Herr Von Muellerhoff" => "Herr Von Muellerhoff"
					,"Hi Melody" => "Hi Melody"
					,"Hind" => "Hind"
					,"Hind Guntur" => "Hind Guntur"
					,"Hind Madurai" => "Hind Madurai"
					,"Hind Siliguri" => "Hind Siliguri"
					,"Hind Vadodara" => "Hind Vadodara"
					,"Holtwood One SC" => "Holtwood One SC"
					,"Homemade Apple" => "Homemade Apple"
					,"Homenaje" => "Homenaje"
					,"IBM Plex Mono" => "IBM Plex Mono"
					,"IBM Plex Sans" => "IBM Plex Sans"
					,"IBM Plex Sans Condensed" => "IBM Plex Sans Condensed"
					,"IBM Plex Serif" => "IBM Plex Serif"
					,"IM Fell DW Pica" => "IM Fell DW Pica"
					,"IM Fell DW Pica SC" => "IM Fell DW Pica SC"
					,"IM Fell Double Pica" => "IM Fell Double Pica"
					,"IM Fell Double Pica SC" => "IM Fell Double Pica SC"
					,"IM Fell English" => "IM Fell English"
					,"IM Fell English SC" => "IM Fell English SC"
					,"IM Fell French Canon" => "IM Fell French Canon"
					,"IM Fell French Canon SC" => "IM Fell French Canon SC"
					,"IM Fell Great Primer" => "IM Fell Great Primer"
					,"IM Fell Great Primer SC" => "IM Fell Great Primer SC"
					,"Iceberg" => "Iceberg"
					,"Iceland" => "Iceland"
					,"Imprima" => "Imprima"
					,"Inconsolata" => "Inconsolata"
					,"Inder" => "Inder"
					,"Indie Flower" => "Indie Flower"
					,"Inika" => "Inika"
					,"Inknut Antiqua" => "Inknut Antiqua"
					,"Irish Grover" => "Irish Grover"
					,"Istok Web" => "Istok Web"
					,"Italiana" => "Italiana"
					,"Italianno" => "Italianno"
					,"Itim" => "Itim"
					,"Jacques Francois" => "Jacques Francois"
					,"Jacques Francois Shadow" => "Jacques Francois Shadow"
					,"Jaldi" => "Jaldi"
					,"Jim Nightshade" => "Jim Nightshade"
					,"Jockey One" => "Jockey One"
					,"Jolly Lodger" => "Jolly Lodger"
					,"Jomhuria" => "Jomhuria"
					,"Josefin Sans" => "Josefin Sans"
					,"Josefin Slab" => "Josefin Slab"
					,"Joti One" => "Joti One"
					,"Jua" => "Jua"
					,"Judson" => "Judson"
					,"Julee" => "Julee"
					,"Julius Sans One" => "Julius Sans One"
					,"Junge" => "Junge"
					,"Jura" => "Jura"
					,"Just Another Hand" => "Just Another Hand"
					,"Just Me Again Down Here" => "Just Me Again Down Here"
					,"K2D" => "K2D"
					,"Kadwa" => "Kadwa"
					,"Kalam" => "Kalam"
					,"Kameron" => "Kameron"
					,"Kanit" => "Kanit"
					,"Kantumruy" => "Kantumruy"
					,"Karla" => "Karla"
					,"Karma" => "Karma"
					,"Katibeh" => "Katibeh"
					,"Kaushan Script" => "Kaushan Script"
					,"Kavivanar" => "Kavivanar"
					,"Kavoon" => "Kavoon"
					,"Kdam Thmor" => "Kdam Thmor"
					,"Keania One" => "Keania One"
					,"Kelly Slab" => "Kelly Slab"
					,"Kenia" => "Kenia"
					,"Khand" => "Khand"
					,"Khmer" => "Khmer"
					,"Khula" => "Khula"
					,"Kirang Haerang" => "Kirang Haerang"
					,"Kite One" => "Kite One"
					,"Knewave" => "Knewave"
					,"KoHo" => "KoHo"
					,"Kodchasan" => "Kodchasan"
					,"Kosugi" => "Kosugi"
					,"Kosugi Maru" => "Kosugi Maru"
					,"Kotta One" => "Kotta One"
					,"Koulen" => "Koulen"
					,"Kranky" => "Kranky"
					,"Kreon" => "Kreon"
					,"Kristi" => "Kristi"
					,"Krona One" => "Krona One"
					,"Krub" => "Krub"
					,"Kumar One" => "Kumar One"
					,"Kumar One Outline" => "Kumar One Outline"
					,"Kurale" => "Kurale"
					,"La Belle Aurore" => "La Belle Aurore"
					,"Laila" => "Laila"
					,"Lakki Reddy" => "Lakki Reddy"
					,"Lalezar" => "Lalezar"
					,"Lancelot" => "Lancelot"
					,"Lateef" => "Lateef"
					,"Lato" => "Lato"
					,"League Script" => "League Script"
					,"Leckerli One" => "Leckerli One"
					,"Ledger" => "Ledger"
					,"Lekton" => "Lekton"
					,"Lemon" => "Lemon"
					,"Lemonada" => "Lemonada"
					,"Libre Barcode 39" => "Libre Barcode 39"
					,"Libre Barcode 39 Extended" => "Libre Barcode 39 Extended"
					,"Libre Barcode 39 Extended Text" => "Libre Barcode 39 Extended Text"
					,"Libre Barcode 39 Text" => "Libre Barcode 39 Text"
					,"Libre Barcode 128" => "Libre Barcode 128"
					,"Libre Barcode 128 Text" => "Libre Barcode 128 Text"
					,"Libre Baskerville" => "Libre Baskerville"
					,"Libre Franklin" => "Libre Franklin"
					,"Life Savers" => "Life Savers"
					,"Lilita One" => "Lilita One"
					,"Lily Script One" => "Lily Script One"
					,"Limelight" => "Limelight"
					,"Linden Hill" => "Linden Hill"
					,"Lobster" => "Lobster"
					,"Lobster Two" => "Lobster Two"
					,"Londrina Outline" => "Londrina Outline"
					,"Londrina Shadow" => "Londrina Shadow"
					,"Londrina Sketch" => "Londrina Sketch"
					,"Londrina Solid" => "Londrina Solid"
					,"Lora" => "Lora"
					,"Love Ya Like A Sister" => "Love Ya Like A Sister"
					,"Loved by the King" => "Loved by the King"
					,"Lovers Quarrel" => "Lovers Quarrel"
					,"Luckiest Guy" => "Luckiest Guy"
					,"Lusitana" => "Lusitana"
					,"Lustria" => "Lustria"
					,"M PLUS 1p" => "M PLUS 1p"
					,"M PLUS Rounded 1c" => "M PLUS Rounded 1c"
					,"Macondo" => "Macondo"
					,"Macondo Swash Caps" => "Macondo Swash Caps"
					,"Mada" => "Mada"
					,"Magra" => "Magra"
					,"Maiden Orange" => "Maiden Orange"
					,"Maitree" => "Maitree"
					,"Major Mono Display" => "Major Mono Display"
					,"Mako" => "Mako"
					,"Mali" => "Mali"
					,"Mallanna" => "Mallanna"
					,"Mandali" => "Mandali"
					,"Manuale" => "Manuale"
					,"Marcellus" => "Marcellus"
					,"Marcellus SC" => "Marcellus SC"
					,"Marck Script" => "Marck Script"
					,"Margarine" => "Margarine"
					,"Markazi Text" => "Markazi Text"
					,"Marko One" => "Marko One"
					,"Marmelad" => "Marmelad"
					,"Martel" => "Martel"
					,"Martel Sans" => "Martel Sans"
					,"Marvel" => "Marvel"
					,"Mate" => "Mate"
					,"Mate SC" => "Mate SC"
					,"Maven Pro" => "Maven Pro"
					,"McLaren" => "McLaren"
					,"Meddon" => "Meddon"
					,"MedievalSharp" => "MedievalSharp"
					,"Medula One" => "Medula One"
					,"Meera Inimai" => "Meera Inimai"
					,"Megrim" => "Megrim"
					,"Meie Script" => "Meie Script"
					,"Merienda" => "Merienda"
					,"Merienda One" => "Merienda One"
					,"Merriweather" => "Merriweather"
					,"Merriweather Sans" => "Merriweather Sans"
					,"Metal" => "Metal"
					,"Metal Mania" => "Metal Mania"
					,"Metamorphous" => "Metamorphous"
					,"Metrophobic" => "Metrophobic"
					,"Michroma" => "Michroma"
					,"Milonga" => "Milonga"
					,"Miltonian" => "Miltonian"
					,"Miltonian Tattoo" => "Miltonian Tattoo"
					,"Mina" => "Mina"
					,"Miniver" => "Miniver"
					,"Miriam Libre" => "Miriam Libre"
					,"Mirza" => "Mirza"
					,"Miss Fajardose" => "Miss Fajardose"
					,"Mitr" => "Mitr"
					,"Modak" => "Modak"
					,"Modern Antiqua" => "Modern Antiqua"
					,"Mogra" => "Mogra"
					,"Molengo" => "Molengo"
					,"Molle" => "Molle"
					,"Monda" => "Monda"
					,"Monofett" => "Monofett"
					,"Monoton" => "Monoton"
					,"Monsieur La Doulaise" => "Monsieur La Doulaise"
					,"Montaga" => "Montaga"
					,"Montez" => "Montez"
					,"Montserrat" => "Montserrat"
					,"Montserrat Alternates" => "Montserrat Alternates"
					,"Montserrat Subrayada" => "Montserrat Subrayada"
					,"Moul" => "Moul"
					,"Moulpali" => "Moulpali"
					,"Mountains of Christmas" => "Mountains of Christmas"
					,"Mouse Memoirs" => "Mouse Memoirs"
					,"Mr Bedfort" => "Mr Bedfort"
					,"Mr Dafoe" => "Mr Dafoe"
					,"Mr De Haviland" => "Mr De Haviland"
					,"Mrs Saint Delafield" => "Mrs Saint Delafield"
					,"Mrs Sheppards" => "Mrs Sheppards"
					,"Mukta" => "Mukta"
					,"Mukta Mahee" => "Mukta Mahee"
					,"Mukta Malar" => "Mukta Malar"
					,"Mukta Vaani" => "Mukta Vaani"
					,"Muli" => "Muli"
					,"Mystery Quest" => "Mystery Quest"
					,"NTR" => "NTR"
					,"Nanum Brush Script" => "Nanum Brush Script"
					,"Nanum Gothic" => "Nanum Gothic"
					,"Nanum Gothic Coding" => "Nanum Gothic Coding"
					,"Nanum Myeongjo" => "Nanum Myeongjo"
					,"Nanum Pen Script" => "Nanum Pen Script"
					,"Neucha" => "Neucha"
					,"Neuton" => "Neuton"
					,"New Rocker" => "New Rocker"
					,"News Cycle" => "News Cycle"
					,"Niconne" => "Niconne"
					,"Niramit" => "Niramit"
					,"Nixie One" => "Nixie One"
					,"Nobile" => "Nobile"
					,"Nokora" => "Nokora"
					,"Norican" => "Norican"
					,"Nosifer" => "Nosifer"
					,"Notable" => "Notable"
					,"Nothing You Could Do" => "Nothing You Could Do"
					,"Noticia Text" => "Noticia Text"
					,"Noto Sans" => "Noto Sans"
					,"Noto Sans JP" => "Noto Sans JP"
					,"Noto Sans KR" => "Noto Sans KR"
					,"Noto Sans SC" => "Noto Sans SC"
					,"Noto Sans TC" => "Noto Sans TC"
					,"Noto Serif" => "Noto Serif"
					,"Noto Serif JP" => "Noto Serif JP"
					,"Noto Serif KR" => "Noto Serif KR"
					,"Noto Serif SC" => "Noto Serif SC"
					,"Noto Serif TC" => "Noto Serif TC"
					,"Nova Cut" => "Nova Cut"
					,"Nova Flat" => "Nova Flat"
					,"Nova Mono" => "Nova Mono"
					,"Nova Oval" => "Nova Oval"
					,"Nova Round" => "Nova Round"
					,"Nova Script" => "Nova Script"
					,"Nova Slim" => "Nova Slim"
					,"Nova Square" => "Nova Square"
					,"Numans" => "Numans"
					,"Nunito" => "Nunito"
					,"Nunito Sans" => "Nunito Sans"
					,"Odor Mean Chey" => "Odor Mean Chey"
					,"Offside" => "Offside"
					,"Old Standard TT" => "Old Standard TT"
					,"Oldenburg" => "Oldenburg"
					,"Oleo Script" => "Oleo Script"
					,"Oleo Script Swash Caps" => "Oleo Script Swash Caps"
					,"Open Sans" => "Open Sans"
					,"Open Sans Condensed" => "Open Sans Condensed"
					,"Oranienbaum" => "Oranienbaum"
					,"Orbitron" => "Orbitron"
					,"Oregano" => "Oregano"
					,"Orienta" => "Orienta"
					,"Original Surfer" => "Original Surfer"
					,"Oswald" => "Oswald"
					,"Over the Rainbow" => "Over the Rainbow"
					,"Overlock" => "Overlock"
					,"Overlock SC" => "Overlock SC"
					,"Overpass" => "Overpass"
					,"Overpass Mono" => "Overpass Mono"
					,"Ovo" => "Ovo"
					,"Oxygen" => "Oxygen"
					,"Oxygen Mono" => "Oxygen Mono"
					,"PT Mono" => "PT Mono"
					,"PT Sans" => "PT Sans"
					,"PT Sans Caption" => "PT Sans Caption"
					,"PT Sans Narrow" => "PT Sans Narrow"
					,"PT Serif" => "PT Serif"
					,"PT Serif Caption" => "PT Serif Caption"
					,"Pacifico" => "Pacifico"
					,"Padauk" => "Padauk"
					,"Palanquin" => "Palanquin"
					,"Palanquin Dark" => "Palanquin Dark"
					,"Pangolin" => "Pangolin"
					,"Paprika" => "Paprika"
					,"Parisienne" => "Parisienne"
					,"Passero One" => "Passero One"
					,"Passion One" => "Passion One"
					,"Pathway Gothic One" => "Pathway Gothic One"
					,"Patrick Hand" => "Patrick Hand"
					,"Patrick Hand SC" => "Patrick Hand SC"
					,"Pattaya" => "Pattaya"
					,"Patua One" => "Patua One"
					,"Pavanam" => "Pavanam"
					,"Paytone One" => "Paytone One"
					,"Peddana" => "Peddana"
					,"Peralta" => "Peralta"
					,"Permanent Marker" => "Permanent Marker"
					,"Petit Formal Script" => "Petit Formal Script"
					,"Petrona" => "Petrona"
					,"Philosopher" => "Philosopher"
					,"Piedra" => "Piedra"
					,"Pinyon Script" => "Pinyon Script"
					,"Pirata One" => "Pirata One"
					,"Plaster" => "Plaster"
					,"Play" => "Play"
					,"Playball" => "Playball"
					,"Playfair Display" => "Playfair Display"
					,"Playfair Display SC" => "Playfair Display SC"
					,"Podkova" => "Podkova"
					,"Poiret One" => "Poiret One"
					,"Poller One" => "Poller One"
					,"Poly" => "Poly"
					,"Pompiere" => "Pompiere"
					,"Pontano Sans" => "Pontano Sans"
					,"Poor Story" => "Poor Story"
					,"Poppins" => "Poppins"
					,"Port Lligat Sans" => "Port Lligat Sans"
					,"Port Lligat Slab" => "Port Lligat Slab"
					,"Pragati Narrow" => "Pragati Narrow"
					,"Prata" => "Prata"
					,"Preahvihear" => "Preahvihear"
					,"Press Start 2P" => "Press Start 2P"
					,"Pridi" => "Pridi"
					,"Princess Sofia" => "Princess Sofia"
					,"Prociono" => "Prociono"
					,"Prosto One" => "Prosto One"
					,"Proza Libre" => "Proza Libre"
					,"Puritan" => "Puritan"
					,"Purple Purse" => "Purple Purse"
					,"Quando" => "Quando"
					,"Quantico" => "Quantico"
					,"Quattrocento" => "Quattrocento"
					,"Quattrocento Sans" => "Quattrocento Sans"
					,"Questrial" => "Questrial"
					,"Quicksand" => "Quicksand"
					,"Quintessential" => "Quintessential"
					,"Qwigley" => "Qwigley"
					,"Racing Sans One" => "Racing Sans One"
					,"Radley" => "Radley"
					,"Rajdhani" => "Rajdhani"
					,"Rakkas" => "Rakkas"
					,"Raleway" => "Raleway"
					,"Raleway Dots" => "Raleway Dots"
					,"Ramabhadra" => "Ramabhadra"
					,"Ramaraja" => "Ramaraja"
					,"Rambla" => "Rambla"
					,"Rammetto One" => "Rammetto One"
					,"Ranchers" => "Ranchers"
					,"Rancho" => "Rancho"
					,"Ranga" => "Ranga"
					,"Rasa" => "Rasa"
					,"Rationale" => "Rationale"
					,"Ravi Prakash" => "Ravi Prakash"
					,"Redressed" => "Redressed"
					,"Reem Kufi" => "Reem Kufi"
					,"Reenie Beanie" => "Reenie Beanie"
					,"Revalia" => "Revalia"
					,"Rhodium Libre" => "Rhodium Libre"
					,"Ribeye" => "Ribeye"
					,"Ribeye Marrow" => "Ribeye Marrow"
					,"Righteous" => "Righteous"
					,"Risque" => "Risque"
					,"Roboto" => "Roboto"
					,"Roboto Condensed" => "Roboto Condensed"
					,"Roboto Mono" => "Roboto Mono"
					,"Roboto Slab" => "Roboto Slab"
					,"Rochester" => "Rochester"
					,"Rock Salt" => "Rock Salt"
					,"Rokkitt" => "Rokkitt"
					,"Romanesco" => "Romanesco"
					,"Ropa Sans" => "Ropa Sans"
					,"Rosario" => "Rosario"
					,"Rosarivo" => "Rosarivo"
					,"Rouge Script" => "Rouge Script"
					,"Rozha One" => "Rozha One"
					,"Rubik" => "Rubik"
					,"Rubik Mono One" => "Rubik Mono One"
					,"Ruda" => "Ruda"
					,"Rufina" => "Rufina"
					,"Ruge Boogie" => "Ruge Boogie"
					,"Ruluko" => "Ruluko"
					,"Rum Raisin" => "Rum Raisin"
					,"Ruslan Display" => "Ruslan Display"
					,"Russo One" => "Russo One"
					,"Ruthie" => "Ruthie"
					,"Rye" => "Rye"
					,"Sacramento" => "Sacramento"
					,"Sahitya" => "Sahitya"
					,"Sail" => "Sail"
					,"Saira" => "Saira"
					,"Saira Condensed" => "Saira Condensed"
					,"Saira Extra Condensed" => "Saira Extra Condensed"
					,"Saira Semi Condensed" => "Saira Semi Condensed"
					,"Salsa" => "Salsa"
					,"Sanchez" => "Sanchez"
					,"Sancreek" => "Sancreek"
					,"Sansita" => "Sansita"
					,"Sarabun" => "Sarabun"
					,"Sarala" => "Sarala"
					,"Sarina" => "Sarina"
					,"Sarpanch" => "Sarpanch"
					,"Satisfy" => "Satisfy"
					,"Sawarabi Gothic" => "Sawarabi Gothic"
					,"Sawarabi Mincho" => "Sawarabi Mincho"
					,"Scada" => "Scada"
					,"Scheherazade" => "Scheherazade"
					,"Schoolbell" => "Schoolbell"
					,"Scope One" => "Scope One"
					,"Seaweed Script" => "Seaweed Script"
					,"Secular One" => "Secular One"
					,"Sedgwick Ave" => "Sedgwick Ave"
					,"Sedgwick Ave Display" => "Sedgwick Ave Display"
					,"Sevillana" => "Sevillana"
					,"Seymour One" => "Seymour One"
					,"Shadows Into Light" => "Shadows Into Light"
					,"Shadows Into Light Two" => "Shadows Into Light Two"
					,"Shanti" => "Shanti"
					,"Share" => "Share"
					,"Share Tech" => "Share Tech"
					,"Share Tech Mono" => "Share Tech Mono"
					,"Shojumaru" => "Shojumaru"
					,"Short Stack" => "Short Stack"
					,"Siemreap" => "Siemreap"
					,"Sigmar One" => "Sigmar One"
					,"Signika" => "Signika"
					,"Signika Negative" => "Signika Negative"
					,"Simonetta" => "Simonetta"
					,"Sintony" => "Sintony"
					,"Sirin Stencil" => "Sirin Stencil"
					,"Six Caps" => "Six Caps"
					,"Skranji" => "Skranji"
					,"Slackey" => "Slackey"
					,"Smokum" => "Smokum"
					,"Smythe" => "Smythe"
					,"Sniglet" => "Sniglet"
					,"Snippet" => "Snippet"
					,"Snowburst One" => "Snowburst One"
					,"Sofadi One" => "Sofadi One"
					,"Sofia" => "Sofia"
					,"Song Myung" => "Song Myung"
					,"Sonsie One" => "Sonsie One"
					,"Sorts Mill Goudy" => "Sorts Mill Goudy"
					,"Source Code Pro" => "Source Code Pro"
					,"Source Sans Pro" => "Source Sans Pro"
					,"Source Serif Pro" => "Source Serif Pro"
					,"Space Mono" => "Space Mono"
					,"Special Elite" => "Special Elite"
					,"Spectral" => "Spectral"
					,"Spectral SC" => "Spectral SC"
					,"Spicy Rice" => "Spicy Rice"
					,"Spinnaker" => "Spinnaker"
					,"Spirax" => "Spirax"
					,"Squada One" => "Squada One"
					,"Sree Krushnadevaraya" => "Sree Krushnadevaraya"
					,"Sriracha" => "Sriracha"
					,"Srisakdi" => "Srisakdi"
					,"Staatliches" => "Staatliches"
					,"Stalemate" => "Stalemate"
					,"Stalinist One" => "Stalinist One"
					,"Stardos Stencil" => "Stardos Stencil"
					,"Stint Ultra Condensed" => "Stint Ultra Condensed"
					,"Stint Ultra Expanded" => "Stint Ultra Expanded"
					,"Stoke" => "Stoke"
					,"Strait" => "Strait"
					,"Stylish" => "Stylish"
					,"Sue Ellen Francisco" => "Sue Ellen Francisco"
					,"Suez One" => "Suez One"
					,"Sumana" => "Sumana"
					,"Sunflower" => "Sunflower"
					,"Sunshiney" => "Sunshiney"
					,"Supermercado One" => "Supermercado One"
					,"Sura" => "Sura"
					,"Suranna" => "Suranna"
					,"Suravaram" => "Suravaram"
					,"Suwannaphum" => "Suwannaphum"
					,"Swanky and Moo Moo" => "Swanky and Moo Moo"
					,"Syncopate" => "Syncopate"
					,"Tajawal" => "Tajawal"
					,"Tangerine" => "Tangerine"
					,"Taprom" => "Taprom"
					,"Tauri" => "Tauri"
					,"Taviraj" => "Taviraj"
					,"Teko" => "Teko"
					,"Telex" => "Telex"
					,"Tenali Ramakrishna" => "Tenali Ramakrishna"
					,"Tenor Sans" => "Tenor Sans"
					,"Text Me One" => "Text Me One"
					,"Thasadith" => "Thasadith"
					,"The Girl Next Door" => "The Girl Next Door"
					,"Tienne" => "Tienne"
					,"Tillana" => "Tillana"
					,"Timmana" => "Timmana"
					,"Tinos" => "Tinos"
					,"Titan One" => "Titan One"
					,"Titillium Web" => "Titillium Web"
					,"Trade Winds" => "Trade Winds"
					,"Trirong" => "Trirong"
					,"Trocchi" => "Trocchi"
					,"Trochut" => "Trochut"
					,"Trykker" => "Trykker"
					,"Tulpen One" => "Tulpen One"
					,"Ubuntu" => "Ubuntu"
					,"Ubuntu Condensed" => "Ubuntu Condensed"
					,"Ubuntu Mono" => "Ubuntu Mono"
					,"Ultra" => "Ultra"
					,"Uncial Antiqua" => "Uncial Antiqua"
					,"Underdog" => "Underdog"
					,"Unica One" => "Unica One"
					,"UnifrakturCook" => "UnifrakturCook"
					,"UnifrakturMaguntia" => "UnifrakturMaguntia"
					,"Unkempt" => "Unkempt"
					,"Unlock" => "Unlock"
					,"Unna" => "Unna"
					,"VT323" => "VT323"
					,"Vampiro One" => "Vampiro One"
					,"Varela" => "Varela"
					,"Varela Round" => "Varela Round"
					,"Vast Shadow" => "Vast Shadow"
					,"Vibur" => "Vibur"
					,"Vidaloka" => "Vidaloka"
					,"Viga" => "Viga"
					,"Voces" => "Voces"
					,"Volkhov" => "Volkhov"
					,"Vollkorn" => "Vollkorn"
					,"Vollkorn SC" => "Vollkorn SC"
					,"Voltaire" => "Voltaire"
					,"Waiting for the Sunrise" => "Waiting for the Sunrise"
					,"Wallpoet" => "Wallpoet"
					,"Walter Turncoat" => "Walter Turncoat"
					,"Warnes" => "Warnes"
					,"Wellfleet" => "Wellfleet"
					,"Wendy One" => "Wendy One"
					,"Wire One" => "Wire One"
					,"Work Sans" => "Work Sans"
					,"Yanone Kaffeesatz" => "Yanone Kaffeesatz"
					,"Yantramanav" => "Yantramanav"
					,"Yatra One" => "Yatra One"
					,"Yellowtail" => "Yellowtail"
					,"Yeon Sung" => "Yeon Sung"
					,"Yeseva One" => "Yeseva One"
					,"Yesteryear" => "Yesteryear"
					,"Yrsa" => "Yrsa"
					,"ZCOOL KuaiLe" => "ZCOOL KuaiLe"
					,"ZCOOL QingKe HuangYou" => "ZCOOL QingKe HuangYou"
					,"ZCOOL XiaoWei" => "ZCOOL XiaoWei"
					,"Zeyada" => "Zeyada"
					,"Zilla Slab" => "Zilla Slab"
					,"Zilla Slab Highlight" => "Zilla Slab Highlight"
				);
				
	return apply_filters('sanzo_list_google_fonts', $fonts);
}

add_action('init','sanzo_define_of_options');

if (!function_exists('sanzo_define_of_options'))
{
	function sanzo_define_of_options()
	{  
		$list_family_fonts = sanzo_get_list_family_fonts();
		$list_google_fonts = sanzo_get_list_google_fonts();
		
		/* Default value for logo and favicon */
		$df_logo_image_uri 			= get_template_directory_uri(). '/images/logo.png'; 
		$df_bg_search_image_uri 	= get_template_directory_uri(). '/images/bg_search.jpg'; 
		$df_icon_image_uri 			= get_template_directory_uri(). '/images/favicon.ico';
		
		/* Product Placeholder Image */
		$df_prod_placeholder_image_uri 	= get_template_directory_uri(). '/images/prod_loading.gif';

		/* Product details banners */
		$df_product_banner_1 			= get_template_directory_uri(). '/images/feature-product-detail-1.jpg';
		$df_product_banner_2 			= get_template_directory_uri(). '/images/feature-product-detail-2.jpg';
		$df_product_banner_3 			= get_template_directory_uri(). '/images/feature-product-detail-3.jpg';
		
		/* Header contact */
		$df_header_contact = get_template_directory_uri(). '/images/contact-header.png';
		
		/* Default Sidebar */
		$of_sidebars 	= array();
		if( function_exists('sanzo_get_list_sidebars') ){
			$default_sidebars = sanzo_get_list_sidebars();
			foreach( $default_sidebars as $key => $_sidebar ){
				$of_sidebars[$_sidebar['id']] = $_sidebar['name'];
			}
		}
		
		/* Admin url */
		$admin_image_url =  get_template_directory() . '/admin/assets/images/';

/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

/* Set the Options Array */
global $sanzo_of_options;
$sanzo_of_options = array();

/***************************/ 
/* General Options		   */
/***************************/
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("General", "sanzo")
						,"type" 	=> "heading"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Logo - Favicon", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_logo_favicon"
						,"std" 		=> "<h3>" . esc_html__("Logo - Favicon", "sanzo") . "</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);	

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Logo Image", "sanzo")
						,"desc" 	=> esc_html__("Select an image file for the main logo", "sanzo")
						,"id" 		=> "ts_logo"
						,"std"		=> $df_logo_image_uri
						,"type" 	=> "upload"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Logo Image On Mobile", "sanzo")
						,"desc" 	=> esc_html__("Leave blank to display the main logo on mobile", "sanzo")
						,"id" 		=> "ts_logo_mobile"
						,"std"		=> ""
						,"type" 	=> "upload"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Sticky Logo Image", "sanzo")
						,"desc" 	=> esc_html__("Display this logo on sticky header", "sanzo")
						,"id" 		=> "ts_logo_sticky"
						,"std"		=> ""
						,"type" 	=> "upload"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Favicon Image", "sanzo")
						,"desc" 	=> esc_html__("Accept ICO files", "sanzo")
						,"id" 		=> "ts_favicon"
						,"std"		=> $df_icon_image_uri
						,"type" 	=> "upload"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Text Logo", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_text_logo"
						,"std" 		=> "SANZO"
						,"type" 	=> "text"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Layout Style", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_layout_style"
						,"std" 		=> "<h3>" . esc_html__("Layout Style", "sanzo") . "</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Layout Style", "sanzo")
						,"desc" 	=> esc_html__("You can override this option for the individual page", "sanzo")
						,"id" 		=> "ts_layout_style"
						,"std" 		=> "advance" 
						,"type" 	=> "select"
						,"options"	=> array(
									'boxed'		=> esc_html__('Boxed', 'sanzo')
									,'wide'		=> esc_html__('Wide', 'sanzo')
									,'advance' 	=> esc_html__('Advance', 'sanzo')
								)
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Header Layout Style", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_header_layout_style"
						,"std" 		=> "boxed" 
						,"type" 	=> "select"
						,"options"	=> array(
									'boxed'		=> esc_html__('Boxed', 'sanzo')
									,'wide'		=> esc_html__('Wide', 'sanzo')
								)
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Main Content Layout Style", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_main_content_layout_style"
						,"std" 		=> "boxed" 
						,"type" 	=> "select"
						,"options"	=> array(
									'boxed'		=> esc_html__('Boxed', 'sanzo')
									,'wide'		=> esc_html__('Wide', 'sanzo')
								)
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Footer Layout Style", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_footer_layout_style"
						,"std" 		=> "wide" 
						,"type" 	=> "select"
						,"options"	=> array(
									'boxed'		=> esc_html__('Boxed', 'sanzo')
									,'wide'		=> esc_html__('Wide', 'sanzo')
								)
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Right To Left", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_rtl"
						,"std" 		=> "<h3>" . esc_html__("Right To Left", "sanzo") . "</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Enable Right To Left", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_enable_rtl"
						,"std" 		=> 0
						,"icon" 	=> true
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Responsive", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_responsive"
						,"std" 		=> "<h3>" . esc_html__("Responsive", "sanzo") . "</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Enable Responsive", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_responsive"
						,"std" 		=> 1
						,"icon" 	=> true
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Smooth Scroll", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_smooth_scroll"
						,"std" 		=> "<h3>" . esc_html__("Smooth Scroll", "sanzo") . "</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Enable Smooth Scroll", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_smooth_scroll"
						,"std" 		=> 1
						,"icon" 	=> true
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Back To Top Button", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_to_top_button"
						,"std" 		=> "<h3>" . esc_html__("Back To Top Button", "sanzo") . "</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Enable Back To Top Button", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_back_to_top_button"
						,"std" 		=> 1
						,"icon" 	=> true
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Enable Back To Top Button On Mobile", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_back_to_top_button_on_mobile"
						,"std" 		=> 0
						,"icon" 	=> true
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Google Map API Key", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_to_gmap_api_key"
						,"std" 		=> "<h3>" . esc_html__("Google Map API Key", "sanzo") . "</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Enter your API key", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_gmap_api_key"
						,"std" 		=> ""
						,"type" 	=> "text"
				);

/***************************/ 
/* Color Scheme Options	   */
/***************************/				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Color Scheme", "sanzo")
						,"type" 	=> "heading"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Select Color Scheme of Theme", "sanzo")
						,"id" 		=> "ts_color_scheme"
						,"std" 		=> "default"
						,"type" 	=> "images"
						,"options" 	=> array(
							'default' 			=> ADMIN_IMAGES . 'color_scheme/default.jpg'
							,'orange' 			=> ADMIN_IMAGES . 'color_scheme/orange.jpg'
							,'blue' 			=> ADMIN_IMAGES . 'color_scheme/blue.jpg'
							,'red' 				=> ADMIN_IMAGES . 'color_scheme/red.jpg'
							,'yellow' 			=> ADMIN_IMAGES . 'color_scheme/yellow.jpg'
							,'orange3' 			=> ADMIN_IMAGES . 'color_scheme/orange3.jpg'
							,'pink' 			=> ADMIN_IMAGES . 'color_scheme/pink.jpg'
							,'pink2' 			=> ADMIN_IMAGES . 'color_scheme/pink2.jpg'
						)
				);

/** Primary Colors **/
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("General Colors", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_general_colors"
						,"std" 		=> "<h3>" . esc_html__("General Colors", "sanzo") . "</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Primary Colors", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_primary_color"
						,"std" 		=> "<h4>" . esc_html__("Primary Colors", "sanzo") . "</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Primary Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_primary_color"
						,"std" 		=> "#f5a72c"
						,"type" 	=> "color"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Text Color In Primary Background Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_text_color_in_bg_primary"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Secondary Colors", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_secondary_color"
						,"std" 		=> "<h4>" . esc_html__("Secondary Colors", "sanzo") . "</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Secondary Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_secondary_color"
						,"std" 		=> "#1f1f1f"
						,"type" 	=> "color"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Text Color In Secondary Background Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_text_color_in_bg_second"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Heading Colors", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_heading_color"
						,"std" 		=> "<h4>" . esc_html__("Heading Colors", "sanzo") . "</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Heading Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_heading_color"
						,"std" 		=> "#535353"
						,"type" 	=> "color"
				);
	
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Main Content Colors", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_main_content_color"
						,"std" 		=> "<h4>" . esc_html__("Main Content Colors", "sanzo") . "</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Main Content Background Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_main_content_background_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Widget Content Background Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_widget_content_background_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Text Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_text_color"
						,"std" 		=> "#666666"
						,"type" 	=> "color"
				);	

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Link Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_link_color"
						,"std" 		=> "#f5a72c"
						,"type" 	=> "color"
				);	

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Link Color Hover", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_link_color_hover"
						,"std" 		=> "#f5a72c"
						,"type" 	=> "color"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Border Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_border_color"
						,"std" 		=> "#d9d9d9"
						,"type" 	=> "color"
				);	

/* Button Colors */
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Button Colors", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_button_color"
						,"std" 		=> "<h4>" . esc_html__("Button Colors", "sanzo") . "</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Button Text Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_button_text_color"
						,"std" 		=> "#1f1f1f"
						,"type" 	=> "color"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Button Text Color Hover", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_button_text_color_hover"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Button Border Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_button_border_color"
						,"std" 		=> "#d9d9d9"
						,"type" 	=> "color"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Button Border Color Hover", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_button_border_color_hover"
						,"std" 		=> "#1f1f1f"
						,"type" 	=> "color"
				);				
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Button Background Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_button_background_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Button Background Color Hover", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_button_background_color_hover"
						,"std" 		=> "#1f1f1f"
						,"type" 	=> "color"
				);
				
/** Breadcrumb Colors **/		
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Breadcrumb Colors", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_breadcrumb_colors"
						,"std" 		=> "<h4>" . esc_html__("Breadcrumb Colors", "sanzo") . "</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Breadcrumb Background Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_breadcrumb_background_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);				
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Breadcrumb Text Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_breadcrumb_text_color"
						,"std" 		=> "#666666"
						,"type" 	=> "color"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Breadcrumb Heading Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_breadcrumb_heading_color"
						,"std" 		=> "#1f1f1f"
						,"type" 	=> "color"
				);

/** Header Colors **/
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Header Colors", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_header_colors"
						,"std" 		=> "<h3>" . esc_html__("Header Colors", "sanzo") . "</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Top Header", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_top_header"
						,"std" 		=> "<h4>" . esc_html__("Top Header", "sanzo") . "</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Top Header Background Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_top_header_background_color"
						,"std" 		=> "#f5f5f5"
						,"type" 	=> "color"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Top Header Text Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_top_header_text_color"
						,"std" 		=> "#666666"
						,"type" 	=> "color"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Middle Header", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_middle_header"
						,"std" 		=> "<h4>" . esc_html__("Middle Header", "sanzo") . "</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Middle Header Background Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_middle_header_background_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Middle Header Text Color", "sanzo")
						,"desc" 	=> "Use for header version 6"
						,"id" 		=> "ts_middle_header_text_color"
						,"std" 		=> "#f5f5f5"
						,"type" 	=> "color"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Bottom Header", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_bottom_header"
						,"std" 		=> "<h4>" . esc_html__("Bottom Header", "sanzo") . "</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Bottom Header Background Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_bottom_header_background_color"
						,"std" 		=> "#1f1f1f"
						,"type" 	=> "color"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Header Product Categories", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_categories_product_header"
						,"std" 		=> "<h4>" . esc_html__("Header Product Categories", "sanzo") . "</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Header Product Categories Name Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_header_categories_product_name_color"
						,"std" 		=> "#d9d9d9"
						,"type" 	=> "color"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Header Product Categories Name Color Hover", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_header_categories_product_name_hover_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Header Product Categories Border Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_header_categories_product_border_color"
						,"std" 		=> "#d9d9d9"
						,"type" 	=> "color"
				);				
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Header Search", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_search_header"
						,"std" 		=> "<h4>" . esc_html__("Header Search", "sanzo") . "</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Header Search Background Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_search_background_color"
						,"std" 		=> "#656565"
						,"type" 	=> "color"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Header Search Border Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_search_border_color"
						,"std" 		=> "#656565"
						,"type" 	=> "color"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Header Search Categories Text Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_search_categories_text_color"
						,"std" 		=> "#e5e5e5"
						,"type" 	=> "color"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Header Search Categories Hightlighted Text Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_search_categories_hightlighted_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Header Search Input Background Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_search_input_text_background_color"
						,"std" 		=> "#656565"
						,"type" 	=> "color"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Header Search Input Text Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_search_input_text_color"
						,"std" 		=> "#e5e5e5"
						,"type" 	=> "color"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Header Search Popup Background Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_popup_heading_color"
						,"std" 		=> "#1f1f1f"
						,"type" 	=> "color"
				);	

/** Menu Colors **/
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Menu Colors", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_menu_colors"
						,"std" 		=> "<h3>" . esc_html__("Menu Colors", "sanzo") . "</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);	

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Vertical Menu Colors", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_vertical_menu_colors"
						,"std" 		=> "<h4>" . esc_html__("Vertical Menu Colors", "sanzo") . "</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);	

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Vertical Menu Icon Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_vertical_menu_icon_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Vertical Menu Title Text Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_vertical_menu_title_text"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Vertical Menu Title Background Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_vertical_menu_title_background_color"
						,"std" 		=> "#f5a72c"
						,"type" 	=> "color"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Vertical Menu Title Text Color Hover", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_vertical_menu_title_text_hover"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Vertical Menu Title Background Color Hover", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_vertical_menu_title_background_color_hover"
						,"std" 		=> "#f5a72c"
						,"type" 	=> "color"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Main Menu Colors", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_main_menu_color"
						,"std" 		=> "<h4>" . esc_html__("Main Menu Colors", "sanzo") . "</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Menu Text Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_menu_text_color"
						,"std" 		=> "#1f1f1f"
						,"type" 	=> "color"
				);	

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Menu Text Color Hover", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_menu_text_color_hover"
						,"std" 		=> "#f5a72c"
						,"type" 	=> "color"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Menu Top Line Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_menu_top_line_color"
						,"std" 		=> "#d9d9d9"
						,"type" 	=> "color"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Sub Menu Colors", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_sub_menu_color"
						,"std" 		=> "<h4>" . esc_html__("Sub Menu Colors", "sanzo") . "</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Sub Menu Background Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_sub_menu_background_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Sub Menu Text Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_sub_menu_text_color"
						,"std" 		=> "#666666"
						,"type" 	=> "color"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Sub Menu Text Color Hover", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_sub_menu_text_color_hover"
						,"std" 		=> "#f5a72c"
						,"type" 	=> "color"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Sub Menu Heading Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_sub_menu_heading_color"
						,"std" 		=> "#1f1f1f"
						,"type" 	=> "color"
				);	

/** Footer Colors **/
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Footer Colors", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_footer_colors"
						,"std" 		=> "<h3>" . esc_html__("Footer Colors", "sanzo") . "</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Footer Background Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_footer_background_color"
						,"std" 		=> "#252525"
						,"type" 	=> "color"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Footer Copyright Background Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_footer_end_background_color"
						,"std" 		=> "#000000"
						,"type" 	=> "color"
				);	
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Footer Text Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_footer_text_color"
						,"std" 		=> "#d9d9d9"
						,"type" 	=> "color"
				);	

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Footer Heading Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_footer_heading_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);			

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Footer Subscription Colors", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_footer_subscription_color"
						,"std" 		=> "<h4>" . esc_html__("Footer Subscription Colors", "sanzo") . "</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);				
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Footer Subscription Background Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_footer_subscription_background_color"
						,"std" 		=> "#595959"
						,"type" 	=> "color"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Footer Subscription Text Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_footer_subscription_text_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);	
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Footer Social Colors", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_footer_social_color"
						,"std" 		=> "<h4>" . esc_html__("Footer Social Colors", "sanzo") . "</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Social Icon Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_footer_social_icon_color"
						,"std" 		=> "#e5e5e5"
						,"type" 	=> "color"
				);				
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Social Border Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_footer_social_icon_border_color"
						,"std" 		=> "#666666"
						,"type" 	=> "color"
				);
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Footer Copyright Text Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_footer_end_text_color"
						,"std" 		=> "#e5e5e5"
						,"type" 	=> "color"
				);
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Footer Copyright Text Color Hover", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_footer_end_text_hover_color"
						,"std" 		=> "#f5a72c"
						,"type" 	=> "color"
				);	
		

/** Product Colors **/
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Colors", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_product_colors"
						,"std" 		=> "<h3>" . esc_html__("Product Colors", "sanzo") . "</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);	
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Hot Deal Background Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_hotdeal_background_color"
						,"std" 		=> "#f5f5f5"
						,"type" 	=> "color"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Hot Deal Text Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_hotdeal_text_color"
						,"std" 		=> "#1f1f1f"
						,"type" 	=> "color"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Hot Deal Border Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_hotdeal_border_color"
						,"std" 		=> "#d9d9d9"
						,"type" 	=> "color"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Hot Deal Label Background Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_hotdeal_ref_background_color"
						,"std" 		=> "#77d23f"
						,"type" 	=> "color"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Hot Deal Label Text Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_hotdeal_ref_text_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Price Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_price_color"
						,"std" 		=> "#1f1f1f"
						,"type" 	=> "color"
				);	

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Sale Price Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_sale_price_color"
						,"std" 		=> "#f5a72c"
						,"type" 	=> "color"
				);					
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Rating Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_rating_color"
						,"std" 		=> "#f5a72c"
						,"type" 	=> "color"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Name Text Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_name_text_color"
						,"std" 		=> "#666666"
						,"type" 	=> "color"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Button Colors", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_product_button_color"
						,"std" 		=> "<h4>" . esc_html__("Product Button Colors", "sanzo") . "</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Button Text Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_button_text_color"
						,"std" 		=> "#1f1f1f"
						,"type" 	=> "color"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Button Text Color Hover", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_button_text_color_hover"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Button Background Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_button_background_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Button Background Color Hover", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_button_background_color_hover"
						,"std" 		=> "#f5a72c"
						,"type" 	=> "color"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Button Border Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_button_border_color"
						,"std" 		=> "#d9d9d9"
						,"type" 	=> "color"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Button Border Color Hover", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_button_border_color_hover"
						,"std" 		=> "#f5a72c"
						,"type" 	=> "color"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Label Colors", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_product_label_color"
						,"std" 		=> "<h4>" . esc_html__("Product Label Colors", "sanzo") . "</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Sale Label Text Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_sale_label_text_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);	

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Sale Label Background Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_sale_label_background_color"
						,"std" 		=> "#31aae8"
						,"type" 	=> "color"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product New Label Text Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_new_label_text_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);	

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product New Label Background Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_new_label_background_color"
						,"std" 		=> "#77d23f"
						,"type" 	=> "color"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Feature Label Text Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_feature_label_text_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);	

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Feature Label Background Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_feature_label_background_color"
						,"std" 		=> "#f5a72c"
						,"type" 	=> "color"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product OutStock Label Text Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_outstock_label_text_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);	

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product OutStock Label Background Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_outstock_label_background_color"
						,"std" 		=> "#d4d4d4"
						,"type" 	=> "color"
				);		

/** Message Box Colors **/
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Message Box Colors", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_message_box_colors"
						,"std" 		=> "<h3>" . esc_html__("Message Box Colors", "sanzo") . "</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);	

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Message Text Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_message_text_color"
						,"std" 		=> "#666666"
						,"type" 	=> "color"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Message Border Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_message_border_color"
						,"std" 		=> "#77d23f"
						,"type" 	=> "color"
				);				

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Info Message Text Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_info_message_text_color"
						,"std" 		=> "#21c2f8"
						,"type" 	=> "color"
				);	

				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Info Message Border Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_info_message_border_color"
						,"std" 		=> "#21c2f8"
						,"type" 	=> "color"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Error Message Text Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_error_message_text_color"
						,"std" 		=> "#666666"
						,"type" 	=> "color"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Error Message Border Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_error_message_border_color"
						,"std" 		=> "#e94b4b"
						,"type" 	=> "color"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Warning Message Text Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_warning_message_text_color"
						,"std" 		=> "#666666"
						,"type" 	=> "color"
				);	

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Warning Message Border Color", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_warning_message_border_color"
						,"std" 		=> "#f5d817"
						,"type" 	=> "color"
				);
				
/***************************/ 
/* Typography Config	   */
/***************************/				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Typography", "sanzo")
						,"type" 	=> "heading"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Fonts", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_fonts"
						,"std" 		=> "<h3>" . esc_html__("Fonts", "sanzo") . "</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Body Font", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_body_font"
						,"std" 		=> "<h4>" . esc_html__("Body Font", "sanzo") . "</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Body Font - Enable Google Font", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_body_font_enable_google_font"
						,"std" 		=> 1
						,"folds"	=> 1
						,"on"		=> esc_html__("Enable", "sanzo")
						,"off"		=> esc_html__("Disable", "sanzo")
						,"type" 	=> "switch"
				);	
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Body Font - Family Font", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_body_font_family"
						,"std" 		=> "Arial" 
						,"type" 	=> "select"
						,"options"	=> $list_family_fonts
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Body Font - Google Font", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_body_font_google"
						,"std" 		=> "Open Sans"
						,"type" 	=> "select_google_font"
						,"preview" 	=> array(
										"text" => esc_html__("This is my font preview!", "sanzo")
										,"size" => "30px"
						)
						,"options"	=> $list_google_fonts
				);

/* Secondary Body Font */				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Secondary Body Font", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_secondary_body_font"
						,"std" 		=> "<h4>" . esc_html__("Secondary Body Font", "sanzo") . "</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Secondary Body Font - Enable Google Font", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_secondary_body_font_enable_google_font"
						,"std" 		=> 1
						,"folds"	=> 1
						,"on"		=> esc_html__("Enable", "sanzo")
						,"off"		=> esc_html__("Disable", "sanzo")
						,"type" 	=> "switch"
				);	
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Secondary Body Font - Family Font", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_secondary_body_font_family"
						,"std" 		=> "Arial" 
						,"type" 	=> "select"
						,"options"	=> $list_family_fonts
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Secondary Body Font - Google Font", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_secondary_body_font_google"
						,"std" 		=> "Montserrat"
						,"type" 	=> "select_google_font"
						,"preview" 	=> array(
										"text" => esc_html__("This is my font preview!", "sanzo")
										,"size" => "30px"
						)
						,"options"	=> $list_google_fonts
				);
				
/* Thirdary Body Font */				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Thirdary Body Font", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_third_body_font"
						,"std" 		=> "<h4>" . esc_html__("Thirdary Body Font", "sanzo") . "</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Thirdary Body Font - Enable Google Font", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_thirdary_body_font_enable_google_font"
						,"std" 		=> 1
						,"folds"	=> 1
						,"on"		=> esc_html__("Enable", "sanzo")
						,"off"		=> esc_html__("Disable", "sanzo")
						,"type" 	=> "switch"
				);	
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Thirdary Body Font - Family Font", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_thirdary_body_font_family"
						,"std" 		=> "Arial" 
						,"type" 	=> "select"
						,"options"	=> $list_family_fonts
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Thirdary Body Font - Google Font", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_thirdary_body_font_google"
						,"std" 		=> "Roboto"
						,"type" 	=> "select_google_font"
						,"preview" 	=> array(
										"text" => esc_html__("This is my font preview!", "sanzo")
										,"size" => "30px"
						)
						,"options"	=> $list_google_fonts
				);
				
/* Menu Font */				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Menu Font", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_menu_font"
						,"std" 		=> "<h4>" . esc_html__("Menu Font", "sanzo") . "</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Menu Font - Enable Google Font", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_menu_font_enable_google_font"
						,"std" 		=> 1
						,"folds"	=> 1
						,"on"		=> esc_html__("Enable", "sanzo")
						,"off"		=> esc_html__("Disable", "sanzo")
						,"type" 	=> "switch"
				);	
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Menu Font - Family Font", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_menu_font_family"
						,"std" 		=> "Arial" 
						,"type" 	=> "select"
						,"options"	=> $list_family_fonts
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Menu Font - Google Font", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_menu_font_google"
						,"std" 		=> "Montserrat"
						,"type" 	=> "select_google_font"
						,"preview" 	=> array(
										"text" => esc_html__("This is my font preview!", "sanzo")
										,"size" => "30px"
						)
						,"options"	=> $list_google_fonts
				);
/* Sub Menu Font */				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Sub Menu Font", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_sub_menu_font"
						,"std" 		=> "<h4>" . esc_html__("Sub Menu Font", "sanzo") . "</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Sub Menu Font - Enable Google Font", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_sub_menu_font_enable_google_font"
						,"std" 		=> 1
						,"folds"	=> 1
						,"on"		=> esc_html__("Enable", "sanzo")
						,"off"		=> esc_html__("Disable", "sanzo")
						,"type" 	=> "switch"
				);	
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Sub Menu Font - Family Font", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_sub_menu_font_family"
						,"std" 		=> "Arial" 
						,"type" 	=> "select"
						,"options"	=> $list_family_fonts
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Sub Menu Font - Google Font", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_sub_menu_font_google"
						,"std" 		=> "Roboto"
						,"type" 	=> "select_google_font"
						,"preview" 	=> array(
										"text" => esc_html__("This is my font preview!", "sanzo")
										,"size" => "30px"
						)
						,"options"	=> $list_google_fonts
				);
				
/*** Custom Font ***/				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Custom Fonts", "sanzo")
						,"desc" 	=> esc_html__("If you get the error message 'Sorry, this file type is not permitted for security reasons', you can add this line define('ALLOW_UNFILTERED_UPLOADS', true); to the wp-config.php file", "sanzo")
						,"id" 		=> "introduction_fonts"
						,"std" 		=> "<h3>" . esc_html__("Custom Fonts", "sanzo") . "</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);

$sanzo_of_options[] = array( 	"name" 		=> ""
						,"desc" 	=> esc_html__("Upload the .ttf font file", "sanzo")
						,"id" 		=> "ts_custom_font_ttf"
						,"std"		=> ''
						,"type" 	=> "upload"
				);

/*** Font Sizes - Line Hight ***/				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Font Sizes - Line Hight", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_font_sizes_line_height"
						,"std" 		=> "<h3>" . esc_html__("Font Sizes - Line Hight", "sanzo") . "</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);

/* Body Font Size */				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Body Font Size", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_body_font_size"
						,"std" 		=> "<h4>" . esc_html__("Body Font Size", "sanzo") . "</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Body Font Size", "sanzo")
						,"desc" 	=> esc_html__("In pixels. Default is 14px", "sanzo")
						,"id" 		=> "ts_font_size_body"
						,"std" 		=> "13"
						,"min" 		=> "10"
						,"step"		=> "1"
						,"max" 		=> "50"
						,"type" 	=> "sliderui" 
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Body Font Line Height", "sanzo")
						,"desc" 	=> esc_html__("In pixels. Default is 26px", "sanzo")
						,"id" 		=> "ts_line_height_body"
						,"std" 		=> "26"
						,"min" 		=> "10"
						,"step"		=> "1"
						,"max" 		=> "50"
						,"type" 	=> "sliderui" 
				);

/* Menu Font Size */				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Menu Font Size", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_menu_font_size"
						,"std" 		=> "<h4>" . esc_html__("Menu Font Size", "sanzo") . "</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Menu Font Size", "sanzo")
						,"desc" 	=> esc_html__("In pixels. Default is 14px", "sanzo")
						,"id" 		=> "ts_font_size_menu"
						,"std" 		=> "14"
						,"min" 		=> "10"
						,"step"		=> "1"
						,"max" 		=> "50"
						,"type" 	=> "sliderui" 
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Menu Font Line Height", "sanzo")
						,"desc" 	=> esc_html__("In pixels. Default is 18px", "sanzo")
						,"id" 		=> "ts_line_height_menu"
						,"std" 		=> "18"
						,"min" 		=> "10"
						,"step"		=> "1"
						,"max" 		=> "50"
						,"type" 	=> "sliderui" 
				);

/* Button Font Size */				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Button Font Size", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_button_font_size"
						,"std" 		=> "<h4>" . esc_html__("Button Font Size", "sanzo") . "</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Button Font Size", "sanzo")
						,"desc" 	=> esc_html__("In pixels. Default is 12px", "sanzo")
						,"id" 		=> "ts_font_size_button"
						,"std" 		=> "12"
						,"min" 		=> "10"
						,"step"		=> "1"
						,"max" 		=> "50"
						,"type" 	=> "sliderui" 
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Button Font Line Height", "sanzo")
						,"desc" 	=> esc_html__("In pixels. Default is 18px", "sanzo")
						,"id" 		=> "ts_line_height_button"
						,"std" 		=> "18"
						,"min" 		=> "10"
						,"step"		=> "1"
						,"max" 		=> "50"
						,"type" 	=> "sliderui" 
				);

/* Heading Font Size */				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Heading Font Size", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_heading_font_size"
						,"std" 		=> "<h4>" . esc_html__("Heading Font Size", "sanzo") . "</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Heading Font Size - H1", "sanzo")
						,"desc" 	=> esc_html__("In pixels. Default is 35px", "sanzo")
						,"id" 		=> "ts_font_size_heading_1"
						,"std" 		=> "34"
						,"min" 		=> "10"
						,"step"		=> "1"
						,"max" 		=> "50"
						,"type" 	=> "sliderui" 
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Heading Font Line Height - H1", "sanzo")
						,"desc" 	=> esc_html__("In pixels. Default is 42px", "sanzo")
						,"id" 		=> "ts_line_height_heading_1"
						,"std" 		=> "42"
						,"min" 		=> "10"
						,"step"		=> "1"
						,"max" 		=> "50"
						,"type" 	=> "sliderui" 
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Heading Font Size - H2", "sanzo")
						,"desc" 	=> esc_html__("In pixels. Default is 30px", "sanzo")
						,"id" 		=> "ts_font_size_heading_2"
						,"std" 		=> "30"
						,"min" 		=> "10"
						,"step"		=> "1"
						,"max" 		=> "50"
						,"type" 	=> "sliderui" 
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Heading Font Line Height - H2", "sanzo")
						,"desc" 	=> esc_html__("In pixels. Default is 38px", "sanzo")
						,"id" 		=> "ts_line_height_heading_2"
						,"std" 		=> "38"
						,"min" 		=> "10"
						,"step"		=> "1"
						,"max" 		=> "50"
						,"type" 	=> "sliderui" 
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Heading Font Size - H3", "sanzo")
						,"desc" 	=> esc_html__("In pixels. Default is 22px", "sanzo")
						,"id" 		=> "ts_font_size_heading_3"
						,"std" 		=> "22"
						,"min" 		=> "10"
						,"step"		=> "1"
						,"max" 		=> "50"
						,"type" 	=> "sliderui" 
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Heading Font Line Height - H3", "sanzo")
						,"desc" 	=> esc_html__("In pixels. Default is 28px", "sanzo")
						,"id" 		=> "ts_line_height_heading_3"
						,"std" 		=> "28"
						,"min" 		=> "10"
						,"step"		=> "1"
						,"max" 		=> "50"
						,"type" 	=> "sliderui" 
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Heading Font Size - H4", "sanzo")
						,"desc" 	=> esc_html__("In pixels. Default is 20px", "sanzo")
						,"id" 		=> "ts_font_size_heading_4"
						,"std" 		=> "18"
						,"min" 		=> "10"
						,"step"		=> "1"
						,"max" 		=> "50"
						,"type" 	=> "sliderui" 
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Heading Font Line Height - H4", "sanzo")
						,"desc" 	=> esc_html__("In pixels. Default is 24px", "sanzo")
						,"id" 		=> "ts_line_height_heading_4"
						,"std" 		=> "24"
						,"min" 		=> "10"
						,"step"		=> "1"
						,"max" 		=> "50"
						,"type" 	=> "sliderui" 
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Heading Font Size - H5", "sanzo")
						,"desc" 	=> esc_html__("In pixels. Default is 18px", "sanzo")
						,"id" 		=> "ts_font_size_heading_5"
						,"std" 		=> "16"
						,"min" 		=> "10"
						,"step"		=> "1"
						,"max" 		=> "50"
						,"type" 	=> "sliderui" 
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Heading Font Line Height - H5", "sanzo")
						,"desc" 	=> esc_html__("In pixels. Default is 24px", "sanzo")
						,"id" 		=> "ts_line_height_heading_5"
						,"std" 		=> "24"
						,"min" 		=> "10"
						,"step"		=> "1"
						,"max" 		=> "50"
						,"type" 	=> "sliderui" 
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Heading Font Size - H6", "sanzo")
						,"desc" 	=> esc_html__("In pixels. Default is 16px", "sanzo")
						,"id" 		=> "ts_font_size_heading_6"
						,"std" 		=> "14"
						,"min" 		=> "10"
						,"step"		=> "1"
						,"max" 		=> "50"
						,"type" 	=> "sliderui" 
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Heading Font Line Height - H6", "sanzo")
						,"desc" 	=> esc_html__("In pixels. Default is 22px", "sanzo")
						,"id" 		=> "ts_line_height_heading_6"
						,"std" 		=> "22"
						,"min" 		=> "10"
						,"step"		=> "1"
						,"max" 		=> "50"
						,"type" 	=> "sliderui" 
				);

/***************************/ 
/* Header Options		   */
/***************************/				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Header", "sanzo")
						,"type" 	=> "heading"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Header Options", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_header_options"
						,"std" 		=> "<h3>" . esc_html__("Header Options", "sanzo") . "</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Header Layout", "sanzo")
						,"id" 		=> "ts_header_layout"
						,"std" 		=> "v1"
						,"type" 	=> "images"
						,"options" 	=> array(
							'v1' 	=> ADMIN_IMAGES . 'header/header_v1.jpg'
							,'v2' 	=> ADMIN_IMAGES . 'header/header_v2.jpg'
							,'v3' 	=> ADMIN_IMAGES . 'header/header_v3.jpg'
							,'v4' 	=> ADMIN_IMAGES . 'header/header_v4.jpg'
							,'v5' 	=> ADMIN_IMAGES . 'header/header_v5.jpg'
							,'v6' 	=> ADMIN_IMAGES . 'header/header_v6.jpg'
							,'v7' 	=> ADMIN_IMAGES . 'header/header_v7.jpg'
							,'v8' 	=> ADMIN_IMAGES . 'header/header_v8.jpg'
							,'v9' 	=> ADMIN_IMAGES . 'header/header_v9.jpg'
						)
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Bottom Header Padding", "sanzo")
						,"desc" 	=> esc_html__("Add padding to the bottom header. This option is only used for the first header layout (boxed style)", "sanzo")
						,"id" 		=> "ts_bottom_header_padding"
						,"std" 		=> 1
						,"icon" 	=> true
						,"type" 	=> "switch"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Search Popup Background", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_bg_search_image"
						,"std"		=> $df_bg_search_image_uri
						,"type" 	=> "upload"
				);			
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Header Contact Information", "sanzo")
						,"desc" 	=> esc_html__("You can add your email, phone number", "sanzo")
						,"id" 		=> "ts_header_contact_information"
						,"std"		=> "Hotline +89 984 90499" 
						,"type" 	=> "textarea"
					);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Middle Header Content", "sanzo")
						,"desc" 	=> esc_html__("This option is only used for the second and fourth header layouts", "sanzo")
						,"id" 		=> "ts_middle_header_content"
						,"std"		=> '<img src="'.$df_header_contact.'" alt="sanzo" />'
						,"type" 	=> "textarea"
					);		

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Vertical Menu Style", "sanzo")
						,"id" 		=> "ts_vertical_menu_style"
						,"std" 		=> "normal"
						,"type" 	=> "select"
						,"options" 	=> array(
								'normal'	=> esc_html__('Normal', 'sanzo')
								,'big'		=> esc_html__('Big', 'sanzo')
						)
					);					
					
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Header Currency", "sanzo")
						,"desc" 	=> esc_html__("If you don't install WooCommerce Multilingual plugin, it will display demo html", "sanzo")
						,"id" 		=> "ts_header_currency"
						,"std"		=> "1"
						,"on"		=> esc_html__("Enable", "sanzo")
						,"off"		=> esc_html__("Disable", "sanzo")
						,"type" 	=> "switch"
					);
					
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Header Language", "sanzo")
						,"desc" 	=> esc_html__("If you don't install WPML plugin, it will display demo html", "sanzo")
						,"id" 		=> "ts_header_language"
						,"std"		=> '1'
						,"on"		=> esc_html__("Enable", "sanzo")
						,"off"		=> esc_html__("Disable", "sanzo")
						,"type" 	=> "switch"
					);
					
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Shopping Cart", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_enable_tiny_shopping_cart"
						,"std" 		=> "1"
						,"on"		=> esc_html__("Enable", "sanzo")
						,"off"		=> esc_html__("Disable", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Search Bar", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_enable_search"
						,"std" 		=> "1"
						,"on"		=> esc_html__("Enable", "sanzo")
						,"off"		=> esc_html__("Disable", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("My Account", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_enable_tiny_account"
						,"std" 		=> "1"
						,"on"		=> esc_html__("Enable", "sanzo")
						,"off"		=> esc_html__("Disable", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Wishlist", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_enable_tiny_wishlist"
						,"std" 		=> "1"
						,"on"		=> esc_html__("Enable", "sanzo")
						,"off"		=> esc_html__("Disable", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Sticky Header", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_enable_sticky_header"
						,"std" 		=> "1"
						,"on"		=> esc_html__("Enable", "sanzo")
						,"off"		=> esc_html__("Disable", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Header Product Categories Slider", "sanzo")
						,"desc" 	=> esc_html__("Some header layouts don't include the product categories slider. In the Product Category editor, you add thumbnail to the Header Thumbnail option", "sanzo")
						,"id" 		=> "introduction_header_product_categories"
						,"std" 		=> "<h4>" . esc_html__("Header Product Categories Slider", "sanzo") . "</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Enable Product Categories Slider", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_enable_product_categories"
						,"std" 		=> "1"
						,"on"		=> esc_html__("Enable", "sanzo")
						,"off"		=> esc_html__("Disable", "sanzo")
						,"type" 	=> "switch"
				);	
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Number of product categories", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_number_product_categories"
						,"std" 		=> "10"
						,"type" 	=> "text"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Include these product categories", "sanzo")
						,"desc" 	=> esc_html__("A comma separated list of the product categories ids", "sanzo")
						,"id" 		=> "ts_include_product_categories"
						,"std" 		=> ""
						,"type" 	=> "text"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Header Social Icons", "sanzo")
						,"desc" 	=> esc_html__("Some header layouts don't include the social icons", "sanzo")
						,"id" 		=> "introduction_header_social_icons"
						,"std" 		=> "<h4>" . esc_html__("Header Social Icons", "sanzo") . "</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Facebook URL", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_facebook_url"
						,"std" 		=> "#"
						,"type" 	=> "text"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Twitter URL", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_twitter_url"
						,"std" 		=> "#"
						,"type" 	=> "text"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Youtube URL", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_youtube_url"
						,"std" 		=> "#"
						,"type" 	=> "text"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Instagram URL", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_instagram_url"
						,"std" 		=> "#"
						,"type" 	=> "text"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("LinkedIn URL", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_linkedin_url"
						,"std" 		=> "#"
						,"type" 	=> "text"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Custom Icon URL", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_custom_social_url"
						,"std" 		=> ""
						,"type" 	=> "text"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Custom Icon Class", "sanzo")
						,"desc" 	=> esc_html__("Use FontAwesome. Ex: fa-facebook", "sanzo")
						,"id" 		=> "ts_custom_social_class"
						,"std" 		=> ""
						,"type" 	=> "text"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Breadcrumb Options", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_breadcrumb_images"
						,"std" 		=> "<h3>" . esc_html__("Breadcrumb Options", "sanzo") . "</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Breadcrumb Layout", "sanzo")
						,"desc" 	=> esc_html__("Layout #1 does not support background image", "sanzo")
						,"id" 		=> "ts_breadcrumb_layout"
						,"std" 		=> "v1"
						,"type" 	=> "images"
						,"options" 	=> array(
							'v1' 	=> ADMIN_IMAGES . 'breadcrumb/breadcrumb_v1.jpg'
							,'v2' 	=> ADMIN_IMAGES . 'breadcrumb/breadcrumb_v2.jpg'
							,'v3' 	=> ADMIN_IMAGES . 'breadcrumb/breadcrumb_v3.jpg'
						)
				);	
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Breadcrumb Background Image", "sanzo")
						,"desc" 	=> esc_html__("Select a new image to replace the default background image", "sanzo")
						,"id" 		=> "ts_bg_breadcrumbs"
						,"std"		=> "" 
						,"type" 	=> "upload"
					);
					
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Enable Breadcrumb Background Image", "sanzo")
						,"desc" 	=> esc_html__("Layout #1 does not support background image", "sanzo")
						,"id" 		=> "ts_enable_breadcrumb_background_image"
						,"std" 		=> 1
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Enable Breadcrumb Background Parallax", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_breadcrumb_bg_parallax"
						,"std" 		=> 0
						,"type" 	=> "switch"
				);

/***************************/
/* Menu - Mega Menu Options*/
/***************************/				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Menu", "sanzo")
						,"type" 	=> "heading"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Mega Menu", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "mega_menu"
						,"std" 		=> "<h3>" . esc_html__("Mega Menu", "sanzo") . "</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Mega Menu Widget Area", "sanzo")
						,"desc" 	=> esc_html__("Number Mega Menu Widget Area. Min: 1, max: 30, step: 1, default value: 12", "sanzo")
						,"id" 		=> "ts_menu_num_widget"
						,"std" 		=> "12"
						,"min" 		=> "1"
						,"step"		=> "1"
						,"max" 		=> "30"
						,"type" 	=> "sliderui" 
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Menu Thumbnail Size", "sanzo")
						,"desc" 	=> esc_html__("Thumbnail width. Min: 5, max: 50, step: 1, default value: 25", "sanzo")
						,"id" 		=> "ts_menu_thumb_width"
						,"std" 		=> "25"
						,"min" 		=> "5"
						,"step"		=> "1"
						,"max" 		=> "50"
						,"type" 	=> "sliderui" 
				);
				
$sanzo_of_options[] = array( 	"name" 		=> ""
						,"desc" 	=> esc_html__("Thumbnail height. Min: 5, max: 50, step: 1, default value: 25", "sanzo")
						,"id" 		=> "ts_menu_thumb_height"
						,"std" 		=> "25"
						,"min" 		=> "5"
						,"step"		=> "1"
						,"max" 		=> "50"
						,"type" 	=> "sliderui" 
				);
				
/***************************/ 
/* Blog Options			   */
/***************************/
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Blog", "sanzo")
						,"type" 	=> "heading"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Blog", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "blog"
						,"std" 		=> "<h3>" . esc_html__("Blog", "sanzo") . "</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Blog Layout", "sanzo")
						,"desc" 	=> esc_html__("It is available when Front page displays the latest posts", "sanzo")
						,"id" 		=> "ts_blog_layout"
						,"std" 		=> "0-1-0"
						,"type" 	=> "images"
						,"options" 	=> array(
							'0-1-0' 	=> ADMIN_IMAGES . '1col.png'
							,'0-1-1' 	=> ADMIN_IMAGES . '2cr.png'
							,'1-1-0' 	=> ADMIN_IMAGES . '2cl.png'
							,'1-1-1' 	=> ADMIN_IMAGES . '3cm.png'
						)
				);	
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Left Sidebar", "sanzo")
						,"id" 		=> "ts_blog_left_sidebar"
						,"std" 		=> "blog-sidebar"
						,"type" 	=> "select"
						,"options" 	=> $of_sidebars
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Right Sidebar", "sanzo")
						,"id" 		=> "ts_blog_right_sidebar"
						,"std" 		=> "blog-sidebar"
						,"type" 	=> "select"
						,"options" 	=> $of_sidebars
				);	
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Blog Thumbnail", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_thumbnail"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Blog Date", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_date"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Blog Title", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_title"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Blog Author", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_author"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Blog Comment", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_comment"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Blog Read More Button", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_read_more"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Blog Categories", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_categories"
						,"std" 		=> 0
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Blog Sharing", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_sharing"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Blog Excerpt", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_excerpt"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Blog Excerpt Strip All Tags", "sanzo")
						,"desc" 	=> esc_html__("Strip all html tags in Excerpt", "sanzo")
						,"id" 		=> "ts_blog_excerpt_strip_tags"
						,"std" 		=> 0
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Blog Excerpt Max Words", "sanzo")
						,"desc" 	=> esc_html__("Input -1 to show full excerpt", "sanzo")
						,"id" 		=> "ts_blog_excerpt_max_words"
						,"std" 		=> "-1"
						,"type" 	=> "text"
				);

/*** Blog Details ***/
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Blog Details", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "blog_details"
						,"std" 		=> "<h3>" . esc_html__("Blog Details", "sanzo") . "</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);				
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Blog Details Layout", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_details_layout"
						,"std" 		=> "0-1-1"
						,"type" 	=> "images"
						,"options" 	=> array(
							'0-1-0' 	=> ADMIN_IMAGES . '1col.png'
							,'0-1-1' 	=> ADMIN_IMAGES . '2cr.png'
							,'1-1-0' 	=> ADMIN_IMAGES . '2cl.png'
							,'1-1-1' 	=> ADMIN_IMAGES . '3cm.png'
						)
				);	
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Left Sidebar", "sanzo")
						,"id" 		=> "ts_blog_details_left_sidebar"
						,"std" 		=> "blog-detail-sidebar"
						,"type" 	=> "select"
						,"options" 	=> $of_sidebars
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Right Sidebar", "sanzo")
						,"id" 		=> "ts_blog_details_right_sidebar"
						,"std" 		=> "blog-detail-sidebar"
						,"type" 	=> "select"
						,"options" 	=> $of_sidebars
				);								

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Blog Thumbnail", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_details_thumbnail"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Blog Date", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_details_date"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Blog Title", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_details_title"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Blog Content", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_details_content"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Blog Tags", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_details_tags"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Blog Categories", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_details_categories"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Blog Sharing", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_details_sharing"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Blog Like", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_details_like"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Blog Author Box", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_details_author_box"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Blog Related Posts", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_details_related_posts"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Blog Comment Form", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_details_comment_form"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
/***************************/ 
/* Portfolio Config      */
/***************************/ 
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Portfolio Details", "sanzo")
						,"type" 	=> "heading"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Layout Style", "sanzo")
						,"id" 		=> "ts_portfolio_layout_style"
						,"std" 		=> "layout-1"
						,"type" 	=> "select"
						,"options" 	=> array(
								'layout-1'	=> esc_html__('Layout 1', 'sanzo')
								,'layout-2'	=> esc_html__('Layout 2', 'sanzo')
						)
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Portfolio Thumbnail", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_portfolio_thumbnail"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Portfolio Title", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_portfolio_title"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Portfolio Like", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_portfolio_likes"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Portfolio Content", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_portfolio_content"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);	
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Portfolio Date", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_portfolio_date"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Portfolio URL", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_portfolio_url"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Portfolio Categories", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_portfolio_categories"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Portfolio Sharing", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_portfolio_sharing"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Portfolio Related Posts", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_portfolio_related_posts"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Portfolio Custom Field", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_portfolio_custom_field"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);	

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Portfolio Custom Field Title", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_portfolio_custom_field_title"
						,"std" 		=> "Custom Field"
						,"type" 	=> "text"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Portfolio Custom Field Content", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_portfolio_custom_field_content"
						,"std" 		=> "Custom content goes here"
						,"type" 	=> "textarea"
				);				
				
/***************************/ 
/* WooCommerce Config      */
/***************************/ 
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("WooCommerce", "sanzo")
						,"type" 	=> "heading"
				);
				
/* Product Label */				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Label", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "product_label_options"
						,"std" 		=> "<h3>" . esc_html__("Product Label", "sanzo") . "</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);	

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Show New Label", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_show_new_label"
						,"std" 		=> 0
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product New Label Text", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_new_label_text"
						,"std" 		=> "New"
						,"fold" 	=> "ts_product_show_new_label"
						,"type" 	=> "text"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product New Label Time", "sanzo")
						,"desc" 	=> esc_html__("Number of days which you want to show New label since product is published", "sanzo")
						,"id" 		=> "ts_product_show_new_label_time"
						,"std" 		=> 30
						,"fold" 	=> "ts_product_show_new_label"
						,"type" 	=> "text"
				);				
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Sale Label Text", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_sale_label_text"
						,"std" 		=> "Sale"
						,"type" 	=> "text"
				);	

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Feature Label Text", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_feature_label_text"
						,"std" 		=> "Hot"
						,"type" 	=> "text"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Out Of Stock Label Text", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_out_of_stock_label_text"
						,"std" 		=> "Sold out"
						,"type" 	=> "text"
				);				
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Show Sale Label As", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_show_sale_label_as"
						,"std" 		=> "text"
						,"type" 	=> "select"
						,"options" 	=> array(
							'text' 		=> esc_html__('Text', 'sanzo')
							,'number' 	=> esc_html__('Number', 'sanzo')
							,'percent' 	=> esc_html__('Percent', 'sanzo')
						)
				);
				
/* Product Style Hover */
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Hover Style", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "prod_hover_style_options"
						,"std" 		=> "<h3>" . esc_html__("Product Hover Style", "sanzo") . "</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Hover Style", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_effect_hover_product_style"
						,"std" 		=> "style-1"
						,"type" 	=> "select"
						,"options" 	=> array(
							'style-1'		=> esc_html__('Style 1', 'sanzo')
							,'style-2' 		=> esc_html__('Style 2', 'sanzo')
						)
				);
/* Back Image */				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Back Product Image", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_enable_img_back"
						,"std" 		=> "<h3>" . esc_html__("Back Product Image", "sanzo") . "</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);	
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Enable Back Product Image", "sanzo")
						,"desc" 	=> esc_html__("Show back product image on hover. It will show an image from Product Gallery", "sanzo")
						,"id" 		=> "ts_effect_product"
						,"std" 		=> "1"
						,"type" 	=> "switch"
				);
				
/* Product Lazy Load */
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Lazy Load", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "prod_lazy_load_options"
						,"std" 		=> "<h3>" . esc_html__("Lazy Load", "sanzo") . "</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Activate Lazy Load", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_lazy_load"
						,"std" 		=> 1
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Placeholder Image", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_placeholder_img"
						,"std"		=> $df_prod_placeholder_image_uri
						,"type" 	=> "upload"
				);
				
/* Quickshop */				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Quickshop", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "quickshop_options"
						,"std" 		=> "<h3>" . esc_html__("Quickshop", "sanzo") . "</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Activate Quickshop", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_enable_quickshop"
						,"std" 		=> 1
						,"type" 	=> "switch"
				);
				
/* Catalog Mode */				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Catalog Mode", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_catalog_mode"
						,"std" 		=> "<h3>" . esc_html__("Catalog Mode", "sanzo") . "</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);	
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Enable Catalog Mode", "sanzo")
						,"desc" 	=> esc_html__("Hide all Add To Cart buttons on your site. You can also hide Shopping cart by going to Header tab > turn the Shopping Cart option off", "sanzo")
						,"id" 		=> "ts_enable_catalog_mode"
						,"std" 		=> "0"
						,"type" 	=> "switch"
				);
								
/* Ajax Search */				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Ajax Search", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ajax_search_options"
						,"std" 		=> "<h3>" . esc_html__("Ajax Search", "sanzo") . "</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Enable Ajax Search", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_ajax_search"
						,"std" 		=> "1"
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Number Of Results", "sanzo")
						,"desc" 	=> esc_html__("Input -1 to show all results", "sanzo")
						,"id" 		=> "ts_ajax_search_number_result"
						,"std" 		=> 3
						,"type" 	=> "text"
				);
				
/***************************/ 
/* Product Category Config */
/***************************/ 
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Category", "sanzo")
						,"type" 	=> "heading"
				);				

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Category Layout", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_cat_layout"
						,"std" 		=> "0-1-0"
						,"type" 	=> "images"
						,"options" 	=> array(
							'0-1-0' 	=> ADMIN_IMAGES . '1col.png'
							,'0-1-1' 	=> ADMIN_IMAGES . '2cr.png'
							,'1-1-0' 	=> ADMIN_IMAGES . '2cl.png'
							,'1-1-1' 	=> ADMIN_IMAGES . '3cm.png'
						)
				);	
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Left Sidebar", "sanzo")
						,"id" 		=> "ts_prod_cat_left_sidebar"
						,"std" 		=> "product-category-sidebar"
						,"type" 	=> "select"
						,"options" 	=> $of_sidebars
				);	
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Right Sidebar", "sanzo")
						,"id" 		=> "ts_prod_cat_right_sidebar"
						,"std" 		=> "product-category-sidebar"
						,"type" 	=> "select"
						,"options" 	=> $of_sidebars
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Columns", "sanzo")
						,"id" 		=> "ts_prod_cat_columns"
						,"std" 		=> "5"
						,"type" 	=> "select"
						,"options" 	=> array(
									3	=> 3
									,4	=> 4
									,5	=> 5
									,6	=> 6
									)
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Number of products per page", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_cat_per_page"
						,"std" 		=> 20
						,"type" 	=> "text"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Meta Align", "sanzo")
						,"id" 		=> "ts_prod_cat_meta_align"
						,"std" 		=> ""
						,"type" 	=> "select"
						,"options" 	=> array(
									''			=> esc_html__('Default', 'sanzo')
									,'center'	=> esc_html__('Center', 'sanzo')
									)
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Thumbnail", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_cat_thumbnail"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Label", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_cat_label"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Categories", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_cat_cat"
						,"std" 		=> 0
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Title", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_cat_title"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product SKU", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_cat_sku"
						,"std" 		=> 0
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Rating", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_cat_rating"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Price", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_cat_price"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Add To Cart Button", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_cat_add_to_cart"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Short Description - Grid View", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_cat_grid_desc"
						,"std" 		=> 0
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Short Description - Grid View - Limit Words", "sanzo")
						,"desc" 	=> esc_html__("Number of words of product description on grid view. It is also used for product shortcode", "sanzo")
						,"id" 		=> "ts_prod_cat_grid_desc_words"
						,"std" 		=> 8
						,"type" 	=> "text"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Short Description - List View", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_cat_list_desc"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Short Description - List View - Limit Words", "sanzo")
						,"desc" 	=> esc_html__("Number of words of product description on list view", "sanzo")
						,"id" 		=> "ts_prod_cat_list_desc_words"
						,"std" 		=> 50
						,"type" 	=> "text"
				);
				
/***************************/ 
/* Product Details Config  */
/***************************/ 
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Details", "sanzo")
						,"type" 	=> "heading"
				);	
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Layout", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_layout"
						,"std" 		=> "1-1-0"
						,"type" 	=> "images"
						,"options" 	=> array(
							'0-1-0' 	=> ADMIN_IMAGES . '1col.png'
							,'0-1-1' 	=> ADMIN_IMAGES . '2cr.png'
							,'1-1-0' 	=> ADMIN_IMAGES . '2cl.png'
							,'1-1-1' 	=> ADMIN_IMAGES . '3cm.png'
						)
				);	
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Left Sidebar", "sanzo")
						,"id" 		=> "ts_prod_left_sidebar"
						,"std" 		=> "product-detail-sidebar"
						,"type" 	=> "select"
						,"options" 	=> $of_sidebars
				);	
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Right Sidebar", "sanzo")
						,"id" 		=> "ts_prod_right_sidebar"
						,"std" 		=> "product-detail-sidebar"
						,"type" 	=> "select"
						,"options" 	=> $of_sidebars
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Cloud Zoom", "sanzo")
						,"desc" 	=> esc_html__("If you turn it off, product gallery images will open in a lightbox", "sanzo")
						,"id" 		=> "ts_prod_cloudzoom"
						,"std" 		=> 1
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Attribute Dropdown", "sanzo")
						,"desc"		=> esc_html__("If you turn it off, the dropdown will be replaced by image or text label", "sanzo")
						,"id" 		=> "ts_prod_attr_dropdown"
						,"std" 		=> 1
						,"type" 	=> "switch"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Next/Prev Product Navigation", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_next_prev_navigation"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Thumbnail", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_thumbnail"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Label", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_label"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Title", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_title"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Rating", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_rating"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product SKU", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_sku"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Availability", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_availability"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Excerpt", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_excerpt"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Count Down", "sanzo")
						,"desc" 	=> esc_html__("You have to activate ThemeSky plugin", "sanzo")
						,"id" 		=> "ts_prod_count_down"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Price", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_price"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Add To Cart Button", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_add_to_cart"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Categories", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_cat"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Tags", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_tag"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Sharing", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_sharing"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Thumbnails", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_product_thumbnails"
						,"std" 		=> "<h3>" . esc_html__("Product Thumbnails", "sanzo") . "</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Thumbnails Style", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_thumbnails_style"
						,"std" 		=> "horizontal" 
						,"type" 	=> "select"
						,"options"	=> array(
									'horizontal'	=> esc_html__('Horizontal', 'sanzo')
									,'vertical'		=> esc_html__('Vertical', 'sanzo')
								)
				);				
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Tabs", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_product_tabs"
						,"std" 		=> "<h3>" . esc_html__("Product Tabs", "sanzo") . "</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);	
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Tabs", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_tabs"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Tabs As Accordion", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_accordion_tabs"
						,"std" 		=> 0
						,"fold"		=> "ts_prod_tabs"
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Tabs Position", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_tabs_position"
						,"std" 		=> "after_summary" 
						,"fold"		=> "ts_prod_tabs"
						,"type" 	=> "select"
						,"options"	=> array(
									'after_summary'		=> esc_html__('After Summary', 'sanzo')
									,'inside_summary'	=> esc_html__('Inside Summary', 'sanzo')
								)
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Custom Tab", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_custom_tab"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"fold"		=> "ts_prod_tabs"
						,"type" 	=> "switch"
				);

$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Custom Tab Title", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_custom_tab_title"
						,"std" 		=> "Custom tab"
						,"fold"		=> "ts_prod_tabs"
						,"type" 	=> "text"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Product Custom Tab Content", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_custom_tab_content"
						,"std" 		=> "Your custom content goes here. You can add the content for individual product"
						,"fold"		=> "ts_prod_tabs"
						,"type" 	=> "textarea"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Ads Banner", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_product_ads_banner"
						,"std" 		=> "<h3>" . esc_html__("Ads Banner", "sanzo") . "</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);	
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Ads Banner", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_ads_banner"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Ads Banner Content", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_ads_banner_content"
						,"std" 		=> '[vc_row layout="ts-row-wide" el_class="fix-column-no-margin"][vc_column width="1/3"][ts_single_image img_url="'.$df_product_banner_1.'" link="#" style_effect="eff-border-scale" target="_self"][/vc_column][vc_column width="1/3"][ts_single_image img_url="'.$df_product_banner_2.'" link="#" style_effect="eff-border-scale" target="_self"][/vc_column][vc_column width="1/3"][ts_single_image img_url="'.$df_product_banner_3.'" link="#" style_effect="eff-border-scale" target="_self"][/vc_column][/vc_row]'
						,"fold"		=> "ts_prod_ads_banner"
						,"type" 	=> "textarea"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Related - Up-Sell Products", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "introduction_related_upsell_product"
						,"std" 		=> "<h3>" . esc_html__("Related - Up-Sell Products", "sanzo") . "</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);	
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Up-Sell Products", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_upsells"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Related Products", "sanzo")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_related"
						,"std" 		=> 0
						,"on"		=> esc_html__("Show", "sanzo")
						,"off"		=> esc_html__("Hide", "sanzo")
						,"type" 	=> "switch"
				);
				
/***************************/ 
/* Custom CSS/JS Options      */
/***************************/			
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Custom CSS/JS", "sanzo")
						,"type" 	=> "heading"
						,"icon"		=> ADMIN_IMAGES . "icon-custom.png"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Custom CSS Code", "sanzo")
						,"desc" 	=> esc_html__("You don't need to add the style tag", "sanzo")
						,"id" 		=> "ts_custom_css_code"
						,"std" 		=> ""
						,"type" 	=> "css_field"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Custom Javascript Code", "sanzo")
						,"desc" 	=> esc_html__("You don't need to add the script tag", "sanzo")
						,"id" 		=> "ts_custom_javascript_code"
						,"std" 		=> ""
						,"type" 	=> "js_field"
				);

/***************************/ 
/* Backup Options          */
/***************************/
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Backup", "sanzo")
						,"type" 	=> "heading"
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Backup and Restore Options", "sanzo")
						,"id" 		=> "of_backup"
						,"std" 		=> ""
						,"type" 	=> "backup"
						,"desc" 	=> esc_html__("You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.", "sanzo")
				);
				
$sanzo_of_options[] = array( 	"name" 		=> esc_html__("Transfer Theme Options Data", "sanzo")
						,"id" 		=> "of_transfer"
						,"std" 		=> ""
						,"type" 	=> "transfer"
						,"desc" 	=> esc_html__("You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click the Import Options button.", "sanzo")
				);
				
	}
}
?>