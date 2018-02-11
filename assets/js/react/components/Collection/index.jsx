import React from 'react'
import PropTypes from 'prop-types'
import { Link } from 'react-router-dom'
import { connect } from 'react-redux'
import { createSelector } from 'reselect'
import actions from '../../actions/user'
import Toon from '../components/Toon'
import Filtering from '../components/Filtering'

class Dashboard extends React.Component {
  constructor(props) {
    super(props)
    this.state = {
      phrase: '',
    }
    this.props.fetchUserCharacter()
  }

  changePhrase = (e) => {
    this.setState({
      phrase: e.target.value,
    })
  }

  render() {
    if (this.props.userCharacters.length === 0) {
      return (
        <div className="alert alert-danger">
          You need to map your user uuid <Link to={'/account'}>HERE</Link>
        </div>
      )
    }

    return (
      <div className="row">
        <Filtering changePhrase={this.changePhrase} />
        {this.props.userCharacters
          .filter(toon => toon.character.name.toLowerCase().indexOf(this.state.phrase) > -1)
          .map(toon => <Toon
            toon={toon}
          />)}
      </div>
    )
  }
}

Dashboard.propTypes = {
  fetchUserCharacter: PropTypes.func.isRequired,
}

const getCharacters = state => state.user.userCharacters

const selector = createSelector(
  getCharacters,
  userCharacters => userCharacters,
)

function mapStateToProps(state) {
  return {
    userCharacters: selector(state),
  }
}

const mapDispatchToProps = {
  fetchUserCharacter: actions.fetchPersonalCollection,
}

export default connect(mapStateToProps, mapDispatchToProps)(Dashboard)
