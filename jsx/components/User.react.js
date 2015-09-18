var React = require('react');

var User = React.createClass({
	render: function() {
		var className = "user";
		return (
			<div className={className}>
				<span>{this.props.user.User.fullname}</span>
			</div>
		);
	}
});

module.exports = User;
