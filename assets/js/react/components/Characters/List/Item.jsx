import React from 'react';
import BoxItem from './ItemBox';
import Name from './Name';
import Side from './Side';
import Image from './Image';

export default class RowItem extends React.Component {

  render() {
    return (
      <div className="col-xs-6 col-sm-3 col-md-2">
        <BoxItem>
          <Image side={this.props.item.side}><img src={'/' + this.props.item.image} /></Image>
          <Name>{this.props.item.name}</Name>
        </BoxItem>
      </div>
    );
  }
}
