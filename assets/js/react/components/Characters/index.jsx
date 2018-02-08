import React from 'react';
import PropTypes from 'prop-types';
import { connect } from 'react-redux';
import { createSelector } from 'reselect';
import actions from '../../actions/character';
import List from './List';

class Characters extends React.Component {
  constructor(props) {
    super(props);

    this.props.getAll();
  }

  render() {
    return (
      <div >
        <List
          phrase={this.props.phrase}
          characters={this.props.characters}
        />
      </div>
    );
  }
}

Characters.defaultProps = {
  phrase: '',
};

Characters.propTypes = {
  phrase: PropTypes.string,
  getAll: PropTypes.func.isRequired,
};

const getGuilds = state => state.character.characters;

const selector = createSelector(
  getGuilds,
  characters => characters,
);

function mapStateToProps(state) {
  return {
    characters: selector(state),
  };
}

const mapDispatchToProps = {
  getAll: actions.fetchCharacters,
};

export default connect(mapStateToProps, mapDispatchToProps)(Characters);
