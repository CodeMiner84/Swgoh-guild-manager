import React from 'react'
import PlusMark from './PlusMark'
import Icon from './Icon'
import Image from './Image'

export default class Switcher extends React.Component {
  showModal = () => {
    this.props.handleModalShow()
  }

  render() {
    return (
      <PlusMark onClick={this.showModal} type={this.props.type} active={this.props.image}>
        {this.props.image !== null &&
        <Image src={this.props.image} alt=""/>
        }
        {!(this.props.image !== null) &&
          <Icon name={'plus'}/>
        }
      </PlusMark>
    )
  }

}
