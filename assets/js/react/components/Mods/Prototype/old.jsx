import React from 'react'
import FontAwesome from 'react-fontawesome'
import { connect } from 'react-redux'
import Placeholder from './Placeholder'
import Remove from './Placeholder/Remove'
import Switcher from './Switcher'
import TypeModal from '../TypeModal'
import SelectorsContainer from './components/SelectorsContainer'
import Selectors from './Selectors'
import Generated from './Generated'
import Template from './components/Template'
import TemplateContainer from './components/TemplateContainer'
import TemplateCol from './components/TemplateCol'
import OverallStats from './OverallStats'

class Prototype extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
      showModal: false,
      modNumber: false,
      stats: this.props.data && this.props.data.stats ? this.props.data.stats : {},
      primary: this.props.data ? this.props.data.primary : null,
      secondary: this.props.data ? this.props.data.secondary : null,
    }

    this.activeItem = 0
  }

  saveModStats = (stat) => {
    const modNumber = this.state.modNumber
    const mods = this.state.stats
    mods[modNumber] = stat

    this.setState({
      stats: mods,
      showModal: false,
    })

    this.props.handleUpdateMod(this.props.number, this.state)
  }

  handleModalShow = (number) => {
    this.setState({
      modNumber: number,
      showModal: true,
    })
  }

  handleModalClose = () => {
    this.setState({
      showModal: false,
    })
  }

  getMod (type) {
    if (!this.state.stats[type]) {
      return null
    }
    return {
      type,
      mod: this.state.stats[type],
    }
  }

  changePrimaryStat = (type) => {
    this.setState({
      primary: type,
    })
    this.props.handleUpdateMod(this.props.number, {
      ...this.state,
      primary: type,
    })
  }

  changeSecondaryStat = (type) => {
    this.setState({
      secondary: type,
    })
    this.props.handleUpdateMod(this.props.number, {
      ...this.state,
      secondary: type,
    })
  }

  removePrototype = () => {
    this.props.removePrototype(this.props.number)
  }

  render() {
    let templates = this.props.templates
    if (this.props.templates.mods !== undefined) {
      templates = JSON.parse(this.props.templates.mods)
    }
    const generated = this.props.number !== null && Object.keys(this.props.generated).length && this.props.generated[this.props.number] !== undefined ? this.props.generated[this.props.number] : {}
    const secondary = this.state.secondary ? this.props.mods.stats[this.state.secondary] : null

    return (
      <div >
        <div >
          <div className={'list-group list-group-flush'}>
            <div className="list-group-item row">
              <TemplateContainer>
                <TemplateCol>
                  <Template>
                    <Placeholder>
                      {this.props.number && templates[this.props.number] !== undefined &&
                      <Remove onClick={this.removePrototype}><FontAwesome name={'trash'}/></Remove>
                      }
                      <Switcher type={'square'} mod={this.getMod(1)} handleModalShow={() => this.handleModalShow(1)} />
                      <Switcher type={'arrow'} mod={this.getMod(2)} handleModalShow={() => this.handleModalShow(2)} />
                      <Switcher type={'diamond'} mod={this.getMod(3)} handleModalShow={() => this.handleModalShow(3)} />
                      <Switcher type={'triangle'} mod={this.getMod(4)} handleModalShow={() => this.handleModalShow(4)} />
                      <Switcher type={'circle'} mod={this.getMod(5)} handleModalShow={() => this.handleModalShow(5)} />
                      <Switcher type={'cross'} mod={this.getMod(6)} handleModalShow={() => this.handleModalShow(6)} />
                    </Placeholder>
                    <SelectorsContainer>
                      <Selectors
                        changePrimary={this.changePrimaryStat} primary={this.state.primary}
                        changeSecondary={this.changeSecondaryStat} secondary={this.state.secondary}
                      />
                      <OverallStats
                        mods={generated}
                        secondary={secondary}
                      />
                    </SelectorsContainer>
                  </Template>
                </TemplateCol>
                {Object.keys(generated).length > 0 &&
                <TemplateCol>
                  <Generated mods={generated} secondary={secondary} />
                </TemplateCol>
                }
              </TemplateContainer>

              {this.state.showModal &&
              <TypeModal saveStat={this.saveModStats} slot={this.state.modNumber} stats={this.state.stats} handleModalClose={this.handleModalClose} />
              }
            </div>
          </div>
        </div>
      </div>
    )
  }
}

const mapStateToProps = state => ({
  mods: state.mods.settings,
  templates: state.mods.mods,
  generated: state.mods.generated,
})

export default connect(mapStateToProps, null)(Prototype)
