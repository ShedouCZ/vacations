var AppDispatcher = require('../dispatcher/AppDispatcher');
var EventEmitter = require('events').EventEmitter;
var AppConstants = require('../constants/AppConstants');
var assign = require('object-assign');

var CHANGE_EVENT = 'change';

var _users = [];
var _users_by_id = {};
//var _users_by_id = {null: {Room: {id:null}, Price: 0, Location: {id:null}}};
//var _upsells_by_location = {};
//var _upsells_by_id = {};

function receive_users(users) {
	// Have just received USERS list from the server API.
	_users = users;

	// construct lookup table
	for (var key in users) {
		var id = users[key].User.id;
		_users_by_id[id] = users[key];
	}
}

function receive_upsells(upsells) {
	// Have just received Upsell list from the server API.
	_upsells_by_location = upsells;

	// construct lookup table
	for (var location_id in upsells) {
		for (var key in upsells[location_id]) {
			var id = upsells[location_id][key].id;
			_upsells_by_id[id] = upsells[location_id][key];
		}
	}
}

var AppStore = assign({}, EventEmitter.prototype, {
	/**
	 * Get the entire collection of Rooms.
	 * @return {object}
	 */
	get_users: function() {
		return _users;
	},

	get_users_by_id: function() {
		return _users_by_id;
	},

	/* event emitter stuff */
	emitChange: function() {
		this.emit(CHANGE_EVENT);
	},
	addChangeListener: function(callback) {
		this.on(CHANGE_EVENT, callback);
	},
	removeChangeListener: function(callback) {
		this.removeListener(CHANGE_EVENT, callback);
	}
});

// Register callbacks to handle updates from dispatcher
AppDispatcher.register(function(action) {
	switch(action.actionType) {
		case AppConstants.RECEIVE_USERS:
			receive_users(action.data);
			AppStore.emitChange();
			break;

		case AppConstants.SET_SELECTED:
			set_selected_room(action.data);
			AppStore.emitChange();
			break;

		case AppConstants.SET_BEDS:
			set_selected_beds(action.data);
			AppStore.emitChange();
			break;

		case AppConstants.SET_NIGHTS:
			set_selected_nights(action.data);
			AppStore.emitChange();
			break;

		case AppConstants.ADD_UPSELL:
			set_selected_upsells(action.data);
			AppStore.emitChange();
			break;

		case AppConstants.ADD_MEAL:
			set_selected_meals(action.data);
			AppStore.emitChange();
			break;

		case AppConstants.ADD_QUERY:
			set_selected_queries(action.data);
			AppStore.emitChange();
			break;

		default:
		// no op
	}
});

module.exports = AppStore;
