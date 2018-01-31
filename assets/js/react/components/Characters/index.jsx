import React from 'react';
import PropTypes from 'prop-types';
import { connect } from 'react-redux';
import { createSelector } from 'reselect';
import actions from '../../actions/character';
import Filtering from './Filtering';
import List from './List';

class Characters extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      phrase: '',
    };
    this.props.getAll();
  }

  changePhrase = (e) => {
    this.setState({
      phrase: e.target.value,
    });
  }

  render() {

    return (
      <div >
        <div>
          <Filtering changePhrase={this.changePhrase} />
        </div>
        <List
          phrase={this.state.phrase}
          characters={this.props.characters}
        />
      </div>
    );
  }
}

Characters.propTypes = {
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
  //filter: actions.filterCharacters,
};

export default connect(mapStateToProps, mapDispatchToProps)(Characters);
