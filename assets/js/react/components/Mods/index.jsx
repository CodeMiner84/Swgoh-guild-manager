import React from 'react'
import uuid from 'uuid'
import { Link } from 'react-router-dom'
import ReactTimeout from 'react-timeout'
import { Button } from 'react-bootstrap'
import { connect } from 'react-redux'
import { createSelector } from 'reselect'
import Prototype from './Prototype'
import actions from '../../actions/mods'
import Loader from '../../components/Loader'
import Buttons from './Prototype/components/Buttons'
import { confirmAlert } from 'react-confirm-alert'

class Mods extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
      stats: [],
    }

    this.protRef = null
    this.number = 0
  }

  componentDidMount() {
    this.props.getModsSettings()
    this.props.getMods().then((response) => {
      if (this.props.mods) {
        const mods = this.props.mods.mods
        this.setState({
          stats: mods,
        })
      }
    })
  }

  handleUpdateMod = (number, state) => {
    const updatedStats = this.state.stats
    const stats = this.state.stats
    updatedStats[number] = state
    this.setState({
      stats: updatedStats,
    })
  }

  addPrototype = (key, map) => {
    const number = map !== undefined ? map.uuid : uuid.v4()

    const stats = this.state.stats
    stats[number] = {
      modNumber: 0,
      stats: {},
      primary: null,
      secondary: null,
    }

    this.setState({
      stats,
    })
  }

  removePrototype = (index) => {
    const stats = this.state.stats
    let iter = 0
    const newStats = []

    Object.keys(stats).map((key) => {
      if (key !== index) {
        newStats[key] = this.state.stats[key]
      }
      iter++
    })
    this.setState({
      stats: {},
    })

    this.props.setTimeout(() => {
      this.setState({
        stats: newStats,
      })
    }, 10)
    this.props.saveMods(newStats)
  }

  save = () => {
    this.props.saveMods(this.getStats())
  }

  getStats(stats = null) {
    const params = []
    let maps = []
    if (!stats) {
      maps = this.state.stats
    } else {
      maps = stats
    }
    Object.keys(maps).map(key => params[maps[key].uuid || key] = {
      uuid: maps[key].uuid || key,
      stats: maps[key].stats,
      primary: maps[key].primary,
      secondary: maps[key].secondary,
    })

    return params
  }

  generate = () => {
    this.props.generate()
  }

  synchronizeMods = () => {
    this.props.synchronizeMods().then((response) => {
      if (response.payload.code === 200) {
        this.syncAlert(true)
      } else {
        this.syncAlert(false)
      }
    }, this)
  }

  syncAlert = (success) => {
    confirmAlert({
      message: success ? 'Your mods will be fetched' : 'Your request is added to queue. Please wait',
      cancelLabel: 'OK',
    })
  }

  render() {
    if (this.props.isLoading) {
      return <Loader />
    }

    if (!this.props.auth.uuid) {
      return (
        <div className="alert alert-danger">
          You need to map your user uuid <Link to={'/account'}>HERE</Link>
        </div>
      )
    }

    return (
      <div >
        <div className="row">

          <divstats className="col-12">
            <button className={'btn btn-default mr-20'} onClick={this.addPrototype}>+ Add mod</button>
            <button className={'btn btn-info'} onClick={this.synchronizeMods}>Synchronize mods</button>
          </divstats>
          <Buttons>
            <Button className={'btn btn-primary mr-20'} onClick={this.save}>Save</Button>
            <Button className={'btn btn-success'} onClick={this.generate}>Generate mods</Button>
          </Buttons>
          <div className="col-12">
            {Object.keys(this.state.stats).map(number =>
              <Prototype
                templates={this.state.stats}
                handleUpdateMod={this.handleUpdateMod}
                data={this.state.stats[number]}
                removePrototype={this.removePrototype}
                generated={this.props.generated ? this.props.generated[number] : {}}
                number={number}
              />,
            )}
          </div>
        </div>
      </div>
    )
  }
}

const getModsSettings = () => state => state.mods.settings
const getUserMods = () => state => state.mods.mods
const getGeneratedMods = () => state => state.mods.generated
const getAccount = () => state => state.account.auth

const selector = createSelector(
  [getModsSettings(), getUserMods(), getGeneratedMods(), getAccount()],
  (settings, mods, generated, auth) => ({
    settings, mods, generated, auth,
  }),
)
const authSelector = createSelector(
  [getAccount()],
  auth => auth,
)

function mapStateToProps(state) {
  return {
    mods: selector(state),
    auth: authSelector(state),
  }
}

const mapDispatchToProps = {
  getModsSettings: actions.getSettings,
  saveMods: actions.saveMods,
  getMods: actions.getMods,
  generate: actions.generate,
  synchronizeMods: actions.synchronizeMods,
}

export default connect(mapStateToProps, mapDispatchToProps)(ReactTimeout(Mods))
