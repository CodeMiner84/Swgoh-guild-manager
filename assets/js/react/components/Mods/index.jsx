import React from 'react'
import Prototype from './Prototype'


class Mods extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
      mods: []
    }
  }

  addPrototype = () => {
    const mods = this.state.mods
    mods.push(<Prototype />)

    this.setState({
      mods,
    })
  }

  render() {
    return (
      <div >
        <div className="row">
          <div className="col-xs-12">
            <button className={'btn btn-default'} onClick={this.addPrototype}>+ Add character</button>
          </div>
          <div className="col-xs-12">
            <h3>Items</h3>
            <div className="row">
              {Object.keys(this.state.mods).length > 0 &&
              this.state.mods.filter(item => <div>{item}</div>)}
            </div>
          </div>
        </div>
      </div>
    )
  }

}

export default Mods
