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
    const updatedSatats = this.state.stats
    console.log('updatedSatats', this.state);
    const stats = this.state.stats
    const tmp = Object.keys(stats).filter(key => stats[key].uuid === number)
    const arrKey = tmp.shift() || 0

    updatedSatats[arrKey] = {
      ...state,
      uuid: number
    }
    // this.setState({
    //   stats: updatedSatats
    // })
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
    const stateMods = this.state.stats
    const stats = []
    const tmp = Object.keys(stateMods).filter(key => key !== index)
    Object.keys(stateMods).filter(key => console.log('key', key))
    this.setState({
      stats,
      mods: stats,
    })
    this.props.saveMods(this.getStats(stats))
    this.setState({
      state: null,
      mods: null,
    })
    stats.map((map, key) => this.addPrototype(key, map))
  }

  save = () => {
    console.log('SAVE');
    console.log('this.getStats()', this.getStats());
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
    console.log('maps', maps);
    Object.keys(maps).map(key => params.push({
      uuid: maps[key].uuid || key,
      stats: maps[key].stats,
      primary: maps[key].primary,
      secondary: maps[key].secondary,
    }))

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
