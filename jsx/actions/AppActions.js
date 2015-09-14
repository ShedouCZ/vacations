var AppDispatcher = require('../dispatcher/AppDispatcher');
var AppConstants  = require('../constants/AppConstants');

var AppActions = {
	// User list has just arrived!
	receive_users: function(users) {
		AppDispatcher.dispatch({
			actionType: AppConstants.RECEIVE_USERS,
			data: users
		});
	},
	setDates: function(start, end) {
		AppDispatcher.dispatch({
			actionType: AppConstants.SET_NIGHTS,
			data: {
				start: start,
				end: end
			}
		});
	}
};

module.exports = AppActions;
