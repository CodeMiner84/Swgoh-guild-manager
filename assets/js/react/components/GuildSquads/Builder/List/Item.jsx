import React from 'react';
import PropTypes from 'prop-types'
import BoxItem from './ItemBox';
import Name from './Name';
import Image from './Image';

class RowItem extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
      active: false,
    }
  }

  toggle = () => {
    const item = this.props.item
    this.setState({
      active: !this.state.active,
    })
    this.props.toggleHandle(item)
  }

  render() {
    let active = false
    if(this.props.active.filter((activeItem) => activeItem.id === this.props.item.id).length > 0) {
      active = true
    }

    return (
      <div className="col-xs-6 col-sm-4 col-md-3 col-lg-2" onClick={() => this.toggle()} >
        <BoxItem active={active}>
          <Image side={this.props.item.side}><img alt={''} src={this.props.item.image} /></Image>
          <Name>{this.props.item.name}</Name>
        </BoxItem>
      </div>
    );
  }
}

RowItem.propTypes = {
  toggleHandle: PropTypes.func.isRequired,
  item: PropTypes.shape.isRequired,
  active: PropTypes.shape.isRequired,
};

export default RowItem
