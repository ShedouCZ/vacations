var AppActions = require('../actions/AppActions');

module.exports = {
	// Load mock product data into some Store via Action
	getData: function(start, end) {
		var url = window.location.href;
		url = App.base + '/api/get';
		$.get(url, function(data) {
			data = JSON.parse(data);
			AppActions.receive_users(data.users);
		});
	}
};
