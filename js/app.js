App.tx = {
	'cs_CZ': {
		'Available': 'Dostupný',
		'Not Available': 'Nedostupný',
		'BOOK': 'VYBRAT',
		'Your details:': 'Vaše údaje:',
		'Contact details:': 'Kontakt',
		'Phone:': 'Tel.:',
		'Your Booking': 'Vaše rezervace',
		'Back': 'Zpět',
		'GO TO PAYMENT': 'ZAPLATIT',
		'Amount:': 'Celkem',
		'Male': 'Muž',
		'Female': 'Žena',
		'Payment': 'Platba',
		'Your Order': 'Číslo zakázky',
		'E-EN': 'CZ',
	},
	'en_CZ': {
	}
};

var __ = function (str) {
	if (App.tx[App.locale] && App.tx[App.locale][str]) return App.tx[App.locale][str];
	return str;
};
