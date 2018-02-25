import React from 'react';
import PropTypes from 'prop-types';
import { connect } from 'react-redux';
import { createSelector } from 'reselect';
import ReactTable from 'react-table';
import actions from '../../actions/guild';
import gridColumns from './gridColumns';


class Dashboard extends React.Component {
  constructor(props) {
    super(props);
    props.getAll();
  }

  render() {
    if (this.props.guilds.length === 0) {
      return (<div />);
    }

    return (
      <ReactTable
        data={this.props.guilds}
        columns={gridColumns}
        filterable
        defaultFilterMethod={(filter, row) =>
          String(row[filter.id]).toLowerCase().indexOf(filter.value.toLowerCase()) > -1}
      />
    );
  }
}

Dashboard.defaultProps = {
  disabledFiltering: false,
};

Dashboard.propTypes = {
  disabledFiltering: PropTypes.bool,
  getAll: PropTypes.func.isRequired,
  guilds: PropTypes.arrayOf(
    PropTypes.shape({
      code: PropTypes.string.isRequired,
      name: PropTypes.string.isRequired,
    }).isRequired,
  ).isRequired,
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
