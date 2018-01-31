import React from 'react';
import PropTypes from 'prop-types';
import { connect } from 'react-redux';
import { createSelector } from 'reselect';
import actions from '../../actions/guild';
import GuildList from './GuildList';

class Dashboard extends React.Component {
  constructor(props) {
    super(props);
    this.props.getAll();
  }

  render() {
    if (this.props.guilds.length === 0) {
      return (<div />);
    }

    return (
      <div >
        <GuildList guilds={this.props.guilds} />
      </div>
    );
  }
}

Dashboard.propTypes = {
  getAll: PropTypes.func.isRequired,
};

const getGuilds = state => state.guild.guilds;

const selector = createSelector(
  getGuilds,
  guilds => guilds,
);

function mapStateToProps(state) {
  return {
    guilds: selector(state),
  };
}

const mapDispatchToProps = {
  getAll: actions.fetchGuilds,
};

export default connect(mapStateToProps, mapDispatchToProps)(Dashboard);
