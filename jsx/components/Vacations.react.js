var React = require('react');
var AppStore   = require('../stores/AppStore');
var AppActions = require('../actions/AppActions');
var AppAPI     = require('../utils/AppAPI');
var User       = require('../components/User.react.js');
var Timegrid   = require('../components/Timegrid.react.js');

/**
 * Retrieve the current data from the AppStore
 */
function getAppState() {
	return {
		users: AppStore.get_users(),
		from: moment(),
		timespan:  moment.duration(3, "months")
	};
}

var Vacations = React.createClass({
	getInitialState: function() {
		return getAppState();
	},
	// subscribe to changes on AppStore
	componentDidMount: function () {
		AppStore.addChangeListener(this._onChange);
	},
	componentWillUnmount: function() {
		AppStore.removeChangeListener(this._onChange);
 	},
	// callback for changes on AppStore
	_onChange: function() {
		this.setState(getAppState());
	},
	render: function() {
		var all_users = AppStore.get_users();
		var users = [];
		for (var id in all_users) {
			users.push(<User key={id} user={all_users[id]} />);
		}
		if (users.length == 0) {
			users = <div className="none">Alas! No users</div>;
		}

		return (
			<div>
				<div className="row">
					<div className="col-md-12">
						<div className="page-header">
							<h1>Calendar</h1>
						</div>
					</div>
				</div>

				<div className="row">
					<div className="col-md-2">
						{users}
					</div>
					<div className="col-md-10">
						<Timegrid users={all_users}/>
					</div>
				</div>
			</div>
		);
	}
});

module.exports = Vacations;
