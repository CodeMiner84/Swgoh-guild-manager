import React from 'react'
import Placeholder from './Placeholder'
import Switcher from './Switcher'
import TypeModal from '../TypeModal'

class Prototype extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
      showModal: false,
    }
  }

  handleModalClose = () => {
    this.setState({
      showModal: false,
    })
  }

  handleModalShow = () => {
    this.setState({
      showModal: true,
    })
  }

  render() {
    return (
      <div className={'protype'}>
        <Placeholder>
          <Switcher type={'square'} handleModalShow={this.handleModalShow} />
          <Switcher type={'arrow'} handleModalShow={this.handleModalShow} />
          <Switcher type={'diamond'} />
          <Switcher type={'triangle'} />
          <Switcher type={'circle'} />
          <Switcher type={'cross'} />
        </Placeholder>

        {this.state.showModal &&
          <TypeModal handleModalClose={this.handleModalClose} />
        }
      </div>
    )
  }
}

export default Prototype
