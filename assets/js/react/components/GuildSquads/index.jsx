import React from 'react'
import PropTypes from 'prop-types'
import { Link } from 'react-router-dom'
import { Route, withRouter, matchPath, Switch } from 'react-router-dom'
import { connect } from 'react-redux'
import { createSelector } from 'reselect'
import actions from '../../actions/user'
import List from './List'
import BuildForm from './Form'
import EditForm from './EditForm'
import Builder from './Builder'

class GuildSquads extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
      submitting: false,
      saved: false,
    }
  }


  handleSubmit = (event) => {
    const params = {
      favGuild: event.favGuild,
      uuid: event.uuid,
    }

    this.props.updateAccount(params).then(() => {
      this.setState({
        saved: true,
      })
    })
  }

  render() {
    return (
      <div>
        <div className={'container'}>
          <div className={'btn-group mb-3'}>
            <Link to={'/guild-squads'} className={'btn btn-info btn-sm'}>View squads</Link>
            <Link to={'/guild-squads/add'} className={'btn btn-info btn-sm'}>Add squad</Link>
          </div>
        </div>
        <Switch >
          <Route exact path="/guild-squads" component={List} />
          <Route exact path="/guild-squads/add" component={BuildForm} />
          <Route exact path="/guild-squads/:id" component={EditForm} />
          <Route exact path="/guild-squads/:id/builder" component={props => <Builder phrase={this.props.phrase} {...props} />} />
        </Switch>
      </div>
    )
  }
}

const getAccount = state => state.account.auth

const selector = createSelector(
  getAccount,
  auth => auth,
)

function mapStateToProps(state) {
  return {
    auth: selector(state),
  }
}

const mapDispatchToProps = {
  updateAccount: actions.updateAccount,
}

GuildSquads.defaultProps = {
  auth: false,
  phrase: '',
}

GuildSquads.propTypes = {
  updateAccount: PropTypes.func.isRequired,
  auth: PropTypes.shape(),
  phrase: PropTypes.string,
}

export default connect(mapStateToProps, mapDispatchToProps)(GuildSquads)

