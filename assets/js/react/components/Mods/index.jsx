import React from 'react'
import uuid from 'uuid'
import { connect } from 'react-redux'
import { createSelector } from 'reselect'
import Prototype from './Prototype'
import actions from '../../actions/mods'
import Loader from '../../components/Loader'
import { Button } from 'react-bootstrap'

class Mods extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
      mods: [],
      stats: [],
    }

    this.protRef = null;
    this.number = 0;
  }

  componentDidMount() {
    this.props.getModsSettings();
    this.props.getMods().then(() => {
      if (this.props.mods) {
        const mods = this.props.mods.mods
        this.setState({
          stats: mods,
        })
        Object.keys(mods).map(key => this.addPrototype(key, mods[key]))
      }
    })
  }

  handleUpdateMod = (number, state) => {
    let updatedStats = this.state.stats
    const stats = this.state.stats
    updatedStats[number] = state
    this.setState({
      stats: updatedStats
    })
  }

  addPrototype = (key, map) => {
    const mods = this.state.mods
    const number = map !== undefined ? map.uuid : uuid.v4()
    
    mods.push(<Prototype handleUpdateMod={this.handleUpdateMod} data={map} removePrototype={this.removePrototype} generated={this.props.generated ? this.props.generated[number] : {}} number={number} />)

    this.setState({
      mods,
    })
  }

  removePrototype = (index) => {
    const stats = this.state.stats
    let activeKey = null
    let iter = 0
    const newMods = []
    const newStats = []

    Object.keys(stats).map(key => {
      if (key !== index) {
        newMods.push(this.state.mods[iter])
        newStats[key] = this.state.stats[key]
      }
      iter++
    })
    this.setState({
      mods: newMods,
      stats: newStats,
    })
    this.props.saveMods(newStats)
    console.log({
      mods: newMods,
      stats: newStats
    });
  }

  save = () => {
    this.props.saveMods(this.getStats())
  }

  getStats(stats = null) {
    const params = [];
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
    this.props.generate();
  }

  render() {
    if (this.props.isLoading) {
      return <Loader />
    }

    const mods = this.state.mods
    
    return (
      <div >
        <div className="container">
          <div className="col-12">
            <button className={'btn btn-default'} onClick={this.addPrototype}>+ Add mod</button>
          </div>
          <div className="col-12">
              {Object.keys(this.state.mods).length > 0 &&
              Object.keys(mods).map(key => <div>{mods[key]}</div>)}
            <Button className={'btn btn-info'} onClick={this.save}>Save</Button>
            <Button className={'btn btn-info'} onClick={this.generate}>Generate mods</Button>
          </div>
        </div>
      </div>
    )
  }
}

const getModsSettings = () => state => state.mods.settings
const getUserMods = () => state => state.mods.mods
const getGeneratedMods = () => state => state.mods.generated

const selector = createSelector(
  [getModsSettings(), getUserMods(), getGeneratedMods()],
  (settings, mods, generated) => ({
    settings, mods, generated
  }),
)

function mapStateToProps(state) {
  return {
    mods: selector(state),
  }
}

const mapDispatchToProps = {
  getModsSettings: actions.getSettings,
  saveMods: actions.saveMods,
  getMods: actions.getMods,
  generate: actions.generate,
}

export default connect(mapStateToProps, mapDispatchToProps)(Mods)
