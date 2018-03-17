import React from 'react'
import PlusMark from './PlusMark'
import Icon from './Icon'
import Image from './Image'
import Legend from './Legend'
import LegendItem from './LegendItem'
import { connect } from 'react-redux'

class Switcher extends React.Component {
  showModal = () => {
    this.props.handleModalShow()
  }

  getImage(mod) {
    if (!mod) {
      return null
    }

    return `/img/mods/mod_${mod.mod.mod}_${mod.type}.png`
  }

  getPrimary = () => {
    if (!this.props.mod) {
      return null
    }
    const primary = this.props.mod.mod.primary
    if (primary) {
      return <LegendItem>I: {this.getStatText('primaryStats', primary)}</LegendItem>
    }
  }

  getSecondary = () => {
    if (!this.props.mod) {
      return null
    }
    const secondary = this.props.mod.mod.secondary
    if (secondary) {
      return <LegendItem>II: {this.getStatText('secondaryStats', secondary)}</LegendItem>
    }
  }

  getStatText = (type, number) => {
    if (number <= 0) {
      return null
    }
    const text = this.props.settings[type][number]
    const splitted = text.split(' ')
    if (splitted.length === 1) {
      return text.slice(0, 2)
    }
    return splitted.reduce((previous, current) => previous.slice(0, 1) + current.slice(0, 1))
  }

  render() {
    const image = this.getImage(this.props.mod)
    
    return (
      <PlusMark onClick={this.showModal} type={this.props.type} active={image ? true : false}>
        <Legend>
          {this.getPrimary()}
          {this.getSecondary()}
        </Legend>
        {image !== null &&
        <Image src={image} alt="" />
        }
        {!(image !== null) &&
          <Icon name={'plus'} />
        }
      </PlusMark>
    )
  }
}

const mapStateToProps = state => ({
  settings: state.mods.settings,
})

export default connect(mapStateToProps, null)(Switcher)
