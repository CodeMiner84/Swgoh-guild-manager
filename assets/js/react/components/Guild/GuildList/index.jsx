import React from 'react';
import Item from './Item';

class GuildList extends React.Component {

  render() {
    return (
      <div className="row">
        {this.props.guilds.map((item) => <Item key={item.code} item={item} />)}
      </div>
    );
  }
};

export default GuildList;
