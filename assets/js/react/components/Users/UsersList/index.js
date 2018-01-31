import React from 'react';
import RowItem from './RowItem';

class GuildList extends React.Component {

  render() {
    return (
      <table className="table">
        {this.props.users.map((item) => <RowItem key={item.uuid} item={item} />)}
      </table>
    );
  }
};

export default GuildList;
