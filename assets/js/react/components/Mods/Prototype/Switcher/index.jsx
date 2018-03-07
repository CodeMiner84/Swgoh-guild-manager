import React from 'react'
import PlusMark from './PlusMark'
import Icon from './Icon'

export default class Switcher extends React.Component {
  showModal = () => {
    this.props.handleModalShow()
  }

  render() {
    return (
      <PlusMark onClick={this.showModal} type={this.props.type}>
        <Icon name={'plus'} />
      </PlusMark>
    )
  }

}
