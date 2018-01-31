import React from 'react';
import Item from '../../Dashboard/ProductList/Item';
import Filtering from './Filtering';

class ProductList extends React.Component {
  changePhrase = (e) => {
    this.props.changePhrase(e.target.value);
  }

  render() {
    return (
      <div className="row">
        <div>
          <Filtering changePhrase={this.changePhrase} />
        </div>
        {this.props.products.map(item => <Item item={item} />)}
      </div>
    );
  }
}

export default ProductList;
