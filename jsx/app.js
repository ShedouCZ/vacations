var React = require('react');
var AppAPI = require('./utils/AppAPI');
var Vacations = require('./components/Vacations.react');

AppAPI.getData();

// initial render so we may setState
// DISABLED NOW
// DRAWED BY D3
// if ($('#Vacations').length) {
// 	App.booking = React.render(<Vacations/>, document.getElementById('Vacations'));
// }
