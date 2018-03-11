import React from 'react'
import { connect } from 'react-redux'
import Placeholder from './Placeholder'
import Switcher from './Switcher'
import TypeModal from '../TypeModal'
import Selectors from './Selectors'

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

    this.activeItem = 0;
  }

  handleModalClose = (stat) => {
    const modNumber = this.state.modNumber
    const mods = this.state.stats
    mods[modNumber] = stat
    this.setState({
      showModal: false,
      stats: mods,
    })
    this.props.update(this.props.number, this.state)
  }

  handleModalShow = (number) => {
    this.setState({
      showModal: true,
      modNumber: number,
    })
  }

  getImage (type) {
    if (!this.state.stats[type]) {
      return null
    }
    return '/img/mods/mod_' + this.state.stats[type] + '_' +  type + '.png'
  }

  changePrimaryStat = (type) => {
    this.setState({
      primary: type,
    })
    this.props.update(this.props.number, {
      ...this.state,
      primary: type,
    })
  }

  changeSecondaryStat = (type) => {
    this.setState({
      secondary: type,
    })
    this.props.update(this.props.number, {
      ...this.state,
      secondary: type,
    })
  }

  render() {
    return (
      <div className={'prototype'}>
        <div className={'card'}>
          <div className={'list-group list-group-flush'}>
            <div className={'card-header'}>
              <h3 className={'pull-left'}>TEMPLATE</h3>
            </div>
            <div className="list-group-item row">
              <div className="row">
                <div className={'col-sm-6 col-md-3'}>
                  <Placeholder>
                    <Switcher type={'square'} image={this.getImage(1)} handleModalShow={() => this.handleModalShow(1)} />
                    <Switcher type={'arrow'} image={this.getImage(2)} handleModalShow={() => this.handleModalShow(2)} />
                    <Switcher type={'diamond'} image={this.getImage(3)} handleModalShow={() => this.handleModalShow(3)} />
                    <Switcher type={'triangle'} image={this.getImage(4)} handleModalShow={() => this.handleModalShow(4)} />
                    <Switcher type={'circle'} image={this.getImage(5)} handleModalShow={() => this.handleModalShow(5)} />
                    <Switcher type={'cross'} image={this.getImage(6)} handleModalShow={() => this.handleModalShow(6)} />
                  </Placeholder>
                </div>
                <div className={'col-sm-6 col-md-3'}>
                  <Selectors
                    changePrimary={this.changePrimaryStat} primary={this.state.primary}
                    changeSecondary={this.changeSecondaryStat} secondary={this.state.secondary}
                  />
                </div>
                <div className="col">

                </div>
              </div>

              {this.state.showModal &&
                <TypeModal handleModalClose={this.handleModalClose} />
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
})

export default connect(mapStateToProps, null)(Prototype)
