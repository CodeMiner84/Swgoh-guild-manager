import React from 'react'
import PropTypes from 'prop-types'
import { Link } from 'react-router-dom'
import { connect } from 'react-redux'
import { createSelector } from 'reselect'
import actions from '../../actions/account'
import Toon from '../components/Toon'
import Loader from '../Loader/index'

class Dashboard extends React.Component {
  constructor(props) {
    super(props)
    this.props.fetchUserCharacter()
  }

  render() {
    if (this.props.isLoading) {
      return <Loader />
    }

    if (this.props.collection.userCharacters == undefined) {
      return (
        <div className="alert alert-danger">
          You need to map your user uuid <Link to={'/account'}>HERE</Link>
        </div>
      )
    }

    return (
      <div className="row">
        {this.props.collection.userCharacters
          .filter(toon => toon.character.name.toLowerCase().indexOf(this.props.phrase) > -1)
          .map(toon => <Toon toon={toon} />)}
      </div>
    )
  }
}

Dashboard.propTypes = {
  fetchUserCharacter: PropTypes.func.isRequired,
  phrase: PropTypes.string.isRequired,
}

const getCharacters = state => state.account.userCharacters
const checkLoading = state => state.account.isLoading

const selector = createSelector(
  getCharacters,
  checkLoading,
  (chars, loading) => ({
    userCharacters: chars,
    isLoading: loading,
  }),
)

function mapStateToProps(state) {
  return {
    collection: selector(state),
    isLoading: state.account.isLoading,
  }
}

const mapDispatchToProps = {
  fetchUserCharacter: actions.fetchPersonalCollection,
}

export default connect(mapStateToProps, mapDispatchToProps)(Dashboard)
