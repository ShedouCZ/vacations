var React = require('react');
var AppStore = require('../stores/AppStore');

var User = React.createClass({
	componentDidMount: function () {
	},
	componentWillUnmount: function() {
 	},
	_onChange: function() {
	},
	onClick: function(e) {
		var $input = $(e.target).closest('.room').find('input');
		var room_id = $input.val();
		// set state on parent via a props.onClick callback
		this.props.onClick(room_id);
	},
	render: function() {
		var className = "user";
		if (this.props.selected) {
			className += " selected";
		}
		return (
			<div className={className} onClick={this.onClick}>
				<input checked={this.props.selected} ref={'user'+this.props.user.User.id} type="checkbox" name="data[User][]" value={this.props.user.User.id}/>
				<h2>
					<span>{this.props.user.User.fullname}</span>
				</h2>
				<p dangerouslySetInnerHTML={{__html:this.props.user.User.fullname}}></p>
			</div>
		);
	}
});

module.exports = User;
